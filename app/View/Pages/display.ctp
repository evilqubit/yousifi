
<div class="floatClass col-lg-4 col-md-4 col-sm-12 col-xs-12 homeLeftContainer">
	<div class="floatClass col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="floatClass homeBusinessLogo"><img src="/img/spacer.gif" width="24" height="24"  alt="" /></div>
		<div class="floatClass homeBusinessHeaderTitle"><?=__("Our Businesses",true)?></div>
	</div>
	
	<div class="floatClass col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<?php foreach($home_our_business as $b){
				$id=$b['DynamicPage']['id'];
				$title=$b['DynamicPage']['title'];
				$section=$b['DynamicPage']['section'];
				
				$slug=$b['SeoManagement']['slug'];
				
				$url="/$lang/DynamicPages/business/$section/$id/$slug";
			?>
			<div class="floatClass headerBusinessRow"><a href="<?=$url?>"><?=$title?></a></div>
			
			<?php 
			
		} ?>
	</div>
</div>

<div class="floatClass col-lg-8 col-md-8 col-sm-12 col-xs-12" >
	<?php
	if(!empty($home_other_category)){
		
		$index=0;
		$counter=count($home_other_category);
		foreach($home_other_category as $c){
			$id=$c['Banner']['id'];
			$image=$c['Banner']['image'];
			$title=$c['Banner']['title'];
			$text=$c['Banner']['text'];
			$url=$c['Banner']['url'];
			
			$img='';
			if(!empty($image)){
				$img="/files/banners/thumb/$image";
			}
			
			if(($index % 2) == 0){
				echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 homeCategoryRow floatClass' >";
			}
			?>
			
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 floatClass homeCategoryRowElement">
					<?php if(!empty($img)){ ?>
						<div class="floatClass HomeCategoryListImage"><a href="<?=$url?>"> <img	src="<?=$img?>"  alt="" /></a></div>
					<?php } ?>
					
					
					<div class="floatClass HomeCategoryListTitle"><a href="<?=$url?>"> <?=$title?> </a></div>
					<div class="floatClass HomeCategoryListText"><a href="<?=$url?>"> <?=$text?> </a></div>
				</div>
			<?php 
			
			$index++;
			
			if(($index % 2)==0  || ($index == $counter)){
				echo "</div>";
			}
		}
		
	}
	
	 ?>
</div>


<div >
	
</div>