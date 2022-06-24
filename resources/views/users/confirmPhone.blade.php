@extends('layouts.app')
@section('content')
    <div class="container">
        @if (session('order_booked'))
            <div class="alert alert-success">
                {{ session('order_booked') }}
            </div>
        @else
            <div class="alert alert-warning" role="alert">
                من فضلك اكد رقم هاتفك حتي نستطيع الوصول اليك
            </div>
        @endif

        <form method="POST" action="{{ route('confirmPhone') }}">
            @csrf
            <input type="hidden" value="{{ $course_name }}" name="course_name">
            <input type="hidden" value="{{ $course_id }}" name="course_id">
            <div class="form-group">
                <label for="exampleInputEmail1">اكد رقم الهاتف</label>
                <input type="number" class="form-control" id="exampleInputPassword1" name="phone">
                <button type="submit" class="btn btn-warning" style="margin-top: 10px;">اكد الرقم</button>
            </div>
        </form>
        <p class="text-center" style="margin-top: 15px;">
            <a href="{{route('users.index')}}" class="btn btn-primary">  الرجوع لصفحة الكورسات المجانية</a>
            <span> <a href="{{route('paidCourses')}}" class="btn btn-primary">  الرجوع لصفحة الكورسات المدفوعة</a> </span>
        </p>
    </div>
@endsection
