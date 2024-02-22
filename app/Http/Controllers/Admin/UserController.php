<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Models\datadiri;
use App\Models\permohonan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{


    public function getData()
{
    $users = User::where('is_admin', 0)->with('datadiri')->get();
    return Datatables::of($users)->make(true);
}
    

    // edit
    public function edit($id){
    $user = User::with('datadiri')->findOrFail($id);

    
    return view('admin.layout.useredit', compact('user'));
    }

    // // register user android
    // public function RUS(Request $request){
    //     $email = $request->input('email');
    //     $password = $request->input('password');

    //     $hashedPassword = Hash::make($password);

    //     // Create a new user record with the hashed password
    //     $user = User::create([
    //         'email' => $email,
    //         'password' => $hashedPassword
    //     ]);
    //     $userID = $user->id;
    //     $datadiri =  datadiri::create([
    //         'user_id' => $userID,
    //     ]);
    //     Auth::login($user);
    //     $token = $user->createToken('MyApp')->plainTextToken;
    //     return response()->json(['token' => $token]);
    // }
    
    // data permohonan android
//     public function DPA()
// {dd(Auth::check());
//     if (Auth::check()) {
//         $user = Auth::user(); // Retrieve the currently authenticated user

//         $user_id = $user->id; // Retrieve the user's ID

//         $data = permohonan::where('user_id', $user_id)->get(); // Filter the records based on the user's ID

//         return response()->json($data);
//     }

//     return response()->json(['error' => 'Unauthenticated.'], 401);
// }


}
