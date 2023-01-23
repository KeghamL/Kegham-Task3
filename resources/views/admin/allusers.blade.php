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
                <h2>Teachers & Students Of The Website</h2>
                <br>
            </div>
        </div>
    </div>
    <form action="/deleteallusers" method="POST">
        @csrf
        @method('delete')
        <table class="table">
            <thead>
                <th>No</th>
                <th>Select</th>
                <th>FirstName</th>
                <th>LastName</th>
                <th>Email</th>
                <th>Course</th>
                <th>Birthday</th>
                <th>Gender</th>
                <th>Role</th>
                <th>RegisterDate</th>
            </thead>
            @foreach ($users as $user)
                <tbody>
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td><input type="checkbox" class="check-list" name="ids[{{ $user->id }}]"
                                value="{{ $user->id }}"></td>
                        <td>{{ $user->fname ?? 'unknown' }}</td>
                        <td>{{ $user->lname ?? 'unknown' }}</td>
                        <td>{{ $user->email ?? 'unknown' }}</td>
                        <td>{{ $user->course->course ?? 'unknown' }}({{ $user->course->branch ?? 'unknown' }})</td>
                        <td>{{ $user->birthday ?? 'unknown' }}</td>
                        <td>{{ $user->gender ?? 'unknown' }}</td>
                        <td>{{ $user->role_as ?? 'unknown' }}</td>
                        <td>{{ $user->created_at ?? 'unknown' }}</td>
                    </tr>
            @endforeach
            <button type="submit" id="btn-delete" class="btn btn-danger"
                onclick="return confirm('Are you sure you want to delete this User?');" disabled>Delete
                Selected</button>
            </tbody>

        </table>
        <script>
            $(document).ready(function() {
                $('.check-list').change(function() {
                    $('#btn-delete').prop('disabled', !($(this).is(":checked")));
                });
            });
        </script>
    @endsection
