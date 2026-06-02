<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Application;

class FixApplicationStatus extends Command
{
    protected $signature = 'app:fix-application-status {reference_no? : Application reference number}';
    protected $description = 'Fix application status from PENDING_APPROVAL to VERIFIED for director dashboard visibility';

    public function handle()
    {
        $referenceNo = $this->argument('reference_no');

        if ($referenceNo) {
            // Fix specific application
            $application = Application::where('reference_no', $referenceNo)->first();

            if (!$application) {
                $this->error("Application {$referenceNo} not found!");
                return 1;
            }

            if ($application->status === 'PENDING_APPROVAL') {
                $application->update(['status' => 'VERIFIED']);
                $this->info("✓ Application {$referenceNo} status updated to VERIFIED");
                return 0;
            }

            $this->info("Application {$referenceNo} is already in status: {$application->status}");
            return 0;
        }

        // Fix all applications with PENDING_APPROVAL status
        $count = Application::where('status', 'PENDING_APPROVAL')->update(['status' => 'VERIFIED']);

        if ($count > 0) {
            $this->info("✓ Updated {$count} application(s) from PENDING_APPROVAL to VERIFIED");

            // Show the updated applications
            $applications = Application::where('status', 'VERIFIED')
                ->latest()
                ->limit(10)
                ->get(['reference_no', 'tajuk', 'status', 'created_at']);

            $this->table(
                ['Reference No', 'Title', 'Status', 'Created At'],
                $applications->map(fn($app) => [
                    $app->reference_no,
                    substr($app->tajuk, 0, 30) . (strlen($app->tajuk) > 30 ? '...' : ''),
                    $app->status,
                    $app->created_at->format('Y-m-d H:i')
                ])->toArray()
            );

            return 0;
        }

        $this->info('No applications with PENDING_APPROVAL status found.');
        return 0;
    }
}
