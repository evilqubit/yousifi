<?php 
if($is_ajax == false){
	echo $this->element("/header/about_us_menu");
	
	echo "<div id='about_sections'>";
}
 ?>


<div class="floatClass textArea  addTopSpace">
<?php
if(isset($opening_hours_list) && !empty($opening_hours_list)){
	
	foreach($opening_hours_list as $oh){
		$title=$oh['Section']['title'];
		$text=$oh['Section']['text_1'];
		$img=$oh['Section']['image'];
		
		$img="/files/sections/preview/$img";
		
	?>
	<div class="floatClass openingHoursContainer">
		<div class="floatClass openHourImage"><img src="<?=$img?>" alt=""/></div>
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
 
 <?php 
if($is_ajax == false){
	
	echo "</div>";
}
 ?>