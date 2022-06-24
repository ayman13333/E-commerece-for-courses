@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>  المستخدمين الذين لديهم طلبات</h1>
        <table class="table" style="margin-top: 10px;">
            <thead>
              <tr>
                <th scope="col">اسم المستخدم</th>
                <th scope="col">تحكم</th>
                <th scope="col">ازالة</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order )
                <tr>
                    <td>{{$order->user_name}} </td>
                    <td> <a class="btn btn-warning"href="{{ route('courses.show', $order->user_id) }}">عرض طلبات هذا المستخدم</a></td>
                    <td> <a class="btn btn-danger"href="{{ route('deleteAllCoursesUser', $order->user_id) }}">ازالة الكورسات الخاصة بهذا المستخدم</a></td>
                </tr>
                @endforeach
            </tbody>
          </table>
    </div>
@endsection
