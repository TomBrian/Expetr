<?php

namespace App\Http\Controllers;

use App\Models\organisations;
use App\Models\User;
use App\Notifications\open;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Musonza\Chat\Models\Conversation;
use Musonza\Chat\Facades\ChatFacade as Chat;

class accountsController extends Controller
{
    // updates on own account(admin or not)
 public function changes(Request $request){
    //  dont update the email if its the same old one
    if ($request->email == Auth::user()->email) {
        User::find(Auth::user()->id)->update([
            'name' => $request->name,
        ]);
        $me = Auth::user();
        $all = User::where('organisation_code', '=', Auth::user()->organisation_code)->get();
        $users =  $all->where('id', '!=', Auth::user()->id);
        Notification::send($users, new open($me->name, ' changed their name to '.$request->name));
    }else{
     // dont update name if its the same old one
     if ($request->name == Auth::user()->name) {
        User::find(Auth::user()->id)->update([
            'email' => $request->email,
            'email_verified_at' => $request->email_verified_at
        ]);
    }else{
     User::find(Auth::user()->id)->update([
         'name' => $request->name,
         'email' => $request->email,
         'email_verified_at' => $request->email_verified_at
     ]);
     $me = Auth::user();
     $all = User::where('organisation_code', '=', Auth::user()->organisation_code)->get();
     $users =  $all->where('id', '!=', Auth::user()->id);
     Notification::send($users, new open($me->name, ' changed their name to '.$request->name));
    }
    }
   return true;
 }
//  logging out
public function logMeOut(){
     // Get user who requested the logout
$user = User::find(Auth::user()->id);
// Revoke current user token
$user->tokens()->delete();
    Auth::logout();
    return true;
}

//  deleting own account
public function removeMe(Request $request){
// the warning will be handled in frontend
// verify if the goner knows their password
if (Hash::check($request->password, Auth::user()->password)) {
    $me = Auth::user();
$all = User::where('organisation_code', '=', Auth::user()->organisation_code)->get();
$users =  $all->where('id', '!=', Auth::user()->id);
// tell the others
Notification::send($users, new open($me->name, 'deleted their account.'));
// delete conversations
$conversations = User::find(Auth::user()->id)->conversations();
foreach ($conversations as $conversation) {
    Conversation::where('id',$conversation->id)->delete();
}
 User::find(Auth::user()->id)->delete();
return  Auth::user()->password;
}
else{
    return  [Auth::user()->password,Hash::make($request->password)];
}
}
public function newPosition($id,$position){
$lucky = User::find($id);
$lucky->update([
    'position'=>$position
]);
$me = Auth::user();
$all = User::where('organisation_code', '=', Auth::user()->organisation_code)->get();
$users =  $all->where('id', '!=', Auth::user()->id)->where('id','!=',$lucky->id);
Notification::send($users, new open($me->name, ' changed '.$lucky->name.'`s position to '.$position));
Notification::send($lucky, new open($me->name, ' changed your position to '.$position));
}
public function orgUpdates(Request $request){
    $myOrg = organisations::where('organisation_code','=',Auth::user()->organisation_code);
    $myOrg->update([
        'name'=>$request->name
    ]);
    $me = Auth::user();
$all = User::where('organisation_code', '=', Auth::user()->organisation_code)->get();
$users =  $all->where('id', '!=', Auth::user()->id);
    Notification::send($users, new open($me->name, ' changed the organisation name to '.$request->name));
    return true;
}
public function removeUser($id){
    $me = Auth::user();
    $all = User::where('organisation_code', '=', Auth::user()->organisation_code)->get();
    $users =  $all->where('id', '!=', Auth::user()->id);
    $conversations = User::find($id)->conversations();
   foreach ($conversations as $conversation) {
    Conversation::where('id',$conversation->id)->delete();
    }
    Notification::send($users, new open($me->name, ' removed '. User::find($id)->name.' from the organisation'));
    User::find($id)->delete();
}
// join requests handling
public function getJoins(){
   $unappronvedAll = User::where('approved','=','0');
   return $unappronvedAll->where('organisation_code','=',Auth::user()->organisation_code)->get();
}
public function deleteJoin($id){
    User::find($id)->delete();
}
public function acceptJoin($id){
    $user = User::where('id','=',$id)->get();
    $me = Auth::user();
    $to_email = $user[0]->email;
    $organisation = organisations::where('organisation_code','=',Auth::user()->organisation_code)->get();
    $all = User::where('organisation_code', '=', Auth::user()->organisation_code)->get();
    $users =  $all->where('id', '!=', Auth::user()->id);
    Notification::send($users, new open($me->name, ' added a new user ('. User::find($id)->name.') to the organisation'));
    Mail::send('pages.mail.joinAccepted',array('userName'=>$user[0]->name,'acceptorName'=>Auth::user()->name,'organisation_name'=>$organisation[0]->name),function($message) use ($to_email){
        $message -> subject("Join request accepted");
        $message -> to($to_email);
    });
    User::where('id','=',$id)->update([
        'approved'=>'1'
    ]);
  
}
}
