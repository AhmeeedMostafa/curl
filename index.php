<?php

/**
 * @author Ahmed Mostafa
 * @copyright 2014
 */
 session_start();
 $page_title = 'Home';
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
echo "<h1 style='font-family: Gabriola; font-style: Oblique; text-align: center; font-size: 40px; color: lightblue; text-shadow: 2px 2px 2px lightblue;'>Short Adsense Links & The First Page will contain Your ads , The Second Will Contain Our Ads .</h1>";
echo "<table><tr>";
echo "<td><div style='color: blue; font-size: 35px; text-shadow: 0px 2px 2.5px lightblue;'>Short Easily , Fast & Links will not Delete</div>";
require_once 'incs/inc.short.php';
echo "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></td><td>";
echo "<form action=\"\" method=\"POST\" id=\"sform\">
        <table>
            <div class=\"fhide\" style='color: green; font-size: 35px; text-shadow: 0px 2px 2.5px lightgreen;'>Sign Up Now & Get More Features</div>
            <tr class=\"fhide\"><td><input type=\"text\" name='first_name' class=\"txt\" placeholder=\"First Name\" size=\"14\" /> <input type=\"text\" name=\"last_name\" class=\"txt\" placeholder=\"Last Name\" size=\"14\" /></td></tr>
            <tr class=\"fhide\"><td><input type=\"email\" name=\"email\" class=\"txt\" placeholder=\"Your Email\" size=\"34\" /></td></tr>
            <tr class=\"fhide\"><td><input type=\"email\" name=\"email_sure\" class=\"txt\" placeholder=\"Re-Enter Your Email\" size=\"34\" /></td></tr>
            <tr class=\"fhide\"><td><input type=\"password\" name=\"password\" class=\"txt\" placeholder=\"Password\" size=\"34\" /></td></tr>
            <tr class=\"fhide\"><td><input type=\"password\" name=\"password_sure\" class=\"txt\" placeholder=\"Re-Enter Password\" size=\"34\" /></td></tr>
            <tr class=\"fhide\"><td><img src='incs/captcha.php' /><input type=\"text\" name=\"captcha\" placeholder=\"Verification Code In Picture\" class=\"txt\" size=\"21\" /></td></tr>
            <tr class=\"fhide\"><td><input type=\"button\" onclick=\"sign_up()\" name=\"signup\" value=\"Sign Up\" class=\"btn\" /> <span style=\"color: red; font-size: 16px;\">All Fields Required</span></td></tr>
            <tr><td id=\"message\" width=\"500px\"></td></tr>
        </table>
    </form>";
echo "</td>";
echo "</tr></table>";

include_once 'incs/inc.footer.php';
?>