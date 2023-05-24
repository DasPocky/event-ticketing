<?php

namespace App\Http\Controllers\Organizer;

use App\Models\Event;
use App\Models\Ticket;
use App\Models\TicketGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{
    public function create(Event $event)
    {
        $ticketGroups = TicketGroup::all(); // Assuming you have a TicketGroup model.
        return view('organizer.tickets.create', compact('event', 'ticketGroups'));
    }

    public function store(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required',
            'ticket_group_id' => 'required|exists:ticket_groups,id',
            'price' => 'required|numeric',
        ]);

        $ticket = new Ticket($request->all());
        $event->tickets()->save($ticket);

        return redirect()->route('organizer.events.index')->with('success', 'Ticket erfolgreich erstellt.');
    }

    public function edit(Event $event, Ticket $ticket)
    {
        $ticketGroups = TicketGroup::all(); // Assuming you have a TicketGroup model.
        return view('organizer.tickets.edit', compact('event', 'ticket', 'ticketGroups'));
    }


    public function update(Request $request, Event $event, Ticket $ticket)
    {
        $request->validate([
            'name' => 'required',
            'ticket_group_id' => 'required|exists:ticket_groups,id',
            'price' => 'required|numeric',
        ]);

        $ticket->update($request->all());

        return redirect()->route('organizer.events.index', $event)->with('success', 'Ticket erfolgreich aktualisiert.');
    }

    public function destroy(Event $event, Ticket $ticket)
    {
        $ticket->delete();

        return redirect()->route('organizer.events.index', $event)->with('success', 'Ticket erfolgreich gelöscht.');
    }
}

