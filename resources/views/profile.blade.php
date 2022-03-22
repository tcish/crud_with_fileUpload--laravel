@extends("welcome")

@section("content")
<div class="pr-3">
    <form action="{{url('logout')}}" method="post">
    @csrf
        <button class="float-right btn btn-outline-danger">Logout</button>
    </form>
    <a href="{{ url('index') }}" class="float-right btn btn-outline-info mr-3">Go Back</a>
    <span style="font-size: 25px;">Log Reg CRUD with Image up</span>
</div><br><br>
<form action="{{ route('submitUpdate', [$getById->id]) }}" method="post" enctype="multipart/form-data">
@csrf
    <div class="container shadow p-5">
        <h1 class="text-center">User Profile</h1>
        <label for="">Name:</label>
        <input type="text" name="name" class="form-control" placeholder="Please Enter Your Name!" value="{{ $getById->name }}">
        @error("name")
            <div class="badge-danger badge-pill d-inline-block float-right mr-2">{{ $message }}</div><br>
        @enderror

        <label for="">User Name:</label>
        <input type="text" name="username" id="" class="form-control" placeholder="Please Enter Your User Name!" value="{{ $getById->username }}">
        @error("username")
            <div class="badge-danger badge-pill d-inline-block float-right mr-2">{{ $message }}</div><br>
        @enderror

        <label for="">E-mail:</label>
        <input type="text" name="email" id="" class="form-control" placeholder="Please Enter Your E-mail!" value="{{ $getById->email }}">
        @error("email")
            <div class="badge-danger badge-pill d-inline-block float-right mr-2">{{ $message }}</div><br>
        @enderror

        <label for="">Image:</label>
        <img src="{{ asset('img/'.$getById->image) }}" width="20%" class="m-3" alt="">
        <input type="file" name="image">
        @error("image")
            <div class="badge-danger badge-pill d-inline-block">{{ $message }}</div>
        @enderror
        @if(session("USER_ID") == $getById->id)
            <div>
                <button type="submit" class=" btn btn-success mt-3">Update Info</button>
                <a href="{{ route('changePass', [$getById->id]) }}" type="submit" class="btn btn-success mt-3">Update Password</a>
            </div>
        @endif
        @if(session("msg"))
            <span class="btn btn-primary form-control mt-3">{{ session("msg") }}</span>
        @endif
    </div>
</form>
@endsection