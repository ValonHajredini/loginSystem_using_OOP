<?php

/**
 * Created by PhpStorm.
 * User: hajre
 * Date: 9/28/2016
 * Time: 1:30 PM
 */
class Input{
    //    Controls of any post or get parameter exists, default is used for post, but in work tu with get
    public static function exists($type = 'post'){
        switch ($type){
            case 'post':
                return (!empty($_POST)) ? true : false;
                break;

            case 'get';
                return (!empty($_GET)) ? true : false;
                break;
            default:
                return false;
            break;
        }
    }
    //    Returns the value of post or get parameters
    public static function get($item){
        if(isset($_POST[$item])){
            return $_POST[$item];
        } else if (isset($_GET[$item])) {
            return $_GET[$item];
        }else {
            return '';
        }
    }
    //    Returns the value of the post parameters
    public static function post($item){
        return $_POST[$item];
    }
    //    Returns the params from get and post parameters
    public static function param($item){
        if(isset($_POST[$item])){
            return $_POST[$item];
        } else {
            return $_GET[$item];
        }
    }
}