@extends('students.master')

@section('title')
    Logout
@endsection

@section('content-title')
    <h1 class="text-center">Logout</h1>
@endsection
@section('content')
    <form action="/logout" method="POST">
        @csrf
        <h4>Are you sure that you want to logout?</h4>
        <button class="btn btn-danger">Yes</button>
        <a href="/" class="btn btn-success">No</a>
    </form>
@endsection