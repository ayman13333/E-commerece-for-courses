@extends('layouts.app')
@section('content')
<div class="container">
    <h1> مرحبا من صفحة اضافة كورس </h1>
    <form method="post" action="{{ route('courses.store') }}"  enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">اسم الكورس</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                 name="name">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">صورة الكورس</label>
            <input type="file" class="form-control" id="exampleInputPassword1" name="photo" >
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">السعر</label>
            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                 name="price">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1" style="margin-top: 10px;display: block;font-size: x-large">التصنيف</label>
            <input type="radio"   name="type" value="free" required>
            <label >مجاني</label><br>
            <input type="radio"    name="type" value="paid" required>
            <label >مدفوع</label><br>
        </div>
        <button type="submit" class="btn btn-success">اضافة</button>
        <a href="{{route('courses.index')}}" class="btn btn-primary">الرجوع لصفحة الكورسات الرئيسية</a>

    </form>
</div>

@endsection
