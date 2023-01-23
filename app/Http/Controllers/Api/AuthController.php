<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseController
{
    //
    public function register(Request $request)
    {
        $usr_phone = User::where('phone', $request->phone)->first();
        $usr_email = User::where('email', $request->email)->first();

        if ($usr_phone || $usr_email) {
            return response()->json([
                'message' => 'Already Registered!'
            ]);
        } else {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json([
                'message' => 'Register successfully!',
            ]);
        }
    }
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $credentails = ['email' => $request->email, 'password' => $request->password];

        if (Auth::attempt($credentails)) {
            // Auth::login($user);
            $user = Auth::user();
            $success['token'] = $user->createToken('manage')->plainTextToken;
            $success['name'] = $user->name;
            // return response()->json(['Successfully Login!', $success]);
            return $this->sendResponse($success,'Login Success');
        } else {
            return response()->json([
                'message' => 'User credential do not match our records!'
            ]);
        } 
    }
}
