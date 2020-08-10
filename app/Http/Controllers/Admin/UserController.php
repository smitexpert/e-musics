<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $users = User::where('type', 'user')->orderBy('id', 'desc')->paginate(20);
        return view('dashboard.users.index', compact('users'));
    }

    public function delete($id)
    {
        $action = User::where('id', $id)->delete();
        if($action)
        {
            return back()->with('success', 'User successfully deleted');
        }else{
            return back()->with('error', 'User Not deleted');
        }
    }

    public function admin()
    {
        $users = User::where('type', 'admin')->orderBy('id', 'desc')->paginate(20);
        return view('dashboard.users.index', compact('users'));
    }

    public function add()
    {
        return view('dashboard.users.add');
    }

    public function insert(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:8'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Admin Created Successfully');
    }
}
