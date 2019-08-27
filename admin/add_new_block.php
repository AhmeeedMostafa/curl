<?php

/**
 * @author Ahmed Mostafa
 * @copyright 2014
 */

if(isset($_POST['add_block'])){
    $b_name    = $db->real_escape_string($_POST['b_name']);
    $b_content = $db->real_escape_string($_POST['b_content']);
    $b_order   = $db->real_escape_string(intval($_POST['b_order']));
    $b_case    = intval($_POST['b_case']);
    
    $add_block = curl_add("blocks","(b_name,b_content,b_order,b_case) VALUE ('".$b_name."','".$b_content."','".$b_order."','".$b_case."')");
    if(isset($add_block)){
        die ("<div class='Done'>Block Has Been Added Successfully, You are Redirecting To Main .<meta http-equiv='refresh' content='2; url=index.php' /></div>");
    }
}

echo "<form action='' method='post'>
    <table align='center' width='100%' cellpadding='0' cellspacing='0'>
        <tr>
            <td width='100%' align='center' class='table' colspan='2'>Add New Block</td>
        </tr>
        <tr>
            <td width='20%' class='table2'>Block Name</td>
            <td width='80%' class='table2'><input type='text' name='b_name' /></td>
        </tr>
        <tr>
            <td width='20%' class='table3'>Block Order</td>
            <td width='80%' class='table3'><input type='text' name='b_order' /></td>
        </tr>
        <tr>
            <td width='20%' class='table2'>Block Content</td>
            <td width='80%' class='table2'><textarea name='b_content' rows='8' cols='40'></textarea></td>
        </tr>
        <tr>
            <td width='20%' class='table3'>Block Case</td>
            <td width='80%' class='table3'>
                <select name='b_case'>
                <option value='1'>Active</option>
                <option value='0'>InActive</option>
                </select>
            </td>
        </tr>
        <tr>
            <td width='100%' align='center' colspan='2'>
                <input type='submit' value='Add Block' name='add_block' />
            </td>
        </tr>
    </table>
</form>";

?>