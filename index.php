<?php
/**
 * Created by PhpStorm.
 * User: hajre
 * Date: 9/28/2016
 * Time: 1:26 PM
 */
require_once 'core/init.php';
echo '<div class="container">';
include 'template/header.php';
if (Session::exists('success')) {
    ?>
    <div class="row">
        <div class="col-md-6 col-md-offset-1">
            <div class="panel panel-success">
                <div class="panel-heading"><b>Success</b></div>
                <div class="panel-body">
                    <div class="list-group">
                        <p></p>
                    </div>
                    <?php echo Session::flash('success') ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}
    $user = new User();



if($user->isLogedIn()){
    ?>
    <ul>
        <li><a href="logout">Logout</a></li>
        <li><a href="profile?user=<?php echo escape($user->data()->username )?>">Profile</a></li>
        <li><a href="update">Update Details</a></li>
        <li><a href="changepassword">Update password</a></li>
    </ul>

<?php

    if ($user->hasPermission('admin')){
        echo '<p>You are admin</p>';
    }
    echo 'Home<br>';
    echo '<pre>';
    echo '<a href="profile?user='.escape($user->data()->username ).'"> '.$user->data()->username.'</a>';
    echo '<br>';
    echo 'Full Name: '.$user->data()->name;
    echo '</pre>';

}else {
    echo '<h2>Hello</h2><p>You need to <a href="login.php">Login </a> or <a href="register.php">Register</a> <p';
}

echo '<div class="/container">';
include 'template/footer.php';
