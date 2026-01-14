<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function login(Request $request)
{
    $request->validate([
        'email'=>'required|email',
        'password'=>'required'
    ]);

    $user = User::where('email',$request->email)
        ->where('role','admin')->first();

    if (!$user || !Hash::check($request->password,$user->password)) {
        return response()->json(['message'=>'Invalid credentials'],401);
    }

    return response()->json([
        'token'=>$user->createToken('admin-token')->plainTextToken,
        'role'=>$user->role
    ]);
}

}
