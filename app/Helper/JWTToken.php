<?php



  namespace App\Helper;
  use Exception;
  use Firebase\JWT\JWT;
  use Firebase\JWT\Key;


  class JWTToken{


    public static function CreateToken($userEmail,$userID){

      $key=env('JWT_KEY');

      $payload=[
            "iss"=>"laravel pos application",
            "iat"=>time(),
            "exp"=>time()+60*60,
            'userEmail'=>$userEmail,
            'userID'=>$userID
      ];

      return JWT::encode($payload,$key,'HS256');
    }


      public static function CreateTokenForSetPassword($userEmail){

      $key=env('JWT_KEY');

      $payload=[
            "iss"=>"laravel pos application",
            "iat"=>time(),
            "exp"=>time()+60*60,
            'userEmail'=>$userEmail,
            'userID'=>'0'
      ];

      return JWT::encode($payload,$key,'HS256');
    }


    public static function VerifyToken($token){

      try{

        if($token==null){

          return "Unauthorized";
        }else{
            $key=env('JWT_KEY');
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            return $decoded;
        }

      }
       catch(Exception $e){
          return "Unauthorized";
       }

    }



  }

?>
