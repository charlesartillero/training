<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\TicketFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\TicketResource;
use App\Models\Ticket;
use Illuminate\Http\Request;

class AuthorTicketsController extends Controller
{
    public function index($author_id, TicketFilter $filters) {

        $tickets = Ticket::where('user_id', $author_id)->filter($filters);

        return TicketResource::collection($tickets->paginate());

    }
}
