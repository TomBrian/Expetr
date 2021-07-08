<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class notificationsController extends Controller
{
    public function displayUnread()
    {
        $user = User::find(Auth::user()->id);
        return $user->unreadNotifications;
    }
    public function displayRead()
    {
        $user = User::find(Auth::user()->id);
        return $user->readNotifications;
    }
    public function markasread($id)
    {
        $user = User::find(Auth::user()->id);
        $notifications = $user->unreadNotifications;
        $getNot = $notifications->find($id);
        $getNot->markAsRead();
    }
    public function delete($id)
    {
        $user = User::find(Auth::user()->id);
        $user->notifications()->find($id)->delete();
    }
}
