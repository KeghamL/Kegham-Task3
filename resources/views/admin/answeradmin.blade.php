@extends('admin.layout')

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
                <h2>Student Answer</h2>
                <br>
            </div>
        </div>
    </div>
    <table class="table">
        <thead>
            <th>Student-FullName</th>
            <th>Student-Email</th>
            <th>Assignment-Mark</th>
            <th>Answer-Description</th>
            <th>Answer-Image</th>
        </thead>
        @foreach ($answers as $answer)
            <tbody>
                <tr>
                    <td>{{ $answer->user->fname }}{{ $answer->user->lname }}</td>
                    <td>{{ $answer->user->email }}</td>
                    <td>{{ $answer->assignment->marks }}</td>
                    <td>{{ $answer->description }}</td>
                    <td><embed src="{{ Storage::url($answer->image) }}" width="50px" height="50px"></td>
                </tr>
        @endforeach
        </tbody>

    </table>


    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Teacher Feedback</h2>
                <br>
            </div>
        </div>
    </div>
    <table class="table">
        <thead>
            <th>Student-FullName</th>
            <th>Student-Email</th>
            <th>Student-Course</th>
            <th>Student-Subject</th>
            <th>Given-Mark</th>
            <th>Given-Description</th>
        </thead>
        @if (!empty($marks))
            @foreach ($marks as $mark)
                <tbody>
                    <tr>
                        <td>{{ $mark->user->fname ?? 'unknown' }} {{ $mark->user->lname ?? 'unknown' }}</td>
                        <td>{{ $mark->user->email ?? 'unknown' }}</td>
                        <td>{{ $mark->user->course->course ?? 'unknown' }}({{ $mark->user->course->branch ?? 'unknown' }})
                        </td>
                        <td>{{ $mark->user->subject->subjectfullname ?? 'unknown' }}</td>
                        <td>{{ $mark->mark ?? 'unknown' }}</td>
                        <td>{{ $mark->description ?? 'unknown' }}</td>
                    </tr>
                </tbody>
            @endforeach
        @endif
    </table>
@endsection
