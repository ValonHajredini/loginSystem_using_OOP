<?php

/**
 * Created by PhpStorm.
 * User: hajre
 * Date: 9/28/2016
 * Time: 1:30 PM
 */
class Cookie{
//    Cheks if the cooki egsists, when exists return true else return false.
    public static function exists($name){
        return (isset($_COOKIE[$name]))? true :false;
    }
//    Gets the cooki object using the name Variable
    public static function get($name){
        return $_COOKIE[$name];
    }
//    Sets the cooki and puts the name of the cooki, the Value of the cooki and expire date of the cooki
    public static function put($name, $value, $expiry){
        if(setcookie($name, $value, time() + $expiry, '/')){
            return true;
        }
        return false;
    }
//    Destrois the cooki using a expire time on the past
    public static function delete($name){
        self::put($name, '', time() -100);
    }
}