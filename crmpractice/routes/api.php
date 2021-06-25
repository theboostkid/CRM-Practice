<?php

use App\Http\Resources\UpcomingTaskResource;
use App\Models\Today;
use App\Models\Upcoming;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Upcoming Task

Route::get("/upcoming", function () {
    $upcoming = Upcoming::all();

    return UpcomingTaskResource::collection($upcoming);
});

//Add a new task
Route::post('/upcoming', function (Request $request) {
    return Upcoming::create([
        'title' => $request->title,
        'taskId' => $request->taskId,
        'waiting' =>$request->waiting
    ]);
});


//Delete Upcoming Tasks
Route::delete('/upcoming/{taskId}', function ($taskId) {
    DB::table('upcomings')->where('taskId', $taskId)->delete();

    return 204;
});

//Today Tasks
Route::post('/dailytask', function (Request $request) {
    return Today::create([
        'id' => $request->id,
        'title' => $request->title,
        'taskId' => $request ->taskId
    ]);
});

//Delete Today Task
Route::delete('/dailytask/{taskId}', function ($taskId) {
    DB::table('todays')->where('taskId', $taskId)->delete();
    return 204;
});
