<?php
$accut = $_GET['acut'];
$ads_information = curl_get("*","adsense_links","WHERE link_cut='$accut'");
$res = $ads_information->fetch_object();
$rfpage_content = stripslashes($res->fpage_content);
?>

<table width='100%' height='100%' style="font-size: 20px; color: #676767;">
    <tr>
        <td class='left_ads' width='20%'>
            <script type="text/javascript">
            google_ad_client = "<?php echo $res->ads_pub; ?>";
            google_ad_width = 160;
            google_ad_height = 600;
            google_ad_format = "160x600_as";
            google_ad_type = "text_image";
            google_ad_channel = "<?php echo $res->ads_channel; ?>";
            google_color_border = "FEF9D1";
            google_color_bg = "FEF9D1";
            google_color_link = "0000cd";
            google_color_text = "CC0000";
            google_color_url = "679701";
            </script>
            <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
        </td>
        <td class='center_content' width='60%' style="border-right: 1px solid black; border-left: 1px solid black;">
            <script type="text/javascript">
            google_ad_client = "<?php echo $res->ads_pub; ?>";
            google_ad_width = 728;
            google_ad_height = 90;
            google_ad_format = "728x90_as";
            google_ad_type = "text_image";
            google_ad_channel = "<?php echo $res->ads_channel; ?>";
            google_color_border = "FEF9D1";
            google_color_bg = "FEF9D1";
            google_color_link = "0000cd";
            google_color_text = "CC0000";
            google_color_url = "679701";
            </script>
            <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script><br />
            <?php
                echo substr($rfpage_content,0,1500);
                echo "<br />";
            ?>
            <script type="text/javascript"><!--
            google_ad_client = "<?php echo $res->ads_pub; ?>";
            google_ad_width = 728;
            google_ad_height = 15;
            google_ad_format = "728x15_0ads_al_s";
            google_ad_channel ="<?php echo $res->ads_channel; ?>";
            google_color_border = "FFFFFF";
            google_color_bg = "FFFFFF";
            google_color_link = "FFFFFF";
            //--></script>
            <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
            <?php
                echo "<br /><a href='/an/$res->link_cut' style='font-size: 16px; text-decoration: none; color: gray; padding: 2px; font-style: italic;'>Next / Continue</a>";
            ?>
            <script type="text/javascript"><!--
            google_ad_client = "<?php echo $res->ads_pub; ?>";
            google_ad_width = 728;
            google_ad_height = 15;
            google_ad_format = "728x15_0ads_al_s";
            google_ad_channel ="<?php echo $res->ads_channel; ?>";
            google_color_border = "FFFFFF";
            google_color_bg = "FFFFFF";
            google_color_link = "FFFFFF";
            //--></script>
            <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
            <?php
                echo substr($rfpage_content,1501,8000);
            ?>
        </td>
        <td class='right_ads' width='20%'>
            <script type="text/javascript">
            google_ad_client = "<?php echo $res->ads_pub; ?>";
            google_ad_width = 160;
            google_ad_height = 600;
            google_ad_format = "160x600_as";
            google_ad_type = "text_image";
            google_ad_channel = "<?php echo $res->ads_channel; ?>";
            google_color_border = "FEF9D1";
            google_color_bg = "FEF9D1";
            google_color_link = "0000cd";
            google_color_text = "CC0000";
            google_color_url = "679701";
            </script>
            <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
        </td>
    </tr>
</table>