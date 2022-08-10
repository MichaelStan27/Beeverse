<?php

namespace App\Http\Controllers;

use App\Models\Hobby;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user && !$user->is_paying) {
            return redirect()->route('payment', $user)->with('feeAmount', random_int(100000, 125000));
        }
        return view('dashboard', [
            'hobbies' => Hobby::all(),
            'users' => User::with(['headerHobbies', 'headerHobbies.hobby'])->where('hidden', false)->paginate(5),
        ]);
    }

    public function search(Request $request)
    {
        $user = auth()->user();

        // Base Query
        $query = User::with(['headerHobbies', 'headerHobbies.hobby'])
            ->join('header_hobbies', 'users.id', '=', 'header_hobbies.user_id')
            ->join('hobbies', 'header_hobbies.hobby_id', '=', 'hobbies.id');

        // Exclude auth user from query
        if ($user) $query = $query->where('users.id', '<>', $user->id);

        // Query Keyword from search
        $keyword = $request->query('keyword');

        $query->where('users.name', 'LIKE', "%$keyword%");

        // Query Gender from checkbox
        $genders = $request->gender;
        if (!empty($genders)) {
            $query = $query->where(function ($query) use ($genders) {
                foreach ($genders as $gender) {
                    $query = $query->orWhere('gender', '=', $gender);
                }
            });
        }

        //Query Hobby from checkbox
        $hobbies = $request->hobbies;
        if (!empty($hobbies)) {
            $query = $query->where(function ($query) use ($hobbies) {
                foreach ($hobbies as $hobby) {
                    $query = $query->orWhere('hobbies.id', '=', $hobby);
                }
            });
        }


        return view('dashboard', [
            'hobbies' => Hobby::all(),
            'users' => $query->select('users.*')->groupBy('users.id')->paginate(5)->appends($request->query()),
            'keyword' => $keyword,
            'genders' => $genders,
            'hobbiesQuery' => $hobbies,
        ]);
    }
}
