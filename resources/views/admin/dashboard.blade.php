<!doctype html>
<html lang="en">

<head>
    <title>Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="adminstyle.css">
</head>

<style>
    img {
        width: 35px;
        height: 35px;
        border-radius: 20px;
    }

    i {
        font-size: 20px;
        position: relative;
        top: 2px;
        padding-left: 3px;
        padding-right: 3px;
        cursor: pointer;
    }

    span {
        position: absolute;
        right: 117px;
        top: 13px;
    }

    #collapseExample {
        height: 300px;
        overflow-y: scroll;
    }
</style>
<script>
    $.ajaxSetup({
        headers: {
            'X-Auth-Token': "{{ csrf_token() }}"
        }
    });
</script>

<body>

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="new">
                <input type="checkbox" class="checkbox" id="chk" />
                <label class="label" for="chk">
                    <i class="fas fa-moon"></i>
                    <i class="fas fa-sun"></i>
                    <div class="ball"></div>
                </label>
            </div>
            <div class="p-4 pt-5">
                <h3 style="color: white">Admin {{ Auth::user()->fname }}</h3>
                <ul class="list-unstyled components mb-5">
                    <li>
                        <a href="/admindashboard">Dashboard</a>
                    </li>
                    <li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle">Teacher</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li>
                                <a href="/teacher">Add Teacher</a>
                            </li>
                            <li>
                                <a href="/manageteacher">Manage Teachers</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle">Uploaded Assignments</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li>
                                <a href="/uncheckedadmin">UnChecked</a>
                            </li>
                            <li>
                                <a href="/checkedadmin">Checked</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="/news">News/Announcments</a>
                    </li>
                    <li>
                        <a href="/subject">Subject</a>
                    </li>
                    <li>
                        <a href="/search">Search Report</a>
                    </li>
                    <li>
                        <a href="/course">Course</a>
                    </li>
                    <li>
                        <a href="/statisticspage">Statistics Page</a>
                    </li>
                    <li>
                        <a href="/allusers">Users</a>
                    </li>
                </ul>

            </div>
        </nav>

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-primary">
                        <i class="fa fa-bars"></i>
                        <span class="sr-only">Toggle Menu</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto ">
                            <li class="nav-item active">
                                @if (count(auth()->user()->unreadNotifications) !== 0)
                                    <span class="badge badge-danger"
                                        id="notifications-badge">{{ count(auth()->user()->unreadNotifications) }}</span>
                                @endif
                                <i class="fa-solid fa-bell" data-toggle="dropdown" data-target="#collapseExample"
                                    id="markasread"></i>
                                <div class="dropdown-menu" id="collapseExample">
                                    @forelse (auth()->user()->Notifications as $notification)
                                        <input type="hidden" value="{{ $notification->id }}" name="notification_id">
                                        <a class="dropdown-item">
                                            @if ($notification->type == 'App\Notifications\NewUserNotification')
                                                <div class="text-dark  p-2 m-3 ">
                                                    <a href="/allusers"><b>{{ $notification->data['fname'] }}
                                                            ({{ $notification->data['email'] }})
                                                        </b>
                                                        Registered In
                                                        Your
                                                        Website!!
                                                    </a>
                                                    {{-- <a href="{{ route('markasread', $notification->id) }}"
                                                        class="p-2 bg-red-400 text-danger rounded-lg">MarkAsRead</a> --}}
                                                </div>
                                        </a>
                                    @elseif ($notification->type == 'App\Notifications\NewAssignmentNotification')
                                        <a class="dropdown-item">
                                            <div class="text-dark  p-2 m-3 ">
                                                <a href="/uncheckedadmin"> Assignmnet With Title
                                                    <b>({{ $notification->data['title'] }})
                                                    </b>
                                                    Has Been Added!
                                                </a>
                                                {{-- <a href="/markasread{{ $notification->id }}"
                                                    class="p-2 bg-red-400 text-danger rounded-lg">MarkAsRead</a> --}}
                                            </div>
                                        </a>
                                    @endif
                                @empty
                                    There Is No Notifications!
                                    @endforelse
                                </div>

                                <div class="dropdown-menu" id="collapseExample1">
                                    <a class="dropdown-item" href="/updateadmin">Profile</a>
                                    <a class="dropdown-item" href="/changeadminpassword">Settings</a>
                                    <a class="dropdown-item" href="/logout"
                                        onclick="return confirm('Are you sure you want to LogOut?');">Logout</a>
                                </div>
                                <img src="{{ Storage::url(Auth::user()->image) }}">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                    data-target="#collapseExample1">
                                    <i class="fa-solid fa-gear"></i>
                                </button>
                                <div class="dropdown-menu">

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4"></div>
                    <div class="card-body">
                        Total Course
                        <h2>{{ $courses }}</h2>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-black stretched-link" href="/course">View Details</a>
                        <div class="small text-black">
                            <i class="fas fa-angle-right"></i>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4"></div>
                    <div class="card-body">
                        Total Subject
                        <h2>{{ $subjects }}</h2>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-black stretched-link" href="/subject">View Details</a>
                        <div class="small text-black">
                            <i class="fas fa-angle-right"></i>
                        </div>
                    </div>
                </div>


                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4"></div>
                    <div class="card-body">
                        Total Teachers
                        <h2>{{ $users }}</h2>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-black stretched-link" href="/manageteacher">View Details</a>
                        <div class="small text-black">
                            <i class="fas fa-angle-right"></i>
                        </div>
                    </div>
                </div>


            </div>

            <script src="js/jquery.min.js"></script>
            <script src="js/popper.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="js/main.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
                integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>

            <script>
                $(document).ready(function() {
                    $("#markasread").on('click', function() {
                        var notification_id = $("[name=notification_id]").val();
                        let data = {
                            notification_id
                        }

                        $.ajax({
                            method: "GET",
                            url: "/markasread",
                            data,
                            success: function(res) {
                                if (res.status) {
                                    $('#notifications-badge').addClass('d-none')
                                }
                            },
                            error: function(e) {
                                console.info("Error");
                            },
                            done: function(e) {
                                console.info("DONE");
                            }
                        });
                    });
                });
            </script>

            <script>
                const chk = document.getElementById('chk');

                chk.addEventListener('change', () => {
                    document.body.classList.toggle('dark');
                });
            </script>
        </div>
</body>

</html>
