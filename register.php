<?php require_once 'core/init.php';
//var_dump();

/**
 * Created by PhpStorm.
 * User: hajre
 * Date: 9/28/2016
 * Time: 1:27 PM
 */
include 'template/header.php';
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Register Here</h1>

<?php

if (Input::exists()){
    if(Token::check(Input::get('token'))){
    $validate = new Validate();
    $validate = $validate->check($_POST, array(
        'username'          => array(
            'required'  => true,
            'min'       => 2,
            'max'       => 20,
            'unique'    => 'users'
        ),
        'password'          => array(
            'required'  => true,
            'min'       => 6
        ),
        'password_again'    => array(
            'required'  => true,
            'matches'   => 'password'
        ),
        'name'              => array(
            'required'  => true,
            'min'       => 2,
            'max'       => 50,
            'unique'    => 'users'
        )
    ));
    if($validate->passed()){
        echo 'Validate pased';
    } else {
//        print_r($validate->errors());
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
            <form action="" method="post">
                <div class="field">
                    <label for="username" class="col-md-2">Username</label>
                    <div class="col-md-10">
                        <input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off">
                    </div>
                </div>
                <div class="field">
                    <label for="password" class="col-md-2">Chose Password</label>
                    <div class="col-md-10">
                        <input type="password" name="password" id="password" value="<?php echo escape(Input::get('password')); ?>" autocomplete="off">
                    </div>
                </div>
                <div class="field">
                    <label for="password_again" class="col-md-2">Psssword Again</label>
                    <div class="col-md-10">
                        <input type="password" name="password_again" id="password_again" value="<?php echo escape(Input::get('password_again'));?>" autocomplete="off">
                    </div>
                </div>
                <div class="field">
                    <label for="name" class="col-md-2">name</label>
                    <div class="col-md-10">
                        <input type="text" name="name" id="name" value="<?php echo escape(Input::get('name')); ?>" autocomplete="off">
                    </div>
                </div>
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                <div class="field">
                    <div class=" col-md-offset-2 col-md-10">
                    <input type="submit" value="Register">
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>


<?php include 'template/footer.php'?>
