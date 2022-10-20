@extends('admin.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Statistics Page</h2>
                <br>
            </div>
        </div>
    </div>
    <table class="table">
        <thead>
            <th>ID</th>
            <th>Visited Page</th>
            <th>User Name</th>
            <th>User Email</th>
            <th>Date Of Visit</th>
            <th>
                <form action="/statisticsdelete" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Are you sure you want to Reset All Statistics?');">RESET</button>
                </form>
            </th>
        </thead>
        @foreach ($activities as $activity)
            <tbody>
                <tr>
                    <td>{{ $activity->id ?? 'unknown' }}</td>
                    <td>{{ $activity->urladdress ?? 'unknown' }}</td>
                    <td>{{ $activity->user->fname ?? 'unknown' }} {{ $activity->user->lname ?? 'unknown' }}</td>
                    <td>{{ $activity->user->email ?? 'unknown' }}</td>
                    <td>{{ $activity->created_at ?? 'unknown' }}</td>
                </tr>
        @endforeach
        </tbody>

    </table>
@endsection
