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
                    <td><span class="countdown" {{ $assignment->submission ?? 'unknown' }}></span></td>
                    <td>{{ $assignment->status ?? 'unknown' }}</td>
                    <td><embed src="{{ Storage::url($assignment->image) }}" width="50px" height="50px"></td>
                    <td>
                        <a href="{{ route('answer', ['id' => $assignment->id]) }}" class="btn btn-success">Submit</a>
                    </td>
                </tr>
        @endforeach
        </tbody>

    </table>
    <script type="text/javascript">
        var count_id = '{{ $assignment->submission }}';
        var countDownDate = new Date(count_id).getTime();
        var x = setInterval(function() {
                var now = new Date().getTime();
                var distance = countDownDate - now;
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                document.getElementsByClassName("countdown")
                    .innerHTML = days + "d  " +
                    hours + "h " + minutes + "m " + seconds + "s";
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementsByClassName("countdown").innerHTML = "ENDED!";
                }
            },
            1000);
    </script>
@endsection
