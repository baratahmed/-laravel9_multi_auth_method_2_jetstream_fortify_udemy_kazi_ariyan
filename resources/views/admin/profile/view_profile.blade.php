@extends('admin.admin_master')

@section('admin')

<div class="card mt-3 ml-3" style="width: 23rem;">
    <img src="{{!empty($admin->profile_photo_path) ? url('uploads/admin_images/'.$admin->profile_photo_path) : url('uploads/no_image.jpg') }}" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">Admin Name: {{$admin->name}}</h5>
        <p class="card-text"><b>Admin Email:</b> {{$admin->email}}</p>
        <a href="{{route('admin.profile.edit')}}" class="btn btn-primary">Edit Profile</a>
    </div>
</div>

@endsection