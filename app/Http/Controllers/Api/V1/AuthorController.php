<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\AuthorFilter;
use App\Http\Requests\Api\V1\StoreUserRequest;
use App\Http\Requests\Api\V1\UpdateUserRequest;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use App\Services\AuthorService;
use Illuminate\Http\Response;


class AuthorController extends ApiController
{
    /**
     * Display a listing of the resource.
     */

    protected AuthorService $authorService;

    function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    public function index(AuthorFilter $filters)
    {
        $authors = $this->authorService->getAllPaginate($filters);

        return UserResource::collection($authors);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $author)
    {
        $author = $this->authorService->getById($author);

        if ($author === null) {
            return $this->error("NOT FOUND AUTHOR", Response::HTTP_NOT_FOUND);
        }

        return new UserResource($author);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
