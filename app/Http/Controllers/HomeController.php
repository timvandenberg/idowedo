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
        $user = auth()->user();
        $challenges = $user->challenges;

        $challengeRequests = Challenge::orderBy('start_at', 'desc')
            ->get();

        return view('home', [
            'challenges' => $challenges,
            'challengeRequests' => $challengeRequests
        ]);
    }
}
