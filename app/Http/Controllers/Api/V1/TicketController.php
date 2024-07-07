<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\TicketFilter;
use App\Http\Requests\Api\V1\StoreTicketRequest;
use App\Http\Requests\Api\V1\UpdateTicketRequest;
use App\Http\Resources\V1\TicketResource;
use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TicketController extends ApiController
{
    protected $ticketService;

    function __construct(TicketService $service)
    {
        $this->ticketService = $service;
    }

    /**
     * Get all tickets
     *
     * @group Managing Tickets
     * @queryParam sort string Data field(s) to sort by.
     * Seperate multiple fields with commas, Denote descending sort with a minus sign.
     * Example: title, -createdAt
     */
    public function index(TicketFilter $filters)
    {
        $tickets = $this->ticketService->getAllTicketsPaginate($filters);

        return TicketResource::collection($tickets);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        $ticket = $this->ticketService->createNewTicket($request);

        return new TicketResource($ticket);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $ticket)
    {
        $ticket = $this->ticketService->findTicketById($ticket);

        if ($ticket === null) {
            return $this->error("Ticket not found", 404);
        }

        return new TicketResource($ticket);

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, string $ticket)
    {
        $ticket = $this->ticketService->findTicketById($ticket);

        if ($ticket === null) {
            return $this->error("Ticket not found", 404);
        }


        if (! $this->ticketService->authorizedTo('update', $ticket)) {
            return $this->error("You do not have permission to update ticket", 403);
        }

        $updateTicket = $this->ticketService->updateTicket($ticket, $request->validated('data.attributes'));


        if (! $updateTicket) {
            return $this->error("Failed to update ticket", 500);
        }

        return $this->success("Ticket updated successfully");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $ticket)
    {

        $ticket = $this->ticketService->findTicketById($ticket);

        if ($ticket === null) {
            return $this->error("Ticket not found", 404);
        }

        if (! $this->ticketService->authorizedTo('delete', $ticket)) {
            return $this->error("You do not have permission to delete this ticket", 403);
        }

        $this->ticketService->deleteTicket($ticket);

        return $this->success("Ticket deleted successfully");


    }
}
