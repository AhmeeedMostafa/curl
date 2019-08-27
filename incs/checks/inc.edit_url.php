<?php

/**
 * @author Ahmed Mostafa
 * @copyright 2014
 */
require_once '../functions.php';
$id     = $_POST['id'];
$eurl_name   = $db->real_escape_string($_POST['eurl_name']);
$ereal_url   = $db->real_escape_string($_POST['ereal_url']);
$ecut_url    = $db->real_escape_string($_POST['ecut_url']);

$get_url_2_edit = curl_get("*","links","WHERE id='".$id."'");
$result2 = $get_url_2_edit->fetch_object();

$links_exists = curl_get("*","links","WHERE link_cut='$ecut_url'");
$alinks_exists = curl_get("*","adsense_links","WHERE link_cut='$ecut_url'");
$num_rows = $links_exists->num_rows;
$anum_rows = $alinks_exists->num_rows;
$domain = $_SERVER['HTTP_HOST'];

if(!empty($eurl_name) && strlen($eurl_name) < 4){
    echo "url name is little";
}elseif(empty($ereal_url)){
    echo "empty real_url";
}elseif(!filter_var($ereal_url,FILTER_VALIDATE_URL,FILTER_FLAG_HOST_REQUIRED)){
    echo "not url";
}elseif(empty($ecut_url)){
    echo "empty cut_url";
}elseif(strlen($ecut_url) < 3){
    echo "little cut_urL";
}elseif($ecut_url != stripslashes($result2->link_cut) && ($num_rows >= 1 || $anum_rows >= 1)){
    echo "links is existing";
}else{
    $edit = curl_update("links","link_real='".$ereal_url."',link_cut='".$ecut_url."' WHERE id='".$id."'");
    if(isset($edit)){
    if(empty($eurl_name)){
        $get   = curl_get("link_real","links","WHERE id='".$id."'");
        $fetch = $get->fetch_object();
        $eurl_name = $fetch->link_real;
        curl_update("links","link_name='".$eurl_name."' WHERE id='".$id."'");
    }else{
    	curl_update("links","link_name='$eurl_name' WHERE id='".$id."'");
    }
        $get_url_2_show = curl_get("*","links","WHERE id='".$id."'");
        $result_show = $get_url_2_show->fetch_object();
            
                echo $link_real = "<input type='hidden' id='nlink' value='".stripslashes($result_show->link_name)."' />
                <input type='hidden' id='rlink' value='".stripslashes($result_show->link_real)."' />
                <input type='hidden' id='clink' value='".stripslashes($result_show->link_cut)."' />
                <input type='hidden' id='date' value='".stripslashes($result_show->date)."' />
                <input type='hidden' id='domain' value='".$domain."' />";
                echo "<b>URL Name : </b><h3><a href='http://www.$domain/".stripslashes($result_show->link_real)."' title='".stripslashes($result_show->link_name)."'>".stripslashes($result_show->link_name)."</a></h3><hr />";
                echo "<b>Real URL : </b><h4 style='color: red;'>".stripslashes($result_show->link_real)."</h4><br />";
                echo "<b>CUT URL : </b><h3><a href='http://www.$domain/".stripslashes($result_show->link_cut)."' style='color: green;'>$domain/".stripslashes($result_show->link_cut)."</a></h3><br />";
                echo "<b>Date &amp; Time : </b><h4 style='color: gray'>".$result_show->date."</h4><br />";
            echo "<br />";
    }
}
?>