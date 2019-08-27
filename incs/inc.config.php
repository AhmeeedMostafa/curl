<?php

/**
 * @author Ahmed Mostafa
 * @copyright 2014
 */

$curl_server = 'localhost';
$curl_user   = '';
$curl_pass   = '';
$curl_dbname = '';

$db = new mysqli($curl_server,$curl_user,$curl_pass,$curl_dbname);

if($db->connect_error)
    die("Connect Error : ".$db->connect_error);

$get_site_settings = $db->query("SELECT * FROM `main_settings`");
$ssettings_result  = $get_site_settings->fetch_object();
$curl_name         = stripslashes($ssettings_result->sname);
$curl_keywords     = stripslashes($ssettings_result->skeywords);
$curl_description  = stripslashes($ssettings_result->sdesc);
$curl_mail         = stripslashes($ssettings_result->smail);

?>