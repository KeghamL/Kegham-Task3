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



    <div class="text-center mb-5">
        <h2 class="fw-bolder">Add New Assignment</h2>
    </div>
    <div class="row gx-5 justify-content-center">
        <div class="col-lg-6">
            <form action="/addassignment" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="course">Assignment Course Name</label>
                    <select class="w3-input w3-border" name="course_id" style="width:540px; height:40px;">
                        <option value="{{ $course->id }}">
                            {{ $course->course }}({{ $course->branch }})</option>
                    </select>
                </div>

                <div class="form-group row">
                    <label for="subject">Assignment Subject Name</label>
                    <select class="w3-input w3-border" name="subject_id" style="width:540px; height:40px;">
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}">
                                {{ $subject->subjectfullname }}({{ $subject->subjectshortname }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group row">
                    <label for="Title" class="col-sm-4 col-form-label"></label>
                    <div class="col-sm-10">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    </div>
                </div>


                <div class="form-group row">
                    <label for="title">Assignment Title</label>
                    <input type="text" id="title" class="form-control" placeholder="Enter Assignment Title"
                        name="title" value="{{ old('title') }}" />
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="description">Assignment Description</label>
                    <input type="text" id="description" class="form-control" placeholder="Enter Assignment Description"
                        name="description" value="{{ old('description') }}" />
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="marks">Assignment Mark</label>
                    <input type="number" id="marks" class="form-control" placeholder="Enter Assignment Mark"
                        name="marks" value="{{ old('marks') }}" />
                    @error('marks')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="submission">Assignment Last Date Of Submission</label>
                    <input type="datetime-local" id="submission" class="form-control"
                        min="{{ $min_date->format('Y-m-d\TH:i:s') }}" max="{{ $max_date->format('Y-m-d\TH:i:s') }}"
                        placeholder="Enter Assignment Last Date Of Submission" name="submission"
                        value="{{ old('submission') }}" />
                    @error('submission')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="image">Assignment Picture</label>
                    <input type="file" id="image" class="form-control" placeholder="" name="image"
                        value="{{ old('image') }}">
                    @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid "><button class="btn btn-success btn-lg" id="run" type="submit">ADD</button>
                </div>
            </form>
        </div>
    </div>
@endsection
