<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('member.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|unique:App\Models\User,phone_number',
            'password' => 'required|min:6'
        ]);

        $data = $request->except('_token');

        $isEmailExist = User::where('email', $request->email)->exists();

        if($isEmailExist) {
            return back()
                ->withErrors([
                    'email' => 'This email already exist'
                ])->withInput();
        }

        $data['role'] = 'member';
        $data['password'] = Hash::make($request->password);

        User::create($data);
        
        return redirect()->route('member.login');
    }
}
