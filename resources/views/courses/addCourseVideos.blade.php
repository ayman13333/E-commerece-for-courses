{{-- @extends('layouts.app')
@section('content')
    {{-- {{$id}}
{{$name}} --}}
{{-- <!DOCTYPE html>
    <html>
<head>

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
</head>
<body>
    <div class="container">
        @if (session('coursesaved'))
            <div class="alert alert-success">
                {{ session('coursesaved') }}
            </div>
        @endif
        <h1> اضافة فيديوهات الكورس </h1>
        <div class="col-md-12">
            <h1 class="mt-2 mb-2">Upload online courses Admin page</h1>

            <form action="" method="post" enctype="multipart/form-data"
                id="image-upload" class="dropzone">
                {{-- @csrf --}}
{{-- {{ csrf_field() }} --}}
{{-- {{ csrf_token() }} --}}
{{-- <h3>Upload Course By Click On Box please upload course first and then fill the rest data to Upload </h3> --}}
{{-- </div>
        </form> --}}

{{-- <form>
            <input type="hidden" name="course_id" value="{{$id}}">
            <div class="form-group">
                <label for="exampleInputPassword1" style="font-size: x-large">الكورس الذي ستضاف له الفيديوهات </label>
                <input type="email" class="form-control" id="exampleInputPassword1" name="book_name" value="{{$name}}" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" style="font-size: x-large">رقم الفيديو او عنوان الفيديو </label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="name" >
            </div>
        </form> --}}

{{-- </div> --}}
@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html>

    <head>

        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
    </head>

    <body>
        <div class="container mt-2">
            @if (session('coursesaved'))
                <div class="alert alert-success">
                    {{ session('coursesaved') }}
                </div>
            @endif
            @if (session('video_saved'))
            <div class="alert alert-success">
                {{ session('video_saved') }}
            </div>
        @endif
            @if (session('course_error'))
                <div class="alert alert-danger">
                    {{ session('course_error') }}
                </div>
            @endif
            <h1> اضافة فيديوهات الكورس </h1>

            <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="{{route('insertVideoData')}}">
                        @csrf
                        <input type="hidden" name="course_id" value="{{ $id }}">
                        <div class="form-group">
                            <label for="exampleInputPassword1" style="font-size: x-large">الكورس الذي ستضاف له الفيديوهات
                            </label>
                            <input type="email" class="form-control" id="exampleInputPassword1" value="{{ $name }}"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" style="font-size: x-large">رقم الفيديو او عنوان الفيديو
                            </label>
                            <input type="text" class="form-control" id="exampleInputPassword1" name="name">
                        </div>
                        <button type="submit" class="btn btn-success">اضافة</button>
                    </form>
                    <form action="{{ route('insertvideo') }}" method="post" enctype="multipart/form-data"
                        id="image-upload" class="dropzone">
                        {{ csrf_field() }}
                        <h3>من فضلك قم برفع فيديوهات الكورس من هنا ثم ادخل التفاصيل
                            يمكنك الرفع بصيغة mp4 mvk avi </h3>
                </div>
                <div class="alert alert-warning" role="alert">
                  <p class="text-center">  من فضلك ارفع الفيديو اولا قبل اضافة تفاصيل الفيديو </p>
                  </div>
                </form>
            </div>
            <a href="{{route('courses.index')}}" class="btn btn-primary">الرجوع لصفحة الكورسات الرئيسية</a>
        </div>
        </div>

        <script type="text/javascript">
            //$('meta[name="csrf-token"]').attr('content');
            Dropzone.options.imageUpload = {
                maxFilesize: 9000,
                acceptedFiles: ".mp4,.mkv,.avi"
            };
        </script>
    @endsection
</body>

</html>
