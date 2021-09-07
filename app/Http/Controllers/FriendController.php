<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function list(Request $request)
    {
        $friendId = Friend::where('user_id', Auth::id())->get()->toArray();
        $friendsInfo = User::whereIn('id',$friendId)->get();

        $users = User::whereHas('roles', function ($query) {
            $query->where('name','!=', 'Admin');
        })->get();

        if($friendId)
        $users = $users->whereNotIn('id',$friendId)->get();

        return view('friends-list', compact('friendsInfo','users'));
    }

}
