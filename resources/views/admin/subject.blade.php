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


    <form action="/savesubject" method="POST">
        @csrf
        <div class="form-group row">
            <label for="CourseName" class="col-sm-4 col-form-label">Course Name</label>
            <div class="col-sm-10">
                <select class="w3-input w3-border" name="course_id" style="width:390px; height:40px;">
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->course }}({{ $course->branch }})</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="SubjectFullName" class="col-sm-4 col-form-label">Subject FullName</label>
            <div class="col-sm-10">
                <input type="text" name="subjectfullname" class="form-control" placeholder="Subject FullName">
            </div>
        </div>
        <div class="form-group row">
            <label for="SubjectShortName" class="col-sm-4 col-form-label">Subject ShortName</label>
            <div class="col-sm-10">
                <input type="text" name="subjectshortname" class="form-control" placeholder="Subject ShortName">
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
            <th>Subject FullName</th>
            <th>Subject ShortName</th>
        </thead>
        @foreach ($subjects as $subject)
            <tbody>
                <tr>
                    <td>{{ $course->course }}({{ $course->branch }})</td>
                    <td>{{ $subject->subjectfullname }}</td>
                    <td>{{ $subject->subjectshortname }}</td>
                    <td>
                        <form action="{{ route('delete-subject', $subject->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to Delete Subject?');">DELETE</button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('showedit-subject', $subject->id) }}" class="btn btn-info">Edit</a>
                    </td>
                </tr>
        @endforeach
        </tbody>

    </table>

@endsection
