<?php include_once 'core/init.php';
/**
 * Created by PhpStorm.
 * User: hajre
 * Date: 9/28/2016
 * Time: 1:26 PM
 */
$user = new User();
$user->logout();
Session::put('logout', 'Succesgully loged Out');
Redirect::to('login');
die();
