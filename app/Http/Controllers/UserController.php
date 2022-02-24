<?php

namespace App\Http\Controllers;


use App\Models\User;
use Cerebralfart\LaravelCRUD\CRUDController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class UserController extends CRUDController {
    protected $model = User::class;
    protected $views = 'users';

    // TODO: Ensure there is always one admin left after updates and deletes, otherwise throw an error

    public function destroy(Request $request) {
        $instance = $this->resolveModel($request);
        $this->authorize('delete', $instance);

        $instance->email = sprintf('removed-%s@grafzicht.nl', date('U'));
        $instance->save();
        $instance->delete();

        return $this->redirect('index');
    }

    public function order(Request $request) {
        $response = Gate::authorize('order', User::class);
        if ($response->denied()) {
            return view('errors.unauthorized', [
                'message' => $response->message(),
            ]);
        }

        if ($request->isMethod('POST')) {
            $items = $request->get('users');
            DB::transaction(function () use ($items) {
                foreach ($items as $order => $id) {
                    $user = User::findOrFail($id);
                    $user->order = $order;
                    $user->save();
                }
            });
            return redirect()->route('users');
        } else {
            return view('users.order', [
                'items' => User::all()
            ]);
        }
    }
}
