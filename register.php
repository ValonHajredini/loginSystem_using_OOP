<?php require_once 'core/init.php';
/**
 * Created by PhpStorm.
 * User: hajre
 * Date: 9/28/2016
 * Time: 1:27 PM
 */
if (Input::exists()){
//    echo Input::post('username');
    echo Input::get('name');
}
?>
<form action="" method="post">
    <div class="field">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="" autocomplete="off">
    </div>
    <div class="field">
        <label for="password">Chose Password</label>
        <input type="password" name="password" id="password" value="" autocomplete="off">
    </div>
    <div class="field">
        <label for="password_again">Psssword Again</label>
        <input type="password" name="password_again" id="password_again" value="" autocomplete="off">
    </div>
    <div class="field">
        <label for="name">name</label>
        <input type="text" name="name" id="name" value="" autocomplete="off">
    </div>
    <div class="field">
        <input type="submit" value="Register">
    </div>

</form>
