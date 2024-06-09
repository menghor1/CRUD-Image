@extends('students.master');

@section('title')
    View Student
@endsection

@section('content-title')
    <h1 class="text-center">View Student</h1>
@endsection

@section('content')

    @if (Session::has('updatesuccess'))
    <script>
        $(document).ready(function(){
            swal({
                title: "Success!",
                text: "Data has been update success!",
                icon: "success",
                button: "Aww yiss!",
            });
        })
    </script>
    @endif
    @if (Session::has('deletesuccess'))
    <script>
        $(document).ready(function(){
            swal({
                title: "Success!",
                text: "Data has been delete success!",
                icon: "success",
                button: "Aww yiss!",
            });
        })
    </script>
    @endif
    <div class="container">
        <table class="table table-hover table-dark text-center align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Score1</th>
                    <th>Score2</th>
                    <th>Score3</th>
                    <th>Total</th>
                    <th>Average</th>
                    <th>Grade</th>
                    <th>Profile</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->gender}}</td>
                        <td>{{$item->score1}}</td>
                        <td>{{$item->score2}}</td>
                        <td>{{$item->score3}}</td>
                        <td>{{$item->total}}</td>
                        <td>{{$item->average}}</td>
                        <td>{{$item->grade}}</td>
                        <td><img src="{{url('image/'.$item->profile)}}" alt="" width="110" height="150"></td>
                        <td>
                            <a href="/update/{{$item->id}}" class="btn btn-warning">Update</a>
                            {{-- <button class="btn btn-warning">Update</button> --}}
                            <button type="submit" id="btn-delete" data-bs-toggle="modal" data-bs-target="#exampleModal" remove="{{$item->id}}" class="btn btn-danger">Delete</button>                            
                        </td>
                    </tr>
                @empty
                    <h1>No Student</h1>
                @endforelse
            </tbody>
        </table>
        
              <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Do you want to delete it?</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <div class="modal-footer">
            <form action="/delete" method="post">
              @csrf
              @method('delete')
              <input type="hidden" name="remove_id" id="remove-val" >
              <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
      </div>
    </div>
  </div>

    </div>
@endsection