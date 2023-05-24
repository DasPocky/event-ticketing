<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organizer\Event\StoreEventRequest;
use App\Http\Requests\Organizer\Event\UpdateEventRequest;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    // Anzeigen aller Events für den authentifizierten Benutzer
    public function index()
    {
        $events = auth()->user()->events()->with('tickets.ticketGroup')->get();
        return view('organizer.events.index', compact('events'));
    }


    // Anzeigen der Erstellungsseite für ein neues Event
    public function create()
    {
        // Abrufen aller Veranstaltungsorte, Kategorien und Unterkategorien aus der Datenbank und Weitergabe an die Ansicht
        $venues = auth()->user()->venues;
        $categories = Category::all();
        $subCategories = SubCategory::all();

        return view('organizer.events.create', compact('venues', 'categories', 'subCategories'));
    }

    // Speichern eines neuen Events
    public function store(StoreEventRequest $request)
    {
        // Abrufen der Subkategorie und der dazugehörigen Kategorie
        $subCategory = SubCategory::find($request->sub_category_id);
        $category = $subCategory->category;

        // Speichern des Bildes im Storage, Vergabe eines Hash-Namens und Abrufen des Pfades
        $imageName = $request->file('image')->hashName();
        $imagePath = $request->file('image')->storeAs('images/events', $imageName, 'public');

        // Speichern des Events in der Datenbank
        $event = auth()->user()->events()->create([
            'category_id' => $category->id,
            'sub_category_id' => $request->sub_category_id,
            'venue_id' => $request->venue_id,
            'title' => $request->title,
            'description' => $request->description,
            'entry_datetime' => $request->entry_datetime,
            'start_datetime' => $request->start_datetime,
            'end_datetime' => $request->end_datetime,
            'status' => $request->status,
            'image' => $imagePath,
            'website' => $request->website
        ]);

        // Zurück zur Event-Übersicht mit Erfolgsmeldung
        return redirect()->route('organizer.events.index')->with('success', 'Event erfolgreich erstellt.');
    }

    // Anzeigen der Bearbeitungsseite für ein spezifisches Event
    public function edit(Event $event)
    {
        // Abrufen aller Veranstaltungsorte, Kategorien und Unterkategorien aus der Datenbank und Weitergabe an die Ansicht
        $venues = auth()->user()->venues;
        $categories = Category::all();
        $subCategories = SubCategory::all();

        return view('organizer.events.edit', compact('event', 'venues', 'categories', 'subCategories'));
    }

    // Aktualisieren eines spezifischen Events
    public function update(UpdateEventRequest $request, Event $event)
    {
        // Abrufen der Subkategorie und der dazugehörigen Kategorie
        $subCategory = SubCategory::find($request->sub_category_id);
        $category = $subCategory->category;

        // Prüfen, ob ein neues Bild hochgeladen wurde
        if ($request->hasFile('image')) {
            // Altes Bild löschen
            Storage::delete('public/' . $event->image);

            // Neues Bild speichern...
            $imageName = $request->file('image')->hashName();
            $imagePath = $request->file('image')->storeAs('images/venues', $imageName, 'public');
        } else {
            // Aktuelles Bild beibehalten
            $imagePath = $event->image;
        }

        // Aktualisieren des Events in der Datenbank
        $event->update([
            'category_id' => $category->id,
            'sub_category_id' => $request->sub_category_id,
            'venue_id' => $request->venue_id,
            'title' => $request->title,
            'description' => $request->description,
            'entry_datetime' => $request->entry_datetime,
            'start_datetime' => $request->start_datetime,
            'end_datetime' => $request->end_datetime,
            'status' => $request->status,
            'image' => $imagePath,
            'website' => $request->website
        ]);

        // Zurück zur Event-Übersicht mit Erfolgsmeldung
        return redirect()->route('organizer.events.index')->with('success', 'Event erfolgreich aktualisiert.');
    }

    // Löschen eines spezifischen Events
    public function destroy(Event $event)
    {
        // Löschen des Bildes im Storage
        Storage::delete('public/' . $event->image);

        // Löschen des Events in der Datenbank
        $event->delete();

        // Zurück zur Event-Übersicht mit Erfolgsmeldung
        return redirect()->route('organizer.events.index')->with('success', 'Event erfolgreich gelöscht.');
    }

    // Anzeigen eines spezifischen Events
    public function show(Event $event)
    {
        return view('organizer.events.show', compact('event'));
    }

}
