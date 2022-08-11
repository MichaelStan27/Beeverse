<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(User $user)
    {
        return view('profile', [
            'user' => User::with(['collections', 'collections.avatar', 'transactions', 'transactions.avatar', 'receives', 'headerHobbies', 'headerHobbies.hobby', 'wishlists', 'wishlists.user_wishlist'])->where('id', $user->id)->first(),
            'followers' => Wishlist::with('user_wishlist')->where('user_id_wishlisted', '=', $user->id)->get(),
            'tabFollowing' => false
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

    public function confirmHidden()
    {
        return redirect()->back()->with('confirm_hidden', 'confirmation')->with('visibleSess', 'vis');
    }

    public function makeHidden(User $user)
    {
        $bear_photo = random_int(1, 3);
        $bear_photo = 'bear_' . $bear_photo . '.png';
        $user->update([
            'photo_profile' => $bear_photo,
            'balance' => $user->balance - 50,
            'hidden' => true
        ]);

        return redirect()->back()->with('message', 'your account visibility is set to hidden')->with('visibleSess', 'vis');
    }

    public function confirmVisible()
    {
        return redirect()->back()->with('confirm_visible', 'confirmation')->with('visibleSess', 'vis');
    }

    public function chooseVisible(User $user)
    {
        if (!$user->collections->isEmpty()) {
            return redirect()->back()->with('choose_visible', 'confirmation')->with('visibleSess', 'vis');
        }

        $user->update([
            'photo_profile' => 'default.png',
            'balance' => $user->balance - 5,
            'hidden' => false
        ]);

        return redirect()->back()->with('message', 'your account visibility is set to visible')->with('visibleSess', 'vis');
    }

    public function makeVisible(Request $request, User $user)
    {
        $user->update([
            'photo_profile' => $request->profile,
            'balance' => $user->balance - 5,
            'hidden' => false
        ]);

        return redirect()->back()->with('message', 'your account visibility is set to visible')->with('visibleSess', 'vis');
    }

    public function chooseAvatar(User $user)
    {
        return redirect()->back()->with('choose_visible', 'confirmation')->with('chooseSess', 'choose');
    }

    public function changeAvatar(Request $request, User $user)
    {
        $user->update([
            'photo_profile' => $request->profile,
        ]);
        return redirect()->back()->with('message', 'photo profile successfully changed');
    }

    public function addFriend(User $user)
    {
        $auth_user = User::with('wishlists')->find(auth()->user()->id);

        $friend = $auth_user->wishlists()->where('user_id_wishlisted', '=', $user->id)->first();

        if (!$friend) {
            Wishlist::create([
                'user_id' => $auth_user->id,
                'user_id_wishlisted' => $user->id
            ]);
            return redirect()->back()->with('message', "$user->name is added to your wishlist(s)");
        }

        $friend->delete();

        return redirect()->back()->with('message', "$user->name is removed from your wishlist(s)");
    }

    public function tabFollowing(User $user)
    {
        return redirect()->back()->with('ingSes', 'following');
    }
    public function tabFollowers(User $user)
    {
        return redirect()->back()->with('ersSes', 'followers');
    }
}
