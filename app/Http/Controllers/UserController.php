<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Course;
use App\Models\Video;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $courses = Course::where('type', '=', 'free')->get();
       $comments=Comment::all();
        return view('welcome',compact('courses','comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function deleteComment($id){
    Comment::where('id',$id)->delete();
    return redirect()->back();
    }
    public function watchCourseVideos($id){
      $course = Course::where('id', $id)->first();
      $course_name=$course->name;
      $views=$course->views;
      $views++;
      $course->views=$views;
      $course->save();
      $videos=Course::find($id)->videos;
      $flag=0;
     return view('users.userVideos',compact('videos','course_name','flag'));
    }
    //for paid courses
    public function paidCourses(){
        //return "done";
        $courses = Course::where('type', '=', 'paid')->get();
        $comments=Comment::all();
         return view('users.paid',compact('courses','comments'));
    }
    public function confirmPhonePage($id,$name){
       $course_name=$name;
       $course_id=$id;
       return view('users.confirmPhone',compact('course_id','course_name'));
    }
    public function confirmPhone(Request $request){
       // return $request;
       $request->phone==null ? $phone=Auth::user()->phone : $phone=$request->phone ;
       Order::create([
            'course_name'=>$request->course_name,
            'course_id'=>$request->course_id,
            'user_id'=>Auth::user()->id,
            'user_name'=>Auth::user()->name,
            'phone'=>$phone,
            'open'=>0,
       ]);
       $update = array();
       $request->phone == null ? '' : $update['phone'] = $request->phone;
       User::where('id', Auth::user()->id)->update(
           $update
       );
       return redirect()->back()->with('order_booked', 'تم الحجز بنجاح وسوف نتواصل معك في اقرب وقت');
    }

    public function userBookedCourses(){
        $user_id=Auth::user()->id;
        $courses=Order::where('user_id','=',$user_id,'and','open','=',1)->get();
      // select('name')->where('id', '=', $id)->get();
        // $courses=Order::select('*')->where('user_id','=',$user_id,'and','open','=',1)->get();
        // foreach($courses as $course){
        // echo $course;
        // }
        //return $courses;
        if($courses->isEmpty())
        {
              $flag=0;
              return view('users.noCourses');
        }
        else{
            $flag=1;
            $pulck=$courses->pluck('course_id');
            // return $pulck;
             $booked_courses = Course::where('id','=',$pulck)->get();
             $comments=Comment::all();
            // return $booked_courses;
             return view('users.userBookedCourses',compact('booked_courses','flag','comments'));
        }
    }
    public function watchPaidCourse($id){
        //return $id;
        $course = Course::where('id', $id)->first();
        $course_name=$course->name;
        $views=$course->views;
        $views++;
        $course->views=$views;
        $course->save();
        $videos=Course::find($id)->videos;
        $flag=1;
       return view('users.userVideos',compact('videos','course_name','flag'));
    }


}
