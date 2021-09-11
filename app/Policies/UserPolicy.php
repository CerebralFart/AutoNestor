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
        return Response::allow(); // TODO
    }

    public function update(?User $user, $object): Response {
        return Response::allow(); // TODO
    }

    public function delete(?User $user, $object): Response {
        return Response::allow(); // TODO
    }
}
