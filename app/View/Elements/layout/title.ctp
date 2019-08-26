<?php
		$windowTitle = "";
			
		if(isset($seoData) && !empty($seoData)){
			
			$windowTitle.=" ".$seoData['SeoManagement']['title'];
			
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