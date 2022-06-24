<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Video;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

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
        // return view('home');
           $courses = Course::where('type', '=', 'free')->get();
          // $comments=Comment::where('user_id','=',Auth::user()->id)->get();
          $comments=Comment::all();
           return view('welcome',compact('courses','comments'));
       // return redirect()->to('/');

    }
}
