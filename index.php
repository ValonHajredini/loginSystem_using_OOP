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
$users  = DB::getInstance()->update('users',3, array(
    'password'  => 'new password',
    'name'      => 'Valon Hajredini'
));

//$users  = DB::getInstance()->showAll('users');
//$first_user  = DB::getInstance()->second('users');
//
//if (!$users->count()){
//    echo "No users";
//} else {
//    foreach ($users->results() as $user){
//        echo $user->username.'<br>';
//    }
//}
//echo $first_user->username;
//echo $users->first()->username;