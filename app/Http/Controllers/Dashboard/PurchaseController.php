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
            ->with('event')
            ->get()
            ->groupBy('event.title');

        return view('dashboard.purchases.index', compact('purchases'));
    }
}
