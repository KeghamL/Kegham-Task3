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


    <div class="card card-outline-secondary">
        <div class="card-header">
            <h3 class="mb-0">Update Admin Profile</h3>
        </div>
        <div class="card-body">
            <form class="form" action="/adminupdate/{{ auth()->user()->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-floating mb-3">
                    <label for="firstname">FirstName</label>
                    <input type="name" id="fname" class="form-control" placeholder="Enter Your FirstName"
                        name="fname" value="{{ auth()->user()->fname }}" />
                    @error('fname')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <label for="lastname">LastName</label>
                    <input type="name" id="lname" class="form-control" placeholder="Enter Your LastName"
                        name="lname" value="{{ auth()->user()->lname }}" />
                    @error('lname')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <label for="email">Email</label>
                    <input type="email" id="email" class="form-control" placeholder="Enter Your Email" name="email"
                        value="{{ auth()->user()->email }}">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <label for="birthday">Birthday</label>
                    <input type="date" id="birthday" class="form-control" placeholder="Enter Your Birthday"
                        name="birthday" value="{{ auth()->user()->birthday }}">
                    @error('birthday')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <label for="image">Profile Picture</label>
                    <input type="file" id="image" class="form-control" placeholder="" name="image"
                        value="{{ auth()->user()->image }}" required>
                    @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-floating mb-3">
                    <input type="radio" id="gender" name="gender" value="male" required>Male
                    <input type="radio" id="gender" name="gender" value="female" required>Female
                    @error('gender')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid"><button class="btn btn-primary" id="run" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
