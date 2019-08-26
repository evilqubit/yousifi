<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<?php
		$windowTitle = "";
			
		if(isset($seoData) && !empty($seoData)){
			$windowTitle = $seoData['SeoManagement']['prepend_title'];
			if(!empty($windowTitle)) $windowTitle .= " | ";
			else{
				$windowTitle = __("pageTitle",true)." | ";
			}
			
			$windowTitle.=" ".$seoData['SeoManagement']['title'];
			if(!empty($seoData['SeoManagement']['append_title'])) $windowTitle .= " | ";
			$windowTitle.=" ".$seoData['SeoManagement']['append_title'];
		}
		
		if(trim($windowTitle) == ""){
			
			if(isset($pageTitle)){
				 $windowTitle = ucwords(($pageTitle));
			}else{
				 $windowTitle = __("pageTitle",true);
			}
			
		}else{
			
			if(isset($windowTitle)){
				
				 $windowTitle = ucwords(($windowTitle));
			}else{
				 $windowTitle = __("pageTitle",true);
			}
		}
	?>
	<title>
		<?php echo $windowTitle; ?>
	</title>
	<?php echo $this->element('meta_tags');?>
	<?php // echo $this->Html->meta('icon'); ?>
	
	<!-- <script type="text/javascript" src="/js/jquery_<?=$lang?>.php" ></script> -->
	<script type="text/javascript" src="/js/js_cached_<?=$lang?>.js" ></script>
	<link rel="stylesheet" type="text/css" href="/css/<?php echo $lang;?>/css_all.php" />
	
	<link rel="stylesheet" type="text/css" href="/js/jquery/lightbox/css/default.css" />
	
	
	<meta name="google-site-verification" content="mb1q0o0Ju2MSWlgE9VlWnljiZp0DukBVb41i7mGW4ws" />

</head>

<?php 

if(isset($back_ground["Background"]['image'])){
	$back_ground="/files/backgrounds/original/{$back_ground['Background']['image']}";
}else{
	$back_ground="/img/default_bg.png";
}
?>
<body style="background:url(<?=$back_ground?>) no-repeat top center #ffffff;margin: 0px;padding: 0px;">
	
	<!-- <div class="top_border"><img src="/img/<?=$lang?>/internal_border.png" width="100%" height="3px"></div> -->

<?=$this->element("photo_gallery/album_overlay",array());?>
<?=$this->element("photo_gallery/home_album_overlay",array());?>

	
<!-- ////////////// facebook ////////////////  -->
<?php //echo $this->element("facebook");?>
<?php //echo $this->element("facebook_tags");?>
<!-- ////////////////// end facebook /////////////////  -->
	
	
	
	
	
	<?=$this->element('header');?>
	
	
	<div class="mainContent">
		<div class="subMainContent floatClass">
			<div class="sessionMessage" onclick="$('.sessionMessage').fadeOut();" >
				<?php echo $this->Session->flash(); ?>
			</div>
			<div class="floatClass  contentDiv" >
				<?php echo $this->fetch('content'); ?>
			</div>
		</div>
	</div>
	
	
	
	<?php
	echo $this->element('footer');
	?>
	
	
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-WDDR85"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-WDDR85');</script>
<!-- End Google Tag Manager -->


<script type="text/javascript">
 function getWindowHeight() {
  var myHeight = 0;
  if( typeof( window.innerWidth ) == 'number' ) {
    //Non-IE
    myHeight = window.innerHeight;
  } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
    //IE 6+ in 'standards compliant mode'
    myHeight = document.documentElement.clientHeight;
  } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
    //IE 4 compatible
    myHeight = document.body.clientHeight;
  }
  return myHeight;
}
	$(document).ready(function(){
		$('.lightbox').lightBox();
		
		
		
		setTimeout(function() {
		      $('.sessionMessage').fadeOut();
		}, 10000);
		
		// var body_height=$(window).height();
		 //alert(body_height);exit;
		//$('.footerMainContainer').css('top',body_height-34);
	});
	
</script>


	<!-- <div class="bottom_border"><img src="/img/internal_border.png" width="100%" height="3px"></div> -->
</body>

</html>







