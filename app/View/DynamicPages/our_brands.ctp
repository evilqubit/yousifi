<?php if($isAjax == false){ ?>

	<div class="floatClass col-lg-3  internalLeftMenu">
		<?=$this->element("/header/left_menu")?>
	</div>

	<div class="floatClass col-lg-9 col-md-12 col-sm-12 col-xs-12 internalContent" id="paginatedContent">
		<?php  } ?>
		<?php
		$text=$page_details['DynamicPage']['text'];
		$email=$page_details['DynamicPage']['url'];
		$image=$page_details['DynamicPage']['image'];
		$img='';
		if(!empty($image)){
			$img="/files/dynamic_pages/preview/$image";
		}

		$children=$page_details['children'];
		 ?>

		<div class="internalText">
			<div class="internalTopBorder col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>

			<?php if($show_brand_details == 1){
				?>

				<div class="floatClass backBtn"><a  onclick="get_brand_content('<?=$back_url?>' , 'back'); return false; " href="<?=$back_url?>"><?=__("< Back to previous page",true)?></a></div>
				<div style="top: 0px;" class="BrandContentAjaxLoader" id="internalContentAjaxLoader_back"><img src="/img/ajax-loader.gif" width="20" height="20" alt=""/></div>
			<?php } ?>
			<?php if(!empty($image)){
				?>
				<div class="floatClass internalImg col-lg-12 col-md-12 col-sm-12 col-xs-12"><img class="img-responsive" src="<?=$img?>" alt=""/></div>
				<?php
			} ?>

			<?php if($show_brand_details == 1){
				?>
				<div class="floatClass brandEmail" ><a href="<?=$email?>" target="_blank"><?=$email?></a></div>
				<?php
			} ?>

			<div class="floatClass "><?php  echo $text ?></div>
			
			<div class="floatClass col-lg-10 col-md-10 col-sm-12 col-xs-12 subPageImageContainer">
				<?php
					if(!empty($children)){
						$index=1;
						foreach($children as $sub){
							$id=$sub['DynamicPage']['id'];
							$title=$sub['DynamicPage']['title'];
							$slug=$sub['SeoManagement']['slug'];
							$image=$sub['DynamicPage']['image'];
							$img='';
							if(!empty($image)){
								$img="/files/dynamic_pages/thumb/$image";
							}

							$url="/$lang/DynamicPages/our_brands/$category_id/$id/$slug";
							
							// $margin='';
							// if(($index % 4 )  == 0){
							// 	$margin='0px;';
							// }
							?>
							<div class="floatClass subPageImageRow" style="margin:10px;">
								<div class="BrandContentAjaxLoader" id="internalContentAjaxLoader_<?=$id?>"><img src="/img/ajax-loader.gif" width="20" height="20" alt=""/></div>
								<a onclick="get_brand_content('<?=$url?>' , '<?=$id?>'); return false; " href="<?=$url?>"><img src="<?=$img?>"  alt='<?=$title?>' /></a>
							</div>

							<?php
						$index++;
						}
					}
				 ?>
			 </div>
		</div>

<?php if($isAjax == false){ ?>
	</div>
<?php  } ?>