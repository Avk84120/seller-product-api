<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class SellerController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'name'=>'required',
        'email'=>'required|email|unique:users',
        'mobile'=>'required',
        'country'=>'required',
        'state'=>'required',
        'skills'=>'required|array',
        'password'=>'required|min:6'
    ]);

    DB::transaction(function() use ($request) {
        $seller = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'mobile'=>$request->mobile,
            'country'=>$request->country,
            'state'=>$request->state,
            'role'=>'seller',
            'password'=>Hash::make($request->password)
        ]);

        $seller->skills()->sync($request->skills);
    });

    return response()->json(['message'=>'Seller created'],201);
}

public function index()
{
    return User::where('role','seller')->paginate(10);
}


}
