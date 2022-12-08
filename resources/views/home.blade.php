<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Course Assignment System</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
    <style>
        .bg-img {

            position: absolute;
            top: 48px;
            max-width: 1400px;
            overflow: hidden;
            height: 500px;
            background-size: cover;
            object-fit: cover;
            filter: brightness(70%);
            margin-bottom: 10px;
        }

        .left,
        .right {
            position: absolute;
            width: 50px;
            height: 50px;
            cursor: pointer;
        }

        .left {
            top: 115%;
            left: 45px;
        }

        .right {
            top: 115%;
            right: 35px;
        }

        .item-div {
            overflow-x: auto;
            display: flex;
        }

        .item-div::-webkit-scrollbar {
            height: 0;
            width: 0;
        }

        .has-bg-img {
            margin-bottom: 70px;
        }

        #subject1,
        #subject2,
        #subject3 {
            display: none;
        }

        /* #google_translate_element {
            transform: translate(120px);
        } */
    </style>
</head>

<body>

    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container px-5">
            <div class="navbar-brand">Online Course Assignment System</div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                    <li id="google_translate_element"></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Header-->
    <header class="has-bg-img py-5">
        <div class="container px-5">
            <div class="row gx-5 justify-content-center">
                <img class="bg-img"
                    src="https://livegamefully.com/wp-content/uploads/2021/01/online-course-business.jpeg"
                    style="width:1650px; height:500px;">
                <div class="col-lg-6">
                    <div class="text-center my-5">
                        <h1 class="display-5 fw-bolder text-white mb-2">The Best Learning Institute</h1>
                        <p class="lead text-white-50 mb-4">Successful Career Starts With Good Training</p>
                        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                            <a class="btn btn-primary btn-lg px-4 me-sm-3" href="#signin">Get Started</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Features section-->
    <section class="py-5 border-bottom" id="features">
        <div class="main">
            <div class="container px-5 my-5">
                <div class=" row gx-5">
                    <div class="item-div" id="box">
                        @foreach ($news as $news)
                            <div class="col-lg-6 mb-5 mb-lg-0">
                                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i
                                        class="bi bi-collection"></i></div>
                                <h2 class="h4 fw-bolder">{{ $news->title }}</h2>
                                <p>{{ $news->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
        <img src="https://cdn-icons-png.flaticon.com/512/1549/1549612.png" class="right" id="right">
        <img src="https://uxwing.com/wp-content/themes/uxwing/download/arrow-direction/angle-circle-arrow-left-icon.png"
            class="left" id="left">
        </div>
        </div>
    </section>

    <!-- Contact section-->
    <section class="bg-light py-5" id="signin">
        <div class="container px-5 my-5 px-5">
            <div class="text-center mb-5">
                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-envelope"></i>
                </div>
                <h2 class="fw-bolder">Lets Start Now!</h2>
                <p class="lead mb-0">Want To Be Our Student? Register Here.</p>
            </div>
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-6">
                    <form action="/register" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="name" id="fname" class="form-control" placeholder="Enter Your FirstName"
                                name="fname" value="{{ old('fname') }}" />
                            <label for="firstname">FirstName</label>
                            @error('fname')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="name" id="lname" class="form-control" placeholder="Enter Your LastName"
                                name="lname" value="{{ old('lname') }}" />
                            <label for="lastname">LastName</label>
                            @error('lname')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="email" id="email" class="form-control" placeholder="Enter Your Email"
                                name="email" value="{{ old('email') }}" />
                            <label for="email">E-Mail</label>
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" id="password" class="form-control"
                                placeholder="Enter Your Password" name="password" value="{{ old('password') }}">
                            <label for="password">Password</label>
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" id="repassword" class="form-control"
                                placeholder="Confirm Your Password" name="repassword"
                                value="{{ old('repassword') }}">
                            <label for="password">Confirm Password</label>
                            @error('repassword')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <select id="course" onchange="enableSubject(this)" class="w3-input w3-border"
                                name="course_id" style="width:510px; height:60px;">
                                <option value="">Choose Your Course:</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->course }}({{ $course->branch }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-floating mb-3" id="subject1">
                            <select class="w3-input w3-border" name="subject_id" style="width:510px; height:60px;">
                                <option value="">Choose Your Subject:</option>
                                @foreach ($subjects1 as $subject)
                                    <option value="{{ $subject->id }}">
                                        {{ $subject->subjectfullname }}({{ $subject->subjectshortname }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-floating mb-3" id="subject2">
                            <select class="w3-input w3-border" name="subject_id" style="width:510px; height:60px;">
                                <option value="">Choose Your Subject:</option>
                                @foreach ($subjects2 as $subject)
                                    <option value="{{ $subject->id }}">
                                        {{ $subject->subjectfullname }}({{ $subject->subjectshortname }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-floating mb-3" id="subject3">
                            <select class="w3-input w3-border" name="subject_id" style="width:510px; height:60px;">
                                <option value="">Choose Your Subject:</option>
                                @foreach ($subjects3 as $subject)
                                    <option value="{{ $subject->id }}">
                                        {{ $subject->subjectfullname }}({{ $subject->subjectshortname }})
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-floating mb-3">
                            <input type="date" id="birthday" class="form-control"
                                placeholder="Enter Your Birthday" name="birthday" value="{{ old('birthday') }}">
                            <label for="date">Birth Date</label>
                            @error('birthday')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="file" id="image" class="form-control" placeholder="" name="image"
                                value="{{ old('image') }}">
                            <label for="image">Profile Picture</label>
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

                        <P>Your Registered Allready? LogIn<a href='/login'>Here</a></P>
                        <div class="d-grid"><button class="btn btn-primary btn-lg" id="run"
                                type="submit">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container px-5">
            <p class="m-0 text-center text-white">Copyright &copy; Online Course Assignment System</p>
        </div>
    </footer>


    {{-- JavaScript Part --}}
    {{-- <script>
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                    pageLanguage: 'en'
                },
                'google_translate_element'
            );
        }
    </script> --}}

    <script type="text/javascript">
        var button = document.getElementById('right');
        button.onclick = function() {
            var container = document.getElementById('box');
            sideScroll(container, 'right', 25, 510, 10);
        };

        var back = document.getElementById('left');
        back.onclick = function() {
            var container = document.getElementById('box');
            sideScroll(container, 'left', 25, 510, 10);
        };

        function sideScroll(element, direction, speed, distance, step) {
            scrollAmount = 0;
            var slideTimer = setInterval(function() {
                if (direction == 'left') {
                    element.scrollLeft -= step;
                } else {
                    element.scrollLeft += step;
                }
                scrollAmount += step;
                if (scrollAmount >= distance) {
                    window.clearInterval(slideTimer);
                }
            }, speed);
        }
    </script>


    <script>
        var button = document.getElementById("run");

        function validateDate(value) {
            if (value === "") {
                window.alert("Your Registration Proccess is Failed!");
                return false;
            }
        }
        button.addEventListener("click", function(e) {
            var value = document.getElementById("fname").value;
            var value = document.getElementById("lname").value;
            var value = document.getElementById("email").value;
            var value = document.getElementById("password").value;
            var value = document.getElementById("repassword").value;
            var value = document.getElementById("birthday").value;
            validateDate(value);
        });
    </script>

    <script>
        function enableSubject(course) {
            if (course.value == 1) {
                document.getElementById('subject1').style = 'display:block';
            } else {
                document.getElementById('subject1').style = 'display:none';
            }

            if (course.value == 2) {
                document.getElementById('subject2').style = 'display:block';
            } else {
                document.getElementById('subject2').style = 'display:none';
            }

            if (course.value == 3) {
                document.getElementById('subject3').style = 'display:block';
            } else {
                document.getElementById('subject3').style = 'display:none';
            }
        };
    </script>

</body>

</html>
