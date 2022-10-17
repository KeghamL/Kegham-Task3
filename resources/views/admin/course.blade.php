@extends('admin.layout')

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


    <form action="/savecourse" method="POST">
        @csrf
        <div class="form-group row">
            <label for="CourseName" class="col-sm-4 col-form-label">Course Name</label>
            <div class="col-sm-10">
                <input type="text" name="course" class="form-control" placeholder="Course">
            </div>
        </div>
        <div class="form-group row">
            <label for="BranchName" class="col-sm-4 col-form-label">Branch Name</label>
            <div class="col-sm-10">
                <input type="text" name="branch" class="form-control" placeholder="Branch">
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
            <th>CourseName</th>
            <th>BranchName</th>
        </thead>
        @foreach ($courses as $course)
            <tbody>
                <tr>
                    <td>{{ $course->course }}</td>
                    <td>{{ $course->branch }}</td>
                    <td>
                        <form action="{{ route('delete-course', $course->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to Delete Course?');">DELETE</button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('showedit-course', $course->id) }}" class="btn btn-info">Edit</a>
                    </td>
                </tr>
        @endforeach
        </tbody>

    </table>

@endsection
