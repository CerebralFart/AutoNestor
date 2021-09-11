<?php

namespace App\Policies;


use App\Models\User;
use Illuminate\Auth\Access\Response;

interface Policy {
    public function viewAny(?User $user): Response;

    public function view(?User $user, $object): Response;

    public function create(?User $user): Response;

    public function update(?User $user, $object): Response;

    public function delete(?User $user, $object): Response;
}
