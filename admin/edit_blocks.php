<?php

/**
 * @author Ahmed Mostafa
 * @copyright 2014
 */

$get_blocks = curl_get("*","blocks","ORDER BY `b_order` ASC");

################################EDIT######################################
if(isset($_GET['query']) && $_GET['query'] == 'edit'){
    $b_id = $_GET['id'];
    
    if(isset($_POST['edit_block'])){
        $eb_name = $db->real_escape_string($_POST['eb_name']);
        $eb_content = $db->real_escape_string($_POST['eb_content']);
        $eb_order   = $db->real_escape_string(intval($_POST['eb_order']));
        $eb_case    = intval($_POST['eb_case']);
        
        $edit = curl_update("blocks","b_name='".$eb_name."',b_content='".$eb_content."',b_order='".$eb_order."',b_case='".$eb_case."' WHERE id='".$b_id."'");
        if(isset($edit)){
            die("<div class='Done'>Block Has Been Edited Successfully, You Are Redirecting To Main .<meta http-equiv='refresh' content='2; url=index.php' />");
        }
    }
    $get_blocks_by_id = curl_get("*","blocks","WHERE id='$b_id'");
    $res_blocks_by_id = $get_blocks_by_id->fetch_object();
    
    echo "<form action='' method='post'>
    <table align='center' width='100%' cellpadding='0' cellspacing='0'>
        <tr>
            <td width='100%' align='center' class='table' colspan='2'>Edit Block</td>
        </tr>
        <tr>
            <td width='20%' class='table2'>Block Name</td>
            <td width='80%' class='table2'><input type='text' name='eb_name' value='".stripslashes($res_blocks_by_id->b_name)."' /></td>
        </tr>
        <tr>
            <td width='20%' class='table3'>Block Order</td>
            <td width='80%' class='table3'><input size='4' type='text' name='eb_order' value='".stripslashes($res_blocks_by_id->b_order)."' /></td>
        </tr>
        <tr>
            <td width='20%' class='table2'>Block Content</td>
            <td width='80%' class='table2'><textarea name='eb_content' rows='8' cols='40'>".stripslashes($res_blocks_by_id->b_content)."</textarea></td>
        </tr>
        <tr>
            <td width='20%' class='table3'>Block Case</td>
            <td width='80%' class='table3'>
                <select name='eb_case'>";
        if ($res_blocks_by_id->b_case == '1'){
            echo "
                <option value='1'>Active</option>
                <option value='0'>InActive</option>";
        }else{
            echo "
                <option value='0'>InActive</option>
                <option value='1'>Active</option>";
        }

                die ("</select>
            </td>
        </tr>
        <tr>
            <td width='100%' align='center' colspan='2'>
                <input type='submit' value='Edit Block' name='edit_block' />
            </td>
        </tr>
    </table>");
}

################################DELETE######################################
if(isset($_GET['query']) && $_GET['query'] == 'delete'){
    $b_id = $_GET['id'];
    
    $delete = curl_delete("blocks","id='".$b_id."'");
    if(isset($delete)){
        die ("<div class='Done'>Block Has Been Deleted Successfully, You Are Redirecting To Main .<meta http-equiv='refresh' content='2; url=index.php' /></div>");
    }
}


echo "<table cellpadding='2' cellspacing='2' border='1' width='100%' height='auto'>
        <tr>
            <th class='table2'>Block Name</th>
            <th class='table3'>Block Order</th>
            <th class='table2'>Block Content</th>
            <th class='table3'>Block Case</th>
            <th class='table2'>Operations</th>
        </tr>";
while($result = $get_blocks->fetch_object()){
    echo "<tr>
            <td class='table2'>".stripslashes($result->b_name)."</td>
            <td class='table3'>".stripslashes($result->b_order)."</td>
            <td class='table2'>".substr(stripslashes($result->b_content),0,50)."</td>";
            if($result->b_case == 1){
                echo "<td class='table3'>Active</td>";
            }else{
                echo "<td class='table3'>InActive</td>";
            }
            echo "<td class='table2' style='text-align: center'><a href='?page=edit_blocks&query=edit&id=".intval($result->id)."'><img src='../imgs/edit.ico' width='20' height='20' /></a>&nbsp;&nbsp;&nbsp;<a href='?page=edit_blocks&query=delete&id=".intval($result->id)."'><img src='../imgs/delete.png' width='20' height='20' /></a></td>
        </tr>";
}
    echo "</table>";
?>