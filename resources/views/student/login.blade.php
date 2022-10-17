@extends('student.layout')

@section('content')


    <div class="container"style="width: 400px">

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

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
            <div class="text-center" style="margin-top: 20px">
                <h3>LogIn</h3>
                <hr>
            </div>
            <form action="/dashboard" method="POST">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="email">E-Mail:</label>
                    <input type="email" class="form-control" placeholder="Enter Your Email" name="email" value="">
                </div>
                <br>
                <div class="form-group">
                    <label for="password">Password:<a href="#" style="margin-left: 170px">Forget
                            Password?</a></label>
                    <input type="password" class="form-control" placeholder="Enter Your Password" name="password"
                        value="">
                </div>
                <br>
                <p>You Need To Register First? Click <a href="/#signin">Here</a></p>

                <div class="form-group">
                    <button class="btn btn-block btn-primary" type="submit">Login</button>
                </div>

            </form>

        </div>
    </div>

@endsection
