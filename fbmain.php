<?php

    //facebook application configuration 
    $fbconfig['appid' ] = "417299788313762";
    $fbconfig['secret'] = "";//secret id

    $fbconfig['baseUrl']    =   "";// "url";
    $fbconfig['appBaseUrl'] =   "http://apps.facebook.com/marioandprincess";// "http://apps.facebook.com/thinkdiffdemo";

    
    /* 
     * If user first time authenticated the application facebook
     * redirects user to baseUrl, so I checked if any code passed
     * then redirect him to the application url 
     */
    if (isset($_GET['code'])){
        header("Location: " . $fbconfig['appBaseUrl']);
        exit;
    }
    //~~
    
    //
    $user            =   null; //facebook user uid
    try{
        include_once "facebook.php";
    }
    catch(Exception $o){
        echo '<pre>';
        print_r($o);
        echo '</pre>';
    }
    // Create our Application instance.
    $facebook = new Facebook(array(
      'appId'  => $fbconfig['appid'],
      'secret' => $fbconfig['secret'],
      'cookie' => true,
    ));

    //Facebook Authentication part
    $user       = $facebook->getUser();
    // We may or may not have this data based 
    // on whether the user is logged in.
    // If we have a $user id here, it means we know 
    // the user is logged into
    // Facebook, but we don’t know if the access token is valid. An access
    // token is invalid if the user logged out of Facebook.
    
    $loginUrl   = $facebook->getLoginUrl(
            array(
                'scope'         => 'publish_stream,read_stream,user_likes,user_status,user_photos,user_about_me'
            )
    );


    if (!$user) {
        echo "<script type='text/javascript'>top.location.href = '$loginUrl';</script>";
        exit;
    }
    
    //get user basic description
    

    function d($d){
        echo '<pre>';
        print_r($d);
        echo '</pre>';
    }
?>