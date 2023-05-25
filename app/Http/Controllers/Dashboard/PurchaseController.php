<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Purchase;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::where('user_id', Auth::user()->id)
            ->with(['ticket.event'])  // Veränderte Zeile
            ->get()
            ->groupBy('ticket.event.title');  // Veränderte Zeile

        return view('dashboard.purchases.index', compact('purchases'));
    }
}
