<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class AuthController
 * @package App\Http\Controllers\API
 */
class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator && $validator->fails()) {
            return response()->json($validator->messages());
        }

        $user = User::where('email', $request->get('email'))->first();
        if ($user && Hash::check($request->get('password'), $user->password)) {
            $user->tokens()->delete();
            $accessToken = $user->createToken($user->name)->accessToken;
            return response()->json([
                'success' => true,
                'token' => $accessToken
            ]);
        } else {
            return response()->json([
                "success" => false,
                "message" => "Invalid credentials"
            ]);
        }
    }
}