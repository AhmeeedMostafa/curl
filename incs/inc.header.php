<?php
/**
 * @author Ahmed Mostafa
 * @copyright 2014
 */
require_once 'functions.php';
?>
<!DOCTYPE HTML>
<html>
<head>
<?php
curl_settings($page_title);
includes($style_path);
?>
<link rel="shortcut icon" href="/imgs/fav.gif" type="imgage/gif" />
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-40914253-2', 'curl.ws');
  ga('send', 'pageview');

</script>
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
                echo "<li><a href='/users/'>Your Profile</a></li><li><a href='/users/edit-profile.php'>Edit Profile</a></li>";
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