<?php

namespace App\Console\Jobs;


use App\Models\Assignment;
use App\Models\Week;
use App\Services\AssignmentService;

class CreateAssignmentsJob {
    public function __invoke() {
        $week = Week::current()->next;
        $service = new AssignmentService();
        $result = $service->generateForWeek($week);
        if ($result === null) return;
        foreach ($result as [$user, $task]) {
            Assignment::create([
                'user_id' => $user->id,
                'task_id' => $task->id,
                'week_id' => $week->id
            ]);
        }
    }
}
