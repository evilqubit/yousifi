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
				 $windowTitle = ucwords(strtolower($pageTitle));
			}else{
				 $windowTitle = __("pageTitle",true);
			}
			
		}
	?>
	<title>
		<?php echo $windowTitle; ?>
	</title>
	<?php echo $this->Html->meta('icon'); ?>
	
	<script type="text/javascript" src="/js/jquery_<?php echo $lang;?>.php" ></script>
	<link rel="stylesheet" type="text/css" href="/css/<?php echo $lang;?>/css_all.php" />
	

</head>
<body>
	<?php echo $this->fetch('content'); ?>
</body>
</html>