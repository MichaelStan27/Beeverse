<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use App\Models\Collection;
use App\Models\User;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        return view("shop", [
            'avatars' => Avatar::where('id', '<>', 1)->paginate(12)
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

    public function viewSend(Avatar $avatar)
    {
        return view("send-avatar", [
            'avatar' => $avatar
        ]);
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

        return redirect()->route('shop')->with('message', $request->avatar_name . " is added to your collection");
    }
}
