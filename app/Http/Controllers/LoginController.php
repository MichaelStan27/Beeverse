<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function viewPayment(User $user)
    {
        return view('payment', [
            'user' => $user,
        ]);
    }

    public function checkPayment(Request $request, User $user)
    {
        $request->validate([
            'fee' => ['required', 'numeric', 'gt:0'],
        ]);

        if ($request->fee > $request->feeAmount) {
            $amount = $request->fee - $request->feeAmount;
            return redirect()->back()->with('amount', $amount)->with('feeAmount', $request->feeAmount);
        } else if ($request->fee < $request->feeAmount) {
            $amount = $request->feeAmount - $request->fee;
            return redirect()->back()->with('amount_underpaid', $amount)->with('feeAmount', $request->feeAmount);
        }

        $user->update([
            'is_paying' => true
        ]);

        return redirect()->route('dashboard')->with('message', 'Payment Success');
    }

    public function convert(Request $request, User $user)
    {
        $user->update([
            'balance' => $request->converted + 100,
            'is_paying' => true
        ]);

        return redirect()->route('dashboard')->with('message', 'Payment Success');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', Password::min(5)->letters()->numbers()]
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->remember)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('message', 'Login successful!');
        }

        return redirect()->back()->with('message', 'Invalid login credentials');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('dashboard')->with('message', 'Logout successful!');
    }
}
