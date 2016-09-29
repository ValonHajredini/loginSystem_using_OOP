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
    echo Session::get(Config::get('session/session_name'));

echo '<div class="/container">';
include 'template/footer.php';
