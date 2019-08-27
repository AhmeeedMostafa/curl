<?php

/**
 * @author Ahmed Mostafa
 * @copyright 2014
 */
require_once 'inc.config.php';
ob_start();

function includes($path = null){
    echo "<link href='http://fonts.googleapis.com/css?family=Hanalei+Fill' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Rancho&effect=shadow-multiple' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Risque' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' type='text/css' href='".$path."styles/style.css' />
    <script type='text/javascript' src='".$path."incs/jquery-1.10.2.min.js'>
    </script><script type='text/javascript' src='".$path."incs/jquery.js'>
    </script>";
}
function curl_settings($title){
    global $curl_name,$curl_keywords,$curl_description;
    echo "<title>$title - $curl_name</title>
    <meta http-equiv='content-type' content='text/html; charset=UTF-8' />
    <meta name='author' content='Ahmed Mostafa' />
    <meta name='keywords' content=\"".$curl_keywords."\" />
    <meta name='description' content=\"".$curl_description."\" />";
}
function curl_add($table,$query_sequel){
    global $db,$curl_dbname;
    $add = $db->query("INSERT INTO `$curl_dbname`.`$table` $query_sequel");
    return $add;
}
function curl_get($fields,$table,$query_sequel = null){
    global $db,$curl_dbname;
    $get = $db->query("SELECT $fields FROM `$curl_dbname`.`$table` $query_sequel");
    return $get;
}
function curl_update($table,$query_sequel){
    global $db,$curl_dbname;
    $update = $db->query("UPDATE `$curl_dbname`.`$table` SET $query_sequel");
    return $update;
}
function curl_delete($table,$query_sequel){
    global $db,$curl_dbname;
    $delete = $db->query("DELETE FROM `$curl_dbname`.`$table` WHERE $query_sequel");
    return $delete;
}
function curl_short_url_nums(){
    $nums = rand(0000,9999);
    return $nums;
}
function curl_short_url_chars(){
    $letters = "QqWwEeRrTtYyUuIiOoPpAaSsDdFfGgHhJjKkLlZzXxCcVvBbNnMm";
    $chars   = substr(str_shuffle($letters),0,4);
    return $chars;
}
function curl_short_url_nums_chars(){
    $nums    = substr(rand(000000,999999),4,5);
    $letters = "QqWwEeRrTtYyUuIiOoPpAaSsDdFfGgHhJjKkLlZzXxCcVvBbNnMm";
    $chars   =  substr(str_shuffle($letters),0,2);
    $nums_chars = str_shuffle($nums.$chars);
    return $nums_chars;
}
function curl_db_close(){
    global $db;
    $db->close();
}
?>