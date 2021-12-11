<?php

namespace App\Http\Controllers;


use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

abstract class CRUDController extends Controller {
    protected $model = null;
    protected $views = null;

    private function getModel() {
        if ($this->model === null) {
            throw new Exception(sprintf("Model is not defined for %s", get_class($this)));
        } else {
            return $this->model;
        }
    }

    private function getView($name = null) {
        if ($this->views === null) {
            throw new Exception(sprintf("View-space is not defined for %s", get_class($this)));
        } elseif ($name === null) {
            return $this->views;
        } else {
            return sprintf("%s.%s", $this->views, $name);
        }
    }

    private function updateModel(Model $model, Request $request) {
        $data = $request->input();
        foreach ($data as $key => $value) {
            if ($model->isRelation($key)) {
                $relation = $model->{$key}();
                if (method_exists($relation, 'sync')) {
                    $relation->sync($value === null ? [] : $value);
                } else {
                    $relation->associate($value);
                }
            } elseif ($model->isFillable($key)) {
                $model->{$key} = $value;
            } elseif (!Str::startsWith($key, '_')) {
                throw new Exception("Parameter ${key} could not be persisted");
            }
        }
        $model->save();
    }

    public function list(Request $request) {
        $response = Gate::inspect('viewAny', $this->getModel());
        if ($response->denied()) {
            return view('errors.unauthorized', [
                'message' => $response->message(),
            ]);
        } else {
            return view($this->getView('list'), [
                'items' => $this->getModel()::all(),
            ]);
        }
    }

    public function show(Request $request, string $id) {
        /** @var Model $instance */
        $instance = $this->getModel()::find($id);
        if (!$instance) {
            return view('errors.not-found');
        }

        $response = Gate::inspect('view', $instance);
        if ($response->denied()) {
            return view('errors.unauthorized', [
                'message' => $response->message(),
            ]);
        } else {
            return view($this->getView('show'), ['item' => $instance]);
        }
    }

    public function create(Request $request) {
        $response = Gate::inspect('create', $this->getModel());
        if ($response->denied()) {
            return view('errors.unauthorized', [
                'message' => $response->message(),
            ]);
        } else if ($request->method() === 'POST') {
            /** @var Model $instance */
            $instance = new ($this->getModel());
            $this->updateModel($instance, $request);
            return redirect()->route($this->getView());
        } else {
            return view($this->getView('create'), ['item' => new ($this->getModel())]);
        }
    }

    public function update(Request $request, string $id) {
        /** @var Model $instance */
        $instance = $this->getModel()::find($id);
        if (!$instance) {
            return view('errors.not-found');
        }

        $response = Gate::inspect('update', $instance);
        if ($response->denied()) {
            return view('errors.unauthorized', [
                'message' => $response->message(),
            ]);
        } else if ($request->method() === 'POST') {
            $this->updateModel($instance, $request);
            return redirect()->route($this->getView());
        } else {
            return view($this->getView('update'), ['item' => $instance]);
        }
    }

    public function delete(Request $request, string $id) {
        /** @var Model $instance */
        $instance = $this->getModel()::find($id);
        if (!$instance) {
            return view('errors.not-found');
        }

        $response = Gate::inspect('delete', $instance);
        if ($response->denied()) {
            return view('errors.unauthorized', [
                'message' => $response->message(),
            ]);
        } else {
            $instance->delete();
            return redirect()->route($this->getView());
        }
    }
}
