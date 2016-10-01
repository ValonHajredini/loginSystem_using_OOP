<?php

/**
 * Created by PhpStorm.
 * User: hajre
 * Date: 9/28/2016
 * Time: 1:30 PM
 */
class Hash{
    //  Makes a hash of 256 characters from a string using algorithm 'sha256',
    //  This method is used to encrypting the password and includes the salt string of 32 characters
    public static function make($string, $salt = ''){
        return hash('sha256', $string.$salt);
    }
    //    Creates an unique hash of 32 characters and this will be used as the salt for the password
    public static function salt($length){
        return mcrypt_create_iv($length);
    }
    //    Returns the unique hash maded from static method make
    public static function unique(){
        return self::make(uniqid());
    }

}