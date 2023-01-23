 @extends('admin.layout')

 @section('content')
     <form action="/searchassignment" method="GET">
         @csrf
         <br>
         <div class="container">
             <div class="row">
                 <div class="container-fluid">
                     <div class="form-group row">
                         <label for="date" class="col-form-label col-sm-2">Date Of Birth From</label>
                         <div class="col-sm-3">
                             <input type="date" class="form-control input-sm" id="fromDate" name="fromDate" required>
                         </div>
                         <label for="date" class="col-form-label col-sm-2">Date Of Birth To</label>
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
     <div class="row">
         <div class="col-lg-12 margin-tb">
             <div class="pull-left">
                 <h2>Checked Assignment</h2>
                 <br>
             </div>
         </div>
     </div>
     <table class="table">
         <thead>
             <th>Assignment-Title</th>
             <th>Assignment-Description</th>
             <th>Assignment-Marks</th>
             <th>Assignment-Last Day Of Submission</th>
             <th>Assignment-image</th>
             <th>Assignment-Status</th>
             <th>Action</th>

         </thead>
         @foreach ($data as $assignment)
             <tbody>
                 <tr>
                     <td>{{ $assignment->title }}</td>
                     <td>{{ $assignment->description }}</td>
                     <td>{{ $assignment->marks }}</td>
                     <td>{{ $assignment->submission }}</td>
                     <td><embed src="{{ Storage::url($assignment->image) }}" width="50px" height="50px"></td>
                     <td>{{ $assignment->status }}</td>
                 </tr>
         @endforeach
         </tbody>
     </table>
 @endsection
