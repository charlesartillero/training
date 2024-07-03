<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\TicketFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreTicketRequest;
use App\Http\Resources\V1\TicketResource;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class AuthorTicketsController extends ApiController
{
    public function index($author_id, TicketFilter $filters) {

        $tickets = Ticket::where('user_id', $author_id)->filter($filters);

        return TicketResource::collection($tickets->paginate());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($author_id, StoreTicketRequest $request)
    {

        try {
            $user = User::findorFail($author_id);
        } catch (ModelNotFoundException $e) {
            return $this->ok("User no found", [
               'error' => 'The provided user is does not exists.'
            ]);
        }

        $model = [
            "title" => $request->validated("data.attributes.title"),
            "description" => $request->validated("data.attributes.description"),
            "status" => $request->validated("data.attributes.status"),
            "user_id" => $author_id,
        ];


        return new TicketResource(Ticket::create($model));
    }
}
