@extends('admin.layout')

@section('content')
    <form action="/searchassignment" method="GET">
        @csrf
        <br>
        <div class="container">
            <div class="row">
                <div class="container-fluid">
                    <div class="form-group row">
                        <label for="date" class="col-form-label col-sm-2">Date Of Assignment From:</label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control input-sm" id="fromDate" name="fromDate" required>
                        </div>
                        <label for="date" class="col-form-label col-sm-2">Date Of Assignment To:</label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control input-sm" id="toDate " name="toDate" required>
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-success" name="search" title="search">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
