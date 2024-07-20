@extends('layouts.app')

@section('content')
<div class="container">
    <h2>我的个人资料</h2>
    <form action="{{ route('students.profile.update') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">姓名</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $student->name }}">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $student->email }}">
        </div>
        <button type="submit" class="btn btn-primary">保存</button>
    </form>
</div>
@endsection