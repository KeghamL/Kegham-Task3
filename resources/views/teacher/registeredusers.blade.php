@extends('teacher.layout')

@section('content')
    <table class="table">
        <thead>
            <th>Student-FirstName</th>
            <th>Student-LastName</th>
            <th>Student-Course</th>
            <th>Student-Email</th>
            <th>Student-RegistrationDate</th>
            <th></th>
        </thead>
        @foreach ($users as $user)
            <tbody>
                <tr>
                    <td>{{ $user->fname }}</td>
                    <td>{{ $user->lname }}</td>
                    <td>{{ $user->course->course ?? 'unknown' }}({{ $user->course->branch ?? 'unknown' }})</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                </tr>
        @endforeach
        </tbody>

    </table>
@endsection
