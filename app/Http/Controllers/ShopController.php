<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
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
        return redirect()->back()->with('check', $avatar->image);
    }

    public function viewBuy(Avatar $avatar)
    {
        return view("buy-avatar", [
            'avatar' => $avatar
        ]);
    }
}
