<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


	<!-- <link rel="stylesheet" type="text/css" href="/css/<?=$lang?>/css_all.php" /> -->
	<link rel="stylesheet" type="text/css" href="/css/<?=$lang?>/css_cached.css" />


	<!-- <script type="text/javascript" src="/js/jquery_<?=$lang?>.php" ></script> -->
	<script type="text/javascript" src="/js/js_cached_en.js" ></script>

	<script src='https://www.google.com/recaptcha/api.js'></script>

	<script type="text/javascript" src="/js/jquery/SlickNav-master/jquery.slicknav.js" ></script>
	<script type="text/javascript" src="http://www.google.com/recaptcha/api/js/recaptcha_ajax.js"></script>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js"></script>



	<?php echo $this->element('/layout/title');?>
	<?php echo $this->element('meta_tags');?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php // echo $this->Html->meta('icon'); ?>
</head>
<body >
		<!-- <div id="my_popup" class="well" >
		<div style="display: none;" id="layerLoader">
			<div style="width:100%; text-align: center; clear: both; margin: 0 auto;"><img alt="ajaxloader" src="/img/ajax-loader.gif" width="40" height="40" /> </div>
			<div style="width:100%; text-align: center; margin: 0 auto; color: #ffffff; font-size: 20px; margin-top: 20px">	<?=__('Loading_content');?></div>
		</div>
		<div id="my_popup_content"></div> -->





			<?php echo $this->Session->flash(); ?>
	<div class="">
		<?=$this->element("/header/internal_header")?>
		<div class="container ">
			<?php echo $this->fetch('content'); ?>
		</div>

		<?php echo $this->element("/footer/footer")?>

	</div>



	<script type="text/javascript">

		$(document).ready(function(){

		});

	</script>



	<?php if(isset($settings) && !empty($settings)){
		$google=$settings['Setting']['google_embed'];

		echo $google;
	} ?>
</body>



</html>
