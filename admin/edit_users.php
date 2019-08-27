<?php

/**
 * @author Ahmed Mostafa
 * @copyright 2014
 */

$get_user = curl_get("*","users","WHERE uid != 1 ORDER BY uid DESC");

##############################################DELETE##########################################
if(isset($_GET['query']) && $_GET['query'] == 'delete'){
    $uid = $_GET['id'];
    $delete = curl_delete("users","uid='".$uid."' AND uid !=1");
    
    if(isset($delete))
        die ("<div class='Done'>User Has Been Deleted Successfully, You Are Redirecting To main .<meta http-equiv='refresh' content='2; url=index.php' /></div>");
}

################################################EDIT##########################################
if(isset($_GET['query']) && $_GET['query'] == 'edit'){
    $uid = $_GET['id'];
    $get_user_by_id = curl_get("*","users","WHERE uid='".$uid."' AND uid !=1");
    $result_u_by_id = $get_user_by_id->fetch_object();
    $efirst_name    = $db->real_escape_string($_POST['efirst_name']);
    $elast_name     = $db->real_escape_string($_POST['elast_name']);
    $emai           = $db->real_escape_string($_POST['email']);
    $epassword      = $db->real_escape_string($_POST['epassword']);
    $epermissions   = $db->real_escape_string($_POST['epermissions']);
    
    if(isset($_POST['edit_user'])){
        $edit = curl_update("users","first_name='".$efirst_name."',last_name='".$elast_name."',email='".$email."',password='".md5($epassword)."',permissions='".$epermissions."' WHERE uid='".$uid."'  AND uid !=1");
        
        if(isset($edit))
            die ("<div class='Done'>User Has Been Edited Successfully, You Are Redirecting To Main .<meta http-equiv='refresh' content='2; url=index.php' />");
    }
    
    echo "<form action='' method='post'>
    <table align='center' width='100%' cellpadding='0' cellspacing='0'>
        <tr>
            <td width='100%' align='center' class='table' colspan='2'>Edit User</td>
        </tr>
        <tr>
            <td width='20%' class='table2'>First Name</td>
            <td width='80%' class='table2'><input type='text' name='efirst_name' value='".stripslashes($result_u_by_id->first_name)."' /></td>
        </tr>
        <tr>
            <td width='20%' class='table3'>Last Name</td>
            <td width='80%' class='table3'><input type='text' name='elast_name' value='".stripslashes($result_u_by_id->last_name)."' /></td>
        </tr>
        <tr>
            <td width='20%' class='table2'>User E-Mail</td>
            <td width='80%' class='table2'><input type='mail' name='email' value='".stripslashes($result_u_by_id->email)."' /></td>
        </tr>
        <tr>
            <td width='20%' class='table3'>User Password</td>
            <td width='80%' class='table3'><input type='password' name='epassword' value='' /></td>
        </tr>
        <tr>
            <td width='20%' class='table2'>User Permissions</td>
            <td width='80%' class='table2'><select name='epermissions'>";
                if($result_u_by_id->permissions == 'user'){
                    echo "<option value='user'>User</option><option value='banned'>Banned</option><option value='admin'>Admin</option>";
                }elseif($result_u_by_id->permissions == 'banned'){
                    echo "<option value='banned'>Banned</option><option value='user'>User</option><option value='admin'>Admin</option>";
                }else{
                    echo "<option value='admin'>Admin</option><option value='user'>User</option><option value='banned'>Banned</option>";
                }
            die ("</select></td>
        </tr>
        <tr>
            <td width='100%' align='center' colspan='2'>
                <input type='submit' name='edit_user' value='Edit User' />
            </td>
        </tr>
    </table></form>");
}


    echo "<table cellpadding='2' cellspacing='2' border='1' width='100%' height='auto'>
        <tr>
            <th class='table2'>First Name</th>
            <th class='table3'>Last Name</th>
            <th class='table2'>User E-Mail</th>
            <th class='table3'>User Password</th>
            <th class='table2'>User Permissions</th>
            <th class='table3'>Operations</th>
        </tr>";
while($result = $get_user->fetch_object()){
    echo "<tr>
            <td class='table2'>".stripslashes($result->first_name)."</td>
            <td class='table3'>".stripslashes($result->last_name)."</td>
            <td class='table2'>".stripslashes($result->email)."</td>
            <td class='table3'>".str_replace(stripslashes($result->password),0,'*********')."</td>
            <td class='table2'>".stripslashes($result->permissions)."</td>
            <td class='table3' style='text-align: center;'><a href='?page=edit_users&query=edit&id=".$result->uid."'><img src='../imgs/edit.ico' width='20' height='20' /></a>&nbsp;&nbsp;&nbsp;<a href='?page=edit_users&query=delete&id=".$result->uid."'><img src='../imgs/delete.png' width='20' height='20' /></a></td>
    </tr>";
}
echo "</table>";

?>