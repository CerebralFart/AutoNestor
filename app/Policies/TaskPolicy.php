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
        return Response::allow("Still to implement"); // TODO
    }

    public function update(?User $user, $object): Response {
        return Response::allow("Still to implement"); // TODO
    }

    public function delete(?User $user, $object): Response {
        return Response::allow("Still to implement"); // TODO
    }
}
