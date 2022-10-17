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
        <h2 class="fw-bolder">Give Mark</h2>
    </div>
    <div class="row gx-5 justify-content-center">


        <div class="col-lg-6">
            <form action="/submitmark" method="POST">
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
                        <input type="hidden" name="answer_id" value="{{ Request::query()['id'] }}">
                    </div>
                </div>


                <div class="form-group row">
                    <label for="description">Teacher Description</label>
                    <input type="text" id="description" class="form-control" placeholder="Enter Your Description"
                        name="description" value="{{ old('description') }}" />
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-group row">
                    <label for="description">Test Mark</label>
                    <input type="number" id="mark" class="form-control" placeholder="Enter Your Mark" name="mark"
                        value="{{ old('mark') }}" />
                    @error('mark')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="d-grid "><button class="btn btn-success btn-lg" id="run" type="submit">Submit
                        Mark</button>
                </div>
            </form>
        </div>
    </div>
@endsection
