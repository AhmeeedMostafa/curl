<?php if(!class_exists('raintpl')){exit;}?><html>
    <head>
        <title><?php echo $message_title;?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body marginheight="0" dir="<?php echo $ltr? 'ltr' : 'rtl';?>" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #e9eef0; padding-top: 20px; font-family: Georgia, 'Times New Roman', Times, serif;" bgcolor="#e9eef0" leftmargin="0">
        <table id="main" cellpadding="5" cellspacing="0" border="0" align="center" width="460">
            <tbody>
               <?php if( $data["one_line"] ){ ?>

                <tr>
                    <td>
                        <table id="one-line-data" cellpadding="10" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td><h2 style="font-weight: normal; font-size: 24px; font-family: Georgia, 'Times New Roman', Times, serif; margin: 0; color: #8fbacb; padding: 0;"><?php echo $one_line_data_title;?></h2></td>
                                </tr>
                                <tr>
                                    <td>
                                        <table cellspacing="0" border="0" style="border: 1px solid #cbe2ec; padding: 10px;" bgcolor="f6f8f9" width="460" cellpadding="5">
                                            <tbody>
                                                <?php $counter1=-1; if( isset($data["one_line"]) && (is_array($data["one_line"]) || $data["one_line"] instanceof Traversable ) ) foreach( $data["one_line"] as $key1 => $value1 ){ $counter1++; ?>

                                                <tr>
                                                    <td>
                                                        <h3 style="font-size: 16px; font-weight: normal; margin: <?php echo $ltr? '0 10px 0 0' : '0 0 0 10px';?>; padding: 0; font-family: Georgia, 'Times New Roman', Times, serif; color: #b4cdd6; float: <?php echo $ltr? 'left' : 'right';?>;"><?php echo $value1["id"];?></h3>
                                                        <p style="font-weight: normal; font-size: 16px; font-family: Georgia, 'Times New Roman', Times, serif; margin: 0; color: #858585; padding: 0;"><?php echo $value1["value"];?></p>
                                                    </td>
                                                </tr>
                                                <?php } ?>

                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div style="position: relative; overflow: hidden; margin: 0; background-color: #dbe1e6; padding: 0; font-family: Georgia, 'Times New Roman', Times, serif; height: 1px; width: 100%;"></div>
                                        <div style="position: relative; overflow: hidden; margin: 0; background-color: #f6f8f9; padding: 0; font-family: Georgia, 'Times New Roman', Times, serif; height: 1px; width: 100%;"></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table><!-- #one-line-data -->
                    </td>
                </tr>
                <?php } ?>

                <?php if( $data["multiple_lines"] ){ ?>

                <tr>
                    <td>
                        <table id="multiple-lines-data"  cellpadding="10" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td>
                                        <h2 style="font-weight: normal; font-size: 24px; font-family: Georgia, 'Times New Roman', Times, serif; margin: 0; color: #8fbacb; padding: 0;"><?php echo $multiple_lines_data_title;?></h2>
                                    </td>
                                </tr>
                                <?php $counter1=-1; if( isset($data["multiple_lines"]) && (is_array($data["multiple_lines"]) || $data["multiple_lines"] instanceof Traversable ) ) foreach( $data["multiple_lines"] as $key1 => $value1 ){ $counter1++; ?>

                                <tr>
                                    <td>
                                        <table cellspacing="0" border="0" style="border: 1px solid #cbe2ec; padding: 10px;" bgcolor="f6f8f9" width="460" cellpadding="5">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <h3 style="font-weight: normal; font-size: 16px; font-family: Georgia, 'Times New Roman', Times, serif; margin: 0; color: #b4cdd6; padding: 0;"><?php echo $value1["id"];?></h3>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p style="font-weight: normal; font-size: 16px; font-family: Georgia, 'Times New Roman', Times, serif; margin: 0; color: #858585; padding: 0;">
                                                        <?php echo $value1["value"];?>

                                                        </p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <?php } ?>

                                <tr>
                                    <td>
                                        <div style="position: relative; overflow: hidden; margin: 0; background-color: #dbe1e6; padding: 0; font-family: Georgia, 'Times New Roman', Times, serif; height: 1px; width: 100%;"></div>
                                        <div style="position: relative; overflow: hidden; margin: 0; background-color: #f6f8f9; padding: 0; font-family: Georgia, 'Times New Roman', Times, serif; height: 1px; width: 100%;"></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table><!-- #multiple-lines-data -->
                    </td>
                </tr>
                <?php } ?>

                <tr>
                    <td>
                        <p id="generator" align="center" style="font-size: 10px; font-family: Georgia, 'Times New Roman', Times, serif; margin: 0; color: #afc1c9; padding: 0;"><?php echo $generator;?></p>
                    </td>
                </tr>
            </tbody>
        </table><!-- #main -->
    </body>
</html>
