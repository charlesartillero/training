<?php

namespace App\Repositories;

use App\Filters\V1\AuthorFilter;
use App\Filters\V1\QueryFilter;
use App\Interfaces\AuthorRepositoryInterface;
use App\Models\User;

class AuthorRepository implements AuthorRepositoryInterface
{
    public function all(AuthorFilter $filters) {
        return User::filter($filters);
    }

    public function find(string $id) {
        return User::find($id);
    }
}
