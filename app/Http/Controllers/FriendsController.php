<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hootlex\Friendships\Traits\Friendable;

class FriendsController extends Controller
{
    use Friendable;

    /**
     * Show All Users
     */
    public function index()
    {
        $user = auth()->user();
        $allUsers = User::where('id', '!=', $user->id)->get();

        $friendRequests = $user->getFriendRequests();
        $requestList = array();
        foreach ($friendRequests as $friendRequest) {
          $friendUser = User::find($friendRequest->sender_id);
          $requestList[$friendRequest->sender_id] = $friendUser->name;
        }

        $friends = $user->getFriends();

        return view('friends.add', [
          'allUsers' => $allUsers,
          'friendRequests' => $requestList,
          'friends' => $friends
        ]);
    }

    /**
     * add friend
     */
    public function sendFriendRequest($potential_friend_user_id)
    {
        $userID = auth()->id();
        $user = User::find($userID);
        $sender = User::find($potential_friend_user_id);
        $user->befriend($sender);
        return $this->index();
    }

    /**
     * accept friends
     */
    public function acceptFriendRequest($potential_friend_user_id)
    {
        $userID = auth()->id();
        $user = User::find($userID);
        $recipient = User::find($potential_friend_user_id);
        $user->acceptFriendRequest($recipient);
        return $this->index();
    }
}
