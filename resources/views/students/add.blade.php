@extends('students.master');

@section('title')
    Add Student
@endsection

@section('content-title')
    <h1 class="text-center">Add Student</h1>
@endsection

@section('content')
    <form action="" method="post">
        <div class="row g-3">
            <div class="col-12">
                <label for="">Name:</label>
                <input type="text" name="" id="" class="form-control" placeholder="Name">
            </div>
            <div class="col-12">
                <label for="">Gender:</label>
                <select name="" id="" class="form-select">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="col-4">
                <label for="">Score1:</label>
                <input type="text" name="" id="" class="form-control" placeholder="Score1">
            </div>
            <div class="col-4">
                <label for="">Score2:</label>
                <input type="text" name="" id="" class="form-control" placeholder="Score2">
            </div>
            <div class="col-4">
                <label for="">Score3:</label>
                <input type="text" name="" id="" class="form-control" placeholder="Score3">
            </div>
            <div class="col-12">
                <label for="">Profile:</label>
                <input type="file" name="" id="" class="form-control" >
            </div>
            <div class="col-6 mx-auto">
                <button class="btn btn-outline-success rounded-0 w-100">Submit</button>
            </div>
        </div>
    </form>
@endsection