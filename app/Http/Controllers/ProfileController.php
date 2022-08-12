<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Room;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

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

        $wishlist = $auth_user->wishlists()->where('user_id_wishlisted', '=', $user->id)->first();
        $is_added = Wishlist::where('user_id', '=', $user->id)->where('user_id_wishlisted', '=', $auth_user->id)->first();

        //Check if the auth user already wishlist the other user
        if (!$wishlist) {
            Wishlist::create([
                'user_id' => $auth_user->id,
                'user_id_wishlisted' => $user->id
            ]);

            //check if the other user wishlisted the auth user
            if ($is_added) {
                $room = Room::create([
                    'name' => $auth_user->name . ' ' . $user->name
                ]);

                Participant::create([
                    'user_id' => $auth_user->id,
                    'room_id' => $room->id
                ]);

                Participant::create([
                    'user_id' => $user->id,
                    'room_id' => $room->id
                ]);
                if (App::isLocale('en')) {
                    return redirect()->back()->with('message', "$user->name is added to your friendlist(s), you can chat with them now!");
                }
                return redirect()->back()->with('message', "$user->name ditambahkan menjadi teman anda, anda bisa mengobrol dengannya sekarang!");
            }
            if (App::isLocale('en')) {
                return redirect()->back()->with('message', "$user->name is added to your wishlist(s)");
            }
            return redirect()->back()->with('message', "$user->name ditambahkan ke daftar keinginan");
        }

        if ($is_added) {
            //get room
            $name1 = $auth_user->name . ' ' . $user->name;
            $name2 = $user->name . ' ' . $auth_user->name;
            $room1 = Room::where('name', '=', $name1)->first();
            $room2 = Room::where('name', '=', $name2)->first();

            if ($room1) {
                $room1->delete();
            } else {
                $room2->delete();
            }

            $wishlist->delete();
            if (App::isLocale('en')) {
                return redirect()->back()->with('message', "$user->name is removed from your friendlist(s), your chat is deleted");
            }
            return redirect()->back()->with('message', "$user->name dihapus dari pertemanan anda, obrolan anda dengannya telah dihapus");
        }

        $wishlist->delete();
        if (App::isLocale('en')) {
            return redirect()->back()->with('message', "$user->name is removed from your wishlist(s)");
        }
        return redirect()->back()->with('message', "$user->name dihapus dari daftar keinginan");
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
