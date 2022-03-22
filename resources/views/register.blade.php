@extends("welcome")

@section("content")
<div class="container">
    <form action="submitReg" method="POST" enctype="multipart/form-data">
        @csrf
    <div class="row">
        <div class="shadow p-5 col-md-12">
            <h2 class=" text-center">Registration Form</h2>
            <label for="">Name:</label>
            <input type="text" name="name" class="form-control" placeholder="Enter Your Name">
            @error("name")
                <div class="badge-danger badge-pill d-inline-block float-right mr-2">{{ $message }}</div><br>
            @enderror

            <label for="">Username:</label>
            <input type="text" name="username" class="form-control" placeholder="Enter Your Username">
            @error("username")
                <div class="badge-danger badge-pill d-inline-block float-right mr-2">{{ $message }}</div><br>
            @enderror

            <label for="">E-mail:</label>
            <input type="text" name="email" class="form-control" placeholder="Enter Your E-mail">
            @error("email")
                <div class="badge-danger badge-pill d-inline-block float-right mr-2">{{ $message }}</div><br>
            @enderror

            <label for="">Image:</label>
            <input type="file" class="mt-3 mb-3" name="image">
            @error("image")
                <div class="badge-danger badge-pill d-inline-block">{{ $message }}</div>
            @enderror

            <br>
            <label for="">Password:</label>
            <input type="password" name="password" class="form-control" placeholder="Enter Your Password">
            @error("password")
                <div class="badge-danger badge-pill d-inline-block float-right mr-2">{{ $message }}</div><br>
            @enderror

            <button type="submit" class="btn btn-success form-control mt-3">Submit</button>
            <a href="/" class="btn btn-primary mt-2 form-control">Already Have An Account! Click Here To Log In.</a> <br> <br>
            @if(session("msg")) 
                <span class="form-control bg-info rounded text-white text-center  justify-content-center align-content-center">
                    {{session("msg") }}
                </span>
            @endif
        </div>
    </div>
    </form>
</div>
@endsection