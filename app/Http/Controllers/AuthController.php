<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\HashController;
use Illuminate\Support\Facades\Hash;

//? Library
use Illuminate\Support\Facades\Auth;

//? Models
use App\Models\SystemAuthorities;


class AuthController extends Controller
{
    // ** Giriş
    public function index()
    {
        return view('login');
    }

    // ** Giriş post
    public function login_post(Request $request)
    {
        $hash = new HashController;
        $name = $request->name;
        $pass = $request->pass;
        $user = SystemAuthorities::where('name', $name)->first();

        if ($user && $pass == $hash->AefnetHashCoz($user->password)) {
            // update last login date
            $user->updateLastLoginDate();
            session()->flash('success', 'Hoşgeldiniz ' . $user->name);
            Auth::login($user);
            return redirect()->route('index');
        } else {
            return redirect()->route('login.index')->with('error', 'Kullanıcı adı veya şifre yanlış!');
        }
    }



    // ** Çıkış
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.index');
    }

    // ** Şifremi unuttum
    public function forgot_password()
    {
        return view('forgot_password');
    }

    private function getEmailPost()
    {
        return session('emailpost');
    }

    public function forgot_password_email_post(Request $request)
    {
        session(['emailpost' => $request->email]);
        $hash = new HashController;

        $manager = SystemAuthorities::where('email', $request->email)->first();
        if ($manager) {
            return redirect()->route('login.verify-code')->with('manager', $manager);
        } else {
            return view('forgot_password')->with('error', 'Email not found!');
        }
    }

    public function verify_code()
    {
        $manager = session('manager');
        return view('verify-code', compact('manager'));
    }

    public function verify_code_post(Request $request)
    {
        $hash = new HashController;
        $email = $this->getEmailPost();
        $manager = SystemAuthorities::where('email', $email)->first();

        if ($manager && $manager->security_answer === $request->security_answer) {
            return redirect()->route('login.new-password');
        } else {
            return redirect()->route('login.forgot');
        }
    }

    public function new_password()
    {
        return view('new-password');
    }

    public function new_password_post(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'password-again' => 'required|same:password'
        ]);

        $hash = new HashController;
        $email = $this->getEmailPost();
        $manager = SystemAuthorities::where('email', $email)->firstOrFail();

        $manager->password = $hash->AefnetHash($request->password);
        $manager->save();

        return redirect()->route('login.index');
    }
}
