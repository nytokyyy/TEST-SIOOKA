<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\CartManagement\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    public function __construct(
        private readonly CartService $cartService
    )
    {
    }

    public function register(Request $request){
        $registerUserData = $request->validate([
            'name'=>'required|string',
            'email'=>'required|string|email|unique:users',
            'password'=>'required|min:8'
        ]);

        $user = User::create([
            'name' => $registerUserData['name'],
            'email' => $registerUserData['email'],
            'password' => Hash::make($registerUserData['password']),
        ]);

        return response()->json([
            'message' => 'User Created ',
        ]);
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email'=>'required|string|email',
            'password'=>'required'
        ]);

        $user = User::where('email',$credentials['email'])->first();
        
        if(!$user || !Hash::check($credentials['password'],$user->password)){
            return response()->json([
                'message' => 'Invalid Credentials'
            ],401);
        }

        // merge guest cart with user cart if exists
        $this->cartService->mergeSessionCartToUserCart($user);

        $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ]);
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }
}
