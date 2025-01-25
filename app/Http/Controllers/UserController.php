<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Mail\OTPMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{


    // Backend User
  public function userRegistration(Request $request){

    try {

        User::create([

            'firstName' => $request->input('firstName'),

            'lastName' => $request->input('lastName'),

            'email' => $request->input('email'),

            'phone' => $request->input('phone'),

            'password' => $request->input('password'),

        ]);

        return response()->json([

            'status' => 'success',

            'message' => 'User Registration Successfully'

        ],200);

    } catch (Exception $e) {

        return response()->json([

            'status' => 'failed',

            'message' => "User Registration Failed"

        ],200);

    }

  }


 public function  userLogin(Request $request){

    $count=User::where('email','=',$request->input('email'))

    ->where('password','=',$request->input('password'))

    ->select('id')->first();

    if($count!==null){

      // token issue
      $token=JWTToken::CreateToken($request->input('email'),$count->id);

      return response()->json([

           'status'=>"success",

           "message"=>"User Login Successfully",


      ],status:200)->cookie('token',$token,time()+60*24*30);;


    }else{

        return response()->json([

           'status'=>"Failed",

           "message"=>"User Login Failed"
        ],status:401);

    }


 }



public function sendOTPCode(Request $request){

   $email=$request->input('email');

   $otp=rand(1000,9999);

   $count=User::where('email','=',$email)->count();

   if($count==1){

    // user email address otp send

    Mail::to($email)->send(new OTPMail($otp));

    // Database table a Otp Update

     User::where('email','=',$email)->update(['otp'=>$otp]);

     return response()->json([

        'status'=>"success",

        "message"=>"OTP Send Successfully"

     ],status:200);

   }else{


    return response()->json([

       'status'=>"Failed",

       "message"=>"Otp Send Failed"

    ],status:401);



   }




}



public function verifyOTPCode(Request $request){

 $email=$request->input('email');

 $otp=$request->input('otp');

 $count=User::where('email','=',$email)->where('otp','=',$otp)->count();

 if($count==1){

   // Database Table ar OTP Update

   User::where('email','=',$email)->update(['otp'=>'0']);

   // pass reset token issue

   $token=JWTToken::CreateTokenForSetPassword($email);

   return response()->json([

      'status'=>"success",

      'message'=>"OTP Verification Successfully",

   ],status:200)->cookie('token',$token,60*24*30);

 }else{

    return response()->json([

       'status'=>"Failed",

       "message"=>"OTP Verification Failed"

    ],status:401);

 }


}



public function resetPassword(Request $request){

   try{

    $email=$request->header('email');

    $password=$request->input('password');

    User::where('email','=',$email)->update(['password'=>$password]);

    return response()->json([

       'status'=>"success",

       "message"=>"Password Reset Successfully"

    ],status:200);

   }catch(Exception $e){

    return response()->json([

       'status'=>"Failed",

       "message"=>"Password Reset Failed"

    ],status:401);

   }


}

// Frontend User

public function registerPage(){

    return view('pages.auth.register-page');

}


public function loginPage(){

    return view('pages.auth.login-page');

}


public function sendOTPPage(){

    return view('pages.auth.send-otp-page');

}


public function verifyOTPPage(){

    return view('pages.auth.verify-otp-page');

}


public function resetPasswordPage(){

    return view('pages.auth.reset-password-page');

}


public function dashboardPage(){

    return view('pages.dashboard.dashboard-page');
}


//user logout----------

public function UserLogout(){

    return redirect('/login-page')->cookie('token','',-1);
}


// Profile Page


public function ProfilePage(){

   return view('pages.dashboard.profile-page');

}

public function UserProfile(Request $request){

 $email=$request->header('email');

 $user=User::where('email','=',$email)->first();

 return response()->json([

     'status'=>'success',

     'message'=>'User Profile Successfully',

     'data'=>$user

 ],status:200);


}

public function UpdateProfile(Request $request){

 try{

    $email=$request->header('email');

    $firstName=$request->input('firstName');

    $lastName=$request->input('lastName');

    $phone=$request->input('phone');

    $password=$request->input('password');

    User::where('email','=',$email)->update([

      'firstName'=>$firstName,

      'lastName'=>$lastName,

      'phone'=>$phone,

      'password'=>$password

    ]);

    return response()->json([

        'status'=>'success',

        'message'=>'User Profile Update Successfully'

    ],status:200);

 }catch(Exception $e){

    return response()->json([

        'status'=>'Failed',

        'message'=>'User Profile Update Failed'

    ],status:401);
 }


}







}
