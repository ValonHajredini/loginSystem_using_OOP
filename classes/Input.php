<?php

/**
 * Created by PhpStorm.
 * User: hajre
 * Date: 9/28/2016
 * Time: 1:30 PM
 */
class Input{
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
    public static function get($item){
        if(isset($_POST[$item])){
            return $_POST[$item];
        } else if (isset($_GET[$item])) {
            return $_GET[$item];
        }else {
            return '';
        }
    }
    public static function post($item){
        return $_POST[$item];
    }
    public static function param($item){
        if(isset($_POST[$item])){
            return $_POST[$item];
        } else {
            return $_GET[$item];
        }
    }
}