<?php

/**
 * @author Ahmed Mostafa
 * @copyright 2014
 */
session_start();
require_once '../functions.php';

$first_name     = $db->real_escape_string(htmlentities($_POST['first_name']));
$last_name      = $db->real_escape_string(htmlentities($_POST['last_name']));
$email          = $db->real_escape_string(htmlentities($_POST['email']));
$email_sure     = $db->real_escape_string(htmlentities($_POST['email_sure']));
$password       = htmlentities($_POST['password']);
$password_sure  = htmlentities($_POST['password_sure']);
$ip             = $_SERVER['REMOTE_ADDR'];

$get = curl_get('email,ip','users');
$emails = array();
$ips    = array();
while($result = $get->fetch_object()){
    $emails[] = $result->email;
    $ips[]    = $result->ip;
}

if(empty($first_name) && empty($last_name) && empty($email) && empty($email_sure) && empty($password) && empty($password_sure)){
    echo "<div class='Failed'>Please Enter All The Fields Above .</div>";
}elseif(empty($first_name)){
    echo "<div class='Failed'>Please Enter Your First Name .</div>";
}elseif(strlen($first_name) < 3 || strlen($first_name) > 25){
    echo "<div class='Failed'>First Name must be more than 3 letters &amp; little than 25 letters .</div>";
}elseif(empty($last_name)){
    echo "<div class='Failed'>Please Enter Your Last Name .</div>";
}elseif(strlen($last_name) < 3 || strlen($last_name) > 30){
    echo "<div class='Failed'>Last Name must be more than 3 letters &amp; little than 30 letters .</div>";
}elseif(empty($email)){
    echo "<div class='Failed'>Please Enter Your Email .</div>";
}elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo "<div class='Failed'>Please Enter An Email .";
}elseif(empty($email_sure)){
    echo "<div class='Failed'>Please Re-Enter Your Email .</div>";
}elseif(!filter_var($email_sure,FILTER_VALIDATE_EMAIL)){
    echo "<div class='Failed'>Please Re-Enter An Email .";
}elseif($email != $email_sure){
    echo "<div class='Failed'>Email isn't match with the other .</div>";
}elseif(in_array($email,$emails)){
    echo "<div class='Failed'>You Registered With Your Email Once, If you forget the password Click <a href='/contact/' style='color: blue; text-decoration: none;'>Here</a></div>";
}elseif(empty($password)){
    echo "<div class='Failed'>Please Enter Your Password .</div>";
}elseif(strlen($password) < 6){
    echo "<div class='Failed'>Password must be more than 6 letters or numbers .</div>";
}elseif(empty($password_sure)){
    echo "<div class='Failed'>Please Re-Enter Your Password .</div>";
}elseif($password != $password_sure){
    echo "<div class='Failed'>Password isn't match with the other .</div>";
}elseif(empty($_POST['captcha'])){
    echo "<div class='Failed'>Please, Enter The Verification Code From The Picture .</div>";
}elseif(isset($_SESSION['captcha']) && $_SESSION['captcha'] != $_POST['captcha']){
    echo "<div class='Failed'>Verification Code Is Wrong .</div>";
}/*elseif(in_array($ip,$ips)){
    echo "<div class='Failed'>You can't register more than one email from The same ip .</div>";
}*/else{
    $password_encrypt   = md5(htmlentities($_POST['password']));
    $add = curl_add("users","(first_name,last_name,email,password,ip,permissions) VALUE ('$first_name','$last_name','$email','$password_encrypt','$ip','user')");
    if(isset($add)){
     echo "Done";   
    }
}

?>