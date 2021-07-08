<?php

namespace App\Http\Controllers;

use App\Models\activities;
use App\Models\User;
use App\Notifications\activityCreated;
use App\Notifications\activityDeleted;
use App\Notifications\activityStatusChanged;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

use Illuminate\Http\Request;

class activitiesController extends Controller
{
    public function make(Request $request)
    {
        activities::create([
            'title' => $request->title,
            'description' => $request->description,
            'date_due' => $request->date,
            'author' => Auth::user()->name,
            'organisation_code' => Auth::user()->organisation_code,
            'status' => 'NULL'
        ]);
        $all = User::where('organisation_code', '=', Auth::user()->organisation_code)->get();
        if (count($all) > 1) {
            $users =  $all->where('id', '!=', Auth::user()->id);
            Notification::send($users, new activityCreated(Auth::user()->name, ' added an task : "' . $request->title . "'"));
        }
        $me = Auth::user();
        Notification::send($me, new activityCreated('you ', 'added  a task :"' . $request->title . '"'));
    }

    public function deleteAct($id)
    {
        $target = activities::find($id);
        $target->delete();
        $all = User::where('organisation_code', '=', Auth::user()->organisation_code)->get();
        if (count($all) > 1) {
            $users =  $all->where('id', '!=', Auth::user()->id);
            Notification::send($users, new activityDeleted(Auth::user()->name, ' deleted a task: "' . $target->title . '"'));
        }
        $me = Auth::user();
        Notification::send($me, new activityDeleted('you ', 'deleted task :"' . $target->title . '"'));
    }


    public function statusAct($id,$status){
     $activity = activities::find($id);
     $activity->update([
         'status'=>$status
     ]);
     $all = User::where('organisation_code', '=', Auth::user()->organisation_code)->get();
        if (count($all) > 1) {
            $users =  $all->where('id', '!=', Auth::user()->id);
            Notification::send($users, new activityStatusChanged(Auth::user()->name, 'changed "' . $activity->title . '" status to'.$status));
        }
        $me = Auth::user();
        Notification::send($me, new activityStatusChanged('you ', 'changed "' . $activity->title . '" status to '.$status));
   
    }

    public function almostDue(){
     $activities = activities::where('organisation_code','=',Auth::user()->organisation_code)->where('status','!=','done')->get();
    //  query checking for activities due in two days time
    $almost = array();
foreach ($activities as $activity){
    // convert them into time
    $start = strtotime(date('Y-m-d'));
    $end = strtotime($activity->date_due);
    $days_between = ceil(($end - $start) / 86400);
    if($days_between <= 4 && $days_between >= 0){
    array_push($almost,$activity);
    }
}
   return $almost;
    }


    public function failed(){
        $activitieses = activities::where('organisation_code','=',Auth::user()->organisation_code)->get();
       $activities = $activitieses->where('status','!=','done');
        //  query checking for activities due in two days time
        $failed = array();
    foreach ($activities as $activity){
        // convert them into time
        $start = strtotime(date('Y-m-d'));
        $end = strtotime($activity->date_due);
        $days_between = ceil(($end - $start) / 86400);
        if($days_between < 0){
            array_push($failed,$activity); 
            }
    }
       return $failed;
    }
    public function completed(){
        $activities = activities::where('organisation_code','=',Auth::user()->organisation_code);
        return $activities->where('status','=','done')->get();
    }
    public function display()
    {
        return activities::where('organisation_code', '=', Auth::user()->organisation_code)->get();
    }
}
