    @extends('student.studentlayout')

    @section('content')
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Uploaded Assignment</h2>
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
                <th>Assignment-Status</th>
                <th>Action</th>
            </thead>
            @foreach ($assignments as $assignment)
                <tbody>
                    <tr>
                        <td>{{ $assignment->course->course ?? 'unknown' }}({{ $assignment->course->branch ?? 'unknown' }})
                        </td>
                        <td>{{ $assignment->subject->subjectfullname ?? 'unknown' }}({{ $assignment->subject->subjectshortname ?? 'unknown' }})
                        </td>
                        <td>{{ $assignment->title ?? 'unknown' }}</td>
                        <td>{{ $assignment->description ?? 'unknown' }}</td>
                        <td>{{ $assignment->marks ?? 'unknown' }}</td>
                        <td>{{ $assignment->submission ?? 'unknown' }}</td>
                        <td>{{ $assignment->image ?? 'unknown' }}</td>
                        <td>{{ $assignment->status ?? 'unknown' }}</td>
                        <td>
                            <a href="/showanswerstudent/{{ $assignment->id }}" class="btn btn-info">View</a>
                        </td>
                    </tr>
            @endforeach
            </tbody>
        @endsection
