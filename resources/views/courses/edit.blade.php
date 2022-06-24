@extends('layouts.app')
@section('content')
    <div class="container">
        @if (session('course_updated'))
            <div class="alert alert-warning">
                {{ session('course_updated') }}
            </div>
        @endif
        <h1> مرحبا من صفحة تعديل الكورسات </h1>
        <h2> تعديل المعلومات الرئيسية للكورس</h2>
        <form method="POST" action="{{ route('courses.update', $course->id) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method('PUT')
            <div class="form-group">
                <label for="exampleInputPassword1" style="font-size: x-large">الكورس المختار</label>
                <input type="email" class="form-control" id="exampleInputPassword1" value="{{ $course->name }}" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" style="font-size: x-large">تعديل الاسم</label>
                <input type="text" placeholder="اذا لم تدخل اسم جديد سيظل الاسم القديم كما هو" class="form-control"
                    id="exampleInputPassword1" name="name">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" style="font-size: x-large">السعر</label>
                <input type="email" class="form-control" id="exampleInputPassword1" value="{{ $course->price }}"
                    readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" style="font-size: x-large">السعر الجديد</label>
                <input type="number" placeholder="اذا لم تدخل سعر جديد سيظل القديم كما هو" class="form-control"
                    id="exampleInputPassword1" name="price">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" style="font-size: x-large">النوع</label>
                <input class="form-control" id="exampleInputPassword1" value="{{ $course->type }}" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" style="margin-top: 10px;display: block;font-size: x-large">من فضلك اختر
                    النوع الجديد اذا بتحب تعدل</label>
                <input type="radio" name="type" value="free">
                <label>مجاني</label><br>
                <input type="radio" name="type" value="paid">
                <label>مدفوع</label><br>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">ارفع الصورة الجديدة اذا بتحب تعدل</label>
                <input type="file" class="form-control" id="exampleInputPassword1" name="photo">
            </div>
            <button type="submit" class="btn btn-warning">تعديل</button>
            <a href="{{route('courses.index')}}" class="btn btn-primary">الرجوع لصفحة الكورسات الرئيسية</a>

        </form>
    </div>
@endsection
