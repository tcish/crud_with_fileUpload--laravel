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
<form action="{{ route('submitUpPass', [$getId->id]) }}" method="post">
@csrf
    <div class="container shadow p-5">
        <h1 class="text-center">User Profile</h1>
        <label for="">Old Password:</label>
        <input type="password" name="oldPass" class="form-control">
        @error("oldPass")
            <div class="badge-danger badge-pill d-inline-block float-right mr-2">{{ $message }}</div><br>
        @enderror

        <label for="">New Password:</label>
        <input type="password" name="newPass" id="" class="form-control">
        @error("newPass")
            <div class="badge-danger badge-pill d-inline-block float-right mr-2">{{ $message }}</div><br>
        @enderror

        @if(session("USER_ID") == $getId->id)
            <div>
                <button type="submit" class="form-control btn btn-success mt-3">Update Password</button>
            </div>
        @endif
        @if(session("msg"))
            <span class="btn btn-primary form-control mt-3">{{ session("msg") }}</span>
        @endif
    </div>
</form>
@endsection