<?php

/**
 * @author Ahmed Mostafa
 * @copyright 2014
 */
 session_start();
$page_title = 'Adsense Cut & Short';
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
echo "<h1 style='font-family: Gabriola; font-style: Oblique; text-align: center; font-size: 38px; color: lightblue; text-shadow: 2px 2px 2px lightblue;'>Short Adsense Links & The First Page will contain Your ads , The Second Will Contain Our Ads .</h1>";
require_once 'incs/inc.ashort.php';

include_once 'incs/inc.footer.php';
?>