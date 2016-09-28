<?php
/**
 * Created by PhpStorm.
 * User: hajre
 * Date: 9/28/2016
 * Time: 1:26 PM
 */
require_once 'core/init.php';
//$users = DB::getInstance()->query('SELECT  username FROM users');
//if ($users->count()){
//    foreach($users as $user){
//        echo $user->username;
//    }
//}
$users  = DB::getInstance()->get('users', array('username', '=', 'ekoloni'));

if (!$users->count()){
    echo "No users";
} else {
    echo 'Ok';
}