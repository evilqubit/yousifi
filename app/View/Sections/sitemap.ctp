

<div class="floatClass textArea addBottomSmallSpace">
	<?php 
	$title=$section_details["Section"]['internal_title'];
	

	
	
	$overview_slug=$section_slugs["overview"]['SeoManagement']['slug'];
	$opening_hours_slug=$section_slugs["opening_hours"]['SeoManagement']['slug'];
	$articles_slug=$section_slugs["articles"]['SeoManagement']['slug'];
	$videos_slug=$section_slugs["videos"]['SeoManagement']['slug'];
	$careers_slug=$section_slugs["careers"]['SeoManagement']['slug'];
	
	$overview_url="/$lang/Sections/overview/$overview_slug";
	$opening_hours_url="/$lang/Sections/opening_hours/$opening_hours_slug";
	$articles_url="/$lang/Sections/articles/$articles_slug";
	$videos_url="/$lang/Sections/videos/$videos_slug";
	$careers_url="/$lang/Sections/careers/$careers_slug";




	$about_us="/$lang/Sections/overview/$all_slugs[overview]";							
	$services="/$lang/Sections/services/$all_slugs[services]";				
	$store_locator="/$lang/Sections/store_locator/$all_slugs[store_locator]";
	$get_here="/$lang/Sections/get_here/$all_slugs[get_here]";
	
	
	$contact="/$lang/Sections/contact_us/$all_slugs[contact]";
	$terms_conditions="/$lang/Sections/terms_conditions/$all_slugs[terms_conditions]";
	$privacy="/$lang/Sections/privacy/$all_slugs[privacy]";
	

	
	?>
	

	<div class="floatClass PageTitle"><?=($title)?></div>
	
	
	
	<div class="floatClass siteMapContainer ">
		<div class="floatClass siteMapTitleBold"><a href="<?=$about_us?>"><?=(__("about_us",true))?></a></div>
		
		<div class="floatClass siteMapTitle"><a href="<?=$overview_url?>"><?=(__("overview",true))?></a></div>
		<div class="floatClass siteMapTitle"><a href="<?=$opening_hours_url?>"><?=(__("opening_hours",true))?></a></div>
		<div class="floatClass siteMapTitle"><a href="<?=$articles_url?>"><?=(__("articles",true))?></a></div>
		<div class="floatClass siteMapTitle"><a href="<?=$videos_url?>"><?=(__("videos",true))?></a></div>
		<div class="floatClass siteMapTitle"><a href="<?=$careers_url?>"><?=(__("careers",true))?></a></div>
		
		
		<div class="floatClass siteMapTitleBold"><a href="<?=$services?>"><?=(__("services",true))?></a></div>
		<div class="floatClass siteMapTitleBold"><a href="<?=$store_locator?>"><?=(__("store_locator",true))?></a></div>
		<div class="floatClass siteMapTitleBold"><a href="<?=$get_here?>"><?=(__("how_to_get_here",true))?></a></div>
		
		<div class="floatClass siteMapTitleBold"><a href="<?=$privacy?>"><?=(__("privacy_policy",true))?></a></div>
		<div class="floatClass siteMapTitleBold"><a href="<?=$terms_conditions?>"><?=(__("terms_conditions",true))?></a></div>
		<div class="floatClass siteMapTitleBold"><a href="<?=$contact?>"><?=(__("contact_us",true))?></a></div>

	</div>
	
	
	
	
	
	<?php 
	$index=1;
	foreach($main_sections_list  as $ms){
		$id=$ms['Section']['id'];
		$section=$ms['Section']['section'];
		$title=$ms['Section']['title'];
		
		if($section == 'entertain'){
			$Shop=$ms['Shop'];
		}else{
			$Category=$ms['Category'];
		}
		
		$slug='';
		if(isset($ms['SeoManagement']['slug'])){
			$slug=$ms['SeoManagement']['slug'];
		}
		
			
		
		$padding='';
		if($index == 3){
			$padding='0px';
		}
		
		if($section == 'entertain'){
			$url="/$lang/Sections/entertain/$slug";
		}else{
			$url="/$lang/Sections/categories/$section/$slug";
		}
		
		
	
	
	?>
	<div class="floatClass siteMapContainer " style="padding: <?=$padding?>">
		<div class="floatClass siteMapTitleBold"><a href="<?=$url?>"><?=$title?></a></div>
		
		<?php
		if($section == 'entertain'){
			foreach($Shop as $sh){
				$shop_id=$sh['id'];
				$shop_title=$sh['title'];
				$category_id=$sh['category_id'];
				$shop_url="/$lang/Sections/entertain/?shop_id=$shop_id";
				?>
				<div class="floatClass siteMapTitle"><a href="<?=$shop_url?>"><?=$shop_title?></a></div>
		<?php 
			}
		}else{
			
			foreach($Category as $cat){
				$cat_id=$cat['id'];
				$cat_title=$cat['title'];
				$slug='';
				if(isset($cat['SeoManagement']['slug'])){
					$slug=$cat['SeoManagement']['slug'];
				}
				
				$cat_url="/$lang/Sections/index/$cat_id/$slug";
				?>
				<div class="floatClass siteMapTitle"><a href="<?=$cat_url?>"><?=$cat_title?></a></div>
				<?php 
			}
		}
		 ?>
	</div>
	<?php
	
	$index++;
	 } ?>

 </div>


