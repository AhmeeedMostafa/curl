<?php

/**
 * @author Ahmed Mostafa
 * @copyright 2014
 */
session_start();
$page_title = 'Log In';
require_once 'incs/inc.header.php';

if(isset($_SESSION['uid'])){
    header("Location: /users/");
}else{
    echo "<form action='' method='POST' class='login_form'>
        <h1 class='heading' style='margin-left: -82px;'>Log In Now With Your Email &amp; Password</h1><br /><br />
        <table>
            <tr><td>Email</td><td><input type='email' name='email' class='txt' /></td></tr>
            <tr><td>Password</td><td><input type='password' name='password' class='txt' /></td></tr>
            <tr><td colspan='2'><input type='submit' name='login' value='Log In' onclick='log_in()' class='btn' /></td></tr>
        </table>
    </form>";

    if(isset($_POST['login'])){
        $email    = $db->real_escape_string(htmlentities($_POST['email']));
        $password = md5($_POST['password']);
        $get = curl_get("*","users","WHERE email='$email' AND password='$password'");
        $num_rows = $get->num_rows;
        $result = $get->fetch_object();
        if($num_rows == 1){
         $_SESSION['uid'] = $result->uid;
         header("Location: /users");
        }else{
            echo "<div class='Failed'>The Email or Password is wrong .</div>";
        }
    }
}

include_once 'incs/inc.footer.php';
ob_end_flush;
curl_db_close();
?>