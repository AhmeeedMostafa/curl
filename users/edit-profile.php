<?php

/**
 * @author Ahmed Mostafa
 * @copyright 2014
 */
 ob_start();
session_start();

if(isset($_SESSION['uid'])){
    $page_title = 'Edit Profile';
    $style_path = '../';
    require_once '../incs/inc.header.php';
    $uid = $_SESSION['uid'];
    
    $get_user = curl_get("*","users","WHERE uid='".$uid."'");
    $result = $get_user->fetch_object();
    
    echo "<center><form action='' method='POST'>
        <h1 style='color: blue; text-shadow: 2px 2px 2px lightblue;'>Edit Your Profile .</h1>
        <input type='text' name='efirst_name' class='txt' placeholder='First Name' value='".$result->first_name."' size='15' />&nbsp;<input type='text' name='elast_name' class='txt' value='".$result->last_name."' placeholder='Last Name'  size='15' /><br />
        <input type='email' name='eemail' class='txt' placeholder='Your E-Mail' value='".$result->email."' size='36' /><br />
        <input type='password' name='opassword' class='txt' placeholder='Old Password' size='36' /><br />
        <input type='password' name='npassword' class='txt' placeholder='New Password' size='36' /><br />
        <input type='password' name='npassword_repeat' class='txt' placeholder='Re-Enter Your New Password' size='36' /><br />
        <input type='submit' name='edit_profile' value='Edit' class='btn' />
    </form></center>";
    
    if(isset($_POST['edit_profile'])){
        $efirst_name      = $db->real_escape_string(htmlentities($_POST['efirst_name']));
        $elast_name       = $db->real_escape_string(htmlentities($_POST['elast_name']));
        $eemail           = $db->real_escape_string(htmlentities($_POST['eemail']));
        $opassword        = htmlentities($_POST['opassword']);
        $npassword        = htmlentities($_POST['npassword']);
        $npassword_repeat = htmlentities($_POST['npassword_repeat']);

        $get_email = curl_get("*","users","WHERE email='".$eemail."' AND uid!='".$uid."'");
        $num_rows_email = $get_email->num_rows;
        $get_password = curl_get("*","users","WHERE password='".md5($opassword)."' AND uid='".$uid."'");
        $num_rows_password = $get_password->num_rows;
        
        if(empty($efirst_name)){
            echo "<div class='Failed'>Enter The First Name .</div>";
        }elseif(strlen($efirst_name) < 3){
            echo "<div class='Failed'>First Name Must Be More Than Three Letters .</div>";
        }elseif(empty($elast_name)){
            echo "<div class='Failed'>Enter The Last Name .</div>";
        }elseif(strlen($elast_name) < 3){
            echo "<div class='Failed'>Last Name Musb Be More Than Three Letters .</div>";
        }elseif(empty($eemail)){
            echo "<div class='Failed'>Enter Your E-Mail .</div>";
        }elseif($$num_rows_email >= 1){
            echo "<div class='Failed'>This E-Mail Used By Another User .</div>";
        }else{
            if(!empty($opassword) && !empty($npassword)){
                if(!empty($opassword) && $num_rows_password == 0){
                    echo "<div class='Failed'>The Old Password Is Wrong .</div>";   
                }elseif(!empty($opassword) && $num_rows_password != 0 && !empty($npassword) && strlen($npassword) < 6){
                    echo "<div class='Failed'>New Password Must Be More Than Six Letters .</div>";
                }elseif(!empty($opassword) && $num_rows_password != 0 && !empty($npassword) && $npassword != $npassword_repeat){
                    echo "<div class='Failed'>The New Password Re-Enter Isn't Like The New Password .</div>";
                }else{
                    $edit = curl_update("users","first_name='".$efirst_name."',last_name='".$elast_name."',email='".$eemail."',password='".md5($npassword)."' WHERE uid='".$uid."'");
                    if(isset($edit))
                        echo "<div class='Done'>You Have Been Edited Your Profile Successfully .<meta http-equiv='refresh' content='2; url=index.php' /></div>";
                }
            }else{
                $edit_profile = curl_update("users","first_name='".$efirst_name."',last_name='".$elast_name."',email='".$eemail."' WHERE uid='".$uid."'");
                if(isset($edit_profile))
                    echo "<div class='Done'>You Have Been Edited Your Profile With Out Password Successfully .<meta http-equiv='refresh' content='2; url=index.php' /></div>";
            }
        }
    }
    
    include_once '../incs/inc.footer.php';
}else{
    header("Location: ../login.php");
}
?>