<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyMail;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use App\UserVerifyToken;
use App\Mail\UserPasswordRecover;
use App\UserPasswordReset;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.custom.index');
    }

    public function authLogin(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember))
        {
            return redirect()->route('dashboard');
        }
        return back()->with('error', 'Email and Password Not Matched');
    }

    public function register()
    {
        return view('auth.custom.register');
    }

    public function authRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'email|required|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        $create = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => 'user',
            'status' => 'pending'
        ]);

        $token = Str::random(32);

        $id = UserVerifyToken::create([
            'email' => $request->email,
            'token' => $token
        ]);

        $user = array();

        $user['name'] = $request->name;
        $user['token'] = $token;

        Mail::to($request->email)->send(new VerifyMail($user));

        return redirect()->route('user.verify', ['id' => $id]);

        // return $create;
    }

    public function verify($id)
    {
        $id = UserVerifyToken::where('id', $id)->first();
        if($id)
        {
            return view('auth.custom.verify', compact('id'));
        }else{
            return redirect()->route('index');
        }
        
    }

    public function verifyToken($token)
    {
        $id = UserVerifyToken::where('token', $token)->first();
        if($id)
        {
            User::where('email', $id->email)->update([
                'email_verified_at' => now(),
                'status' => 'payment'
            ]);

            UserVerifyToken::where('id', $id->id)->delete();

            return redirect()->route('user.login')->with('success', 'Your Account is now verified!');
        }else{
            return redirect()->route('user.verify', ['id' => $id])->with('error', 'Invalid Token');
        }
    }

    public function verifyResend($id)
    {
        $token = UserVerifyToken::where('id', $id)->first();

        if($token)
        {
            $account = User::where('email', $token->email)->first();

            $user = array();
            $user['name'] = $account->name;
            $user['token'] = $token->token;

            Mail::to($account->email)->send(new VerifyMail($user));

            return redirect()->route('user.verify', ['id' => $id]);
        }
        else {
            return redirect()->route('index');
        }
    }

    public function forgot()
    {
        return view('auth.custom.forgot');
    }

    public function recover(Request $request)
    {
        $account = User::where('email', $request->email)->first();

        if($account)
        {

            $check = UserPasswordReset::where('user_id', $account->id)->first();

            if($check)
            {
                $data = ['token' => $check->token, 'name' => $account->name];
                Mail::to($account->email)->send(new UserPasswordRecover($data));
            }
            else {
                
                $token = Str::random(32);
            
                $data = ['token' => $token, 'name' => $account->name];

                UserPasswordReset::create([
                    'user_id' => $account->id,
                    'token' => $token
                ]);

                Mail::to($account->email)->send(new UserPasswordRecover($data));
            }

            

            return back()->with('success', 'A recovery mail has been sent to your Email');
        }
        else {
            return redirect()->route('user.forgot')->with('error', 'Email Account Not Found!');
        }
    }

    public function forgotToken($token)
    {
        $reset = UserPasswordReset::where('token', $token)->first();

        if($reset)
        {
            return view('auth.custom.password', compact('token'));
        }
        else {
            return redirect('/');
        }
    }

    public function password(Request $request, $token)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed'
        ]);

        $reset = UserPasswordReset::where('token', $token)->first();

        if($reset)
        {
            User::where('id', $reset->user_id)->update([
                'password' => Hash::make($request->password)
            ]);

            UserPasswordReset::where('token', $token)->delete();

            return redirect()->route('user.login')->with('success', 'Your Password restored Successfully');
        }
        else {
            return redirect('/');
        }

    }
}
