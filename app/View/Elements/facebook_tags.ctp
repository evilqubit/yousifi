<?php
$SITE_LOCATION = Configure::read("WEBSITE_URL");
if(!isset($pageTitle_Fb))
	$pageTitle_Fb = Configure::read("SITE_NAME");
if(!isset($pageImg_Fb))
	$pageImg_Fb ="$SITE_LOCATION/files/themes/logo.jpg";
if(!isset($pageUrl_Fb))
	$pageUrl_Fb =$SITE_LOCATION;
?>

<meta property="fb:app_id" content="<?php echo Configure::read("facebook_ap_id");?>"/>
<meta property="og:title" content="<?php echo $pageTitle_Fb;?>"/> 
<meta property="og:type" content="website"/> 
<meta property="og:image" content="<?php echo $pageImg_Fb;?>"/> 
<meta property="og:url" content="<?php echo $pageUrl_Fb;?>"/> 
<meta property="og:site_name" content="<?php echo Configure::read("SITE_NAME");?>"/> 