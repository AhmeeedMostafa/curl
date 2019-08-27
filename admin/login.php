<?php

/**
 * @author Ahmed Mostafa
 * @copyright 2014
 */
 ob_start();
session_start();

$page_title = 'Admin Log In';
$style_path = '../';
require_once '../incs/inc.header.php';

if(isset($_POST['admin_login'])){
    $email          = $db->real_escape_string(trim(htmlentities($_POST['email'])));
    $password       = md5($_POST['password']);
    $password_check = $_POST['password'];
    if(empty($email)){
            echo "<div class='Failed'>Email Is Required .</div>";
    }elseif(empty($password_check)){
            echo "<div class='Failed'>Password Is Required .</div>";
    }else{
            $sel_admins = curl_get("*","users","WHERE email='".$email."' AND password='".$password."' AND permissions='admin'");
            $unum_rows = $sel_admins->num_rows;
        if($unum_rows == 0){
            echo "<div class='Failed'>The Email Or Password Is Wrong .</div>";
        }else{
            $result_admins = $sel_admins->fetch_object();
            $_SESSION['adminid'] = $result_admins->uid;
            header('Location: index.php');
        }
    }
}
?>

<form action="" method="POST" style="text-align: center;">
    <h1 style='font-weight: bold; font-family: cursive; text-shadow: 2px 2px 2px gray; font-style: italic;'>Administrator Log In System ...</h1>
    <input type="email" name="email" class="txt" placeholder="Admin Email" size="27" /><br />
    <input type="password" name="password" class="txt" placeholder="Password" size="27" /><br />
    <input type="submit" name="admin_login" class="btn" value="Log In !" />
</form>

<?php
    include_once '../incs/inc.footer.php';
    ob_end_flush();
?>
