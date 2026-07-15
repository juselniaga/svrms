<?php

namespace App\Services;

use App\Models\Application;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

class AuditLogService
{
    /**
     * Log a state transition or action for an application, capturing snapshot differencing.
     */
    public function logTransition(
        Application $application,
        string $action,
        ?string $previousStatus = null,
        ?string $newStatus = null,
        ?array $snapshotOld = null,
        ?array $snapshotNew = null,
        ?string $remarks = null
    ): AuditLog {
        return AuditLog::create([
            'application_id' => $application->application_id,
            'user_id' => Auth::id(), // captures the currently logged-in actor
            'action' => $action,
            'previous_status' => $previousStatus ?? $application->getOriginal('status'),
            'new_status' => $newStatus ?? $application->status,
            'snapshot_old' => $snapshotOld ? json_encode($snapshotOld) : null,
            'snapshot_new' => $snapshotNew ? json_encode($snapshotNew) : null,
            'remarks' => $remarks,
        ]);
    }

    /**
     * Automatically capture the diff of an eloquence model and log it.
     */
    public function logModelChanges(Application $application, string $action, ?string $remarks = null): AuditLog
    {
        // Get the original attributes before they were changed
        $original = $application->getOriginal();
        // Get the attributes that were actually changed
        $changes = $application->getChanges();

        $snapshotOld = [];
        $snapshotNew = [];

        foreach ($changes as $key => $value) {
            // Only map keys that exist in the original array (ignores 'updated_at' if we want, etc)
            if (array_key_exists($key, $original)) {
                $snapshotOld[$key] = $original[$key];
                $snapshotNew[$key] = $value;
            }
        }

        return $this->logTransition(
            $application,
            $action,
            $original['status'] ?? null,
            $application->status,
            $snapshotOld,
            $snapshotNew,
            $remarks
        );
    }
}
