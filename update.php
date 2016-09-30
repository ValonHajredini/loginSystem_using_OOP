<?php
/**
 * Created by PhpStorm.
 * User: hajre
 * Date: 9/28/2016
 * Time: 1:27 PM
 */
require_once 'core/init.php';
include 'template/header.php';
echo "<div class='container'>";
$user = new User();
if(!$user->isLogedIn()){
    Redirect::to(404);
}
if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validate = $validate->check($_POST, ['name'=> ['required' => true, 'min' => 6, 'max' => 30 ]]);
        if($validate->passed()){
//            $edit_user = DB::getInstance();
//            $update = $edit_user->update('users', $user->data()->id, ['name' => Input::get('name')]);
            try{
                $user->update(['name' => Input::get('name')]);
                $update = true;
            }catch (Exception $e){
                die($e->getMessage());
            }
            if($update){
                $user->data()->name = Input::get('name');
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
?>
<h1>Edit Your Full name</h1>
<form action="" method="post">
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    <div class="field">
        <label for="name" class="col-md-2">Username</label>
        <div class="col-md-2">
            <input type="text" name="name" id="name" value="<?php echo escape($user->data()->name)?>" autocomplete="off">
        </div>
        <div class="col-md-2">
            <input type="submit" value="Update">
        </div>
    </div>
</form>
</div>
<?php require 'template/footer.php'; ?>