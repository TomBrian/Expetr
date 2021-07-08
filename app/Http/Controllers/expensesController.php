<?php

namespace App\Http\Controllers;

use App\Models\expenses;
use App\Models\User;
use App\Notifications\expenseCreated;
use App\Notifications\expenseDeleted;
use App\Notifications\statusChange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\Notifiable;


class expensesController extends Controller
{
    use Notifiable;

    public function make(Request $request)
    {
        expenses::create([
            'title' => $request->title,
            'description' => $request->description,
            'amount' => $request->amount,
            'category' => $request->category,
            'status' => 'progress',
            'author' => Auth::user()->name,
            'organisation_code' => Auth::user()->organisation_code
        ]);
        $all = User::where('organisation_code', '=', Auth::user()->organisation_code)->get();
        if (count($all) > 1) {
            $users =  $all->where('id', '!=', Auth::user()->id);
            Notification::send($users, new expenseCreated(Auth::user()->name, ' added an expense "' . $request->title . "'"));
        }
        $me = Auth::user();
        Notification::send($me, new expenseCreated('you ', 'added "' . $request->title . '" as an expense'));
    }
    public function deleteExp($id)
    {
        $target = expenses::find($id);
        $target->delete();
        $all = User::where('organisation_code', '=', Auth::user()->organisation_code)->get();
        if (count($all) > 1) {
            $users =  $all->where('id', '!=', Auth::user()->id);
            Notification::send($users, new expenseDeleted(Auth::user()->name, ' deleted an expense ', "'" . $target->title . "'"));
        }
        $me = Auth::user();
        Notification::send($me, new expenseDeleted('you ', 'deleted expense " ', $target->title.' "'));
    }
    public function setStatus($id, $status)
    {
        $target = expenses::find($id);
        $target->update([
            'status' => $status
        ]);
        $all = User::where('organisation_code', '=', Auth::user()->organisation_code)->get();
        if (count($all) > 1) {
            $users =  $all->where('id', '!=', Auth::user()->id);
            Notification::send($users, new statusChange(Auth::user()->name, 'changed "' . $target->title . '(' . $id . ')" status to ', $status));
        }
        $me = Auth::user();
        Notification::send($me, new statusChange('you ', 'changed "' . $target->title . '(' . $id . ')" status to ', $status));
    }
    public function display()
    {
        return expenses::orderBy('id', 'desc')->where('organisation_code', Auth::user()->organisation_code)->get();
    }
}
