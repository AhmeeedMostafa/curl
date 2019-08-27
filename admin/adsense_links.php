<?php

/**
 * @author Ahmed Mostafa
 * @copyright 2014
 */

$get_adsense_links = curl_get("*","adsense_links","ORDER BY id DESC");

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
    $ereal_link     = $db->real_escape_string($_POST['ereal_link'];)
    $elink_cut      = $db->real_escape_string($_POST['elink_cut']);
    $eads_pub       = $db->real_escape_string($_POST['eads_pub']);
    $eads_channel   = $db->real_escape_string($_POST['eads_channel']);
    $efpage_content = $db->real_escape_string($_POST['efpage_content']);
    $espage_content = $db->real_escape_string($_POST['espage_content']);
    $epage_desc     = $db->real_escape_string($_POST['epage_desc']);
    $epage_keywords = $db->real_escape_string($_POST['epage_keywords']);
    
    $edit = curl_update("adsense_links","link_title='".$elink_title."',link_real='".$ereal_link."',link_cut='".$elink_cut."',ads_pub='".$eads_pub."',ads_channel='".$eads_channel."',fpage_content='".$efpage_content."',spage_content='".$espage_content."',page_desc='".$epage_desc."',page_keywords='".$epage_keywords."' WHERE id='".$id."'");
    if(isset($edit)){
        die ("<div class='Done'>Adsense Link Has Been Edited Successfully, You Are Redirecting To Main .<meta http-equiv='refresh' content='2; url=index.php' /></div>");
    }
}

if(isset($_GET['query']) && $_GET['query'] == 'edit'){
    $id = $_GET['id'];
    $get_alinks = curl_get("*","adsense_links","WHERE id='".$id."'");
    $res_alinks = $get_alinks->fetch_object();
    
    die("<form action='' method='post'>
    <table align='center' width='100%' cellpadding='0' cellspacing='0'>
        <tr>
            <td width='100%' align='center' class='table' colspan='2'>Edit Adsense Links</td>
        </tr>
        <tr>
            <td width='20%' class='table2'>Link Title</td>
            <td width='80%' class='table2'><input type='text' name='elink_title' size='52' value='".stripslashes($res_alinks->link_title)."' /></td>
        </tr>
        <tr>
            <td width='20%' class='table3'>Real URL</td>
            <td width='80%' class='table3'><input type='text' name='ereal_link' size='52' value='".stripslashes($res_alinks->link_real)."' /></td>
        </tr>
        <tr>
            <td width='20%' class='table2'>CUT URL</td>
            <td width='80%' class='table2'><input type='text' name='elink_cut' size='52' value='".stripslashes($res_alinks->link_cut)."' /></td>
        </tr>
        <tr>
            <td width='20%' class='table3'>Ads Pub</td>
            <td width='80%' class='table3'><input type='text' name='eads_pub' size='52' value='".stripslashes($res_alinks->ads_pub)."' /></td>
        </tr>
        <tr>
            <td width='20%' class='table2'>Ads Channel</td>
            <td width='80%' class='table2'><input type='text' name='eads_channel' size='52' value='".stripslashes($res_alinks->ads_channel)."' /></td>
        </tr>
        <tr>
            <td width='20%' class='table3'>Fpage Content</td>
            <td width='80%' class='table3'><textarea name='efpage_content' cols='40' rows='9'>".stripslashes($res_alinks->fpage_content)."</textarea></td>
        </tr>
        <tr>
            <td width='20%' class='table2'>Spage Content</td>
            <td width='80%' class='table2'><textarea name='espage_content' cols='40' rows='9'>".stripslashes($res_alinks->spage_content)."</textarea></td>
        </tr>
        <tr>
            <td width='20%' class='table3'>Page Description</td>
            <td width='80%' class='table3'><textarea name='epage_desc' cols='40' rows='3'>".stripslashes($res_alinks->page_desc)."</textarea></td>
        </tr>
        <tr>
            <td width='20%' class='table2'>Page KeyWords</td>
            <td width='80%' class='table2'><input type='text' name='epage_keywords' size='52' value='".stripslashes($res_alinks->page_keywords)."' /></td>
        </tr>
        <tr>
            <td width='20%' class='table3'>Date</td>
            <td width='80%' class='table3'>".stripslashes($res_alinks->date)."</td>
        </tr>
        <tr>
            <td width='20%' class='table2'>User ID</td>
            <td width='80%' class='table2'>".stripslashes($res_alinks->uid)."</td>
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
        <th class='table3'>Ads Pub</th>
        <th class='table2'>Ads Channel</th>
        <th class='table3'>Fpage Content</th>
        <th class='table2'>Spage Content</th>
        <th class='table3'>Page Description</th>
        <th class='table2'>Page KeyWords</th>
        <th class='table3'>Operations</th>
    </tr>";
        
while($res_adsense_links = $get_adsense_links->fetch_object()){
    echo "<tr>
            <td class='table2'>".substr(stripslashes($res_adsense_links->link_title),0,10)."</td>
            <td class='table3'>".substr(stripslashes($res_adsense_links->link_real),7,15)."</td>
            <td class='table2'>".stripslashes($res_adsense_links->link_cut)."</td>
            <td class='table3'>".stripslashes($res_adsense_links->ads_pub)."</td>
            <td class='table2'>".substr(stripslashes($res_adsense_links->ads_channel),0,10)."</td>
            <td class='table3'>".substr(stripslashes($res_adsense_links->fpage_content),0,10)."</td>
            <td class='table2'>".substr(stripslashes($res_adsense_links->spage_content),0,10)."</td>
            <td class='table3'>".substr(stripslashes($res_adsense_links->page_desc),0,10)."</td>
            <td class='table2'>".substr(stripslashes($res_adsense_links->page_keywords),0,10)."</td>
            <td class='table3' style='text-align: center;'><a href='?page=adsense_links&query=edit&id=".$res_adsense_links->id."'><img src='../imgs/edit.ico' width='20' height='20' /></a>&nbsp;&nbsp;&nbsp;<a href='?page=adsense_links&query=delete&id=".$res_adsense_links->id."'><img src='../imgs/delete.png' width='20' height='20' /></a></td>
    </tr>";
}
echo "</table>";

?>