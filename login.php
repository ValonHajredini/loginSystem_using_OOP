<?php include_once 'core/init.php';
/**
 * Created by PhpStorm.
 * User: hajre
 * Date: 9/28/2016
 * Time: 1:26 PM
 */
include 'template/header.php';
echo '<div class="container">';
if (Session::exists('logout')) {
    ?>
    <div class="row">
        <div class="col-md-6 col-md-offset-1">
            <div class="panel panel-warning">
                <div class="panel-heading"><b>Loged Out</b></div>
                <div class="panel-body">
                    <div class="list-group">
                        <p></p>
                    </div>
                    <?php echo Session::flash('logout') ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}
if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validate = $validate->check($_POST, [
            'username'          => ['required'     => true ],
            'password'          => [ 'required'    => true ]
        ]);
        if($validate->passed()){
            echo '1 -> The remember is: '.Input::get('remember').'<br>';
//            die();
            $remember = (Input::get('remember') == 'on') ? true : false;
            $user = new User();
            $login = $user->login(Input::get('username'), Input::get('password'), $remember);

            if ($login){
                Redirect::to('index');
            } else {
                ?>
                <div class="row">
                    <div class="col-md-6 col-md-offset-1">
                        <div class="panel panel-danger">
                            <div class="panel-heading"><b>Authentication Error</b>  </div>
                            <div class="panel-body">
                                <p>Sorry, the <b>username</b> or <b>password</b> is incorrect</p>

                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }else{
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
?>

        <h1>Login Page</h1>
        <form action="" method="post">
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            <div class="field">
                <label for="username" class="col-md-2">Username</label>
                <div class="col-md-10">
                    <input type="text" name="username" id="username" value="" autocomplete="off">
                </div>
            </div>
            <div class="field">
                <label for="password" class="col-md-2">Password</label>
                <div class="col-md-10">
                    <input type="password" name="password" id="username" value="" autocomplete="off">
                </div>
            </div>
            <div class="field">

                <div class="col-md-6 col-md-offset-2">
                    <input type="checkbox" name="remember" id="remember" value="on" >
                    <label for="remember" >Remember me</label>
                </div>
            </div>
            <div class="field">
                <div class=" col-md-offset-2 col-md-10">
                    <input type="submit" value="LogIn">
                </div>
            </div>
        </form>
    </div>
<?php include 'template/footer.php'; ?>