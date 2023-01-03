<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TestController extends Controller
{
    public function exceptionTest($txt){

        try{
            $user = User::where('email',$txt)->firstOrFail();
            // $user->load(['projects']);
        }catch(ModelNotFoundException $e){
            return view('user.notfound'); 
        }
        catch(RelationNotFoundException $e){
            // dd($e->getMessage());
            // dd(get_class($e));
            return view('user.notfound_relation');  
        }

        return view('user.show', compact('user'));

    }

}
