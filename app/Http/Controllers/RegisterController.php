<?php

namespace App\Http\Controllers;

use App\Models\HeaderHobby;
use App\Models\Hobby;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Ramsey\Uuid\Type\Integer;

class RegisterController extends Controller
{
    public function index()
    {

        $feeAmount = random_int(100000, 125000);

        return view('register', [
            'hobbies' => Hobby::all(),
            'feeAmount' => $feeAmount
        ]);
    }

    public function validation(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'min:5'],
                'gender' => ['required'],
                'hobbies' => ['required', 'min:3'],
                'username' => ['required', 'alpha_dash', 'unique:users,ig_username'],
                'number' => ['required', 'digits_between:10,12'],
                'address' => ['required'],
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => ['required', Password::min(5)->letters()->numbers(), 'confirmed'],
                'password_confirmation' => ['required', Password::min(5)->letters()->numbers()]
            ],
            [
                'hobbies.min' => 'You must select your hobbies with minimum 3 hobbies'
            ],
        );

        $user = User::create([
            'name' => $request->name,
            'photo_profile' => 'default.png',
            'gender' => $request->gender,
            'ig_username' => $request->username,
            'number' => $request->number,
            'address' => $request->address,
            'balance' => 0,
            'email' => $request->email,
            'hidden' => false,
            'is_paying' => false,
            'password' => Hash::make($request->password),
        ]);

        foreach ($request->hobbies as $hobby) {
            HeaderHobby::create([
                'user_id' => $user->id,
                'hobby_id' => $hobby,
            ]);
        }

        Auth::attempt($request->only('email', 'password'));

        return redirect()->route('payment', $user)->with('feeAmount', $request->feeAmount);
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
            'balance' => $request->converted,
            'is_paying' => true
        ]);

        return redirect()->route('dashboard')->with('message', 'Payment Success');
    }
}
