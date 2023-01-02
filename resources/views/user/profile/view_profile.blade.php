@extends('user.user_master')

@section('user')

<div class="card mt-3 ml-3" style="width: 23rem;">
    <img src="{{!empty($user->profile_photo_path) ? url('uploads/user_images/'.$user->profile_photo_path) : url('uploads/no_image.jpg') }}" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">User Name: {{$user->name}}</h5>
        <p class="card-text"><b>User Email:</b> {{$user->email}}</p>
        <a href="{{route('user.profile.edit')}}" class="btn btn-primary">Edit Profile</a>
    </div>
</div>

@endsection