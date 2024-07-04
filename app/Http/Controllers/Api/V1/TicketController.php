<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\TicketFilter;
use App\Http\Requests\Api\V1\StoreTicketRequest;
use App\Http\Requests\Api\V1\UpdateTicketRequest;
use App\Http\Resources\V1\TicketResource;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TicketController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(TicketFilter $filters)
    {
        $tickets = Ticket::filter($filters);

        return TicketResource::collection($tickets->paginate());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {

        $user_id = $request->user()->is_manager
            ? $request->validated("data.relationships.author.data.id")
            : $request->user()->id;


        $model = [
            "title" => $request->validated("data.attributes.title"),
            "description" => $request->validated("data.attributes.description"),
            "status" => $request->validated("data.attributes.status"),
            "user_id" => $user_id,
        ];

        return new TicketResource(Ticket::create($model));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $ticket)
    {
        try {
            $ticket = Ticket::with('author')->findorFail($ticket);
            return new TicketResource($ticket);

        } catch (ModelNotFoundException $e) {
            return $this->error("Ticket not found.",404);
        }

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, string $ticket)
    {

        try {
            $ticket = Ticket::findorFail($ticket);

            if ($request->user()->cannot('update', $ticket)) {
                return $this->error("You don't have permission to update this ticket.",403);
            }

            $ticket->update($request->validated("data.attributes"));

            return new TicketResource($ticket);

        } catch (ModelNotFoundException $e) {
            return $this->error("Ticket not found.",404);
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $ticket)
    {

        try {
            $ticket = Ticket::findorFail($ticket);

            if ($request->user()->cannot('delete', $ticket)) {
                return $this->error("You don't have permission to delete this ticket.",403);
            }

            $ticket->delete();

            return $this->ok("Ticket deleted successfully.");

        } catch (ModelNotFoundException $e) {
            return $this->error("Ticket not found.",404);
        }



    }
}
