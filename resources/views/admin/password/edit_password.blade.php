@extends('admin.admin_master')

@section('admin')

<div class="row mt-3 ml-3">
    <div class="col-md-6">
        <h4>Change Password</h4>
        <form method="post" action="{{route('admin.password.update')}}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="oldpassword" class="form-label">Current Password</label>
                <input type="password" name="oldpassword" class="form-control" id="oldpassword">
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
            </div>
           

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

@endsection