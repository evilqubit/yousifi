<?php if($isAjax == false){ ?>

	<div class="floatClass col-lg-3   internalLeftMenu" style="margin-top: 80px;">
		<?=$this->element("/header/left_menu_multi")?>
	</div>
	<div class="floatClass mainCategoryContainer">
		<?php
		$locale="/$lang/DynamicPages/business/our_business_local";
		$international="/$lang/DynamicPages/business/our_business_international";

		$locale_active='';
		$international_active='';
		if($sub_section == 'our_business_local'){
			$locale_active='bisnessSectionsActive';
			$international_active='';
		}else{
			$locale_active='';
			$international_active='bisnessSectionsActive';
		}


		?>
		<div class="floatClass bisnessSections <?=$locale_active?>"><a href="<?=$locale?>"><?=__("LOCAL",true)?></a></div>
		<div class="floatClass bisnessSections <?=$international_active?>"  ><a href="<?=$international?>"><?=strtoupper(__("international",true))?></a></div>
	</div>
	<div class="floatClass col-lg-9 col-md-12 col-sm-12 col-xs-12 internalContent" style="margin-top: 20px;">

		<?php  } ?>
		<?php
		if(!empty($page_details)){
			$text=$page_details['DynamicPage']['text'];
			$image=$page_details['DynamicPage']['image'];
			$children=$page_details['children'];
		}else{
			$text = "";
			$image = "";
			$children = "";
		}
		 ?>

		<div class="internalText">
			<div class="internalTopBorder col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 floatClass "><?php  echo $text ?></div>
			<?php if(!empty($image)){ ?>
				<img src="/files/dynamic_pages/thumb/<?= $image ?>" class="col-lg-6 col-md-6 col-sm-12 col-xs-12 floatClass " alt=""></img>
			<?php } ?>


			<div class="floatClass col-lg-12 col-md-12 col-sm-12 col-xs-12 subSectionMenuContainer">
			<?php

			if(!empty($children)){
				$index=0;
				foreach($children as $ch){
					$id=$ch['DynamicPage']['id'];
					$title=$ch['DynamicPage']['title'];
					$url='';
					$subActivClass='';
					if($index == 0){
						$subActivClass='subSectionMenuLinkActive';
					}

					?>

					<div class="floatClass subSectionMenuLink <?=$subActivClass?>" id="subMenuElement_<?=$id?>"><a onclick="show_sub_content('<?=$id?>'); return false;" href="<?=$url?>" ><?=$title?></a></div>

					<?php
					$index++;
				}

				?>



			<?php if(!empty($children)){
				$index = 0;
				foreach($children as $ch){
					$id=$ch['DynamicPage']['id'];
					$title=$ch['DynamicPage']['title'];
					$image=$ch['DynamicPage']['image'];
					$text=$ch['DynamicPage']['text'];

					$img='';
					if(!empty($image)){
						$img="/files/dynamic_pages/thumb/$image";
					}
					$sub_content_activeDisplay='none';
					if($index == 0){
						$sub_content_activeDisplay='block';
					}
					?>
					<!-- debug($img);die; -->

					<div style="display: <?=$sub_content_activeDisplay?>" class="floatClass col-lg-12 col-md-12 col-sm-12 col-xs-12  subContent" id="subContent_<?=$id?>">
						<?php if(!empty($img)){ ?>
							<div><img class="img-responsive" src="<?=$img?>" alt=""/></div>
						<?php  } ?>

						<div><?=$text?></div>
					</div>

					<?php
					$index++;
				}
			}

			} ?>

			</div>
		</div>

<?php if($isAjax == false){ ?>
	</div>
<?php  } ?>