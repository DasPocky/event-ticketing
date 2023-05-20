<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\Venue;
use Illuminate\Http\Request;

class OrganizerController extends Controller
{
    public function index()
    {
        // Zähle alle Venues zusammen und gib sie an die View weiter
        $venues = Venue::all()->count();
        return view('organizer.index', compact('venues'));
    }
}
