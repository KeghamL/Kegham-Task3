@extends('admin.layout')

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if ($message = Session::get('fail'))
        <div class="aler alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif


    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Manage Teachers</h2>
                <br>
            </div>
        </div>
    </div>
    <table class="table">
        <thead>
            <th>Teacher-FirstName</th>
            <th>Teacher-LastName</th>
            <th>Teacher-Email</th>
            <th>Teacher-Password</th>
            <th>Teacher-Course_id</th>
            <th>Teacher-Birthday</th>
            <th>Teacher-Gender</th>
            <th>Teacher-Delete</th>
            <th>Teacher-Edit</th>
        </thead>
        @foreach ($users as $user)
            <tbody>
                <tr>
                    <td>{{ $user->fname }}</td>
                    <td>{{ $user->lname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->password }}</td>
                    <td>{{ $user->course_id }}</td>
                    <td>{{ $user->birthday }}</td>
                    <td>{{ $user->gender }}</td>
                    <td>
                        <form action="{{ route('delete-teacher', $user->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to Delete Teacher?');">DELETE</button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('showedit-teacher', $user->id) }}" class="btn btn-info">Edit</a>
                    </td>
                </tr>
        @endforeach
        </tbody>

    </table>
@endsection
