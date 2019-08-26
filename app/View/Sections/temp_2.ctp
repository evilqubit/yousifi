<div class="row beauty-con">
	
	<?php
	$index=0;
	foreach($section_categories_list as $c){
		$id=$c['Category']['id'];
		$section_id=$c['Category']['section_id'];
		$title=$c['Category']['title'];
		$image=$c['Category']['image'];
		$slug=$c['SeoManagement']['slug'];
		
		$image="/files/categories/preview/$image";
		
		$url="/Shops/temp_2/$section_id/$id/$slug";
		
		if($index % 2 ==0){
			?>
			
			
			<div class="hold left">
				<a style="background-image: url('<?=$image?>');" href="<?=$url?>"><span><?=$title?></span></a>
			</div>
			<?php 
			
			
		}else{?>
			
			<div class="hold right">
				<a style="background-image: url('<?=$image?>');" href="<?=$url?>"><span><?=$title?></span></a>
			</div>
			
			<?php 
			
		}
			
		$index++;
		
		}
	 ?>
	
</div>