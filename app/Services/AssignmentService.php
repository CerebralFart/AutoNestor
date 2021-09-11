<?php

namespace App\Services;


use App\Models\Assignment;
use App\Models\Task;
use App\Models\User;
use App\Models\Veto;
use App\Models\Week;
use Kickin\Hungarian\Algo\Hungarian;
use Kickin\Hungarian\Matrix\MatrixBuilder;
use Kickin\Hungarian\Result\ResultSet;

class AssignmentService {
    private const BASE_RATE = 100;

    private $hungarian;

    public function __construct() {
        $this->hungarian = new Hungarian();
    }

    public function generateForWeek(Week $week): ?ResultSet {
        // Don't generate assignments if they already exist
        if ($week->assignments()->exists()) return null;

        $builder = new MatrixBuilder();
        $builder->setColSource(Task::all()->all());
        $builder->setRowSource(User::all()->all());
        $builder->setMappingFunction(function (User $user, Task $task) use ($week) {
            if (Veto::query()->where([
                'user_id' => $user->id,
                'task_id' => $task->id,
            ])->exists()) return 0;

            /** @var Assignment $last */
            $last = Assignment::query()
                ->where([
                    'user_id' => $user->id,
                    'task_id' => $task->id,
                ])
                ->where('week_id', '<', $week->id)
                ->orderBy('week_id', 'DESC')
                ->first();

            if ($last === null) return 2 * self::BASE_RATE;
            return self::BASE_RATE + $last->week->weeksUntil($week);
        });

        $matrix = $builder->build();
        var_dump($matrix);
        $matrix->shuffle();
        return $this->hungarian->solveMax($matrix)->withoutUnassigned();
    }
}
