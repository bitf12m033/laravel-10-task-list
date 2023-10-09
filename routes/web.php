<?php

use App\Http\Requests\TaskRequest;
use App\Models\Task;
// use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// class Task
// {
//   public function __construct(
//     public int $id,
//     public string $title,
//     public string $description,
//     public ?string $long_description,
//     public bool $completed,
//     public string $created_at,
//     public string $updated_at
//   ) {
//   }
// }

// $tasks = [
//   new Task(
//     1,
//     'Buy groceries',
//     'Task 1 description',
//     'Task 1 long description',
//     false,
//     '2023-03-01 12:00:00',
//     '2023-03-01 12:00:00'
//   ),
//   new Task(
//     2,
//     'Sell old stuff',
//     'Task 2 description',
//     null,
//     false,
//     '2023-03-02 12:00:00',
//     '2023-03-02 12:00:00'
//   ),
//   new Task(
//     3,
//     'Learn programming',
//     'Task 3 description',
//     'Task 3 long description',
//     true,
//     '2023-03-03 12:00:00',
//     '2023-03-03 12:00:00'
//   ),
//   new Task(
//     4,
//     'Take dogs for a walk',
//     'Task 4 description',
//     null,
//     false,
//     '2023-03-04 12:00:00',
//     '2023-03-04 12:00:00'
//   ),
// ];

Route::get('/' , function () {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function () {
  // $tasks = \App\Models\Task::all();
  $tasks = Task::latest()->get();
    return view('index',[
        'tasks' => $tasks
    ]);
})->name('tasks.index');

Route::view('/tasks/create','create')->name('tasks.create');

// Route::get('/tasks/{id}/edit', function ($id) {
Route::get('/tasks/{task}/edit', function (Task $task) {
  
  // $task =  Task::findorFail($id);
  
   return view('edit', ['task' => $task]);
})->name('tasks.edit');

Route::get('/tasks/{task}', function (Task $task) {
  
  // $task =  Task::findorFail($id);
  
   return view('show', ['task' => $task]);
})->name('tasks.show');

// Route::post('/tasks', function (Request $request){
Route::post('/tasks', function (TaskRequest $request){
  
  // $data = $request->validate([
  //   'title' => 'required|max:255',
  //   'description' => 'required',
  //   'long_description' => 'required'

  // ]);

  $data = $request->validated();
  $task = new Task;

  $task->title = $data['title'];
  $task->description = $data['description'];
  $task->long_description = $data['long_description'];

  $task->save();

  return redirect()->route('tasks.show',['id'=>$task->id])
  ->with('success','Task created successfully!');
})->name('tasks.store');


// Route::put('/tasks/{id}', function ($id,Request $request){
Route::put('/tasks/{task}', function (Task $task,TaskRequest $request){
  
  // $data = $request->validate([
  //   'title' => 'required|max:255',
  //   'description' => 'required',
  //   'long_description' => 'required'

  // ]);

  // $task =  Task::findorFail($id);
  
  $data = $request->validated();
  $task->title = $data['title'];
  $task->description = $data['description'];
  $task->long_description = $data['long_description'];

  $task->save();

  return redirect()->route('tasks.show',['task'=>$task->id])
  ->with('success','Task updated successfully!');
})->name('tasks.update');

// Hard coded data
// Route::get('/tasks/{id}', function ($id)  use($tasks){
  
//    $task = collect($tasks)->firstWhere('id',$id);
//    if(!$task) {
//         abort(Response::HTTP_NOT_FOUND);
//    }

//    return view('show', ['task' => $task]);
// })->name('tasks.show');


// Route::get('/hello', function () {
//     return 'HEllo page';
// })->name('hi');
// Route::get('/hallo', function () {
//     return  redirect()->route('hi');
// });
// Route::get('/hi/{name}', function ($name) {
//     return 'Hi '.$name;
// })->name('hi-name');

Route::fallback(function(){
    return 'Still some where!!';
});