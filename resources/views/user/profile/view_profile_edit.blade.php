@extends('user.user_master')

@section('user')
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

<div class="row mt-3 ml-3">
    <div class="col-md-6">
        <form method="post" action="{{route('user.profile.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">User Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{$user->name}}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" value="{{$user->email}}" class="form-control" id="email">
            </div>
            
            <div class="mb-3">
                <label for="image" class="form-label">Profile Image</label>
                <input type="file" name="profile_photo_path" class="form-control" id="image">
            </div>

            <div class="mb-3">
                <img id="showImage" src="{{!empty($user->profile_photo_path) ? url('uploads/user_images/'.$user->profile_photo_path) : url('uploads/no_image.jpg') }}" width="100px" height="100px">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    });
</script>

@endsection