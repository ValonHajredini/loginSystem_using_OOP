<?php

/**
 * Created by PhpStorm.
 * User: hajre
 * Date: 9/28/2016
 * Time: 1:31 PM
 */
class Session{
    public static function put($name,$value ){
        return $_SESSION[$name] = $value;
    }
    public static function exists($name){
        return(isset($_SESSION[$name])) ? true : false;
    }
    public  static function delete($name){
        if(self::exists($name)){
            unset($_SESSION[$name]);

        }
    }
    public static function get($name){
        return $_SESSION[$name];
    }
}