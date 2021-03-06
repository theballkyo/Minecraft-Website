<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = App\Topic::news()->orderBy('updated_at', 'desc')->limit(5)->get();
        $authme = App\User::all();
        // dd($authme);

        return view('home3', ['topics' => $topics, 'authme' => $authme]);
    }
}
