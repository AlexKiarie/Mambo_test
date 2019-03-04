<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Mail;

class GeneralController extends Controller
{
    //login
    public function login(REQUEST $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }else{
            $user = User;
            $token = uniqid();
            $user->auth_token = $token;
            $expiry = datetime();
            $token_expiry = $expiry;
             //send token to email
            $data = array(
                'token' => $token,
            );
            Mail::send('emails.verify',$data, function($message) use($user){
                $message->to($user->email)->subject('Verify login');
                $message->from('info.company.desk@gmail.com', 'Mabo Test');
            });
            $user->save();
        }
    }
    public function two_factor(){
        return view('two_factor_auth');
    }
    public function verify_token($id, $token){
        $user = User::find($id);
    }
    public function logged_in(){
        return view('logged_in');
    }

}
