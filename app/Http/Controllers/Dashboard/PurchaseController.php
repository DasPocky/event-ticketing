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
        if (Auth::check()) {
            $purchases = Purchase::where('user_id', Auth::id())
                ->with(['ticket.event'])
                ->get()
                ->groupBy('ticket.event.title');

            return view('dashboard.purchases.index', compact('purchases'));
        }

        return redirect()->route('login'); // oder jede andere geeignete Aktion
    }

}
