@extends('teacher.layout')

@section('content')

    <style>
        .form-group {
            width: 500px;
        }
    </style>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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


    <form action="/addannouncment" method="POST">
        @csrf
        <div class="form-group row">
            <label for="Title" class="col-sm-4 col-form-label">Title</label>
            <div class="col-sm-10">
                <input type="text" name="title" class="form-control" placeholder="Enter Your Title">
            </div>
        </div>

        <div class="form-group row">
            <label for="Title" class="col-sm-4 col-form-label"></label>
            <div class="col-sm-10">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="Title" class="col-sm-4 col-form-label"></label>
            <div class="col-sm-10">
                <input type="hidden" name="course_id" value="{{ Auth::user()->course_id }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="Description" class="col-sm-4 col-form-label">Description</label>
            <div class="col-sm-10">
                <input type="text" name="description" class="form-control" placeholder="Enter Your Description">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </div>
    </form>
    <br>
    <table class="table">
        <thead>
            <th>Title</th>
            <th>Description</th>
            <th>Action</th>
        </thead>
        @foreach ($announcments as $announcment)
            <tbody>
                <tr>
                    <td>{{ $announcment->title }}</td>
                    <td>{{ $announcment->description }}</td>
                    <td>
                        <form action="{{ route('delete-announcment', $announcment->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to Delete Announcement?');">DELETE</button>
                        </form>
                    </td>
                </tr>
        @endforeach
        </tbody>

    </table>

@endsection
