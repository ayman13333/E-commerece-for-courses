@extends('layouts.app')
@section('content')
    <div class="container">
        <a class="btn btn-success" href="{{ route('courses.create') }} ">اضافة كورس</a>
        <h1> مرحبا من صفحة الادمن </h1>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">الاسم</th>
                    <th scope="col">الصورة</th>
                    <th scope="col">السعر</th>
                    <th scope="col">التقييم</th>
                    <th scope="col">عدد المشاهدات</th>
                    <th scope="col">النوع</th>
                    <th scope="col">تحكم</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach ($courses as $course)
                        <td> {{ $course->name }} </td>
                        <td> <img src="{{ asset('storage/upload_courses/' . $course->picture) }}" alt=""
                                style="height: 216px;"> </td>
                        <td> {{ $course->price }} </td>
                        <td> {{ $course->rate }} </td>
                        <td> {{ $course->views }} </td>
                        <td> {{ $course->type }} </td>
                        <td> <a class="btn btn-warning"
                                href="{{ route('editVideosPage', [$course->id, $course->name]) }}">تعديل الفيديوهات الخاصة
                                بالكورس</a> </td>
                        <td style="width: 0px;"> <a class="btn btn-warning"
                                href="{{ route('courses.edit', $course->id) }}">تعديل</a> </td>
                        <td>
                            @if (session('delete_confirm'))
                                @if ($course->id == session('delete_confirm'))
                                    <div class="alert alert-danger" role="alert">
                                        هل انت متأكد من حذف هذا الكورس
                                        <form method="POST" action="{{ route('courses.destroy', $course->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="btn btn-danger" value="تأكيد الحذف">
                                        </form>
                                    </div>
                                @else
                                    <a href="{{ route('confirmDeleteCourse', $course->id) }}" class="btn btn-danger">حذف </a>
                                @endif
                            @else
                                <a href="{{ route('confirmDeleteCourse', $course->id) }}" class="btn btn-danger">حذف </a>
                            @endif

                        </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
