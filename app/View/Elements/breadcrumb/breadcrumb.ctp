<div class="floatClass l_index_title">
	
	
	
	<?php
		if(!empty($otherTitles)){
			foreach ($otherTitles as $entryHref=>$entryTitle){
				//print_r($lang);exit;
				// if($lang == 'en'){
					// $entryTitle=strtoupper($entryTitle)." &nbsp;&nbsp;/&nbsp;&nbsp; ";
				// }elseif($lang == 'ar'){
					// $entryTitle=" &nbsp;&nbsp;/&nbsp;&nbsp; ".strtoupper($entryTitle);
				// }
				$entryTitle=$entryTitle." &nbsp;&nbsp;/&nbsp;&nbsp; ";
				//$entryTitle=strtoupper($entryTitle)." &nbsp;&nbsp;/&nbsp;&nbsp; ";
				if(!empty($entryHref)){
					$aStart = "<a href='$entryHref'>";
					$aEnd = "</a>";
				}else{
					$aStart = "";
					$aEnd = "";
				}
				echo "<div class='floatClass breadcrumbTitle'>$aStart$entryTitle$aEnd</div>";
			}
		}
		
		
		
		if(isset($current_title) && !empty($current_title)){
				$title=($current_title ["$modelName"]['title']);
			
				echo "<div class='floatClass breadcrumbSecondayTitle'>$title</div>";
			}
		
	?>
	<?php 
	if($lang == 'en'){
		$margin="margin-left: 10px";
	}else{
		$margin="margin-right: 10px";
	}
	
	 ?>
	<div class="floatClass " style="<?=$margin?>; display: none" id="contentLoader"><img src="/img/ajax-loader.gif" alt=""/></div>
</div>
