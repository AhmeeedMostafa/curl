<?php

/**
 * @author Ahmed Mostafa
 * @copyright 2014
 */
 session_start();
$page_title = 'Cut & Short';
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
echo "<div style='color: blue; font-size: 35px; text-shadow: 0px 2px 2.5px lightblue;'>Short Easily , Fast & Links will not Delete</div>";
require_once 'incs/inc.short.php';

include_once 'incs/inc.footer.php';
?>