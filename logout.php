<?php

/**
 * @author Ahmed Mostafa
 * @copyright 2014
 */
session_start();
$page_title = 'Log Out';
require_once 'incs/inc.header.php';
if(isset($_SESSION['uid'])){
    session_destroy();
    echo "<div class='Done' style='margin-top: 20%'>You Have Been Log out Successfully, We Hope You Come Back.</div>";
}else{
    echo "<div class='Failed' style='margin-top: 20%'>You Didn't Log In To Log Out !</div>";
}

include_once 'incs/inc.footer.php';
?>