<?php

namespace App\Repositories;

use App\Filters\V1\TicketFilter;
use App\Interfaces\TicketRepositoryInterface;
use App\Models\Ticket;

class TicketRepository implements TicketRepositoryInterface
{

    public function all(TicketFilter $filters) {
        return Ticket::filter($filters);
    }

    public function create($attributes)
    {
        return Ticket::create($attributes);
    }

    public function find(string $id, string $relation = '')
    {
        return Ticket::with($relation)->find($id);
    }

    public function update(Ticket $ticket, $attributes) {
        return $ticket->update($attributes);
    }

    public function delete(Ticket $ticket) {
        return $ticket->delete();
    }
}
