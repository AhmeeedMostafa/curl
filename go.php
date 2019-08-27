<?php

/**
 * @author Ahmed Mostafa
 * @copyright 2014
 */
require_once 'incs/inc.header.php';
includes();
$page_title = 'Go';
if(!isset($_GET['cut'])){
    echo "<div class='Failed' style='margin-top: 20%'>You didn't select the URL, Please try again with the right URL Go back to our site <a href='index.php' title='Cur Url' style='text-decoration: none;'>Cut Url</a> .</div>";
}
if(isset($_GET['cut'])){
    $cut = $_GET['cut'];
    $get_url = curl_get("*","links","WHERE link_cut='$cut'");
    $num_rows = $get_url->num_rows;
    if(empty($cut))
        echo "<div class='Failed' style='margin-top: 20%'>Your URL is wrong, go back to our site <a href='index.php' title='Cut Url' style='text-decoration: none;'>Cut Url</a> .</div>";
    elseif($num_rows == 0)
        echo "<div class='Failed' style='margin-top: 20%'>No URL found, Please try again with the right URL go back to our site <a href='index.php' title='Cut Url' style='text-decoration: none;'>Cut Url</a> .</div>";
    else{
        $result = $get_url->fetch_object();
        header("Location: $result->link_real");
    }
}
echo "<div style='position: absolute; bottom: 0px;'>";
    include 'incs/inc.footer.php';
echo "</div>";
ob_end_flush();
curl_db_close();
?>
