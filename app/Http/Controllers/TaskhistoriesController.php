<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Taskhistory;

class TaskhistoriesController extends Controller
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
    
    public function index()
    {
        $taskhistories = Taskhistory::all();
        return view('taskhistories.index', ['taskhistories' => $taskhistories]);
    }
    
    public function show($id)
    {
        $taskhistory = Taskhistory::find($id);
        return view('taskhistories.show', ['taskhistory' => $taskhistory]);
    }
}
