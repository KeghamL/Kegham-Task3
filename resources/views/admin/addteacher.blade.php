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
    <div class="text-center mb-5">
        <h2 class="fw-bolder">Add New Teacher</h2>
    </div>
    <div class="row gx-5 justify-content-center">
        <div class="col-lg-6">
            <form action="/addteacher" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-floating mb-3">
                    <label for="firstname">FirstName</label>
                    <input type="name" id="fname" class="form-control" placeholder="Enter Teachers FirstName"
                        name="fname" value="{{ old('fname') }}" />
                    @error('fname')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <label for="lastname">LastName</label>
                    <input type="name" id="lname" class="form-control" placeholder="Enter Teachers LastName"
                        name="lname" value="{{ old('lname') }}" />
                    @error('lname')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <label for="email">E-Mail</label>
                    <input type="email" id="email" class="form-control" placeholder="Enter Teachers Email"
                        name="email" value="{{ old('email') }}" />
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <label for="password">Password</label>
                    <input type="password" id="password" class="form-control" placeholder="Enter Your Password"
                        name="password" value="{{ old('password') }}">
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <label for="password">Confirm Password</label>
                    <input type="password" id="repassword" class="form-control" placeholder="Confirm Your Password"
                        name="repassword" value="{{ old('repassword') }}">
                    @error('repassword')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-group row">
                    <label for="CourseName" class="col-sm-4 col-form-label">Course Name</label>
                    <div class="col-sm-10">
                        <select class="w3-input w3-border" name="course_id" style="width:540px; height:40px;">
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->course }}({{ $course->branch }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-floating mb-3">
                    <label for="date">Birth Date</label>
                    <input type="date" id="birthday" class="form-control" placeholder="Enter Teachers Birthday"
                        name="birthday" value="{{ old('birthday') }}">
                    @error('birthday')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <label for="number">Role</label>
                    <input type="number" id="role_as" class="form-control"
                        placeholder="0 For User & 1 For Admin & 2 For Teacher" name="role_as" value="{{ old('role_as') }}">
                    @error('role_as')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-floating mb-3">
                    <label for="image">Profile Picture</label>
                    <input type="file" id="image" class="form-control" placeholder="" name="image"
                        value="{{ old('image') }}">
                    @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="radio" id="gender" name="gender" value="male">Male
                    <input type="radio" id="gender" name="gender" value="female">Female
                    @error('gender')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid "><button class="btn btn-success btn-lg" id="run" type="submit">Create</button>
                </div>
            </form>
        </div>
    </div>
@endsection
