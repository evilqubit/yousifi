
<div class="floatClass services_container">
	<?=$this->element('common_services_details_overlay')?>
	<?php foreach($common_services as $com_ser){
		
		$id=$com_ser["Service"]['id'];
		$title=$com_ser["Service"]['title'];
		
		$href="/$lang/Services/service_details/$id";
	?>
	
		<!-- <div class="floatClass common_service_title"> <?=$title?></div> -->
		<div class="floatClass commonServiceTitleContainer"  onclick="open_service_overlay('<?=$href?>');return false;" >
			<div class="floatClass common_service_title_width"><?=strtoupper($title)?></div> 
			<div class="floatRevClass common_service_arrow1"></div>
			<div class="floatRevClass common_service_arrow2"></div>
		</div>
		
		
	<?php } ?>
</div>