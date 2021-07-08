<?php

namespace App\Http\Controllers;

use App\Models\event;
use App\Models\User;
use App\Notifications\eventCreated;
use App\Notifications\eventDeleted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;

class eventsController extends Controller
{
    public function make(Request $request){
        event::create([
'title' => $request->title,
'description' => $request->description,
'date'=>$request->date,
'author'=>Auth::user()->name,
'organisation_code'=>Auth::user()->organisation_code
        ]);
        // notification  
        $all = User::where('organisation_code', '=', Auth::user()->organisation_code)->get();
        if (count($all) > 1) {
            $users =  $all->where('id', '!=', Auth::user()->id);
            Notification::send($users, new eventCreated(Auth::user()->name, ' added an activity "' . $request->title . "'"));
        }
        $me = Auth::user();
        Notification::send($me, new eventCreated('you ', 'added "' . $request->title . '" as an event'));
   
    }
    public function remove($id){
$target = event::find($id);
$target->delete();
$all = User::where('organisation_code', '=', Auth::user()->organisation_code)->get();
if (count($all) > 1) {
    $users =  $all->where('id', '!=', Auth::user()->id);
    Notification::send($users, new eventDeleted(Auth::user()->name, ' deleted an event "' . $target->title . '"'));
}
$me = Auth::user();
Notification::send($me, new eventDeleted('you ', 'deleted event "' . $target->title . '"'));

    }
    public function onComing(){
        $events = event::where('organisation_code','=',Auth::user()->organisation_code)->get();
        $near = array();
        foreach ($events as $event) {
            $start = strtotime(date('Y-m-d'));
            $end = strtotime($event->date);
            $days_between = ceil(($end - $start) / 86400);
            if($days_between < 3 && $days_between > 0){
                array_push($near,$event); 
                }
        }
        return $near;
    }
    public function display(){
        return event::where('organisation_code','=',Auth::user()->organisation_code)->orderBy('date', 'ASC')->get();
    }
}
