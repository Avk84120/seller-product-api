<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SellerAuthController extends Controller
{
    public function login(Request $request)
{
    $request->validate([
        'email'=>'required|email',
        'password'=>'required'
    ]);

    $seller = User::where('email',$request->email)
        ->where('role','seller')->first();

    if (!$seller || !Hash::check($request->password,$seller->password)) {
        return response()->json(['message'=>'Invalid credentials'],401);
    }

    return response()->json([
        'token'=>$seller->createToken('seller-token')->plainTextToken,
        'role'=>'seller'
    ]);
}

}
