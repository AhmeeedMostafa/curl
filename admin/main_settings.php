<?php

/**
 * @author Ahmed Mostafa
 * @copyright 2014
 */

$get_settings = curl_get("*","main_settings");
$sresult      = $get_settings->fetch_object();


if(isset($_POST['save_settings'])){
    $sname     = $db->real_escape_string($_POST['sname']);
    $sdesc     = $db->real_escape_string($_POST['sdesc']);
    $smail     = $_POST['smail'];
    $skeywords = $db->real_escape_string($_POST['skeywords']);
    $scase     = $_POST['scase'];
    $closemsg  = $db->real_escape_string($_POST['closemsg']);
    
    $update = curl_update("main_settings","sname='".$sname."',sdesc='".$sdesc."',smail='".$smail."',skeywords='".$skeywords."',scase='".$scase."',closemsg='".$closemsg."'");
    if(isset($update))
        die('<center class=\'Done\'>Save Has Been Done Successfully, You are redirecting to Main .<meta http-equiv=\'refresh\' content=\'2; url=index.php\' /></center>');
}

$be_sname     = stripslashes($sresult->sname);
$be_sdesc     = stripslashes($sresult->sdesc);
$be_smail     = stripslashes($sresult->smail);
$be_skeywords = stripslashes($sresult->skeywords);
$be_closemsg  = stripslashes($sresult->closemsg);

echo "
<form action='' method='post'>
    <table align='center' width='100%' cellpadding='0' cellspacing='0'>
        <tr>
            <td class='table' colspan='2'>Main Settings</td>
        </tr>
        <tr>
            <td class='table2'>Site Name</td>
            <td class='table2'><input type='text' size='30' name='sname' value='".$be_sname."' /></td>
        </tr>
        <tr>
            <td class='table3'>Site Description</td>
            <td class='table3'><textarea name='sdesc' rows='5' cols='40'>".$be_sdesc."</textarea></td>
        </tr>
        <tr>
            <td class='table2'>Site Mail</td>
            <td class='table2'><input type='mail' size='30' name='smail' value='".$be_smail."' /></td>
        </tr>
        <tr>
            <td class='table3'>Site KeyWords</td>
            <td class='table3'><textarea name='skeywords' rows='5' cols='40'>".$be_skeywords."</textarea></td>
        </tr>
        <tr>
            <td class='table2'>Site Cas</td>
            <td class='table2'>
                <select name='scase'>";
if($sresult->scase == 1){
    echo
   "<option value='1'>Open</option>
    <option value='0'>Close</option>";
}else{
    echo
    "<option value='0'>Close</option>
    <option value='1'>Open</option>";
}

echo "
                </select>
            </td>
        </tr>
        <tr>
            <td class='table3'>Close Message</td>
            <td class='table3'><textarea name='closemsg' rows='5' cols='40'>".$be_closemsg."</textarea></td>
        </tr><br />
    </table>
    <input type='submit' name='save_settings' value='Save Settings' />
</form>";
?>