<? ob_start("ob_gzhandler"); 
error_reporting(E_ERROR | E_PARSE);
?> 
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<script type="text/javascript" src="http://connect.facebook.net/en_US/all.js"></script>

<style type="text/css">
#loding_msg
{
    font: 16px/normal 'lucida grande', tahoma, verdana, arial, sans-serif;
    color:#000;
    border-radius:5px; 
    padding: 3px 10px 3px;
    
}

#fb_image_bg
{

background:#fff;
width:1045px;
min-height:450px;
padding:0px 10px 10px;
}

.btn_css_class{ 
    position: relative; 
    z-index: 1;
    overflow: visible; 
    display: inline-block; 
    padding: 5px 20px 5px; 
    margin: 0;
    text-decoration: none; 
    text-align: center;
    font: bold 16px/normal 'lucida grande', tahoma, verdana, arial, sans-serif; 
    white-space: nowrap; 
    cursor: pointer; 
    
    color: #fff;
    border-radius:5px;
    background-color:#017dc3;
    
    zoom: 1; 
    display: inline; 
}
#ur_pic_uploaded{ 
text-align:center;
font:  16px/normal 'lucida grande', tahoma, verdana, arial, sans-serif;
background-color: #FFF;
color:#0000ff;
padding:5px 10px 5px;
border-radius:5px;

    }
#partner_name_span1
{
    font-family:Arial, Helvetica, sans-serif;
    font-size:14px;
    font-weight:bold;
    color:#000;
}
#partner_name_span2
{
    font-family:Arial, Helvetica, sans-serif;
    font-size:14px;
    font-weight:bold;
    color:#017dc3;
}
</style>

<?php
include_once "fbmain.php";

$tag_id_1="382781135113070";
$tag_id_2="134732746664364";
$partner_name="";
if ($user) {
try{
     $mario_img_url="";
     
     
    $user_me = $facebook->api(array(  
        'method' => 'fql.query',  
        'query' => 'SELECT uid,name,sex,pic_square FROM user WHERE uid=me()' ,
        ));
    
    
     if("male"==$user_me[0][sex])
     {
        
     $mario_img_url="for_boys.jpg";
    $query_acc_gender="SELECT uid, first_name,pic_square FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = me() ) and sex='female' ORDER BY rand() limit 1";
    }
    else
    {
        
    $mario_img_url="for_girls.jpg";
    $query_acc_gender="SELECT uid, first_name,pic_square FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = me() ) and sex='male' ORDER BY rand() limit 1";   
    }
    
    
     $user_partner = $facebook->api(array(  
            'method' => 'fql.query',  
            'query' =>  $query_acc_gender ,
            )); 

$image_p = imagecreatefromjpeg($mario_img_url);
//////////////////////////////////////////////////////////////////////////////////


$image_me= imagecreatefromjpeg($user_me[0][pic_square]);
$image_partner= imagecreatefromjpeg($user_partner[0][pic_square]);
$partner_name=$user_partner[0][first_name];
if("male"==$user_me[0][sex])
     {
     
     $tag_id_1=$user_me[0][uid];
     $tag_id_2=$user_partner[0][uid];
    imagecopyresampled($image_p, $image_me, 198, 185, 0, 0, 50,50,50,50);
    imagecopyresampled($image_p, $image_partner, 296, 266, 0, 0, 50,50,50,50);
 
    }
    else
    {
    
    $tag_id_2=$user_me[0][uid];
     $tag_id_1=$user_partner[0][uid];
    imagecopyresampled($image_p, $image_partner, 198, 185, 0, 0, 50,50,50,50);
    imagecopyresampled($image_p, $image_me, 296, 266, 0, 0, 50,50,50,50);
    }
//save image on server
imagejpeg($image_p,"temp1/".$user_me[0][uid].".jpg",65);

}
catch(Exception $o){
            d($o);
            }
}                           
?>


<div id="fb_image_bg">
<table >
<tr><td> </td>
    <td><iframe src="https://www.facebook.com/plugins/like.php?href=http://www.facebook.com/techgigs.in"
        scrolling="no" frameborder="0"
        style="border:none; width:450px; height:80px"></iframe> 
    </td>
    <td> 
    </td>
</tr>

<tr>
    <td> 
    </td>
<td>


<div id="fb_image"><center>
<div id="loding_msg">Please wait your image is being generated</div>
<div><img  src="loading.gif"/></div>
</center>
</div>
</td><td style="vertical-align:top">
<table>
<tr><td> <span id="partner_name_span1">Your partner is :&nbsp;</span><span id="partner_name_span2"><? echo $partner_name; ?> </span> </td></tr>

<tr><td>
 <FORM>
 <INPUT TYPE="button" class="btn_css_class" onClick="location.reload()" VALUE="Try another partner">
 </FORM>
 </td></tr>
<tr><td> <div><img  src="inst_img2.jpg"/></div> </td></tr>
 <tr><td>
<div id="ur_pic_uploaded_outer" ><button id="upload_btn" class="btn_css_class"> Publish your photo </button></div>
</td></tr>
<tr><td>  </td></tr>
 <tr><td><a class="btn_css_class" href="#" onclick="newInvite(); return false;">&nbsp;Invite your friends&nbsp;</a>
</td></tr>

</table>
</td>
</tr>
 </table>
<div>
<script type="text/javascript"><!--
google_ad_client = "ca-pub-0982721878546292";
/* facebook app */
google_ad_slot = "6290204375";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>

<script type="text/javascript">
$.ajax({
                    type: "GET",
                    url: "photo_ajax.php",
                    data: "uid="+<? echo $user_me[0][uid];?>,
                    success: function(msg){
                         $("#fb_image").html(msg);
                         
                    },
                    error: function(msg){
                alert(msg);                   
                    }
                });
                
$("#upload_btn").click(function(){
$("#ur_pic_uploaded_outer").html("<div id='ur_pic_uploaded'>Image sucessfully published</div>");
$.ajax({
                    type: "GET",
                    url: "upload.php",
                    data: "uid="+<? echo $user_me[0][uid];?>+"&male1="+<? echo $tag_id_1;?>+"&male2="+<? echo $tag_id_2;?>+"&message1=find princess or mario at ",
                    success: function(msg){
                //alert("success");
                    //alert(msg);
                    },
                    error: function(msg){
                alert(msg);                   
                    }
                });

    });
    
    function newInvite(){
             FB.init({ 
               appId:'417299788313762', cookie:true, 
               status:true, xfbml:true 
             });
                 FB.ui({ 
                        method : 'apprequests',
                        message: 'Find your partner in mario world at https://apps.facebook.com/marioandprincess/',
                 });
            
            }                   
</script>