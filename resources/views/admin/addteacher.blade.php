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
                        name="fname" value="{{ old('fname') }}"
                        @error('fname')
                        style="border-color:rgb(221, 18, 18);"
                        @enderror>
                </div>

                <div class="form-floating mb-3">
                    <label for="lastname">LastName</label>
                    <input type="name" id="lname" class="form-control" placeholder="Enter Teachers LastName"
                        name="lname" value="{{ old('lname') }}"
                        @error('lname')
                        style="border-color:rgb(221, 18, 18);"
                        @enderror>
                </div>

                <div class="form-floating mb-3">
                    <label for="email">E-Mail</label>
                    <input type="email" id="email" class="form-control" placeholder="Enter Teachers Email"
                        name="email" value="{{ old('email') }}"
                        @error('email')
                        style="border-color:rgb(221, 18, 18);"
                        @enderror>
                </div>

                <div class="form-floating mb-3">
                    <label for="password">Password</label>
                    <input type="password" id="password" class="form-control" placeholder="Enter Your Password"
                        name="password" value="{{ old('password') }}"
                        @error('password')
                        style="border-color:rgb(221, 18, 18);"
                        @enderror>
                </div>

                <div class="form-floating mb-3">
                    <label for="password">Confirm Password</label>
                    <input type="password" id="repassword" class="form-control" placeholder="Confirm Your Password"
                        name="repassword" value="{{ old('repassword') }}"
                        @error('repassword')
                        style="border-color:rgb(221, 18, 18);"
                        @enderror>
                </div>


                <div class="form-group row">
                    <label for="CourseName" class="col-sm-4 col-form-label">Course Name</label>
                    <div class="col-sm-10">
                        <select class="w3-input w3-border" name="course_id" style="width:455px; height:40px;">
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->course }}({{ $course->branch }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-floating mb-3">
                    <label for="date">Birth Date</label>
                    <input type="date" id="birthday" class="form-control" placeholder="Enter Teachers Birthday"
                        name="birthday" value="{{ old('birthday') }}"
                        @error('birthday')
                        style="border-color:rgb(221, 18, 18);"
                        @enderror>
                </div>

                <div class="form-floating mb-3">
                    <input type="checkbox" id="role_as" name="role_as" value="0"
                        @error('role_as')
                        style="border-color:rgb(221, 18, 18);"
                    @enderror>
                    <strong>Student</strong>
                    <input type="checkbox" id="role_as" name="role_as" value="2"
                        @error('role_as')
                        style="border-color:rgb(221, 18, 18);"
                    @enderror>
                    <strong>Teacher</strong>
                </div>


                <div class="form-floating mb-3">
                    <label for="image">Profile Picture</label>
                    <input type="file" id="image" class="form-control" placeholder="" name="image"
                        value="{{ old('image') }}"
                        @error('image')
                        style="border-color:rgb(221, 18, 18);"
                        @enderror>
                </div>

                <div class="form-floating mb-3">
                    <input type="radio" id="gender" name="gender" value="male"
                        @error('gender')
                        style="border-color:rgb(221, 18, 18);"
                    @enderror>
                    Male
                    <input type="radio" id="gender" name="gender" value="female"
                        @error('gender')
                        style="border-color:rgb(221, 18, 18);"
                    @enderror>
                    Female
                </div>

                <div class="d-grid "><button class="btn btn-success btn-lg" id="run" type="submit">Create</button>
                </div>
            </form>
        </div>
    </div>
@endsection
