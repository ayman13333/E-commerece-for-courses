<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Video;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('courses.create');
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
        // return $request;
        $course_pic = $request->photo;
        $course_pic_name = time() . '.' . $course_pic->extension();
        Storage::putFileAs('public/upload_courses', $course_pic,  $course_pic_name);
        $request->price == null ? $price = 0 : $price = $request->price;
        $course = new Course;
        $course->name = $request->name;
        $course->picture = $course_pic_name;
        $course->price = $price;
        $course->type = $request->type;
        $course->save();
        $id = $course->id;
        $name = $course->name;
        return redirect()->route('addVideos', [$id, $name])->with('coursesaved', ' تم حفظ الكورس بنجاح');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return $id;
        $orders = Order::where('user_id', '=', $id)->get();
        // return $orders;
        $name = User::where('id', '=', $id)->get();
        return view('courses.showCourse', compact('orders', 'name'));
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
        $course = Course::find($id);
        return view('courses.edit', compact('course'));
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
        if ($request->photo == null) {
            // return "done";
            $update = array();
            $request->name == null ? '' : $update['name'] = $request->name;
            $request->price == null ? '' : $update['price'] = $request->price;
            $request->type == null ? '' : $update['type'] = $request->type;
            Course::where('id', $id)->update(
                $update
            );
        } else {
            //return $request;
            $course = Course::find($id);
            // return $course->picture;
            $img_destination = 'storage/upload_courses/' . $course->picture;
            //return $img_destination;
            if (File::exists($img_destination)) {
                File::delete($img_destination);
            }
            //upload new video
            $course_pic = $request->photo;
            $course_pic_name = time() . '.' . $course_pic->extension();
            Storage::putFileAs('public/upload_courses', $course_pic,  $course_pic_name);

            $update = array();
            $request->name == null ? '' : $update['name'] = $request->name;
            $request->price == null ? '' : $update['price'] = $request->price;
            $request->type == null ? '' : $update['type'] = $request->type;
            $update['picture'] = $course_pic_name;
            Course::where('id', $id)->update(
                $update
            );
        }
        return redirect()->back()->with('course_updated', 'تم تعديل الكورس بنجاح');
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
        //return $id;
        $videos = Video::where('course_id', $id)->get();
        // deleting videos related to this course from videos table
        foreach ($videos as $video) {
            $img_destination = 'storage/upload_courses/' . $video->file;
            if (File::exists($img_destination)) {
                File::delete($img_destination);
            }
            $video->delete();
        }
        //deleting course data from courses table
        $course = Course::find($id);
        $img_destination = 'storage/upload_courses/' . $course->picture;
        if (File::exists($img_destination)) {
            File::delete($img_destination);
        }
        $course->delete();
        return redirect()->back();
    }
    public function addVideos($id, $name)
    {
        // return $id.$name;
        return view('courses.addCourseVideos', compact('id', 'name'));
    }
    public function insertvideo(Request $request)
    {
        $course_rar = $request->file;
        //upload course picture
        $course_rar_Name = time() . '.' . $course_rar->extension();
        //save course file to storage
        Storage::putFileAs('public/upload_courses', $course_rar,  $course_rar_Name);
        $request->session()->put('course_rar_name', $course_rar_Name);
    }
    public function insertVideoData(Request $request)
    {
        $course_rar_name = session('course_rar_name');
        if ($course_rar_name) {
            Session::forget('course_rar_name');
            Video::create([
                'name' => $request->name,
                'file' => $course_rar_name,
                'course_id' => $request->course_id,
            ]);
            return redirect()->back()->with('video_saved', 'تم حفظ الفيديو لهذا الكورس');
        } else {
            return redirect()->back()->with('course_error', 'من فضلك ارفع الفيديو اولا ثم املا البيانات');
        }
    }
    public function editVideosPage($id, $name)
    {
        $course_id = $id;
        $videos = Video::all()->where('course_id', $id);
        return view('courses.editVideosPage', compact('name', 'videos', 'course_id'));
    }
    public function editVideoNamePage($id)
    {
        $name_course = Video::select('name')->where('id', '=', $id)->get();
        $name = $name_course[0]->name;
        $video_id = $id;
        return view('courses.editVideoName', compact('name', 'video_id'));
    }
    public function editVideoName(Request $request)
    {
        $id = $request->video_id;
        $update = array();
        $request->name == null ? '' : $update['name'] = $request->name;
        Video::where('id', $id)->update(
            $update
        );
        return redirect()->back()->with('name_updated', 'تم تعديل الاسم لهذا الكورس');
    }
    public function deleteVideo(Request $request)
    {
        $id = $request->video_id;
        $video = Video::find($id);
        $img_destination = 'storage/upload_courses/' . $video->file;
        if (File::exists($img_destination)) {
            File::delete($img_destination);
        }
        $video->delete();
        return redirect()->back();
    }
    public function confirmDeleteCourse($id)
    {
        return redirect()->back()->with('delete_confirm', $id);
    }
    public function bookedCourses()
    {
        $orders = Order::select('user_id', 'user_name')->distinct('user_id')->get();
        return view('courses.bookedCourses', compact('orders'));
    }
    public function openCourse($user_id, $course_id)
    {
        Order::where(['user_id'=>$user_id,'course_id'=>$course_id])->update(array(
            'open' => 1,
        ));
        return redirect()->back();
    }
    public function closeCourse($user_id, $course_id)
    {
        Order::where(['user_id'=>$user_id,'course_id'=>$course_id])->update(array(
            'open' => 0,
        ));
        return redirect()->back();
    }
    public function deleteCourseUser($user_id, $course_id)
    {
      Order::where(['user_id'=>$user_id,'course_id'=>$course_id])->delete();
      return redirect()->back();
    }
    public function deleteAllCoursesUser($id)
    {
        Order::where(['user_id'=>$id])->delete();
        return redirect()->back();
    }
}
