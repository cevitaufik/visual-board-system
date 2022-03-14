<?php

namespace App\Http\Controllers;

use App\Mail\PasswordResetMail;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class AuthController extends Controller
{
    public function login() {
        return view('users.login');
    }


    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $remember = $request['remember'] ? true : false;

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            $route = '/' . auth()->user()->position;
            return redirect($route);
        }

        return redirect('/login')->with('failed', 'Login gagal');
    }


    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }


    public function forgotPasswordForm() {
        return view('auth.forgot-password');
    }


    // menghandle form permintaan reset password (lupa password)
    // menerima alamat email dari user dan mengirim email link verifikasi
    public function forgotPassword(Request $request) {
        $request->validate(['email' => 'required|email|exists:users,email']);
        $token = Str::random(100);
        $link = URL::to('/') . '/reset-password/' . $token;

        PasswordReset::updateOrCreate(
            ['email' => $request->email],
            ['token' => $token]
        );

        $message = [
            'user_name' => User::whereEmail($request->email)->first()->name,
            'link' => $link
        ];

        Mail::to($request->email)->queue(new PasswordResetMail($message));

        // berbaiki returnnya !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        // berbaiki returnnya !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        // berbaiki returnnya !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        // berbaiki returnnya !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        // berbaiki returnnya !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        return 'Sukses. silahkan cek email anda.';
    }


    public function resetPasswordForm($token) {
        $resetToken = PasswordReset::whereToken($token)->firstOrFail()->token;

        return view('auth.reset-password-form', ['resetToken' => $resetToken]);
    }


    public function resetPassword(Request $request) {
        $validatedData = $request->validate([
            'password' => ['required', 'min:5', 'max:255', 'confirmed']
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $token = PasswordReset::whereToken($request->resetToken)->firstOrFail();
        User::whereEmail($token->email)->first()->update($validatedData);

        PasswordReset::destroy($token->id);

        return redirect('/login')->with('success', 'Password berhasil diperbarui.');
    }


    public function emailVerify() {
        return view('auth.verify-email');
    }


    public function emailVerificationRequest(EmailVerificationRequest $request) {
        $request->fulfill();
 
        return redirect('/user/' . auth()->user()->username)
                ->with('success', 'Email anda berhasil di verifikasi.');
    }


    public function registerForm() {
        return view('users.register');
    }


    public function register(Request $request) {
        $validatedData = $request->validate([
            'name' => ['required', 'max:255'],
            'username' => ['required', 'min:4', 'max:255', 'unique:users'],
            'email' => ['required', 'email:dns', 'unique:users'],
            'password' => ['required', 'min:5', 'max:255', 'confirmed']
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);

        $user = User::whereUsername($request->username)->latest()->first();
        event(new Registered($user));

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect('/' . auth()->user()->position)->with('success', 'Registrasi berhasil silahkan verifikasi email Anda, dengan mengklik tautan yang kami kirim ke alamat email Anda.');
        }
    }


    public function updatePassword(Request $request, User $user) {
        $route = '/user/' . auth()->user()->username;
        if (Hash::check($request->currentPassword, auth()->user()->password)) {
            $validatedData = $request->validate([
                'password' => ['required', 'min:5', 'max:255', 'confirmed']
            ]);
            
            $validatedData['password'] = Hash::make($validatedData['password']);
            User::where('id', $user->id)->update($validatedData);

            return redirect($route)->with('success', 'Password berhasil diperbarui');
        } else {
            return redirect($route)->with('failed', 'Password gagal diperbarui');
        }        
    }

}
