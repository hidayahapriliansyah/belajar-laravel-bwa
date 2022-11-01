<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('member.login');
    }

    public function auth(Request $request)
    {   
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->except('_token');
        $credentials['role'] = 'member';

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('member.dashboard');
        }

        return back()->withErrors([
            'credentials' => 'Your credentials are wrong'
        ])->withInput();
    }

    public function logout()
    {

    }
}