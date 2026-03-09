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
     * Mark the application as officially FILED in the system.
     */
    public function markAsFiled(Request $request, Application $application)
    {
        DB::beginTransaction();
        try {
            if (! in_array($application->status, ['APPROVED', 'REJECTED'])) {
                abort(403, 'Application must be APPROVED or REJECTED to be filed.');
            }

            $this->stateMachine->transitionTo(
                $application,
                'FILED',
                'Application Dossier completely compiled and FILED by Clerk '.Auth::user()->name.'.'
            );

            DB::commit();

            return redirect()->route('filings.show', $application)->with('success', 'Application marked as FILED and locked.');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Error filing application: '.$e->getMessage());
        }
    }
}
