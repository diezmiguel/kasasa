<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function createNewToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
        ];
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $plainPassword = $request->get('password');
        $user->password = Hash::make($plainPassword);
        $user->save();

        $response = [
            'user' => $user,
        ];

        return response()->json($response, 201);
    }

    public function login(Request $request)
    {
        $rules = [
            'email.required' => 'Email can not be empty.',
            'password.required' => 'Password can not be empty.',
        ];
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string',
        ], $rules);

        if ($validator->fails()) {
            $errors = $validator->errors();

            return response()->json($errors, 400);
        }

        $credentials = $request->only('email', 'password');
        $token = null;

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(null, 401);
        }

        return response()->json($this->createNewToken($token), 200);
    }

    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required',
        ]);

        try {
            JWTAuth::invalidate($request->token);
            $details = 'Logged out';

            return $this->helpers->response(true, $this->accepted, $details, null, $this->acceptedCode);
        } catch (JWTException $exception) {
            $details = 'Please try again!';

            return $this->helpers->response(false, $this->internalError, $details, null, $this->internalErrorCode);
        }
    }

    public function getAuthUser(Request $request)
    {
        $this->validate($request, [
            'token' => 'required',
        ]);

        $user = JWTAuth::authenticate($request->token);
        $response = [
            'user' => $user,
        ];

        return response()->json($response, 200);
    }
}
