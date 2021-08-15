<?php

namespace App\Http\Controllers;

use App\Models\organisations;
use App\Models\User;
use App\Notifications\open;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\Notifiable;

class exOrgController extends Controller
{
    use Notifiable;
    public function index()
    {
        return view('auth.existing');
    }
    public function register(Request $request)
    {
        // validate 
        $request->validate([
            'email' => ['required', 'unique:users,email'],
            'organisation' => ['required'],
         ]);
         if (count(organisations::where('organisation_code','=',$request->organisation)->get()) == 0) {
            return redirect(route('exOrga'))->with('message','The organisation code you entered does not match any organisation');
        }
         //generate admin id
      $adminTwoChars = str_split($request->name);
      $adminId = $adminTwoChars[0] . $adminTwoChars[1] . rand(1000, 200000);

       // create users media folder in organisation path
    
       $adTargetPath = public_path('users') . '/'.$request->organisation;
       $adTargetUrl = asset('users') . '/'.$request->organisation;
        User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>Hash::make($request->password),
        'organisation_code'=>$request->organisation,
        'approved'=>'0',
        'position'=>'member',
        'userId'=>$adminId,
        'media_path'=>$adTargetPath,
        'media_url'=> $adTargetUrl 
    ]);
    return redirect(route('login'))->with('message','welcome '.$request->name.' we will notify you through email once your request to join has been approved');
    }
}
