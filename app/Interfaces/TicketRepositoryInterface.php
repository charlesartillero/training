<?php

namespace App\Interfaces;

use App\Filters\V1\TicketFilter;
use App\Models\Ticket;

interface TicketRepositoryInterface
{
    public function all(TicketFilter $filters);

    public function create($attributes);
    public function find(string $id, string $relation = '');
    public function update(Ticket $ticket, array $attributes);
    public function delete(Ticket $ticket);
}
