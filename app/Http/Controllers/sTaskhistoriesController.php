<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    
}
