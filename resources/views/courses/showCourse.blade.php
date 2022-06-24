@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="form-group">
            <label for="exampleInputPassword1" style="font-size: x-large">اسم المستخدم</label>
            <input type="text" class="form-control" id="exampleInputPassword1" value="{{ $name[0]->name }}"readonly>
        </div>
            <div class="form-group">
                <label for="exampleInputPassword1" style="font-size: x-large">رقم الهاتف</label>
                <input type="text" class="form-control" id="exampleInputPassword1" value="{{ $name[0]->phone }}"readonly>
            </div>
        <h1  style="margin-top: 15px;">  الطلبات الواردة من هذا المستخدم</h1>
        <table class="table" style="margin-top: 10px;">
            <thead>
              <tr>
                <th scope="col">اسم المستخدم</th>
                <th scope="col">رقم التليفون</th>
                <th scope="col">تحكم</th>
                <th scope="col">ازالة</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order )
                <tr>
                    <td>{{$order->course_name}} </td>
                    <td>{{$order->phone}}</td>
                    @if ($order->open==0)
                    <td> <a class="btn btn-danger"href="{{route('openCourse', [$order->user_id,$order->course_id])}}">فتح الكورس لهذا المستخدم</a></td>
                    @else
                    <td> <a class="btn btn-dark"href="{{route('closeCourse', [$order->user_id,$order->course_id])}}">اغلاق الكورس لهذا المستخدم</a></td>
                    @endif
                    <td> <a class="btn btn-danger"href="{{route('deleteCourseUser', [$order->user_id,$order->course_id])}}">حذف الكورس </a></td>
                </tr>
                @endforeach
            </tbody>
          </table>
        <p class="text-center"> <a class="btn btn-primary"href="{{ route('bookedCourses')}}">الرجوع لصفحة طلبات المستخدمين</a> </p>
    </div>
@endsection
