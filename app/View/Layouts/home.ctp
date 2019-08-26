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
	<script type="text/javascript" src="/js/jquery/jquery.bxslider/jquery.bxslider.js" ></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>


	<script type="text/javascript" src="/js/jquery/SlickNav-master/jquery.slicknav.js" ></script>
	<script type="text/javascript" src="http://www.google.com/recaptcha/api/js/recaptcha_ajax.js"></script>

	<?php echo $this->element('/layout/title');?>
	<?php echo $this->element('meta_tags');?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php // echo $this->Html->meta('icon'); ?>
	<?php
    $windowTitle = "";
    if (isset($seoData['SeoManagement']) && !empty($seoData['SeoManagement'])) {
        if (isset($seoData['SeoManagement']['prepend_title']) && !empty($seoData['SeoManagement']['prepend_title']))
            $windowTitle = $seoData['SeoManagement']['prepend_title'];
        if (!empty($windowTitle)) $windowTitle .= " | ";
        if (isset($seoData['SeoManagement']['title']) && !empty($seoData['SeoManagement']['title']))
            $windowTitle .= " " . $seoData['SeoManagement']['title'];
        if (isset($seoData['SeoManagement']['append_title']) && !empty($seoData['SeoManagement']['append_title'])) {
            $windowTitle .= " | ";
            $windowTitle .= " " . $seoData['SeoManagement']['append_title'];
        }
    }
    if (trim($windowTitle) == "") {
        $windowTitle = __("siteTitle", true);
    }
    ?>
    <title dir="<?php echo __("direction", true); ?>">
        <?php echo $windowTitle; ?>
    </title>
</head>
<body>

				<?php echo $this->Session->flash(); ?>
	<div class="">
		<?=$this->element("/header/header")?>
		<div class="container">
			<?php echo $this->fetch('content'); ?>
		</div>

		<?php echo $this->element("/home/news") ?>

		<div class="container">
			<?php echo $this->element("/home/banners") ?>
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
