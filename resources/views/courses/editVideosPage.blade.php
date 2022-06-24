@extends('layouts.app')
@section('content')
    <div class="container">
        <h1> صفحة تعديل الفيديوهات الخاصة بالكورس </h1>
        <div class="form-group">
            <label for="exampleInputPassword1" style="font-size: x-large">الكورس الذي ستضاف له الفيديوهات
            </label>
            <input type="email" class="form-control" id="exampleInputPassword1" value="{{ $name }}"
                readonly>
        </div>
        <a class="btn btn-success" href="{{ route('addVideos',[$course_id,$name])}} ">اضافة فيديو</a>
        <table class="table" style="margin-top: 10px;">
            <thead>
              <tr>
                <th scope="col">الاسم</th>
                <th scope="col">الفيديو</th>
                <th scope="col">تحكم</th>
              </tr>
            </thead>
            <tbody>
                @foreach ( $videos as $video )
              <tr>
                <td>{{$video->name}}</td>
                 <td  style="height: 75px">
                     <video loop="true" controls >
                    <source src="{{asset('storage/upload_courses/'.$video->file)}}" type="video/mp4">
                    </video>
                </td>
                <td style="width: 100px;"> <a class="btn btn-warning" href="{{route('editVideoNamePage',$video->id)}}">تعديل الاسم</a> </td>
                <td>
                 <form method="POST" action="{{ route('deleteVideo') }}">
                     @csrf
                     {{-- @method('DELETE') --}}
                      <input type="hidden" value="{{$video->id}}" name="video_id">
                     <input type="submit" class="btn btn-danger" value=" حذف الفيديو">
                 </form>
             </td>

              </tr>
              @endforeach
            </tbody>
          </table>
          <a href="{{route('courses.index')}}" class="btn btn-primary">الرجوع لصفحة الكورسات الرئيسية</a>
    </div>
@endsection
