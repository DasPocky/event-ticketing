<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organizer\Venue\StoreVenueRequest;
use App\Http\Requests\Organizer\Venue\UpdateVenueRequest;
use App\Models\Venue;
use Illuminate\Support\Facades\Storage;

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

    public function store(StoreVenueRequest $request)
    {

        // Speichern des Bildes im Storage, Vergabe eines Hash-Namens und Abrufen des Pfades
        $imageName = $request->file('image')->hashName();
        $imagePath = $request->file('image')->storeAs('images/venues', $imageName, 'public');

        // Speichern des Veranstaltungsorts in der Datenbank
        $venue = auth()->user()->venues()->create([
            'name' => $request->name,
            'address' => $request->address,
            'zip' => $request->zip,
            'city' => $request->city,
            'country' => $request->country,
            'image' => $imagePath,
            'contact_name' => $request->contact_name,
            'contact_phone' => $request->contact_phone,
            'contact_email' => $request->contact_email,
            'notes' => $request->notes
        ]);

        // Zurück zur Veranstaltungsort-Übersicht mit Erfolgsmeldung
        return redirect()->route('organizer.venues.index')->with('success', 'Venue erfolgreich erstellt.');
    }

    public function edit(Venue $venue)
    {
        return view('organizer.venues.edit', compact('venue'));
    }

    public function update(UpdateVenueRequest $request, Venue $venue)
    {
        // Prüfen, ob ein neues Bild hochgeladen wurde
        if ($request->hasFile('image')) {
            // Altes Bild löschen
            Storage::delete('public/' . $venue->image);

            // Neues Bild speichern...
            $imageName = $request->file('image')->hashName();
            $imagePath = $request->file('image')->storeAs('images/venues', $imageName, 'public');
        } else {
            // Aktuelles Bild beibehalten
            $imagePath = $venue->image;
        }

        // Aktualisieren des Veranstaltungsorts in der Datenbank
        $venue->update([
            'name' => $request->name,
            'address' => $request->address,
            'zip' => $request->zip,
            'city' => $request->city,
            'country' => $request->country,
            'image' => $imagePath,
            'contact_name' => $request->contact_name,
            'contact_phone' => $request->contact_phone,
            'contact_email' => $request->contact_email,
            'notes' => $request->notes
        ]);

        // Zurück zur Veranstaltungsort-Übersicht mit Erfolgsmeldung
        return redirect()->route('organizer.venues.index')->with('success', 'Venue erfolgreich aktualisiert.');
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
