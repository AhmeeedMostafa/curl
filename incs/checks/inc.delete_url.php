<?php

/**
 * @author Ahmed Mostafa
 * @copyright 2014
 */

require_once '../functions.php';
$url_id = $_POST['id'];

$delete_url = curl_delete("links","id='".$url_id."'");
if(isset($delete_url)){
    echo "Deleted";
}else{
    echo "Wrong Link !!!";
}
?>