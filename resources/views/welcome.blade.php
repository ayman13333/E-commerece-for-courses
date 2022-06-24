@extends('layouts.app')
@section('content')
    <div class="container">
        @auth
            <div class="alert alert-success" role="alert">
                <h1 class="text-center"> يمكنك الاستمتاع بهذه الكورسات المجانية الان </h1>
            </div>
            @foreach ($courses as $course)
                <p class="text-center"><img src="{{ asset('storage/upload_courses/' . $course->picture) }}"
                        style="width: 50%" alt=""> </p>
                <h3 class="text-center" style="margin-top: 10px">اسم الكورس :{{ $course->name }}</h3>
                <h3 class="text-center"> عدد المشاهدات: {{ $course->views }} |
                    <span> التقييم:
                        <span class="fa fa-star checked"></span> {{ $course->rate }} </span>
                </h3>
                <h3>التعليقات: </h3>
                @foreach ($comments as $comment)
                    @if ($course->id == $comment->course_id)
                        <h5 style="font-size: xx-large"> <span> <img src="{{ asset('profile.jpg') }}"
                                    style="height: 50px;border-radius: 33px;"> </span> {{ $comment->username }} </h5>
                        {{-- <img src="{{asset('profile.jpg')}}"> <span> {{$comment->username}} </span> --}}
                        <div class="alert alert-dark" role="alert">
                            {{ $comment->comments }}
                        </div>
                        {{-- <p style="font-size: 16px;line-height: 2rem;"> {{$comment->comments}} </p> --}}
                        @if (Auth::user()->rule_id == 1)
                            {{-- {{$comment->id}} --}}
                            <form method="POST" action="{{ route('deleteComment', $comment->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-danger" style="margin-top: 10px">حذف التعليق</button>
                            </form>
                        @endif
                        <hr>
                    @endif
                @endforeach
                <form method="post" action="{{ route('comments.store') }}">
                    @csrf
                    <input type="hidden" name="username" value="{{ Auth::user()->name }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <textarea name="comment" style="width: 100%;display:block" required></textarea>
                    <button type="submit" class="btn btn-success" style="margin-top: 10px">اضافة تعليق</button>
                </form>

                {{-- rating --}}
                <form method="post" action="" style="margin-top: 10px">
                    @csrf
                    <input type="hidden" name="username" value="{{ Auth::user()->name }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <span class="fa fa-star checked"></span>
                    <input type="radio" name="type" value="1" checked>
                    <span class="fa fa-star checked"></span>
                    <input type="radio" name="type" value="2">
                    <span class="fa fa-star checked"></span>
                    <input type="radio" name="type" value="3">
                    <span class="fa fa-star checked"></span>
                    <input type="radio" name="type" value="4">
                    <span class="fa fa-star checked"></span>
                    <input type="radio" name="type" value="5" >
                    <span class="fa fa-star checked"></span>
                    <br>
                    <button type="submit" class="btn btn-dark" style="margin-top: 10px">اضافة تقييم</button>
                </form>
                {{-- {{$course->id}} --}}
                <p class="text-center"> <a href="{{ route('watchCourseVideos', $course->id) }}" class="btn btn-success"
                        style="margin-top: 10px">مشاهدة الكورس الان</a> </p>
                <hr>
            @endforeach
        @else
            <p class="text-center"> <img src="{{ asset('1.jpeg') }}" style="width: 50%"> </p>
            <p class="text-center"> <a href="{{ route('login') }}" class="btn btn-success"> من فضلك سجل الدخول حتي تتصفح</a>
            </p>
            <p class="text-center"> <a href="{{ route('register') }}" class="btn btn-primary"> اضغط هنا لانشاء حساب</a></p>
        @endauth
    </div>
@endsection
