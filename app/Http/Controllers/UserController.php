<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends CRUDController {
    protected $model = User::class;
    protected $views = 'users';

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
}
