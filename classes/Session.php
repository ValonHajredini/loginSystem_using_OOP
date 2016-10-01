<?php

/**
 * Created by PhpStorm.
 * User: hajre
 * Date: 9/28/2016
 * Time: 1:31 PM
 */
class Session{
    //    Creates a session with name $name and value $value ' $_SESSION['session_name'] = Session value'
    public static function put($name,$value ){
        return $_SESSION[$name] = $value;
    }
    //    looks if a specified session exists or not using session name $name
    public static function exists($name){
        return(isset($_SESSION[$name])) ? true : false;
    }
    //    Unset a specified session using the session name $name
    public  static function delete($name){
        if(self::exists($name)){
            unset($_SESSION[$name]);
        }
    }
    //  Get the session $name
    public static function get($name){
        return $_SESSION[$name];
    }
    //  Creates a flash message when login when update , when delete...
    public static function flash($name, $string = ''){
        if(self::exists($name)){
            $session = self::get($name);
            self::delete($name);
            return $session;
        } else {
           return  self::put($name, $string);
        }
    }
    public static function has($status){

    }

}