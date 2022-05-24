<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {
    protected $user;

    public function __construct() {
        $this->middleware("auth:api", ["except" => ["login", "register","forgotpassword"]]);
        $this->user = new User;
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(),[
            "name" => "required|string",
            "email" => "required|string|unique:users",
            "password" => "required|min:6|confirmed",
        ]);
        
        if($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->messages()->toArray()
            ], 500);
        }

        $data = [
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ];

        $this->user->create($data);
        $responseMessage = "Registration successful";
        return response()->json([
            "success" => true,
            "message" => $responseMessage
        ], 200);
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(),[
            "email" => "required|string",
            "password" => "required|min:6",
        ]);

        if($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->messages()->toArray()
            ], 500);
        }

        $credentials = $request->only(["email","password"]);
        $user = User::where("email", $credentials["email"])->first();
        
        if($user) {
            if(!auth()->attempt($credentials)) {
                $responseMessage = "Invalid username or password";
                return response()->json([
                    "success" => false,
                    "message" => $responseMessage,
                    "error" => $responseMessage
                ], 422);
            }
            $accessToken = auth()->user()->createToken("authToken")->accessToken;
            $responseMessage = "Login Successful";
            return $this->respondWithToken($accessToken,$responseMessage,auth()->user());
        } else{
            $responseMessage = "User does not exist";
            return response()->json([
                "success" => false,
                "message" => $responseMessage,
                "error" => $responseMessage
            ], 422);
        }
    }

    public function forgotpassword(Request $request) {
        $credentials = $request->only(["email"]);
        $user = User::where("email", $credentials["email"])->first();
        
        // for privacy, server won't reveal if user has been found or not
        if($user) {
            $user->sendPasswordResetMail();
        }
        
        return response()->json([
            "success" => true,
            "message" => "Reset instruction mail has been sent, if entered mail was an existing one.",
        ], 200);
    }

    public function viewProfile() {
        $responseMessage = "User Profile";
        $data = Auth::guard("api")->user();
        return response()->json([
            "success" => true,
            "message" => $responseMessage,
            "data" => $data
        ], 200);
    }

    public function logout() {
        $user = Auth::guard("api")->user()->token();
        $user->revoke();
        $responseMessage = "Successfully logged out";
        return response()->json([
            "success" => true,
            "message" => $responseMessage
        ], 200);
    }
}