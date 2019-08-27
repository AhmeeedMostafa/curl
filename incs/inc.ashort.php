<?php

/**
 * @author Ahmed Mostafa
 * @copyright 2014
 */

?>

<form id="ashort_form" action="" method="POST">
    <table>
    <tr><td id="acmessage"></td></tr>
    <tr><td><input type="url" name="aURL" id="aURL_short" placeholder="URL You Want Short it: http://www.ex.com" class="txt" size="38" /> <span style="display: none; font-size: 35px; color: red; font-weight: bold;" id="slash">/</span> <input type="text" name="auser_enter" style="display: none;" id="user_enter" class="txt" size="11" placeholder="Short URL Code" />  <a href="#" style="color: red; font-size: 20px; text-decoration: none; display: none;" id="ashort_another">Short Another URL .</a></td>
    <td><input type="text" name="aurl_title" placeholder="URL Title" class="txt" size="38" /></td></tr>
    <tr><td><input type="text" name="ads_pub" placeholder="Your Adsense Pub : pub-12345678912345" class="txt" size="38" /></td>
    <td><input type="text" name="ads_channel" placeholder="Your Adsense Channel ( Optional )" size="38" class="txt" /></td></tr>
    <tr><td><textarea name="fpage_content" id="fpage_content" placeholder="First Page Content OR First Page Topic" cols="35" rows="9" class="txt"></textarea> <span style="color: red; font-weight: bold;" class="fpage_content"></span></td>
    <td><textarea name="spage_content" id="spage_content" placeholder="Second Page Content OR Second Page Topic" cols="35" rows="9" class="txt"></textarea> <span style="color: red; font-weight: bold;" class="spage_content"></span></td></tr>
    <tr><td><textarea name="page_desc" id="page_desc" placeholder="Page description" class="txt" cols="35" rows="3"></textarea> <span style="color: red; font-weight: bold;" class="page_desc"></span></td>
    <td><input name="page_keywords" id="page_keywords" placeholder="Page KeyWords : cuturl,shorturl,adsense cut" size="38" class="txt" /> <span style="color: red; font-weight: bold;" class="page_keywords"></span></td></tr>
    <tr><td>Short With Numbers <input type="radio" name="ashort_type" onclick="user_enter_hide()" checked="checked" value="nums" />
     Short With Characters <input type="radio" name="ashort_type" onclick="user_enter_hide()" value="chars" />
     Short With Numbers &amp; Characters <input type="radio" name="ashort_type" onclick="user_enter_hide()" value="nums&chars" />
     Short With Your Code <input type="radio" id="user_enter" name="ashort_type" onclick="user_enter_show()" value="user_enter" /></td></tr>
    <tr><td><input type="button" name="short" value="Short !" onclick="ashort_url()" class="btn" /></td></tr>
    </table>
</form>
