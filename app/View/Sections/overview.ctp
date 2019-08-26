<?php 
if($is_ajax == false){
	echo $this->element("/header/about_us_menu");
	
	echo "<div id='about_sections'>";
}
 ?>

<?php
if(isset($section_details) && !empty($section_details)){
	$text=$section_details['Section']['text_1'];
	?>
	<div class="floatClass textArea addBottomSpace"><?=$text?></div>
	<?php 
}

 ?>

<?php 
if($is_ajax == false){
	echo "</div>";
}
 ?>