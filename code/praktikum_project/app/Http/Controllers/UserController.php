<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller {
    protected $user;

    public function __construct() {
        $this->middleware("auth:api", ["except" => ["login", "register","forgotpassword", "test"]]);
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
            ], 400);
        }

        $data = [
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ];

        if(filter_var($data["email"], FILTER_VALIDATE_EMAIL)===false) {
            return response()->json([
                "success" => false,
                "message" => "Invalid E-Mail address format."
            ], 400);
        }

        $this->user->create($data);

        return $this->respondWithToken($this->user->createToken("authToken")->accessToken, "Registration successful", $this->user);
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
            ], 400);
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
            // $accessToken = auth()->user()->createToken("authToken")->accessToken;
            // $responseMessage = "Login Successful";
            return $this->respondWithToken(auth()->user()->createToken("authToken")->accessToken, "Login successful", auth()->user());
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

        if(array_key_exists("email", $credentials)===true) { 
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
        return response()->json([
            "success" => false,
            "message" => "No email specified.",
        ], 400);
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
        // if($user) {
            $user->revoke();
            return response()->json([
                "success" => true,
                "message" => "Successfully logged out"
            ], 200);
        /*} might be not needed cause middleware already checks
        return response()->json([
            "success" => false,
            "message" => "You are not logged in"
        ], 422)*/
    }

    /**
     * This hook is used for testing stuff
     */
    public function test() {
        Log::info(print_r(get_class(auth()->user()), true));

        return response()->json([
            "success" => true
        ], 200);
    }
}