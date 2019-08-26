
<div class="floatClass textArea  addTopSpace">
	<?php 
	$title=$section_details["Section"]['internal_title'];
	$text=$section_details["Section"]['text_1'];
	
	?>
	
	<div class="floatClass PageTitle"><?=strtoupper($title)?></div>
	<div class="floatClass PageText"><?=$text?></div>
	
	
<?php
if(isset($services_list) && !empty($services_list)){
	
	foreach($services_list as $oh){
		$title=$oh['Service']['title'];
		$text=$oh['Service']['text'];
		$img=$oh['Service']['image'];
		
		$img="/files/services/preview/$img";
		
	?>
	<div class="floatClass openingHoursContainer">
		<div class="floatClass openHourImage"><img src="<?=$img?>" alt='<?=$title?>' /></div>
		<div class="floatClass openHourTextContainer">
			<div class="floatClass openHourListTitle"><?=$title?></div>
			<div class="floatClass openHourText"><?=$text?></div>
		</div>
	</div>
	<?php 
}

}
 ?>
 </div>


