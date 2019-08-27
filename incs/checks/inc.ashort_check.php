<?php

/**
 * @author Ahmed Mostafa
 * @copyright 2014
 */
 ob_start();
 session_start();
 require_once '../functions.php';
$link_name       = trim($db->real_escape_string(htmlentities($_POST['aurl_title'])));
$url             = trim($db->real_escape_string(htmlentities($_POST['aURL'])));
$user_enter      = trim($db->real_escape_string(strip_tags($_POST['auser_enter'])));
$ads_pub         = trim($db->real_escape_string(strip_tags($_POST['ads_pub'])));
$uads_pub        = "ca-".$ads_pub;
$ads_channel     = trim($db->real_escape_string(htmlentities($_POST['ads_channel'])));
$fpage_content   = trim($db->real_escape_string(strip_tags($_POST['fpage_content'])));
$spage_content   = trim($db->real_escape_string(strip_tags($_POST['spage_content'])));
$page_desc       = trim($db->real_escape_string(strip_tags($_POST['page_desc'])));
$page_keywords   = trim($db->real_escape_string(strip_tags($_POST['page_keywords'])));
$short_type      = $_POST['ashort_type'];
$date            = date("Y/M/d - H:i:s A");
$domain          = $_SERVER['HTTP_HOST'];
if(empty($link_name)){
    echo "empty_title";
}elseif(strlen($link_name) < 4 || strlen($link_name) > 100){
    echo "title is small";
}elseif(empty($url)){
    echo "empty_url";
}elseif(!filter_var($url,FILTER_VALIDATE_URL,FILTER_FLAG_HOST_REQUIRED)){
    echo "enter_url";
}elseif($short_type == 'user_enter' && empty($user_enter)){
    echo "empty_input";
}elseif($short_type == 'user_enter' && !empty($user_enter) && strlen($user_enter) < 3){
    echo "little than 3";
}elseif(empty($ads_pub)){
    echo "empty ads_pub";
}elseif(strlen($ads_pub) < 14 || strlen($ads_pub) > 70){
    echo "ads_pub is little or more";
}elseif(empty($fpage_content)){
    echo "empty fpage_content";
}elseif(strlen($fpage_content) < 2500 || strlen($fpage_content) > 8000){
    echo "fpage is little or more";
}elseif(empty($spage_content)){
    echo "empty spage_content";
}elseif(strlen($spage_content) < 2500 || strlen($spage_content) > 8000){
    echo "spage is little or more";
}elseif($fpage_content == $spage_content){
    echo "fpage and spage equals";
}elseif(empty($page_desc)){
    echo "empty page_desc";
}elseif(strlen($page_desc) < 100 || strlen($page_desc) > 400){
    echo "page_desc is little";
}elseif(empty($page_keywords)){
    echo "empty page_keywords";
}elseif(strlen($page_keywords) < 10 || strlen($page_keywords) > 200){
    echo "page_keywords is little or more";
}else{
    if($short_type == 'nums'){
        $uid = $_SESSION['uid'];
        $nums = curl_short_url_nums();
        $add = curl_add("adsense_links","(uid,link_title,link_real,link_cut,date,ads_pub,ads_channel,fpage_content,spage_content,page_desc,page_keywords) VALUE('$uid','$link_name','$url','$nums','$date','$uads_pub','$ads_channel','$fpage_content','$spage_content','$page_desc','$page_keywords')");
        if(isset($add)){
            $get = curl_get("*","adsense_links","WHERE link_cut='$nums' AND date='$date'");
            $result = $get->fetch_object();
            echo $domain."/a/".$result->link_cut;
        }
    }elseif($short_type == 'chars'){
        $uid = $_SESSION['uid'];
        $chars = curl_short_url_chars();
        $add = curl_add("adsense_links","(uid,link_title,link_real,link_cut,date,ads_pub,ads_channel,fpage_content,spage_content,page_desc,page_keywords) VALUE('$uid','$link_name','$url','$chars','$date','$uads_pub','$ads_channel','$fpage_content','$spage_content','$page_desc','$page_keywords')");
        if(isset($add)){
            $get = curl_get("*","adsense_links","WHERE link_cut='$chars' AND date='$date'");
            $result = $get->fetch_object();
            echo $domain."/a/".$result->link_cut;
        }
    }elseif($short_type == 'nums&chars'){
        $uid = $_SESSION['uid'];
        $nums_chars = curl_short_url_nums_chars();
        $add = curl_add("adsense_links","(uid,link_title,link_real,link_cut,date,ads_pub,ads_channel,fpage_content,spage_content,page_desc,page_keywords) VALUE('$uid','$link_name','$url','$nums_chars','$date','$uads_pub','$ads_channel','$fpage_content','$spage_content','$page_desc','$page_keywords')");
        if(isset($add)){
            $get = curl_get("*","adsense_links","WHERE link_cut='$nums_chars' AND date='$date'");
            $result = $get->fetch_object();
            echo $domain."/a/".$result->link_cut;
        }
    }elseif($short_type == 'user_enter'){
        $uid = $_SESSION['uid'];
        $alinks_exists = curl_get("*","adsense_links","WHERE link_cut='$user_enter'");
        $links_exists = curl_get("*","links","WHERE link_cut='$user_enter'");
        $anum_rows = $alinks_exists->num_rows;
        $num_rows = $links_exists->num_rows;
        if($anum_rows >= 1 || $num_rows >= 1){
            echo "Link Exists";
        }elseif(!ctype_alnum($user_enter)){
            echo "not string";
        }else{
            $add = curl_add("adsense_links","(uid,link_title,link_real,link_cut,date,ads_pub,ads_channel,fpage_content,spage_content,page_desc,page_keywords) VALUE('$uid','$link_name','$url','$user_enter','$date','$uads_pub','$ads_channel','$fpage_content','$spage_content','$page_desc','$page_keywords')");
            if(isset($add)){
                $get = curl_get("*","adsense_links","WHERE link_cut='$user_enter' AND date='$date'");
                $result = $get->fetch_object();
                echo $domain."/a/".$result->link_cut;
            }
        }
    }
}
ob_end_flush();
?>