<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use \App\Task;
use Illuminate\Http\Request;

Auth::routes();
Route::get('/', function () {
    return redirect('/task');
});

Route::get('/task', function () {
    $tasks = Task::active()->orderBy('created_at', 'asc')->get();

    return view('task', ['tasks' => $tasks]);
})->middleware('auth');

Route::post('/task', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'title' => 'required|max:255',
        'description' => 'required|max:2048',
    ]);

    if ($validator->fails()) {
        return redirect('/task')
            ->withInput()
            ->withErrors($validator);
    }

    $task = new Task;
    $task->title = $request->title;
    $task->description = $request->description;
    $task->completed = false;
    $task->active = true;
    $task->save();

    return redirect('/task');
})->middleware('auth');

Route::get('/task/{id}', function ($id) {
    $task = Task::active()->findOrFail($id);

    return view('task_detail', ['task' => $task]);
})->middleware('auth');

Route::post('/task/{id}', function (Request $request, $id) {
    $validator = Validator::make($request->all(), [
        'title' => 'required|max:255',
        'description' => 'required|max:2048',
    ]);

    if ($validator->fails()) {
        return redirect('/task')
            ->withInput()
            ->withErrors($validator);
    }

    $task = Task::active()->findOrFail($id);

    $task->title = $request->title;
    $task->description = $request->description;
    $task->save();

    return redirect('/task');
})->middleware('auth');

Route::delete('/task/{id}', function ($id) {
    $task = Task::findOrFail($id);
    $task->active = false;
    $task->save();

    return redirect('/task');
})->middleware('auth');

Route::post('/task/{id}/complete', function ($id) {
    $task = Task::findOrFail($id);
    $task->completed = true;
    $task->save();

    return redirect('/task');
})->middleware('auth');
