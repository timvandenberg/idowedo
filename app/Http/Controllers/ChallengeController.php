<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Hootlex\Friendships\Traits\Friendable;

class ChallengeController extends Controller
{
    use Friendable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $challenges = Challenge::orderBy('start_at', 'desc')
        //     ->get();

        // return view('challenges.index', [
        //     'challenges' => $challenges
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('challenges.create', [

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'duration' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('images/challenges'), $imageName);

        $user = auth()->user();

        $Challenge = new Challenge;
        $Challenge->owner_id = $user->id;
        $Challenge->fill($request->all());
        $Challenge->image_name = $imageName;
        $Challenge->start_at = Carbon::now();
        $Challenge->finish_at = Carbon::now();
        $Challenge->save();

        $newPivot = $user->challenges()->save($Challenge, ['accepted' => 1, 'completed_at' => 'BEMMMM']);

        return redirect()->route('home');
    }

    /**
     * Send a newly created resource in storage.
     */
    public function sendChallenge($friend_id, $challenge_id)
    {
        // $challenge = Challenge::find($challenge_id);

        // $Challenge = new Challenge;
        // $Challenge->owner_id = $challenge->owner_id;
        // $Challenge->status = 0;
        // $Challenge->name = $challenge->name;
        // $Challenge->description = $challenge->description;
        // $Challenge->duration = $challenge->duration;
        // $Challenge->start_at = $challenge->start_at;
        // $Challenge->finish_at = $challenge->finish_at;
        // $Challenge->save();

        // return $this->show($challenge);
    }

    /**
     * Accept a newly created resource in storage.
     */
    public function acceptChallenge(Challenge $challenge, $challenge_id)
    {
        $challenge = Challenge::find($challenge_id);
        $challenge->update([
            'status' => 1
        ]);

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function show(Challenge $challenge)
    {
        $user = auth()->user();
        $friends = $user->getFriends();

        return view('challenges.show', [
            'challenge' => $challenge,
            'friends' => $friends
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function edit(Challenge $challenge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Challenge $challenge)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function destroy(Challenge $challenge)
    {
        //
    }
}
