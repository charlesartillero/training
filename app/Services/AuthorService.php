<?php

namespace App\Services;

use App\Filters\V1\AuthorFilter;
use App\Interfaces\AuthorRepositoryInterface;
use App\Repositories\AuthorRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;

class AuthorService
{
    protected AuthorRepositoryInterface $authorRepository;

    function __construct(AuthorRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function getAllPaginate(AuthorFilter $filters) {
        return $this->authorRepository->all($filters)->paginate();
    }

    public  function getById($id) {

        return  $this->authorRepository->find($id);

    }



}
