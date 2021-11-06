<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index', [
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $validatedData = $request->validate([
            'name' => ['required', 'max:255'],
            'username' => ['required', 'min:4', 'max:255', 'unique:users'],
            'email' => ['required', 'email:dns', 'unique:users'],
            'password' => ['required', 'min:5', 'max:255'],
            'position' => ['required'],
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['access'] = $request['access'];
        User::create($validatedData);

        return redirect('/user')->with('success', 'Registrasi berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.profile', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {        
        $rules = [
            'name' => ['required', 'max:255'],
            'position' => ['required'],
        ];

        if ($request->username != $user->username) {
            $rules['username'] = ['required', 'min:4', 'max:255', 'unique:users'];
        }

        if ($request->email != $user->email) {
            $rules['email'] = ['required', 'email:dns', 'unique:users'];
        }

        if (isset($request->password)) {
            $rules['password'] = ['required', 'min:5', 'max:255'];            
        }

        $validatedData = $request->validate($rules);
        $validatedData['access'] = $request['access'];
        
        (isset($request['status'])) ? $validatedData['status'] = $request['status'] : $validatedData['status'] = 0;

        if (isset($request->password)) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        User::where('id', $user->id)->update($validatedData);

        return redirect('/user')->with('success', 'Data berhasil diperbarui');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/user');
    }

    public function login() {
        return view('users.login');
    }

    public function authenticate(Request $request) {

        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        
        return redirect('/login')->with('failed', 'Login gagal');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function register() {
        return view('users.register');
    }

    public function userRegister(Request $request) {
        $validatedData = $request->validate([
            'name' => ['required', 'max:255'],
            'username' => ['required', 'min:4', 'max:255', 'unique:users'],
            'email' => ['required', 'email:dns', 'unique:users'],
            'password' => ['required', 'min:5', 'max:255']
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);

        return redirect('/login')->with('success', 'Registrasi berhasil');
    }
}
