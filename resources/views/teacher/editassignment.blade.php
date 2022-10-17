@extends('teacher.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Assignment</h2>
            </div>
        </div>
    </div>

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

    <form action="/editassignment{{ $assignment->id }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Course Name:</strong>
                    <select class="form-control" name="course_id" style="width:540px; height:40px;">
                        <option value="{{ $course->id }}">{{ $course->course }}({{ $course->branch }})</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Subject Name:</strong>
                    <select class="form-control" name="subject_id" style="width:540px; height:40px;">
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}">
                                {{ $subject->subjectfullname }}({{ $subject->subjectshortname }})</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Title:</strong>
                    <input type="text" name="title" value="{{ $assignment->title }}" class="form-control"
                        placeholder="">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    <input type="text" name="description" value="{{ $assignment->description }}" class="form-control"
                        placeholder="">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Marks:</strong>
                    <input type="text" name="marks" value="{{ $assignment->marks }}" class="form-control"
                        placeholder="">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Last Date Of Submission:</strong>
                    <input type="text" name="submission" value="{{ $assignment->submission }}" class="form-control"
                        placeholder="">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Assignment Photo:</strong>
                    <input type="file" name="image" value="{{ $assignment->image }}" class="form-control"
                        placeholder="" required>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-success btn-lg">Update</button>
            </div>
        </div>
    </form>
@endsection
