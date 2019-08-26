<?php 
$seo_description="";
$seo_keywords="";


if(isset($seoData) && !empty($seoData)){
	
	if(isset($seoData["SeoManagement"]["keywords"]) && !empty($seoData["SeoManagement"]["keywords"]))
		$seo_keywords=$seoData["SeoManagement"]["keywords"];
	
	if(isset($seoData["SeoManagement"]["description"]) && !empty($seoData["SeoManagement"]["description"]))
		$seo_description=$seoData["SeoManagement"]["description"];
		
}

?>

<meta name="DESCRIPTION" content="<?php echo $seo_description; ?>"/>
<meta name="KEYWORDS" content="<?php echo $seo_keywords; ?>" />
<meta name="CLASSIFICATION" content="" />
<meta name="CATEGORY" content="" />
<meta name="LANGUAGE" content="<?php echo $lang;?>" />
<meta name="DISTRIBUTION" content="global" />
<meta name="ROBOTS" content="index,follow" />
