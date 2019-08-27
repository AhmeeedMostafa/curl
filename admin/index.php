<?php

/**
 * @author Ahmed Mostafa
 * @copyright 2014
 */
 ob_start();
session_start();

if(!isset($_SESSION['adminid'])){
    header('Location: login.php');
}else{
    require_once '../incs/functions.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin CP - <?=$curl_name; ?></title>
    <meta http-equiv='content-type' content='text/html; charset=UTF-8' />
    <meta name='author' content='Ahmed Mostafa' />
    <meta name='keywords' content="<?=$curl_keywords; ?>" />
    <meta name='description' content="<?=$curl_description; ?>" />
    <link href='http://fonts.googleapis.com/css?family=Hanalei+Fill' rel='stylesheet' type='text/css'/>
    <link href='http://fonts.googleapis.com/css?family=Rancho&effect=shadow-multiple' rel='stylesheet' type='text/css'/>
    <link href='http://fonts.googleapis.com/css?family=Risque' rel='stylesheet' type='text/css'/>
    <link rel='stylesheet' type='text/css' href='styles/adminstyle.css' />
    <script type='text/javascript' src='../incs/jquery-1.10.2.min.js'></script>
    <script type='text/javascript' src='../incs/jquery.js'></script>
</head>
<body>
<table dir="ltr" algin="center" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td>
            <div id="header">Welcome To Admin Control Panel .</div>
        </td>
    </tr>
</table>

<table dir="ltr" align="center" width="100%" cellpadding="5" cellspacing="5">
    <tr>
        <td dir="ltr" class="rpanel" width="15%" valign="top">
            <div class="head">Public Settings</div>
            <div class="bodypanel">
            <a href="index.php">Main</a><br />
            <a href="../index.php" target="_blank">Site Preview</a><br />
            <a href="?page=main_settings">Main Settings</a><br />
            </div>
            <div class="head">Blocks</div>
            <div class="bodypanel">
                <a href="?page=add_new_block">Add New Block</a><br />
                <a href="?page=edit_blocks">Edit Blocks</a><br />
            </div>
            <div class="head">Users</div>
            <div class="bodypanel">
                <a href="?page=edit_users">Edit Users</a><br />
            </div>
            <div class="head">Links</div>
            <div class="bodypanel">
                <a href="?page=adsense_links">Adsense Links</a><br />
                <a href="?page=links">Links</a><br />
            </div>
            <div class="head">Base Settings</div>
            <div class="bodypanel">
                <a href="?page=optimize_tables">Optimize Tables</a><br />
                <a href="?page=repair_tables">Repair Tables</a><br />
            </div>
        </td>
        <td class="cpanel" width="85%" valign="top">
            <?php
                if(isset($_POST['save_notes'])){
                    $admin_notes = $db->real_escape_string($_POST['admin_notes']);
                    $save        = curl_update("main_settings","admin_notes='".$admin_notes."'");
                }
                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                    $url  = $page.".php"; 
                    if(file_exists($url)){
                        require_once $url;
                    }else{
                        echo "No Pages Found";
                    }
                }else{
                    $aid = $_SESSION['adminid'];
                    $get_admin = curl_get("*","users","WHERE uid='$aid' AND permissions='admin'");
                    $re        = $get_admin->fetch_object();
                    $get_notes = curl_get("admin_notes","main_settings");
                    $res_notes = $get_notes->fetch_object();
                    
                    echo "<div class='imp'>Welcome To Admin Control Panel ".$re->first_name." ".$re->last_name."</div>
                <br />
               <form action='index.php' method='post'>
                <table align='center' width='100%' cellpadding='2' cellspacing='2'>
                    <tr>
                        <td class='table'>Admin Public Notes</td>
                    </tr>
                    <tr>
                        <td align='center' class='table3'><textarea name='admin_notes' rows='6' cols='80' placeholder='Put Your Notes To Remember It, Admin Notes ...'>".stripslashes($res_notes->admin_notes)."</textarea></td>
                    </tr>
                    <tr>
                        <td align='center' class='table2'><input class='buttons' type='submit' value='Save Notes' name='save_notes' /></td>
                    </tr>
                </table>
               </form>
                <br />
                <table align='center' width='100%' cellpadding='0' cellspacing='0'>
                    <tr>
                        <td class='table' colspan='2'>Script Info</td>
                    </tr>
                    <tr>
                        <td width='50%' class='table2'>Script Name : CUT URL</td>
                        <td width='50%' class='table3'>Programmer : Ahmed Mostafa</td>
                    </tr>
                    <tr>
                        <td width='50%' class='table3'>Version : 1</td>
                        <td width='50%' class='table2'>PHP Version : 5</td>
                    </tr>
                </table>";
                }
            ?>
        </td>
    </tr>
</table>
<?php
    include_once '../incs/inc.footer.php';
}
ob_end_flush();
?>