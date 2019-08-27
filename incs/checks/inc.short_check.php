<?php

/**
 * @author Ahmed Mostafa
 * @copyright 2014
 */
 ob_start();
 session_start();
 require_once '../functions.php';
$link_name       = $db->real_escape_string(htmlentities($_POST['url_name']));
$url             = $db->real_escape_string(htmlentities($_POST['URL']));
$short_type      = $_POST['short_type'];
$date            = date("Y/M/d - H:i:s A");
$domain          = $_SERVER['HTTP_HOST'];
if(empty($url)){
    echo "empty_url";
}elseif(!filter_var($url,FILTER_VALIDATE_URL,FILTER_FLAG_HOST_REQUIRED)){
    echo "enter_url";
}else{
    if($short_type == 'nums'){
        $uid = $_SESSION['uid'];
        $nums = curl_short_url_nums();
        $add = curl_add("links","(uid,link_name,link_real,link_cut,date) VALUE('$uid','$link_name','$url','$nums','$date')");
        if(isset($add)){
            $get = curl_get("*","links","WHERE link_cut='$nums' AND date='$date'");
            $result = $get->fetch_object();
            echo $domain."/".$result->link_cut;
        }
    }elseif($short_type == 'chars'){
        $uid = $_SESSION['uid'];
        $chars = curl_short_url_chars();
        $add = curl_add("links","(uid,link_name,link_real,link_cut,date) VALUE('$uid','$link_name','$url','$chars','$date')");
        if(isset($add)){
            $get = curl_get("*","links","WHERE link_cut='$chars' AND date='$date'");
            $result = $get->fetch_object();
            echo $domain."/".$result->link_cut;
        }
    }elseif($short_type == 'nums&chars'){
        $uid = $_SESSION['uid'];
        $nums_chars = curl_short_url_nums_chars();
        $add = curl_add("links","(uid,link_name,link_real,link_cut,date) VALUE('$uid','$link_name','$url','$nums_chars','$date')");
        if(isset($add)){
            $get = curl_get("*","links","WHERE link_cut='$nums_chars' AND date='$date'");
            $result = $get->fetch_object();
            echo $domain."/".$result->link_cut;
        }
    }elseif($short_type == 'user_enter'){
        $uid = $_SESSION['uid'];
        $user_enter = $db->real_escape_string(strip_tags($_POST['user_enter']));
        if(empty($user_enter)){
            echo "empty_input";
        }elseif(strlen($user_enter) < 3){
            echo "little than 3";
        }else{
            $links_exists = curl_get("*","links","WHERE link_cut='$user_enter'");
            $alinks_exists = curl_get("*","adsense_links","WHERE link_cut='$user_enter'");
            $num_rows = $links_exists->num_rows;
            $anum_rows = $alinks_exists->num_rows;
            if($num_rows >= 1 || $anum_rows >= 1){
                echo "Link Exists";
            }elseif(!ctype_alnum($user_enter)){
                echo "not string";
            }else{
                $add = curl_add("links","(uid,link_name,link_real,link_cut,date) VALUE('$uid','$link_name','$url','$user_enter','$date')");
                if(isset($add)){
                    $get = curl_get("*","links","WHERE link_cut='$user_enter' AND date='$date'");
                    $result = $get->fetch_object();
                    echo $domain."/".$result->link_cut;
                }
            }
        }
    }
}

?>