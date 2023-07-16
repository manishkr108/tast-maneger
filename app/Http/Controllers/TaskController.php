<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $tasks = Task::orderBy('priority')->paginate(5);
    $projects = Project::all();
    return view("tasks.index", compact(['tasks', 'projects']));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $projects = Project::all();
    return view('tasks.create', compact('projects'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|max:255',
      'priority' => 'required|integer',
      'project_id' => 'required|exists:projects,id',
    ]);

    if ($validator->fails()) {
      return redirect()
        ->back()
        ->withErrors($validator)
        ->withInput();
    }

    $task = Task::create($request->only(['name', 'priority', 'project_id']));

    Session::flash('success', 'Task created successfully.');

    return redirect()->route('tasks.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Task  $task
   * @return \Illuminate\Http\Response
   */
  public function show(Task $task)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Task  $task
   * @return \Illuminate\Http\Response
   */
  public function edit(Task $task)
  {
    $projects = Project::all();
    return view('tasks.edit', compact('task', 'projects'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Task  $task
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Task $task)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|max:255',
      'priority' => 'required|integer',
      'project_id' => 'required|exists:projects,id',
    ]);

    $task->update([
      'name' => $request->input('name'),
      'priority' => $request->input('priority'),
      'project_id' => $request->input('project_id'),
    ]);

    return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Task  $task
   * @return \Illuminate\Http\Response
   */
  public function destroy(Task $task)
  {
    $task->delete();

    return redirect()->route('tasks.index');
  }
}
