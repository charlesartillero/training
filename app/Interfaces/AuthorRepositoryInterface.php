<?php

namespace App\Interfaces;

use App\Filters\V1\AuthorFilter;
use App\Models\User;

interface AuthorRepositoryInterface
{
    public function all(AuthorFilter $filters);
    public function find(string $id);
}
