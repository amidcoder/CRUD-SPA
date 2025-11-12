<?php

namespace Src\Interfaces\Http\Controllers;
use App\Domains\Users\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $r)
    {
        $r->validate([
            'name'=>'required','email'=>'required|email|unique:users','password'=>'required|min:6'
        ]);
        $user = User::create([
            'name'=>$r->name,
            'email'=>$r->email,
            'password'=>bcrypt($r->password),
            'role'=>$r->role ?? 'user',
        ]);
        return response()->json(['user'=>$user]);
    }

    public function login(Request $r)
    {
        $r->validate(['email'=>'required|email','password'=>'required']);
        $user = User::where('email',$r->email)->first();
        if (!$user || !Hash::check($r->password,$user->password))
            throw ValidationException::withMessages(['email'=>['Invalid credentials']]);
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['user'=>$user,'token'=>$token]);
    }

    public function user(Request $r){ return $r->user(); }
    public function logout(Request $r){ $r->user()->tokens()->delete(); }
}
