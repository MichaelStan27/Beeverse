<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user && !$user->is_paying) {
            return redirect()->route('payment', $user)->with('feeAmount', random_int(100000, 125000));
        }
        return view('dashboard');
    }
}
