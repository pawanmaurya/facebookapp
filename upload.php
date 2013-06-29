<?
error_reporting(E_ERROR | E_PARSE);
include_once "fbmain.php";


if ($user){

	try{
		
		$facebook->setFileUploadSupport(true);

		$args = array(
		'message' => 'lol... i found my partner. get your at http://apps.facebook.com/marioandprincess/',
		'image'   => '@' . realpath("temp1/".$_GET[uid].".jpg"),
		'tags'    => array(
    			array(
      			'tag_uid' => $_GET[male1],
      			'x'       => 40,
      			'y'       => 51
     			),
     			array(
      			'tag_uid' => $_GET[male2],
      			'x'       => 59,
      			'y'       => 71
    			),
  			)
  		);
		$data = $facebook->api('/me/photos', 'post', $args);
		echo "pic has been uploaded to your profile";
		
	}
	catch (Exception $e) {
            	d($e);
    		}
	}
	

else
{
echo "error";
}
?>