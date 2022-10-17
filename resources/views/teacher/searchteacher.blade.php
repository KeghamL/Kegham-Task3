@extends('teacher.layout')

@section('content')
    <style>
        /*20px padding-Just to be well visible here*/
        #searchForm {
            padding: 20px;

        }

        #searchForm {
            display: absolute;
            width: 100%;
            margin-left: 11%;
            margin-top: 70px;
        }

        #searchForm .form-row .col {
            margin: 0;
            padding: 0;
        }

        #searchForm .form-row button,
        #searchForm .form-row input {
            border: 1px solid #DBDBDB;
            border-radius: 0;
            margin: 0;
        }

        #searchForm .form-row input {
            border-right: 0px;
            width: 750px;
        }

        /* #searchForm .form-row button {
                                                                                  width: 50px;
                                                                                } */
        #searchForm .form-row button i {
            color: #FFFFFF;
        }

        #searchForm .form-row button:hover {
            background: #2ED654 !important;
        }

        .form-control:focus,
        .btn:focus {
            border-color: none !important;
            box-shadow: none !important;
        }
    </style>
    </head>

    <body>

        <div id="searchForm">
            <div class="container">
                <div class="row">
                    <form class="form-row" id="search-form" action="/fullsearch" method="GET">
                        @csrf
                        <div class="col">
                            <input class="form-control" type="text" id="search" name="find"
                                placeholder="Search Here By Teacher Name Or Assignment Title...">
                            <div id="searchlist"></div>
                        </div>
                </div>
                <div class="col">
                    <button class="btn btn-success" type="submit"
                        style="position: relative; bottom: 38px; left:710px;">Search</i></button>
                </div>
                </form>

            </div>
        </div>

    </body>

    </html>
@endsection
