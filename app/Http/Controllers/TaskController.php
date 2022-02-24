<?php

namespace App\Http\Controllers;


use App\Models\Task;
use Cerebralfart\LaravelCRUD\CRUDController;

class TaskController extends CRUDController {
    protected $model = Task::class;
    protected $views = 'tasks';
}
