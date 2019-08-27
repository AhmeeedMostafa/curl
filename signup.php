<?php
/**
 * @author Ahmed Mostafa
 * @copyright 2014
 */
 session_start();
$page_title = 'Sign Up';
require_once 'incs/inc.header.php';

 $curl_closemsg = stripslashes($ssettings_result->closemsg);
 $puid = $_SESSION['uid'];
 $get_user_permissions = curl_get("*","users","WHERE uid='".$puid."'");
 $presult = $get_user_permissions->fetch_object();
 $upermissions = $presult->permissions;
if($ssettings_result->scase == 0 && (!isset($_SESSION['uid']) || $upermissions != 'admin')){
    $page_title = "Site IS Close";
    include 'incs/inc.footer.php';
    die("<div style='margin-top: 20%;'>".$curl_closemsg."</div>");
}

?>
    <form action="" method="POST" id="sform" class="signup_form">
    <h1 class='heading'>Sign Up Now To Get More Features For Free</h1><br /><br />
        <table>
            <tr class="fhide"><td><input type="text" name="first_name" class="txt" placeholder="First Name" /> <input type="text" name="last_name" class="txt" placeholder="Last Name" /></td></tr>
            <tr class="fhide"><td><input type="email" name="email" class="txt" placeholder="Your Email" size="47" /></td></tr>
            <tr class="fhide"><td><input type="email" name="email_sure" class="txt" placeholder="Re-Enter Your Email" size="47" /></td></tr>
            <tr class="fhide"><td><input type="password" name="password" class="txt" placeholder="Password" size="47" /></td></tr>
            <tr class="fhide"><td><input type="password" name="password_sure" class="txt" placeholder="Re-Enter Password" size="47" /></td></tr>
            <tr class="fhide"><td><img src='incs/captcha.php' /> <input type="text" name="captcha" placeholder="Verification Code In Picture" class="txt" size="32" /></td></tr>
            <tr class="fhide"><td><input type="button" onclick="sign_up()" name="signup" value="Sign Up" class="btn" /> <span style="color: red; font-size: 16px;">All Fields Required</span></td></tr>
            <tr><td id="message"></td></tr>
        </table>
    </form>
<?php require_once 'incs/inc.footer.php'; curl_db_close(); ?>