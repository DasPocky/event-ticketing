<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Venue;

class VenueController extends Controller
{
    public function index()
    {
        $venues = auth()->user()->venues;
        return view('organizer.venues.index', compact('venues'));
    }

    public function create()
    {
        return view('organizer.venues.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'zip' => 'required',
            'city' => 'required',
            'country' => 'required',
            'contact_name' => 'required',
            'contact_phone' => 'required',
            'contact_email' => 'required',
            'notes' => 'required'
        ]);

        $venue = auth()->user()->venues()->create($request->all());

        return redirect()->route('organizer.venues.index')
            ->with('success', 'Venue successfully created.');
    }

    public function edit(Venue $venue)
    {
        return view('organizer.venues.edit', compact('venue'));
    }

    public function update(Request $request, Venue $venue)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'zip' => 'required',
            'city' => 'required',
            'country' => 'required',
            'contact_name' => 'required',
            'contact_phone' => 'required',
            'contact_email' => 'required',
            'notes' => 'required'
        ]);

        $venue->update($request->all());

        return redirect()->route('organizer.venues.index')
            ->with('success', 'Venue successfully updated.');
    }

    public function destroy(Venue $venue)
    {
        $venue->delete();

        return redirect()->route('organizer.venues.index')
            ->with('success', 'Venue successfully deleted.');
    }

    public function show(Venue $venue)
    {
        return view('organizer.venues.show', compact('venue'));
    }
}
