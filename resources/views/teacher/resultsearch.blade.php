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

    @foreach ($assignments as $assignment)
        <table class="table">
            <thead>
                <th>Teacher-FullName</th>
                <th>Teacher-E-Mail</th>
                <th>Assignment-Course</th>
                <th>Assignment-Subject</th>
                <th>Assignment-Title</th>
                <th>Assignment-Description</th>
                <th>Assignment-LastDate</th>
                <th>Assignment-Image</th>
                <th>Assignment-Status</th>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $assignment->fname }} {{ $assignment->lname }}</td>
                    <td>{{ $assignment->email }}</td>
                    <td>{{ $assignment->course }}({{ $assignment->branch }})</td>
                    <td>{{ $assignment->subjectfullname }}({{ $assignment->subjectshortname }})</td>
                    <td>{{ $assignment->title }}</td>
                    <td>{{ $assignment->description }}</td>
                    <td>{{ $assignment->submission }}</td>
                    <td><embed src="{{ Storage::url($assignment->image) }}" width="50px" height="50px"></td>
                    <td>{{ $assignment->status }}</td>
                    <td>
                </tr>

            </tbody>
        </table>
    @endforeach
@endsection
