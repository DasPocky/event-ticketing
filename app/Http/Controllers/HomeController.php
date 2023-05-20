<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Hole alle Events aus der Datenbank und gebe sie an die View weiter
        $events = Event::all();
        return view('home', compact('events'));
    }
}
