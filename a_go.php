<!DOCTYPE HTML>
<html>
<head>
<?php
$style_path = '/';
require_once 'incs/functions.php';
if(isset($_GET['acut'])){
    $atcut          = $_GET['acut'];
    $get_title      = curl_get("*","adsense_links","WHERE link_cut='".$atcut."'");
    $num_rows       = $get_title->num_rows;
    $rget_title     = $get_title->fetch_object();
    $rpage_title    = stripslashes($rget_title->link_title);
    $rpage_keywords = stripslashes($rget_title->page_keywords);
    $rpage_desc     = stripslashes($rget_title->page_desc);
    if(empty($atcut)){
     $page_title = 'Wrong URL';
     curl_settings($page_title);   
    }elseif($num_rows == 0){
     $page_title = 'No URL Found';
     curl_settings($page_title);   
    }else{
        echo '<title>'.$rpage_title." - ".$curl_name.'</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta name="author" content="Ahmed Mostafa" />
        <meta name="keywords" content="'.$rpage_keywords.'" />
        <meta name="description" content="'.$rpage_desc.'" />';
    }
}else{
    $page_title = 'No URL Found';
    curl_settings($page_title);   
}
includes($style_path);
?>
<link rel="shortcut icon" href="/imgs/fav.gif" type="imgage/gif" />
</head>
<body>
<div id="header">
    <div id="logo"><a href="http://<?=$_SERVER['HTTP_HOST']; ?>" title="Curl"><img title="Curl" alt="CutUrl" src="/imgs/Curl_Logo.gif" /></a></div>
</div>
    <menu id="menu">
        <ul>
            <li><a href='/index.php'>Home</a></li>
            <li><a href='/cut.php'>Short URL</a></li>
            <li><a href='/acut.php'>Adsense Short</a></li>
            <?php
            if(!isset($_SESSION['uid'])){
                echo "<li><a href='/signup.php'>Sign Up</a></li><li><a href='/login.php'>Log In</a></li>";  
            }else{
                echo "<li><a href='/user/'>Your Profile</a></li><li><a href='/user/edit-profile.php'>Edit Profile</a></li>";
                $suid = $_SESSION['uid'];
                $get_users = curl_get("*","users","WHERE uid='".$suid."'");
                $result = $get_users->fetch_object();
                if($result->permissions == 'admin'){
                    echo "<li><a href='/admin/'>Admin</a></li>";
                }
                echo "<li><a href='/logout.php'>Log Out</a></li>";
            }
            ?>
        </ul>
    </menu>
<hr />
<?php

/**
 * @author Ahmed Mostafa
 * @copyright 2014
 */
 
if(isset($_GET['acut'])){
    $acut = $_GET['acut'];
    $get_ads = curl_get("*","adsense_links","WHERE link_cut='".$acut."'");
    $num_rows = $get_ads->num_rows;
    if(empty($acut))
        echo "<div class='Failed' style='margin-top: 20%'>Your URL is wrong, go back to our site <a href='index.php' title='Cut Url' style='text-decoration: none;'>Cut Url</a> .</div><br />";
    elseif($num_rows == 0)
        echo "<div class='Failed' style='margin-top: 20%'>No URL found, Please try again with the right URL go back to our site <a href='index.php' title='Cut Url' style='text-decoration: none;'>Cut Url</a> .</div><br />";
    else{
        if(isset($_GET['q']) && $_GET['q'] == 'next'){
            require_once 'incs/ads_gopage2.php';
            include_once 'incs/inc.footer.php';
            die();
        }
        require_once 'incs/ads_gopage.php';
    }
}else{
    echo "<div class='Failed' style='margin-top: 20%'>No URL found, Please try again with the right URL go back to our site <a href='index.php' title='Cut Url' style='text-decoration: none;'>Cut Url</a> .</div><br />";
}


include_once 'incs/inc.footer.php';
?>