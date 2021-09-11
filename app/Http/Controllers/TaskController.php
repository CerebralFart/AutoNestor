<?php

namespace App\Http\Controllers;


use App\Models\Task;

class TaskController extends CRUDController {
    protected $model = Task::class;
    protected $views = 'tasks';
}
