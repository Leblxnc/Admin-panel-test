<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\datadiri;
use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;


class AuthController extends Controller
{

    use HasApiTokens;

    public function getLogin(){
        if(Auth::check()){
            return redirect()->route('dashboard');
        }

        return View('admin.auth.login');
    }
    public function postLogin(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        $validated=auth()->attempt([
            'email'=>$request->email,
            'password'=>$request->password,
            'is_admin'=>1
        ]);
        if($validated){
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('succes','login berhasil');
        }else{
            return redirect()->back()->with('error','Invalid credentials');
        }
    }
    public function logout(Request $request){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('getLogin');
    }

    // public function loginandroid(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');

    //     if (Auth::attempt($credentials)) {
    //         // Authentication passed
    //         $user = Auth::user();
    //         $token = $user->createToken('authToken')->plainTextToken;

    //         return response()->json(['token' => $token], 200);
    //     }

    //     // Authentication failed
    //     return response()->json(['message' => 'Invalid credentials'], 401);
    // }

// create android user from google log in
public function CAUG(Request $request){

    $email = $request->input('email');
    $identifier = $request->input('identifier');

    $user = User::where('identifier', $identifier)->first();

    if($user){
        Auth::login($user);
            $token = $user->createToken('MyApp')->plainTextToken;
            return response()->json(['token' => $token]);
    }else{
        $newuser = User::create([
            'email' => $email,
            'identifier' => $identifier
        ]);
        // verifikasi email
        // $token_verify = Str::random(64);

        // $newuser->token_verify = $token_verify;
        // $newuser->save();

        // Mail::to($newuser)->send(new VerifyEmail($newuser, $token_verify));

        Auth::login($newuser);
        $datadiri =  datadiri::create([
            'user_id' => Auth::id(),
        ]);
        $token = $newuser->createToken('MyApp')->plainTextToken;
            return response()->json(['token' => $token]);
    }
    return response()->json(['error' => 'Invalid credentials'], 401);
}

}
