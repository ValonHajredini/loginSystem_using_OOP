<?php

/**
 * Created by PhpStorm.
 * User: hajre
 * Date: 9/28/2016
 * Time: 1:32 PM
 */
class Token{
    //  Generates a token with the algorythem md5 for forms
    public static function generate(){
        return Session::put(Config::get('session/token_name'),md5(uniqid()));
    }
    //  Cheks if the token is valid on the session
    public static function check($token){
        $tokenName = Config::get('session/token_name');
        if(Session::exists($tokenName) && $token =  Session::get($tokenName)){
           Session::delete($tokenName);
            return true;
        }
        else{
            return false;
        }

    }
}