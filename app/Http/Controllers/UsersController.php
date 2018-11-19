<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

use Auth;
use Validator;

class UsersController extends Controller
{
    protected $user;
    
    public function __construct()
    {
        // $this->middleware('auth:user');
        // $this->user = Auth::guard('user')->user();
    }
    
    public function index()
    {
        $users = User::paginate(10);
        
        return view('users.index', [
            'users' => $users,
        ]);
    }
    
    public function show($id)
    {
        $user = User::find($id);
        
        return view('users.show', [
            'user' => $user,
        ]);
    }
    
    public function edit($id)
    {
        $user = User::find($id);
        
        if (\Auth::id() === $user->id) {
            return view('users.edit', [
            'user' => $user,
            ]);
        } elseif (\Auth::id() === 1) {
            return view('users.edit', [
            'user' => $user,
            ]);
        } else {
            return redirect()->back();
        }
    }
    
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        
        if (\Auth::id() === $user->id) {
            $this->validate($request, [
            'name' => 'required|string|max:191',
            ]);
            
            $user->name = $request->name;
            $user->save();
            return redirect()->back();
        } elseif (\Auth::user()->role <= 3) {
            $this->validate($request, [
            'name' => 'required|string|max:191',
            'role' => 'required|integer',
            ]);
            
            $user->name = $request->name;
            $user->role = $request->role;
            $user->save();
            return redirect()->back();
        } else {
            return redirect()->back();
        }
        return redirect()->back();
    }
    
    public function delete($id)
    {
        $user = User::find($id);
        
        if (\Auth::user()->role <= 3){
            if ($user->role !== 1){
                $user->delete();
            }
        }
        return redirect('/');
    }
}
