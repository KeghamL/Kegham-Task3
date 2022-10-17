@extends('student.studentlayout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>New Assignments</h2>
                <br>
            </div>
        </div>
    </div>
    <table class="table">
        <thead>
            <th>CourseName</th>
            <th>SubjectName</th>
            <th>TeacherName</th>
            <th>Mark</th>
            <th>Last Day Of Submission</th>
            <th>Status</th>
            <th>image</th>
        </thead>
        @foreach ($assignments as $assignment)
            <tbody>
                <tr>
                    <td>{{ $assignment->course->course ?? 'unknown' }}({{ $assignment->course->branch ?? 'unknown' }})</td>
                    <td>{{ $assignment->subject->subjectfullname ?? 'unknown' }}({{ $assignment->subject->subjectshortname ?? 'unknown' }})
                    </td>
                    <td>{{ $assignment->user->fname ?? 'unknown' }}</td>
                    <td>{{ $assignment->marks ?? 'unknown' }}</td>
                    <td>{{ $assignment->submission ?? 'unknown' }}</td>
                    <td>{{ $assignment->status ?? 'unknown' }}</td>
                    <td>{{ $assignment->image ?? 'unknown' }}</td>
                    <td>
                        <a href="{{ route('answer', ['id' => $assignment->id]) }}" class="btn btn-success">Submit</a>
                    </td>
                </tr>
        @endforeach
        </tbody>

    </table>
@endsection
