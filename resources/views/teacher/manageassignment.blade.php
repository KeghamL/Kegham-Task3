@extends('teacher.layout')

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
                <h2>Manage Assignments</h2>
                <br>
            </div>
        </div>
    </div>
    <table class="table">
        <thead>
            <th>Assignment-course</th>
            <th>Assignment-subject</th>
            <th>Assignment-Title</th>
            <th>Assignment-Description</th>
            <th>Assignment-Marks</th>
            <th>Assignment-Last Day Of Submission</th>
            <th>Assignment-image</th>
            <th>Assignment-Edit</th>
            <th>Assignment-Delete</th>
        </thead>
        @foreach ($assignments as $assignment)
            <tbody>
                <tr>
                    <td>{{ $assignment->course->course ?? 'unknown' }}({{ $assignment->course->branch ?? 'unknown' }})</td>
                    <td>{{ $assignment->subject->subjectfullname ?? 'unknown' }}({{ $assignment->subject->subjectshortname ?? 'unknown' }})
                    </td>
                    <td>{{ $assignment->title ?? 'unknown' }}</td>
                    <td>{{ $assignment->description ?? 'unknown' }}</td>
                    <td>{{ $assignment->marks ?? 'unknown' }}</td>
                    <td>{{ $assignment->submission ?? 'unknown' }}</td>
                    <td> <embed src="{{ Storage::url($assignment->image) }}" width="50px" height="50px"></td>
                    <td>
                        <a href="{{ route('showedit-assignment', $assignment->id) }}" class="btn btn-info">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('delete-assignment', $assignment->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to Delete This Assignement?');">DELETE</button>
                        </form>
                    </td>
                </tr>
        @endforeach
        </tbody>

    </table>
@endsection
