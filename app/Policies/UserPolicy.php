<?php

namespace App\Policies;


use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy implements Policy {
    public function viewAny(?User $user): Response {
        return $user === null ?
            Response::deny("Unauthenticated") :
            Response::allow();
    }

    public function view(?User $user, $object): Response {
        return $this->viewAny($user);
    }

    public function create(?User $user): Response {
        if ($user === null) return Response::deny("Authentication required");
        return $user->role === 'admin' ?
            Response::allow() :
            Response::deny("Only admins allowed");
    }

    public function update(?User $user, $object): Response {
        if ($user === null) return Response::deny("Authentication required");
        return $user->role === 'admin' ?
            Response::allow() :
            Response::deny("Only admins allowed");
    }

    public function delete(?User $user, $object): Response {
        if ($user === null) return Response::deny("Authentication required");
        if ($user->role !== 'admin') return Response::deny("Only admins allowed");
        if ($object->role === 'admin' && User::query()
                ->where('id', '!=', $object->id)
                ->where('role', 'admin')
                ->doesntExist()
        ) return Response::deny("Cannot remove last admin");
        return Response::allow();
    }
}
