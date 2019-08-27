<?php

/**
 * @author Ahmed Mostafa
 * @copyright 2014
 */

?>

<form id="short_form" action="" method="POST">
    <table>
    <tr><td><input type="text" name="url_name" placeholder="URL Name (optional)" class="txt" /></td></tr>
    <tr><td><input type="url" name="URL" id="URL_short" placeholder="URL You Want Short it: http://www.ex.com" class="txt" size="40" /> <span style="display: none; font-size: 35px; color: red; font-weight: bold;" id="slash">/</span> <input type="text" name="user_enter" style="display: none;" id="user_enter" class="txt" size="11" placeholder="Short URL Code" />  <a href="#" style="color: red; font-size: 20px; text-decoration: none; display: none;" id="short_another">Short Another URL .</a></td></tr>
    <tr><td>Short With Numbers <input type="radio" name="short_type" onclick="user_enter_hide()" checked="checked" value="nums" />
    - Short With Characters <input type="radio" name="short_type" onclick="user_enter_hide()" value="chars" />
    - Short With Numbers &amp; Characters <input type="radio" name="short_type" onclick="user_enter_hide()" value="nums&chars" />
    - Short With Your Code <input type="radio" id="user_enter" name="short_type" onclick="user_enter_show()" value="user_enter" /></td></tr>
    <tr><td><input type="button" name="short" value="Short !" onclick="short_url()" class="btn" /></td></tr>
    <tr><td id="cmessage"></td></tr>
    </table>
</form>
