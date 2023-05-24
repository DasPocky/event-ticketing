<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TicketGroupController extends Controller
{
    public function create($event)
    {
        return view('organizer.ticket-groups.create', [
            'event' => $event
        ]);
    }

    public function store(Request $request)
    {
        //
    }

    public function edit($event, $ticketGroup)
    {
        return view('organizer.ticket-groups.create', [
            'event' => $event,
            'ticketGroup' => $ticketGroup
        ]);
    }

    public function update(Request $request, $id)
    {
        //
    }
}
