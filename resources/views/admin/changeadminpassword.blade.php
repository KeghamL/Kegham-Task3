 @extends('admin.layout')

 @section('content')

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

     <div class="card card-outline-secondary">
         <div class="card-header">
             <h3 class="mb-0">Change Password</h3>
         </div>
         <div class="card-body">
             <form class="form" action="/updateadminpassword" method="POST">
                 @csrf
                 <div class="form-group">
                     <label for="inputPasswordOld">Current Password</label>
                     <input type="password" class="form-control" name="oldpassword" required="">
                 </div>
                 <div class="form-group">
                     <label for="inputPasswordNew">New Password</label>
                     <input type="password" class="form-control" name="newpassword" required="">
                     <span class="form-text small text-muted">
                         The password must be 5-20 characters, and must <em>not</em> contain spaces.
                     </span>
                 </div>
                 <div class="form-group">
                     <label for="inputPasswordNewVerify">Confirm Password</label>
                     <input type="password" class="form-control" name="newconfirmedpassword" required="">
                     <span class="form-text small text-muted">
                         To confirm, type the new password again.
                     </span>
                 </div>
                 <div class="form-group">
                     <button type="submit" class="btn btn-success btn-lg float-right">Change Password</button>
                 </div>
             </form>
         </div>
     </div>

 @endsection
