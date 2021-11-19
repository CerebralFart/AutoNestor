<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class UserController extends CRUDController {
    protected $model = User::class;
    protected $views = 'users';

    // TODO: Ensure there is always one admin left after updates and deletes, otherwise throw an error

    public function delete(Request $request, string $id) {
        /** @var Model $instance */
        $instance = User::find($id);
        if (!$instance) {
            return view('errors.not-found');
        }

        $response = Gate::inspect('delete', $instance);
        if ($response->denied()) {
            return view('errors.unauthorized', [
                'message' => $response->message(),
            ]);
        } else {
            $instance->email = sprintf('removed-%s@grafzicht.nl', date('U'));
            $instance->save();
            $instance->delete();
            return redirect()->route('users');
        }
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
