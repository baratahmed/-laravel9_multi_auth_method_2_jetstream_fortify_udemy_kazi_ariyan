<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MainUserController extends Controller
{
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function userProfile(){
        $user = Auth::user();
        return view('user.profile.view_profile', compact('user'));
    }

    public function userProfileEdit(){
        $user = Auth::user();
        return view('user.profile.view_profile_edit', compact('user'));
    }

    public function userProfileStore(Request $request){
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->file('profile_photo_path')){
            $file = $request->file('profile_photo_path');
            @unlink(public_path('uploads/user_images/'.$user->profile_photo_path));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads/user_images'),$filename);
            $user->profile_photo_path = $filename;
        }
        $user->save();

        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('user.profile')->with($notification);
    }

    public function userPasswordView(){
        return view('user.password.edit_password');
    }

    public function userPasswordUpdate(Request $request){
        $validteData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required:confirmed'
        ]);

        $hashedPassword = Auth::user()->password;

        if(Hash::check($request->oldpassword, $hashedPassword)){
            $user = Auth::user();
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login');
        }else{
            $notification = array(
                'message' => 'Something went wrong.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
