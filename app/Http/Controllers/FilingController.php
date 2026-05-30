<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Services\AuditLogService;
use App\Services\StateMachineService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FilingController extends Controller
{
    protected StateMachineService $stateMachine;

    protected AuditLogService $auditLog;

    public function __construct(StateMachineService $stateMachine, AuditLogService $auditLog)
    {
        $this->stateMachine = $stateMachine;
        $this->auditLog = $auditLog;
    }

    /**
     * Display applications ready for filing.
     */
    public function index()
    {
        $applications = Application::with('developer')
            ->whereIn('status', ['APPROVED', 'REJECTED', 'FILED'])
            ->latest()
            ->paginate(15);

        return view('filings.index', compact('applications'));
    }

    /**
     * Show the filing prep screen and dossier view.
     */
    public function show(Application $application)
    {
        if (! in_array($application->status, ['APPROVED', 'REJECTED', 'FILED'])) {
            abort(403, 'Application must have a final decision before it can be filed.');
        }

        $application->load(['developer', 'siteVisits.officer', 'reviews.officer', 'verifications.assistantDirector', 'approvals.director', 'auditLogs.user']);

        return view('filings.show', compact('application'));
    }

    /**
     * Preview the PDF Dossier as HTML without downloading.
     */
    public function previewPdf(Application $application)
    {
        if (! in_array($application->status, ['APPROVED', 'REJECTED', 'FILED'])) {
            abort(403, 'Application must have a final decision for PDF compilation.');
        }

        $application->load(['developer', 'site', 'siteVisits.officer', 'reviews.officer', 'verifications.assistantDirector', 'approvals.director']);

        return view('filings.pdf_template', compact('application'));
    }

    /**
     * Generate the complete PDF Dossier for the application.
     */
    public function generatePdf(Application $application)
    {
        if (! in_array($application->status, ['APPROVED', 'REJECTED', 'FILED'])) {
            abort(403, 'Application must have a final decision for PDF compilation.');
        }

        $application->load(['developer', 'site', 'siteVisits.officer', 'reviews.officer', 'verifications.assistantDirector', 'approvals.director']);

        $pdf = Pdf::loadView('filings.pdf_template', compact('application'));

        return $pdf->download('SVRMS_Dossier_'.str_replace('/', '_', $application->reference_no).'.pdf');
    }

    /**
     * Mark the application as officially FILED in the system and generate PDF(s).
     */
    public function markAsFiled(Request $request, Application $application)
    {
        if (! in_array($application->status, ['APPROVED', 'REJECTED'])) {
            abort(403, 'Application must be APPROVED or REJECTED to be filed.');
        }

        $validated = $request->validate([
            'include_laporan' => 'nullable|in:1',
            'include_surat_balas' => 'nullable|in:1',
            'ruj_kami' => 'required_if:include_surat_balas,1|nullable|string|max:255',
            'addressed_to' => 'required_if:include_surat_balas,1|nullable|in:YDP,SU,PENGARAH',
        ]);

        $includeLaporan = $request->has('include_laporan');
        $includeSuratBalas = $request->has('include_surat_balas');

        if (!$includeLaporan && !$includeSuratBalas) {
            return back()->with('error', 'Please select at least one document to print.');
        }

        try {
            $application->load(['developer', 'site', 'siteVisits.officer', 'reviews.officer', 'verifications.assistantDirector', 'approvals.director']);

            $pdf = null;

            if ($includeLaporan && $includeSuratBalas) {
                // Generate combined PDF with both laporan and surat balas
                $pdf = Pdf::loadView('filings.combined_pdf_template', [
                    'application' => $application,
                    'ruj_kami' => $validated['ruj_kami'] ?? '',
                    'addressed_to' => $validated['addressed_to'] ?? '',
                ]);
            } elseif ($includeLaporan) {
                // Generate laporan only
                $pdf = Pdf::loadView('filings.pdf_template', compact('application'));
            } elseif ($includeSuratBalas) {
                // Generate surat balas only
                $pdf = Pdf::loadView('filings.surat_balas_template', [
                    'application' => $application,
                    'ruj_kami' => $validated['ruj_kami'],
                    'addressed_to' => $validated['addressed_to'],
                ]);
            }

            // Transition status to FILED
            DB::transaction(function () use ($application) {
                $this->stateMachine->transitionTo(
                    $application,
                    'FILED',
                    'Application Dossier completely compiled and FILED by Clerk '.Auth::user()->name.'.'
                );
            });

            // Return the PDF download
            $filename = 'SVRMS_Dossier_'.str_replace('/', '_', $application->reference_no).'.pdf';
            return $pdf->download($filename);

        } catch (\Exception $e) {
            return back()->with('error', 'Error filing application: '.$e->getMessage());
        }
    }
}
