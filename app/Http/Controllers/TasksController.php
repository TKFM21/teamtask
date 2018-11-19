<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Taskhistory;

class TasksController extends Controller
{
    protected $redirectTo = 'login';
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        return view('home', ['tasks' => $tasks]);
    }
    
    public function show($id)
    {
        $task = Task::find($id);
        return view('tasks.show', ['task' => $task]);
        //return 'show';
    }
    
    public function create()
    {
        $task = new Task;
        return view('tasks.create', ['task' => $task]);
        //return 'create';
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:191',
            'status' => 'required|max:191',
            'in_charge_id' => 'required|integer',
            'detail' => 'required|max:191',
            'time_limit' => 'nullable|date',
        ]);
        
        $task = new Task;
        $task->title = $request->title;
        $task->status = $request->status;
        $task->in_charge_id = $request->in_charge_id;
        $task->detail = $request->detail;
        $task->time_limit = $request->time_limit;
        $task->save();
        
        $taskhistory = new Taskhistory;
        $taskhistory->task_id = $task->id;
        $taskhistory->crud = 'create';
        $taskhistory->title = $task->title;
        $taskhistory->status = $task->status;
        $taskhistory->in_charge_id = $task->in_charge_id;
        $taskhistory->detail = $task->detail;
        $taskhistory->time_limit = $task->time_limit;
        $taskhistory->save();
        
        return redirect('/');
        //return $task->id;
    }
    
    public function edit($id)
    {
        $task = Task::find($id);
        return view('tasks.edit', ['task' => $task]);
        //return 'edit';
    }
    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:191',
            'status' => 'required|max:191',
            'in_charge_id' => 'required|integer',
            'detail' => 'required|max:191',
            'time_limit' => 'nullable|date',
        ]);
        
        $task = Task::find($id);
        $task->title = $request->title;
        $task->status = $request->status;
        $task->in_charge_id = $request->in_charge_id;
        $task->detail = $request->detail;
        $task->time_limit = $request->time_limit;
        $task->save();
        
        $taskhistory = new Taskhistory;
        $taskhistory->task_id = $task->id;
        $taskhistory->crud = 'update';
        $taskhistory->title = $task->title;
        $taskhistory->status = $task->status;
        $taskhistory->in_charge_id = $task->in_charge_id;
        $taskhistory->detail = $task->detail;
        $taskhistory->time_limit = $task->time_limit;
        $taskhistory->save();
        
        return redirect()->back();
    }
    
    public function destroy($id)
    {
        $task = Task::find($id);
        
        $taskhistory = new Taskhistory;
        $taskhistory->task_id = $task->id;
        $taskhistory->crud = 'delete';
        $taskhistory->title = $task->title;
        $taskhistory->status = $task->status;
        $taskhistory->in_charge_id = $task->in_charge_id;
        $taskhistory->detail = $task->detail;
        $taskhistory->time_limit = $task->time_limit;
        $taskhistory->save();
        
        $task->delete();
        
        return redirect('/');
        //return 'delete : '.$task;
    }
}
