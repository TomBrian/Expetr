<?php

use App\Http\Controllers\accountsController;
use App\Http\Controllers\chatsController;
use App\Http\Controllers\downloadsController;
use App\Http\Controllers\historyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\profileController;
use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!

**/

// expenses
Route::post('/log-me-out',[accountsController::class,'logMeOut'])->name('apiLog')->middleware('auth');
Route::group(['middleware'=>'auth:sanctum'],function(){
Route::get('/get-quote',[HomeController::class,'getQuote'])->middleware('auth');
Route::post('/make-expense', [App\Http\Controllers\expensesController::class, 'make'])->middleware('auth');
Route::post('/delete-expense/{id}', [App\Http\Controllers\expensesController::class, 'deleteExp'])->middleware('auth');
Route::post('/set-status/{id}/{status}', [App\Http\Controllers\expensesController::class, 'setStatus'])->middleware('auth');
Route::get('/all-expenses', [App\Http\Controllers\expensesController::class, 'display']);
Route::get('/downloads/download-expenses-pdf', [App\Http\Controllers\pdfConverter::class, 'download'])->middleware('auth');
// notifications
Route::get('/get-unread-notifications', [App\Http\Controllers\notificationsController::class, 'displayUnread'])->middleware('auth');
Route::get('/get-read-notifications', [App\Http\Controllers\notificationsController::class, 'displayRead'])->middleware('auth');
Route::get('/mark-as-read/{id}', [App\Http\Controllers\notificationsController::class, 'markasread'])->middleware('auth');
Route::get('/delete-notification/{id}', [App\Http\Controllers\notificationsController::class, 'delete'])->middleware('auth');
// Authentification
Route::get('/get-organisation', [App\Http\Controllers\profileController::class, 'orgDetails'])->middleware('auth');
Route::get('/all-users', function () {
    return User::where('id','!=',Auth::user()->id)->where('organisation_code','=',Auth::user()->organisation_code)->where('approved','=',1)->get();
})->middleware('auth');
Route::get('/user', function () {
    return Auth::user();
})->middleware('auth');
// activities
Route::post('/make-activity', [App\Http\Controllers\activitiesController::class, 'make'])->middleware('auth');
Route::get('/get-activities', [App\Http\Controllers\activitiesController::class, 'display'])->middleware('auth');
Route::get('/get-almost-due-activities', [App\Http\Controllers\activitiesController::class, 'almostDue'])->middleware('auth');
Route::get('/get-failed-activities', [App\Http\Controllers\activitiesController::class, 'failed'])->middleware('auth');
Route::get('/get-completed-activities', [App\Http\Controllers\activitiesController::class, 'completed'])->middleware('auth');
Route::get('/get-underway-activities', [App\Http\Controllers\activitiesController::class, 'getUnderway'])->middleware('auth');
Route::post('/delete-activity/{id}', [App\Http\Controllers\activitiesController::class, 'deleteAct'])->middleware('auth');
Route::post('/set-activity-status/{id}/{status}', [App\Http\Controllers\activitiesController::class, 'statusAct'])->middleware('auth');
Route::get('/get-assignments', [App\Http\Controllers\activitiesController::class, 'assignments'])->middleware('auth');
// events
Route::post('/make-event', [App\Http\Controllers\eventsController::class, 'make'])->middleware('auth');
Route::get('/get-events', [App\Http\Controllers\eventsController::class, 'display'])->middleware('auth');
Route::get('/delete-event/{id}', [App\Http\Controllers\eventsController::class, 'remove'])->middleware('auth');
Route::get('/approaching-events', [App\Http\Controllers\eventsController::class, 'onComing'])->middleware('auth');
// chats
Route::post('/create-private-chat/{id}', [App\Http\Controllers\chatsController::class, 'createPrivateConversation'])->middleware('auth');
Route::post('/create-group-chat', [App\Http\Controllers\chatsController::class, 'createGroupConversation'])->middleware('auth');
Route::get('/getConversations', [App\Http\Controllers\chatsController::class, 'getAllConversations'])->middleware('auth');
Route::post('/send-message/{convId}', [App\Http\Controllers\chatsController::class, 'sendMessage'])->middleware('auth');
Route::get('/get-messages/{convId}', [App\Http\Controllers\chatsController::class, 'getMessages'])->middleware('auth');
Route::post('/mark-message-as-read/{id}', [App\Http\Controllers\chatsController::class, 'markasread'])->middleware('auth');
Route::post('/delete-conversation/{id}', [App\Http\Controllers\chatsController::class, 'deleteConv'])->middleware('auth');
// history
Route::get('/get-history',[historyController::class,'index'])->middleware('auth');
Route::get('/get-curr-history',[historyController::class,'currHistory'])->middleware('auth');
Route::post('/update-history/{orgCode}',[historyController::class,'updates'])->middleware('auth');
// downloads
Route::get('/get-organisation-downloads',[downloadsController::class,'index'])->middleware('auth');
// uniform resource locators for the accountsController endpoints
Route::post('/remove-me',[accountsController::class,'removeMe'])->middleware('auth');
Route::post('/update-my-details',[accountsController::class,'changes'])->middleware('auth');
// admin requests
Route::post('/change-organisation-name',[accountsController::class,'orgUpdates'])->middleware('auth');
Route::post('/new-position/{id}/{position}',[accountsController::class,'newPosition'])->middleware('auth');
Route::post('/remove-user/{id}',[accountsController::class,'removeUser'])->middleware('auth');
Route::get('/get-unread-messages-number',[chatsController::class,'numberOfUnread']);
// join requests
Route::get('get-all-join-requests',[accountsController::class,'getJoins'])->middleware('auth');
Route::post('delete-join/{id}',[accountsController::class,'deleteJoin'])->middleware('auth');
Route::post('accept-join/{id}',[accountsController::class,'acceptJoin'])->middleware('auth');
});
Route::get('/register-organisation/create', [App\Http\Controllers\newOrgcontroller::class, 'make'])->name('createOrg');
