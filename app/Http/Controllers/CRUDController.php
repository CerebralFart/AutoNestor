<?php

namespace App\Http\Controllers;


use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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
            $instance->fill($request->only($instance->fillable));
            $instance->save();
            return redirect()->route($this->getView());
        } else {
            return view($this->getView('create'));
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
            $instance->fill($request->only($instance->fillable));
            $instance->save();
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
