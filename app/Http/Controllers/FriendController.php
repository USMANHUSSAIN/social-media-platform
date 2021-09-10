<?php

namespace App\Http\Controllers;

use App\Models\FriendUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function list()
    {
        list($friends, $friendIDs) = $this->getFriendList();
        list($requestSent, $friendIDs) = $this->getFriendRequestSentList($friendIDs);
        list($requestReceived, $friendIDs) = $this->getFriendRequestReceivedList($friendIDs);
        list($users) = $this->getUsersList($friendIDs);
        return view('friends-list', compact('friends','users', 'requestReceived', 'requestSent'));
    }

    public function sendRequest(Request $request)
    {
        Auth::user()->friends()->attach($request->user_id, ['status' => USER::FRIEND_REQUEST_STATUS['P']]);
        return redirect()->back();
    }

    public function acceptRequest(Request $request)
    {
        FriendUser::updateOrCreate(
            ['friend_id' => Auth::id(), 'user_id' => $request->user_id],
            ['status' => USER::FRIEND_REQUEST_STATUS['C']]
        );
        FriendUser::updateOrCreate(
            ['user_id' => Auth::id(), 'friend_id' => $request->user_id],
            ['status' => USER::FRIEND_REQUEST_STATUS['C']]
        );
        return redirect()->back();
    }

    public function unFriendRequest(Request $request)
    {
        $friend = User::find($request->user_id);
        $friend->friends()->detach(Auth::id());
        Auth::user()->friends()->detach($request->user_id);
        return redirect()->back();
    }

    private function getFriendList(): array
    {
        $friends = Auth::user()->friends()->wherePivot('status', USER::FRIEND_REQUEST_STATUS['C'])->get();
        $friendIDs = $friends ? [Auth::id(),...$friends->pluck('id')] : [Auth::id()];
        return [$friends, $friendIDs];
    }

    private function getFriendRequestSentList($friendIDs): array
    {
        $requestSent = Auth::user()->friends()->wherePivot('status', USER::FRIEND_REQUEST_STATUS['P'])->get();
        $friendIDs = $requestSent ? [...$friendIDs,...$requestSent->pluck('id')] : $friendIDs;
        return [$requestSent, $friendIDs];
    }

    private function getFriendRequestReceivedList($friendIDs): array
    {
        $requestReceived = FriendUser::where('friend_id', Auth::id())->where('status', USER::FRIEND_REQUEST_STATUS['P'])->get();
        $requestReceived = $requestReceived ? User::whereIn('id', $requestReceived->pluck('user_id'))->get() : new \stdClass();
        $friendIDs = $requestReceived ? [...$friendIDs,...$requestReceived->pluck('id')] : $friendIDs;
        return [$requestReceived, $friendIDs];
    }

    private function getUsersList($friendIDs): array
    {
        $users = User::role('User')->whereNotIn('id', $friendIDs)->get();
        return [$users];
    }


}
