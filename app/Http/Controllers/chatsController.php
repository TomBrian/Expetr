<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Musonza\Chat\Models\Conversation;
use Musonza\Chat\Facades\ChatFacade as Chat;
class chatsController extends Controller
{
    public function createPrivateConversation($id){
        $own = User::find(Auth::user()->id);
        $participant = User::find($id);
        $allParticipants = [$own,$participant];
        $mfCommoners = Chat::conversations()->between($own,$participant);
        if($mfCommoners != null){
           return false;
        }
        else{
            Chat::createConversation($allParticipants)->makeDirect()->makePrivate()->update(['data'=>[
                'admin'=>Auth::user()->name
            ]]);;
            return true;
        };
    }
    public function createGroupConversation(Request $request){
    //get participants
    $allParticipants = array(User::find(Auth::user()->id));
    for ($i=0; $i < count($request->participants); $i++) { 
       $participant =User::find($request->participants[$i]);
       array_push($allParticipants,$participant);
    }
    Chat::createConversation($allParticipants)->makePrivate()->update(['data'=>[
        'name'=>$request->groupName,
        'admin'=>Auth::user()->name
    ]]);
    }
    public function sendMessage($convId,Request $request){
        $conversation = Conversation::find($convId);
        Chat::message($request->message)->from(User::find(Auth::user()->id))->to($conversation)->send();
        return true;
    }
    public function getAllConversations(){
        $convose = User::find(Auth::user()->id)->conversations();
        $convos = $convose->sortByDesc('id');
        $convoDets = array();
        foreach ($convos as $convo) {
        $parts = $convo->getParticipants();
        $unreadCount = Chat::conversation($convo)->setParticipant(User::find(Auth::user()->id))->unreadCount();
        $notMe = array();
        $type = '';
       foreach ($parts as $part) {
         if ($part->id != Auth::user()->id) {
             array_push($notMe,$part);
         }
       
       }
       if (count($notMe) > 1) {
           $type = 'group';
       }
       else {
           $type = 'personal';
       }
        $obj = [
            "conversationId"=>$convo->id,
            "participants"=>$notMe,
            'type'=>$type,
            'unread'=>$unreadCount,
            'data'=>$convo->data
        ]; 
        array_push($convoDets, $obj);
        }
       return $convoDets;
    }
    public function getMessages($convId){
        $conversation = Conversation::find($convId);
        $messages = Chat::conversation($conversation)->setParticipant(User::find(Auth::user()->id))->getMessages();
      
        return $messages;
    }
    public function markasread($id){
            $message = Chat::messages()->getById($id);
            Chat::message($message)->setParticipant(User::find(Auth::user()->id))->markRead();
            Chat::message($message)->setParticipant(User::find(Auth::user()->id))->markRead();
    }
    public function deleteConv($id){
        Conversation::where('id',$id)->delete();
    }
    public function numberOfUnread(){
        return Chat::messages()->setParticipant(User::find(Auth::user()->id))->unreadCount();
    }
}
