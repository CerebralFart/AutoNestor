<?php

namespace App\Policies;


use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskPolicy implements Policy {
    public function viewAny(?User $user): Response {
        return Response::allow();
    }

    public function view(?User $user, $object): Response {
        return Response::allow();
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
        return $user->role === 'admin' ?
            Response::allow() :
            Response::deny("Only admins allowed");
    }
}
