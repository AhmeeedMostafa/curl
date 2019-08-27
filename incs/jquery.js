$(document).ready(function(){
    $('#new').hide(100);
    $('.edit_urls').click(function(){
        var edit_url_id = $(this).attr('href');
        var element = $(this).parent();
        var elink_name = element.find("input[id=nlink]").val();
        var ereal_link = element.find("input[id=rlink]").val();
        var ecut_link  = element.find("input[id=clink]").val();
        var link_date  = element.find("input[id=date]").val();
        var domain     = element.find("input[id=domain]").val();
        
        var links_edit_form_code = "<form action='#' method='POST' id='edit_url_form'><b>URL Name : </b><input type='text' name='eurl_name' class='txt' value='"+elink_name+"' size='30' /><br /><b>Real URL &nbsp;&nbsp;: </b><input type='url' name='ereal_url' class='txt' value='"+ereal_link+"' size='30' /><br /><b>Short URL &nbsp;: </b><span style='color: red; font-size: 25px; font-weight:bold;'>"+domain+"/</span><input type='text' name='ecut_url' style='text-align: center;' class='txt' value='"+ecut_link+"' size='8' /><br /><br /><b>Date&amp;Time: </b><h4 style='color: gray'>"+link_date+"</h4><br /><input type='button' name='url_edit' value='Edit' id='edit_url_sub' class='btn' /><br /><span id='emsg'></span></form>";
        var links_edit_form = element.html(links_edit_form_code);
        
        $('#edit_url_sub').click(function(){
            var edit_url_form_values = $('#edit_url_form').serialize()+"&id="+edit_url_id;
             
            $.post('../incs/checks/inc.edit_url.php',edit_url_form_values,function(data){
                if(data == 'url name is little'){
                    $('#emsg').html("<div class='Failed'>URL Name must be four letters or more .</div>");
                }else if(data == 'empty real_url'){
                    $('#emsg').html("<div class='Failed'>Plese, Enter The Real URL .</div>");
                }else if(data == 'not url'){
                    $('#emsg').html("<div class='Failed'>That doesn't a URL, Please Try Again with right URL .</div>");
                }else if(data == 'empty cut_url'){
                    $('#emsg').html("<div class='Failed'>Please, Enter The Short URL Code .</div>");
                }else if(data == 'little cut_urL'){
                    $('#emsg').html("<div class='Failed'>The Short URL Code must be more than three letters .</div>");
                }else if(data == 'links is existing'){
                    $('#emsg').html("<div class='Failed'>The Short URL Code You Entered Exists, Please Try Again with another one .</div>");
                }else{
                    element.html(data);
                }
            });
        })
        return false;
    });
    $('.delete_urls').click(function(){
       var delete_url_id = $(this).attr('href');
       var element = $(this).parent();
       $.post('../incs/checks/inc.delete_url.php',{'id':delete_url_id},function(data){
            if(data == 'Deleted'){
             element.slideUp('slow');   
            }else{
                alert(data);
            }
       });
       return false; 
    });
    function letters_count(id, span, num, num2){
        $(id).keyup(function(){
            var val = $(id).val().length;
            if(val < num || val > num2){
                $(id).css({"background-color":"#FCE0E0","border":"1px solid red","color":"red"});
            }else{
                $(id).css({"background-color":"white","border":"1px solid lightblue","color":"black"});
            }
            $(span).html(val+" Letters");
        })
    }
letters_count('#fpage_content', '.fpage_content', 2500, 8000);
letters_count('#spage_content', '.spage_content', 2500, 8000);
letters_count('#page_desc', '.page_desc', 100, 400);
letters_count('#page_keywords','.page_keywords',10,200);
});
function sign_up(){
    var form_values = $('#sform').serialize();
    $.post('incs/checks/inc.signup_check.php',form_values,function(data){
        if(data == 'Done'){
            $('.fhide').fadeOut(500);
            $('#message').html("<div class='Done'>You Have Been Registered Successcully, Please <a href='login.php' style='color: red; text-decoration: none;'>Log In</a> .</div>");
        }else{
            $('#message').html(data);
        }
    });
}
function short_url(){
    var form_values = $('#short_form').serialize();
    $.post('incs/checks/inc.short_check.php',form_values,function(data){
        if(data == 'empty_url'){
            $('#cmessage').html("<div class='Failed'>Enter the URL you want CUT it .</div>").slideDown('fast');
        }else if(data == 'enter_url'){
            $('#cmessage').html("<div class='Failed'>That doesn't a URL, Please Try Again with right URL .</div>").slideDown('fast');
        }else if(data == 'empty_input'){
            $('#cmessage').html("<div class='Failed'>Enter The Short link for the URL you want cut it .</div>").slideDown('fast');
        }else if(data == 'little than 3'){
            $('#cmessage').html("<div class='Failed'>The Short link must be three letters or more .</div>").slideDown('fast');
        }else if(data == 'Link Exists'){
            $('#cmessage').html("<div class='Failed'>The Short URL Code you Entered Exists, Please try again with another one .</div>").slideDown('fast');
        }else if(data == 'not string'){
            $('#acmessage').html("<div class='Failed'>The Short URL Code you Entered must contain numbers and characters only .</div>").slideDown('fast');
        }else{
            $('#URL_short').attr('disabled','disabled');
            $('#URL_short').removeClass('txt');
            $('#URL_short').addClass('txt_disabled');
            $('#URL_short').val(data);
            $('#short_another').fadeIn(500);
            $('#cmessage').html("<div class='Done'>The URL Has Been CUT Successfully, See it in the URL field .</div>").slideDown('fast');
            $('#short_another').click(function(){
                $('#URL_short').removeAttr('disabled');
                $('#URL_short').removeClass('txt_disabled');
                $('#URL_short').addClass('txt');
                $('#URL_short').val("");
                $('#short_another').fadeOut(500);
                $('#cmessage').slideUp('fast');
                return false;
            })
        }
    });
}
function ashort_url(){
    var form_values = $('#ashort_form').serialize();
    $.post('incs/checks/inc.ashort_check.php',form_values,function(data){
        if(data == 'empty_title'){
            $('#acmessage').html("<div class='Failed'>Enter The Title Of URL You Want CUT it .</div>").slideDown('fast');
        }else if(data == 'title is small'){
            $('#acmessage').html("<div class='Failed'>Title Must Be Four Letters Or More And little than 100 letters .</div>").slideDown('fast');
        }else if(data == 'empty_url'){
            $('#acmessage').html("<div class='Failed'>Enter the URL you want CUT it .</div>").slideDown('fast');
        }else if(data == 'enter_url'){
            $('#acmessage').html("<div class='Failed'>That doesn't a URL, Please Try Again with right URL .</div>").slideDown('fast');
        }else if(data == 'empty_input'){
            $('#acmessage').html("<div class='Failed'>Enter The Short link for the URL you want cut it .</div>").slideDown('fast');
        }else if(data == 'little than 3'){
            $('#acmessage').html("<div class='Failed'>The Short link must be three letters or more .</div>").slideDown('fast');
        }else if(data == 'empty ads_pub'){
            $('#acmessage').html("<div class='Failed'>Please, Enter Your Adsense Pub .</div>").slideDown('fast');
        }else if(data == 'ads_pub is little or more'){
            $('#acmessage').html("<div class='Failed'>Adsense Pub must be more than 14 letters and little than 70 letters .</div>").slideDown('fast');
        }else if(data == 'empty fpage_content'){
            $('#acmessage').html("<div class='Failed'>Please, Enter The First Page Content .</div>").slideDown('fast');
        }else if(data == 'fpage is little or more'){
            $('#acmessage').html("<div class='Failed'>The First Page Content Must Be More Than 2500 Letters And little than 8000 letters .</div>").slideDown('fast');
        }else if(data == 'empty spage_content'){
            $('#acmessage').html("<div class='Failed'>Please, Enter The Second Page Content .</div>").slideDown('fast');
        }else if(data == 'spage is little or more'){
            $('#acmessage').html("<div class='Failed'>The Second Page Content Must Be More Than 2500 Letters And little than 8000 letters .</div>").slideDown('fast');
        }else if(data == 'fpage and spage equals'){
            $('#acmessage').html("<div class='Failed'>The First Page Content & Second Page Content Are Alike It Must Be different .</div>").slideDown('fast');
        }else if(data == 'empty page_desc'){
            $('#acmessage').html("<div class='Failed'>Please, Enter The Page Description .</div>").slideDown('fast');
        }else if(data == 'page_desc is little'){
            $('#acmessage').html("<div class='Failed'>Page Description Must Be More Than 100 Letters And little than 400 letters .</div>").slideDown('fast');
        }else if(data == 'empty page_keywords'){
            $('#acmessage').html("<div class='Failed'>Please, Enter Page KeyWords Unplug between KeyWord And Another with Comma , .</div>").slideDown('fast');
        }else if(data == 'page_keywords is little or more'){
            $('#acmessage').html("<div class='Failed'>Page KeyWords Must Be More Than 10 Letters And little than 200 letters .</div>").slideDown('fast');
        }else if(data == 'Link Exists'){
            $('#acmessage').html("<div class='Failed'>The Short URL Code you Entered Exists, Please try again with another one .</div>").slideDown('fast');
        }else if(data == 'not string'){
            $('#acmessage').html("<div class='Failed'>The Short URL Code you Entered must contain numbers and characters only .</div>").slideDown('fast');
        }else{
            $('#aURL_short').attr('disabled','disabled');
            $('#aURL_short').removeClass('txt');
            $('#aURL_short').addClass('txt_disabled');
            $('#aURL_short').val(data);
            $('#ashort_another').fadeIn(500);
            $('#acmessage').html("<div class='Done'>The URL Has Been CUT Successfully, See it in the URL field .</div>").slideDown('fast');
            $('#ashort_another').click(function(){
                $('#aURL_short').removeAttr('disabled');
                $('#aURL_short').removeClass('txt_disabled');
                $('#aURL_short').addClass('txt');
                $('#aURL_short').val("");
                $('#ashort_another').fadeOut(500);
                $('#acmessage').slideUp('fast');
                return false;
            })
        }
    });
}
function user_enter_show(){
    $('#slash').show(100);
    $('#user_enter').show(100);
}
function user_enter_hide(){
    $('#user_enter').hide(100);
    $('#slash').hide(100);
}
function send_message(){
    var contact = $('#contact_form').serialize();
    $.post('incs/checks/inc.contact_check.php',contact,function(data){
        if(data == 'msg Sent'){
            $('.fhide').slideUp('slow');
            $('#s_message').html("<div class='Done'>Message Has Been Sent Successfully, We Will Answer You With In 24 hours Or 48 Hours & Thank's For Contact Us .</div>");
        }else{
            $('#s_message').html(data);
        }
    })
}