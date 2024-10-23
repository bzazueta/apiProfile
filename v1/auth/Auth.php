<?php

use Firebase\JWT\JWT;

class Auth {
    private $key = '7d343434f4087bc4c909bf89b2e66771f683e599694150c92e21d1b99ee63886'; // Llave secreta
    private $iss = 'http://miapi.com/api';  // Donde se genera el API
    private $aud = 'http://miapi.com'; // Donde se consume el API
    private $iat; // Fecha de generación del token
    private $exp; // Fecha de expiración del token
    private $alg = 'HS256'; // Algoritmo de encriptación
    

    function __construct()
    {
      //  $this->iat = time();
       // $this->exp = $this->iat + (60 * 60);
    }

    public static function SignIn($data)
    {
        $time = time();
        
        $token = array(
            //'exp' => $time + (60*60),
            'aud' => self::Aud(),
            'data' => $data
        );
          //var_dump($data);
        return JWT::encode($token, self::$secret_key);
    }

    public function getToken($data){
        try {   
            $payload = array(
                'iss' => $this->iss,
                'aud' => $this->aud,
                'iat' => $this->iat,
                'exp' => $this->exp,
                'data' => $data
            );

            $token = JWT::encode($payload, $this->key, $this->alg);
            //$response = array('token' => $token);
            return $token;
        } catch (\Exception $e) {
            $response = array('msg' => $e->getMessage());
            return $response;
        }
    }

    public function decodeToken($token){
        try {
            JWT::decode($token, $this->key, array($this->alg));
            return true;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}