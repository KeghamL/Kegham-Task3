@extends('teacher.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>UnChecked Assignment</h2>
                <br>
            </div>
        </div>
    </div>
    <div id="image-popup">
        <img id="large-image" src="" alt="">
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
            <th>Assignment-Viewd</th>
            <th>Action</th>
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
                    <td> <embed class="open" src="{{ Storage::url($assignment->image) }}" width="50px" height="50px">
                        <a href="{{ Storage::url($assignment->image) }}" download="{{ $assignment->image }}">Download</a>
                    </td>
                    <td>{{ $assignment->status ?? 'unknown' }}</td>
                    <td><i class="fa fa-eye" aria-hidden="true"></i>
                        {{ $assignment->views ?? 'unknown' }}
                    </td>
                    <td>
                        <a href="{{ route('check-assignment', $assignment->id) }}" class="btn btn-success">Check</a>
                    </td>
                    <td>
                        <a href="/showanswer/{{ $assignment->id }}" class="btn btn-info">View</a>
                        @csrf
                    </td>
                </tr>
        @endforeach
        </tbody>

    </table>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".open").click(function() {
                var path = $(this).attr('src');
                $("#large-image").attr('src', path);
                $("#image-popup").show();
            })
            $("#image-popup").click(function() {
                $("#image-popup").hide();
            })
        })
    </script>
@endsection
