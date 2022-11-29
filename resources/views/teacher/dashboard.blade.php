<!doctype html>
<html lang="en">

<head>
    <title>Teacher</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="teacherstyle.css">
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
            <div class="p-4 pt-5">
                <h3 style="color: white">Teacher {{ Auth::user()->fname }}</h3>
                <ul class="list-unstyled components mb-5">
                    <li>
                        <a href="/teacherdashboard">Dashboard</a>
                    </li>
                    <li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle">Assignment</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li>
                                <a href="/assignment">Add Assignment</a>
                            </li>
                            <li>
                                <a href="/manageassignment">Manage Assignment</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="/announcment">News/Announcments</a>
                    </li>
                    <li>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle">Uploaded Assignments</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li>
                                <a href="/unchecked">UnChecked</a>
                            </li>
                            <li>
                                <a href="/checked">Checked</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="/searchteacher">Search</a>
                    </li>
                    <li>
                        <a href="/registeredusers">Registered Users</a>
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
                                                    <a href="/registeredusers"> <b>{{ $notification->data['fname'] }}
                                                            ({{ $notification->data['email'] }})
                                                        </b>
                                                        Registered In
                                                        The
                                                        Website!!
                                                    </a>
                                                </div>
                                        </a>
                                    @elseif ($notification->type == 'App\Notifications\NewAnswerNotification')
                                        <a class="dropdown-item" id="markasread">
                                            <div class="text-dark  p-2 m-3 ">
                                                <a href=""> New <b>Answer</b> Has Been
                                                    Submitted!</a>
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
                        Total Students
                        <h2>{{ $users }}</h2>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-black stretched-link" href="/registeredusers">View Details</a>
                        <div class="small text-black">
                            <i class="fas fa-angle-right"></i>
                        </div>
                    </div>
                </div>


                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4"></div>
                    <div class="card-body">
                        Total Assignments
                        <h2>{{ $assignments }}</h2>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-black stretched-link" href="/manageassignment">View Details</a>
                        <div class="small text-black">
                            <i class="fas fa-angle-right"></i>
                        </div>
                    </div>
                </div>


                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4"></div>
                    <div class="card-body">
                        Total Announcments
                        <h2>{{ $announcments }}</h2>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-black stretched-link" href="/announcment">View Details</a>
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

        </div>

</body>

</html>
