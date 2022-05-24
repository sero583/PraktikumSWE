<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Redirect,Response,File;
use Illuminate\Support\Facades\Hash;
 
class UserController extends Controller {
    /**
     * Catches the registration try. At this point, no real registration is done and the account is not accessible, until registration has been finished.
     * To finish the registration, the registering user must follow the verification link sent by mail.
     */
    public function catchRegistriationTry(Request $req) {
        $username = $req->input("username");
        $email = $req->input("email");
        $hashedPassword = Hash::make($req->input("password"));
    }

    /**
     * This get's executed, when the user clicks on the 'verify my account' link in the welcome mail.
     */
    public function finalizeRegistration(Request $req) {

    }

    public function login(Request $req) {
        $email =  $req->input("email");
        $password = $req->input("password");
 
        $user = DB::table("users")->where("email", $email)->first();

        if(!Hash::check($password, $user->password)) {
            // authenticated -> generate access token

            echo "Not Matched";
        } else {
            // not authenticated -> send to frontend specific response

            //$user = DB::table('users')->where('email',$email)->first();
           echo $user->email;
        }
    }
    
    public function register(Request $req) {
        $name = $req->input('name');

        if(DB::table('users'))

        $email = $req->input('email');
        $password = Hash::make($req->input('password'));
        
        DB::table('users')->insert([
            'name' =>   $name,
            'email' =>  $email ,
            'password'=> $password
          ]);
    }
}