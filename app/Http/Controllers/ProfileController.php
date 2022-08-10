<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(User $user)
    {
        return view('profile', [
            'user' => User::with(['collections', 'collections.avatar', 'transactions', 'transactions.avatar', 'receives'])->where('id', $user->id)->first(),
        ]);
    }

    public function viewError()
    {
        abort(404);
    }

    public function topup(User $user)
    {
        $user->update([
            'balance' => $user->balance + 100
        ]);

        return redirect()->back()->with('message', '100 coins added successfully')->with('topupSess', 'topup');
    }
}
