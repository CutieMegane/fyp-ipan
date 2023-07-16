<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!(Auth::check())) //preventing null read on template
            return redirect('/');

        $user = User::all();
        //dd($user);
        if (env('APP_ROUTEPATH')  == 2)
            return view('new.users', compact('user'));
        else
            return view('users.index', compact('user'));
        
    }

    public function dashboardUser()
    {
        $user = User::all();
        return view('users.dashboard', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (env('APP_ROUTEPATH')  == 2)
            return view('new.usercreate');
        else
            return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        DB::table('users')->insert([
            'name' => $request->name,
            'password' => $request->password,
            'email' => $request->email,
            'level' => '0',
        ]);
  
        // User::create($request->all());
   
        return redirect()->route('users.index')->with('success','User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
        if (env('APP_ROUTEPATH')  == 2)
            return view('new.usershow', compact('user'));
        else
            return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        if (env('APP_ROUTEPATH')  == 2)
            return view('new.useredit', compact('user'));
        else
            return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        //dd($request);
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'level' => 'required' , 'boolean',
        ]);

        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->level= $request->level; 
        if (!($request->password == 'null')) {
            $user->password = Hash::make($request->password);
        }
        
  
        $user->save();
        return redirect()->route('users.index')->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        $user->delete();
  
        return redirect()->route('users.index')->with('success','User deleted successfully');
    }
}
