<?php include_once 'core/init.php';
include 'template/header.php';
echo '<div class="container">';

?>
<h1>My profile</h1>
<!--<h2>Welcome --><?php //echo $_GET['user'];?><!--</h2>-->
<?php
    if (!$username = Input::get('user')){
         Redirect::to('index');

    }else {
        $user = new User($username);
        if (!$user->exists()){
            Redirect::to(404);
        } else {
            echo $user->data()->name;
        }
    }
?>


<?php include 'template/footer.php';?>
