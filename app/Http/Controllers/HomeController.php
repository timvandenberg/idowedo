<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Challenge;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $challenges = Challenge::orderBy('start_at', 'desc')
            ->where('participant_id', '=', auth()->id())
            ->where('status', '=', 1)
            ->get();

        $challengeRequests = Challenge::orderBy('start_at', 'desc')
            ->where('participant_id', '=', auth()->id())
            ->where('status', '=', 0)
            ->get();

        return view('home', [
            'challenges' => $challenges,
            'challengeRequests' => $challengeRequests
        ]);
    }
}
