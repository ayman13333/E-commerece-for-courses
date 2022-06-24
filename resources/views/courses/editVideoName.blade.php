@extends('layouts.app')
@section('content')
    <div class="container">
        @if (session('name_updated'))
            <div class="alert alert-warning">
                {{ session('name_updated') }}
            </div>
        @endif
        <div class="form-group">
            <label for="exampleInputPassword1" style="font-size: x-large">الاسم القديم</label>
            <input type="email" class="form-control" id="exampleInputPassword1" value="{{ $name }}" readonly>
        </div>
        <form method="POST" action="{{ route('editVideoName') }}">
            @csrf
            <div class="form-group">
                <input type="hidden" value="{{ $video_id }}" name="video_id">
                <label for="exampleInputPassword1" style="font-size: x-large">ادخل الاسم الجديد</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="name">

            </div>
            <button type="submit" class="btn btn-warning">تعديل</button>
            <a href="{{ route('courses.index') }}" class="btn btn-primary">الرجوع لصفحة الكورسات الرئيسية</a>
            {{-- <a href="{{url()->previous()}}" class="btn btn-primary">الرجوع للخلف</a> --}}
            {{-- <button onclick="goBack()">Go Back</button>
            <script>
                function goBack() {
                    window.history.back();
                }
            </script> --}}
        </form>
    </div>
@endsection
