@extends('students.master');

@section('title')
    Update Student
@endsection

@section('content-title')
    <h1 class="text-center">Update Student</h1>
@endsection

@section('content')

    

    @if (Session::has('updateunsuccess'))
        <script>
            $(document).ready(function(){
                swal({
                    title: "Error!",
                    text: "Data cannot be null!",
                    icon: "error",
                    button: "Aww yiss!",
                });
            })
        </script>
    @endif

    <form action="/update" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row g-3">
            <input type="text" name="update_id" value="{{$student->id}}">
            <div class="col-12">
                <label for="">Name:</label>
                <input type="text" name="name" value="{{$student->name}}" id="" class="form-control" placeholder="Name">
            </div>
            <div class="col-12">
                <label for="">Gender:</label>
                <select name="gender" id="" class="form-select">
                    <option value="Male" @if($student->gender == "Male") selected @endif>Male</option>
                    <option value="Female" @if($student->gender == "Female") selected @endif>Female</option>
                </select>
            </div>
            <div class="col-4">
                <label for="">Score1:</label>
                <input type="text" name="score1" value="{{$student->score1}}"  id="" class="form-control" placeholder="Score1">
            </div>
            <div class="col-4">
                <label for="">Score2:</label>
                <input type="text" name="score2" value="{{$student->score2}}" id="" class="form-control" placeholder="Score2">
            </div>
            <div class="col-4">
                <label for="">Score3:</label>
                <input type="text" name="score3" value="{{$student->score3}}" id="" class="form-control" placeholder="Score3">
            </div>
            <div class="col-12">
                <label for="">Profile:</label>
                <input type="file" name="profile" id="" class="form-control" >
                <img src="{{url('image/'.$student->profile)}}" alt="" width="110" height="150">
                <input type="hidden" name="old_profile" value="{{$student->profile}}">
            </div>
            <div class="col-6 mx-auto">
                <button class="btn btn-outline-success rounded-0 w-100">Update</button>
            </div>
        </div>
    </form>
@endsection