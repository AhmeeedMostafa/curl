<?php

/**
 * @author Ahmed Mostafa
 * @copyright 2014
 */

$get_links = curl_get("*","links","ORDER BY id DESC");

################################################DELETE#######################################################
if(isset($_GET['query']) && $_GET['query'] == 'delete'){
    $id = $_GET['id'];
    $delete = curl_delete("adsense_links","id='".$id."'");
    if(isset($delete))
        die ("<div class='Done'>Link Has Been Deleted Successfully, You Are Redirecting To Main .<meta http-equiv='refresh' content='2; url=index.php' />");
}

################################################EDIT#######################################################
if(isset($_POST['edit_alink'])){
    $id = $_GET['id'];
    $elink_title    = $db->real_escape_string($_POST['elink_title']);
    $ereal_link     = $db->real_escape_string($_POST['ereal_link']);
    $elink_cut      = $db->real_escape_string($_POST['elink_cut']);
    
    $edit = curl_update("links","link_name='".$elink_title."',link_real='".$ereal_link."',link_cut='".$elink_cut."' WHERE id='".$id."'");
    if(isset($edit)){
        die ("<div class='Done'>Link Has Been Edited Successfully, You Are Redirecting To Main .<meta http-equiv='refresh' content='2; url=index.php' /></div>");
    }
}

if(isset($_GET['query']) && $_GET['query'] == 'edit'){
    $id = $_GET['id'];
    $get_links = curl_get("*","links","WHERE id='".$id."'");
    $res_links = $get_links->fetch_object();
    
    die("<form action='' method='post'>
    <table align='center' width='100%' cellpadding='0' cellspacing='0'>
        <tr>
            <td width='100%' align='center' class='table' colspan='2'>Edit Adsense Links</td>
        </tr>
        <tr>
            <td width='20%' class='table2'>Link Title</td>
            <td width='80%' class='table2'><input type='text' name='elink_title' size='52' value='".stripslashes($res_links->link_title)."' /></td>
        </tr>
        <tr>
            <td width='20%' class='table3'>Real URL</td>
            <td width='80%' class='table3'><input type='text' name='ereal_link' size='52' value='".stripslashes($res_links->link_real)."' /></td>
        </tr>
        <tr>
            <td width='20%' class='table2'>CUT URL</td>
            <td width='80%' class='table2'><input type='text' name='elink_cut' size='52' value='".stripslashes($res_links->link_cut)."' /></td>
        </tr>
        <tr>
            <td width='20%' class='table3'>Date</td>
            <td width='80%' class='table3'>".stripslashes($res_links->date)."</td>
        </tr>
        <tr>
            <td width='20%' class='table2'>User Id</td>
            <td width='80%' class='table2'>".stripslashes($res_links->uid)."</td>
        </tr>
        <tr>
            <td width='100%' align='center' colspan='2'>
                <input type='submit' name='edit_alink' value='Edit Link' />
            </td>
        </tr>");
}

echo "<table cellpadding='2' cellspacing='2' border='1' width='100%' height='auto'>
    <tr>
        <th class='table2'>Link Title</th>
        <th class='table3'>Link Real</th>
        <th class='table2'>Link Cut</th>
        <th class='table3'>Date</th>
        <th class='table2'>User ID</th>
    </tr>";
        
while($res_links = $get_links->fetch_object()){
    echo "<tr>
            <td class='table2'>".stripslashes($res_links->link_name )."</td>
            <td class='table3'>".substr(stripslashes($res_links->link_real),0,50)."</td>
            <td class='table2'>".stripslashes($res_links->link_cut)."</td>
            <td class='table3'>".stripslashes($res_links->date)."</td>
            <td class='table2'>".stripslashes($res_links->uid)."</td>
            <td class='table3' style='text-align: center;'><a href='?page=links&query=edit&id=".$res_links->id."'><img src='../imgs/edit.ico' width='20' height='20' /></a>&nbsp;&nbsp;&nbsp;<a href='?page=links&query=delete&id=".$res_links->id."'><img src='../imgs/delete.png' width='20' height='20' /></a></td>
    </tr>";
}
echo "</table>";


?>