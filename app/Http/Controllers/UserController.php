<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        if(! Gate::allows('view-all-users')) {
            return redirect('/' . auth()->user()->position);
        }

        return view('users.index', [
            'users' => User::all()
        ]);
    }

    public function create()
    {
        if(! Gate::allows('create-users')) {
            return redirect('/' . auth()->user()->position);
        }

        return view('users.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => ['required', 'max:255'],
            'username' => ['required', 'min:4', 'max:255', 'unique:users'],
            'email' => ['required', 'email:dns', 'unique:users'],
            'password' => ['required', 'min:5', 'max:255', 'confirmed'],
            'position' => ['required'],
        ];

        if (isset($request->phone)) {
            $rules['phone'] = ['min:9', 'unique:users'];
        }

        $validatedData = $request->validate($rules);

        if (isset($request->status)) {
            $validatedData['status'] = $request->status;
        }

        $validatedData['password'] = Hash::make($validatedData['password']);
        
        if ($request['role']) {
            $validatedData['role'] = implode(',', $request['role']);
        } else {
            $validatedData['role'] = null;
        }

        User::create($validatedData);

        return redirect('/user')->with('success', 'Registrasi berhasil');
    }

    public function show(User $user)
    {
        return view('users.profile', [
            'user' => $user
        ]);
    }

    public function edit(User $user)
    {
        if(! Gate::allows('update-users')) {
            return redirect('/' . auth()->user()->position);
        }
        
        return view('users.edit', [
            'user' => $user
        ]);
    }

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
            $rules['password'] = ['required', 'min:5', 'max:255', 'confirmed'];
        }

        if (isset($request->phone) && ($request->phone != $user->phone)) {
            $rules['phone'] = ['regex:/(08)[0-9]/', 'min:9', 'unique:users'];
        }

        $validatedData = $request->validate($rules);

        if ($request['role']) {
            $validatedData['role'] = implode(',', $request['role']);
        } else {
            $validatedData['role'] = null;
        }
        
        (isset($request['status'])) ? $validatedData['status'] = $request['status'] : $validatedData['status'] = 0;

        if (isset($request['address'])) {
            $validatedData['address'] = $request['address'];
        }

        if (isset($request['about'])) {
            $validatedData['about'] = $request['about'];
        }

        if (isset($request->password)) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        User::where('id', $user->id)->update($validatedData);

        if (auth()->user()->position != 'superadmin') {
            $route = '/user/' . auth()->user()->username;
            return redirect($route)->with('success', 'Data berhasil diperbarui');
        } else {
            return redirect('/user')->with('success', 'Data berhasil diperbarui');
        }        
    }

    public function destroy(User $user)
    {
        if(! Gate::allows('update-users')) {
            return redirect('/' . auth()->user()->position);
        }
        User::destroy($user->id);
        return redirect('/user');
    }


    public function uploadImg(Request $request) {
        $rules = [
            'profile_img' => ['file', 'max:1000','mimes:jpg,jpeg,bmp,png']
        ];

        $validatedData = $request->validate($rules);

        $fileName = auth()->user()->username . '.' . $request->file('profile_img')->extension();
        $validatedData['profile_img'] = $request->file('profile_img')->storeAs('profile_image', $fileName);

        User::where('username', auth()->user()->username)->update($validatedData);

        return redirect()->back()->with('success', 'Photo profile berhasil diupload');
    }

    public function deleteImg($username) {
        $img = User::where('username', $username)->first();

        if ($img->profile_img) {
            Storage::delete($img->profile_img);
            User::where('username', $username)->update(['profile_img' => null]);
            return redirect()->back()->with('success', 'Poto profil berhasil dihapus.');
        } else {
            return redirect()->back()->with('failed', 'Poto profil gagal dihapus.');
        }
    }

    public function contributions() {
       return view('users.users-contribution', ['contributions' => contributions()]);
    }

    public function userContributions($username) {
        $data = userContributions($username);

        return response()->json($data);
    }
}
