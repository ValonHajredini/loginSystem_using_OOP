<?php

/**
 * Created by PhpStorm.
 * User: hajre
 * Date: 9/28/2016
 * Time: 1:32 PM
 */
class Token{
    public static function generate(){
        return Session::put(Config::get('session/token_name'),md5(uniqid()));
    }
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