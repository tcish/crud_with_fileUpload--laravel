@extends("welcome")

@section("content")
    <div class="container">
        <div class="row">
            <div class="shadow p-5 col-md-12">
                <h2 class="text-center">Login From</h2>
                <form action="submitLog" method="POST">
                    @csrf
                    <label for="">E-mail:</label>
                    <input type="text" name="email" class="form-control">
                    @error("email")
                        <span class="badge-danger badge-pill float-right mr-2">{{$message }}</span><br>
                    @enderror
                    <label for="">Password:</label>
                    <input type="password" name="password" class="form-control">
                    @error("password")
                        <span class="badge-danger badge-pill float-right mr-2">{{$message }}</span><br>
                    @enderror
                    <button type="submit" class="btn btn-success form-control mt-3">Log In</button>
                    <a href="register" class="btn btn-warning mt-2 form-control text-dark">Not Have Any Account! Click Here.</a> <br> <br>
                    @if(session("msg")) 
                        <span class="form-control bg-danger rounded text-white text-center  justify-content-center align-content-center">
                            {{ session("msg") }}
                        </span>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection