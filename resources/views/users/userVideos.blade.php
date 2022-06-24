@extends('layouts.app')
@section('content')
<div class="container">
    <div class="alert alert-success" role="alert">
    <h1>   شاهد الان مجانا كورس  {{$course_name}}</h1>
    </div>
    <hr>
    @foreach ($videos as $video )
    <h2  >{{$video->name}} </h2>
    <video loop="true" controls >
        <source src="{{asset('storage/upload_courses/'.$video->file)}}" type="video/mp4">
        </video>
    <hr>
    @endforeach
</div>
@if ($flag==1)
<p class="text-center"> <a href="{{route('userBookedCourses')}}" class="btn btn-primary">  الرجوع لصفحة الكورسات المحجوزة</a> </p>
@else
<p class="text-center"> <a href="{{route('users.index')}}" class="btn btn-primary">  الرجوع لصفحة الكورسات المجانية</a> </p>
@endif

@endsection
