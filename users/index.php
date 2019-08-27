<?php

/**
 * @author Ahmed Mostafa
 * @copyright 2014
 */
 session_start();
 
 if(isset($_SESSION['uid'])){
    $page_title = 'Users';
    $style_path = '../';
    require_once '../incs/inc.header.php';

 $curl_closemsg = stripslashes($ssettings_result->closemsg);
 $puid = $_SESSION['uid'];
 $get_user_permissions = curl_get("*","users","WHERE uid='".$puid."'");
 $presult = $get_user_permissions->fetch_object();
 $upermissions = $presult->permissions;
    if($ssettings_result->scase == 0 && (!isset($_SESSION['uid']) || $upermissions != 'admin')){
        $page_title = "Site IS Close";
        include '../incs/inc.footer.php';
        die("<div style='margin-top: 20%;'>".$curl_closemsg."</div>");
    }
    
    $uid = $_SESSION['uid'];
    $get = curl_get("*","links","WHERE uid='".$uid."' ORDER BY id DESC");
    $num_rows = $get->num_rows;
    if($num_rows == 0){
        echo "<h1 class='heading'>You Didn't Cut Any Link until now .</h1>";
        $get_blocks = curl_get("*","blocks","WHERE b_case=1 ORDER BY `b_order` ASC");
        $blocks_num_rows = $get_blocks->num_rows;
        if($blocks_num_rows >= 1){
            echo "<div class='blocks'>";
            while($blocks_result = $get_blocks->fetch_object()){
                $rb_name = stripslashes($blocks_result->b_name);
                $rb_content = stripslashes($blocks_result->b_content);
                echo "<div class='block_box'>";
                echo "<div class='block_name'>".$rb_name."</div>";
                echo "<div style='padding: 5px;'>".$rb_content."</div>";
                echo "</div>";   
            }
            echo "</div>";
        }
    }else{
        $domain = $_SERVER['HTTP_HOST'];
        echo "<div style='width: 70%; float: left;'>";
        while($result = $get->fetch_object()){
            $rlink_name = stripslashes($result->link_name);
            $rlink_real = stripslashes($result->link_real);
            $rlink_cut  = stripslashes($result->link_cut);
            echo "<div class='links_show'>";
            echo $link_real = "<input type='hidden' id='nlink' value='".$rlink_name."' />
                <input type='hidden' id='rlink' value='".$rlink_real."' />
                <input type='hidden' id='clink' value='".$rlink_cut."' />
                <input type='hidden' id='date' value='".$result->date."' />
                <input type='hidden' id='domain' value='".$domain."' />";
                echo "<b>URL Name : </b><h3><a href='http://www.$domain/$rlink_cut' title='".$rlink_name."'>".$rlink_name."</a></h3>  <a href='".$result->id."' class='edit_urls'><img src='../imgs/edit.ico' width='20' height='20' /></a> <a href='".$result->id."' class='delete_urls'><img src='../imgs/delete.png' width='20' height='20' /></a><hr />";
                echo "<b>Real URL : </b><h4 style='color: red;'>".$rlink_real."</h4><br />";
                echo "<b>CUT URL : </b><h3><a href='http://www.$domain/$rlink_cut' style='color: green;'>$domain/$rlink_cut</a></h3><br />";
                echo "<b>Date &amp; Time : </b><h4 style='color: gray'>".$result->date."</h4><br />";
            echo "</div><br />";
        }
        echo "</div>";
        $get_blocks = curl_get("*","blocks","WHERE b_case=1 ORDER BY `b_order` ASC");
        $blocks_num_rows = $get_blocks->num_rows;
        if($blocks_num_rows >= 1){
            echo "<div class='blocks'>";
            while($blocks_result = $get_blocks->fetch_object()){
                $rb_name = stripslashes($blocks_result->b_name);
                $rb_content = stripslashes($blocks_result->b_content);
                echo "<div class='block_box'>";
                echo "<div class='block_name'>".$rb_name."</div>";
                echo "<div style='padding: 5px;'>".$rb_content."</div>";
                echo "</div>";   
            }
            echo "</div>";
        }
    }
    include '../incs/inc.footer.php';
 }else{
    header("Location: ../login.php");
 }
 ?>