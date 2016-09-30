<?php include_once 'core/init.php';
include 'template/header.php';
$user = new User();
if (!$user->isLogedIn()){
    Redirect::to('index');
}
if (Input::exists()){
    if(Token::check(Input::get('token'))){
    $validate = new Validate();
        $validate->check($_POST, [
            'password_current'  => ['required' => true, 'min' => '6', 'max' => '32'],
            'password_new'      => ['required' => true, 'min' => '6', 'max' => '32'],
            'password_new_agan' => ['required' => true, 'min' => '6', 'max' => '32', 'matches' => 'password_new']

        ]);
        if ($validate->passed()){

            if (Hash::make(Input::get('password_current'), $user->data()->salt) !== $user->data()->password){

                ?>
                <div class="row">
                    <div class="col-md-6 col-md-offset-1">
                        <div class="panel panel-danger">
                            <div class="panel-heading"><b>Current password</b> Errors </div>
                            <div class="panel-body">
                                <div class="list-group">
                                    <p>Your current passsword is wrong!</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                $hash = Hash::make(Input::get('password_current'), $user->data()->salt);
                $salt = Hash::salt(32);
                $user->update([ 'password' => Hash::make(Input::get('password_new_agan'), $salt), 'salt' => $salt  ]);

                Session::flash('success', 'Your password wos succesfully changed.');

                $update = true;
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
            }
        } else {
            ?>
            <div class="row">
                <div class="col-md-6 col-md-offset-1">
                    <div class="panel panel-danger">
                        <div class="panel-heading"><b><?php echo count($validate->errors())?></b> Errors </div>
                        <div class="panel-body">
                            <div class="list-group">
                                <?php
                                foreach ($validate->errors() as $error) {
                                    echo '<a href="#" class="list-group-item">'.$error. '</a>';
                                }
                                ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}
echo '<div class="container">';
/**
 * Created by PhpStorm.
 * User: hajre
 * Date: 9/28/2016
 * Time: 1:27 PM
 */?>
<h1>Change passwors</h1>
<form action="" method="post">
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    <div class="field">
        <label for="password_current" class="col-md-2">Current PAssword</label>
        <div class="col-md-10">
            <input type="password" name="password_current" id="password_current" value="" autocomplete="off">
        </div>

    </div>
    <div class="field">
        <label for="password_new" class="col-md-2">New Password</label>
        <div class="col-md-10">
            <input type="password" name="password_new" id="password_new" value="" autocomplete="off">
        </div>

    </div>
    <div class="field">
        <label for="password_new_agan" class="col-md-2">New password agan</label>
        <div class="col-md-10">
            <input type="password" name="password_new_agan" id="password_new_agan" value="" autocomplete="off">
        </div>

    </div>
    <div class="field ">
        <div class="col-md-2 col-md-offset-2">
            <input type="submit" value="Change password">
        </div>
    </div>
</form>
</div>
<?php include 'template/footer.php';?>