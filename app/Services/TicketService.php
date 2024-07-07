<?php

namespace App\Services;

use App\Models\Ticket;
use App\Repositories\TicketRepository;

class TicketService
{
    protected $ticketRepository;

    function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    public function getAllTicketsPaginate($filters)
    {
        return $this->ticketRepository->all($filters)->paginate();
    }

    public function createNewTicket($request) {

        $user_id = $request->user()->is_manager
            ? $request->validated("data.relationships.author.data.id")
            : $request->user()->id;


        $model = [
            "title" => $request->validated("data.attributes.title"),
            "description" => $request->validated("data.attributes.description"),
            "status" => $request->validated("data.attributes.status"),
            "user_id" => $user_id,
        ];

        return $this->ticketRepository->create($model);
    }

    public function findTicketById($id) {
        return $this->ticketRepository->find($id, 'author');
    }

    public function authorizedTo($action, $resource) {

        if (request()->user()->cannot($action, $resource)) {
            return false;
        }

        return true;
    }

    public function updateTicket(Ticket $ticket, $attributes) {

        return $this->ticketRepository->update($ticket, $attributes);

    }

    public function deleteTicket(Ticket $ticket) {
        return $this->ticketRepository->delete($ticket);
    }

}
