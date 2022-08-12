<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use App\Models\Collection;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ShopController extends Controller
{
    public function index()
    {
        return view("shop", [
            'avatars' => Avatar::where('id', '<>', 1)->paginate(12),
            'users' => User::where('id', '<>', auth()->user()->id)->get(),
        ]);
    }

    public function checkBuy(Avatar $avatar)
    {
        return redirect()->back()->with('check', $avatar);
    }

    public function confirmBuy(Avatar $avatar)
    {
        return redirect()->back()->with('confirm', $avatar);
    }

    public function checkSend(Avatar $avatar)
    {
        return redirect()->back()->with('checkSend', $avatar);
    }

    public function viewError()
    {
        abort(404);
    }

    public function buy(Request $request, User $user)
    {
        $collection = Collection::create([
            'user_id' => $user->id,
            'avatar_id' => $request->avatar_id
        ]);

        $user->update([
            'balance' => $request->new_balance,
        ]);
        if (App::isLocale('en')) {
            return redirect()->route('shop')->with('message', $request->avatar_name . " is added to your collection");
        }
        return redirect()->route('shop')->with('message', $request->avatar_name . " ditambahkan ke koleksi anda");
    }

    public function send(Request $request, User $user)
    {
        if (!$request->sended_user) return redirect()->back()->with('message', 'send failed, users cant be empty');

        $sended_user = User::find($request->sended_user);

        $collection = Collection::create([
            'user_id' => $sended_user->id,
            'avatar_id' => $request->avatar_id
        ]);

        Transaction::create([
            'user_id' => $user->id,
            'user_id_sent' => $sended_user->id,
            'avatar_id' => $request->avatar_id
        ]);

        $user->update([
            'balance' => $request->new_balance,
        ]);

        if (App::isLocale('en')) {
            return redirect()->route('shop')->with('message', $request->avatar_name . " is added to " . $sended_user->name . "'s collection");
        }
        return redirect()->route('shop')->with('message', $request->avatar_name . " ditambahkan ke koleksi " . $sended_user->name);
    }
}
