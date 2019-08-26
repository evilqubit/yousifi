<?php if(!empty($home_middle_banners)){
	?>
		
	<div class="floatClass col-lg-12 col-md-12 col-sm-12 col-xs-12">	
	<?php 
	$index=1;
	foreach($home_middle_banners as $banner){
			$id=$banner['Banner']['id'];
			$title=$banner['Banner']['title'];
			$image=$banner['Banner']['image'];
			$url=$banner['Banner']['url'];
			
			$img="/files/banners/preview/$image";
			
			$margin='';
			if($index == 4){
				$margin ="0px;";
			}
		?>
		
		<div style="margin: <?=$margin?>" class="floatClass homeMiddleBanner"><a href="<?=$url?>"><img src="<?=$img?>" alt=""/></a></div>
		
		<?php 
		$index++;
	} ?>
	
	
	
	</div>
	<?php 
} ?>