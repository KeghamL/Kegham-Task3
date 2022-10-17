@extends('student.studentlayout')
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
        <h2 class="fw-bolder">Submit Your Answer</h2>
    </div>
    <div class="row gx-5 justify-content-center">


        <div class="col-lg-6">
            <form action="/addanswer" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group row">
                    <label for="Title" class="col-sm-4 col-form-label"></label>
                    <div class="col-sm-10">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="Title" class="col-sm-4 col-form-label"></label>
                    <div class="col-sm-10">
                        <input type="hidden" name="assignment_id" value="{{ Request::query()['id'] }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="Title" class="col-sm-4 col-form-label"></label>
                    <div class="col-sm-10">
                        <input type="hidden" name="course_id" value="{{ Auth::user()->course_id }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="Title" class="col-sm-4 col-form-label"></label>
                    <div class="col-sm-10">
                        <input type="hidden" name="subject_id" value="{{ Auth::user()->subject_id }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="Title" class="col-sm-4 col-form-label"></label>
                    <div class="col-sm-10">
                        <input type="hidden" name="subject_id" value="{{ Auth::user()->assignment_id }}">
                    </div>
                </div>


                <div class="form-group row">
                    <label for="description">Answer Description</label>
                    <input type="text" id="title" class="form-control" placeholder="Enter Your Description"
                        name="description" value="{{ old('description') }}" />
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>



                <div class="form-group row">
                    <label for="image">Submit Answers Image</label>
                    <input type="file" id="image" class="form-control" placeholder="" name="image"
                        value="{{ old('image') }}">
                    @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid "><button class="btn btn-success btn-lg" id="run" type="submit">Submit
                        Answer</button>
                </div>
            </form>
        </div>
    </div>
@endsection
