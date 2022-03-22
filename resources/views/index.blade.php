@extends("welcome")

@section("content")
<div class="pr-3">
    <form action="logout" method="post">
    @csrf
        <button class="float-right btn btn-outline-danger">Logout</button>
    </form>
    <a href="profile/{{ session('USER_ID') }}" class="float-right btn btn-outline-info mr-3">Profile</a>
    <span style="font-size: 25px;">Log Reg CRUD with Image up</span>
</div>

<div>
    @if (session("login_msg"))
        <h1 class="text-center py-5 text-success">{{ session("login_msg") }}</h1>
    @endif
    <h1 class="text-center p-5 text-danger">{{ session("USER_NAME") }} greetings!</h1>
</div>

<table class="table  w-100 text-center">
    <thead class="thead-dark">
        <tr>
            <th>Name</th>
            <th>User Name</th>
            <th>E-mail</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @if(count($data) > 0)
            @foreach($data as $datas)
            <tr>
                <th class="align-middle">{{ $datas->name }}</th>
                <th class="align-middle">{{ $datas->username }}</th>
                <th class="align-middle">{{ $datas->email }}</th>
                <th class="align-middle" width="20%"><img src="{{ asset('img/'.$datas->image) }}" width="50%"></th>
                <th class="align-middle"><a href="profile/{{ $datas->id }}" class="btn btn-warning">View</a></th>
            </tr>
            @endforeach
        @else
            <tr>
                <td colspan="5">No Data Found!</td>
            </tr>
        @endif
    </tbody>
</table>
@endsection