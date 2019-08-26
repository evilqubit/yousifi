<?php 
if(!$this->request->params["isAjax"]){?>

<div id='tabsContent' class="floatClass">
<?php }?>

<div class="tabsContentLoader"><img src="/img/ajax-loader.gif" alt=""/></div>
<div class="floatClass internal_container">
	<?php 
	$id=$NewsDetails["$modelName"]['id'];
	$title=$NewsDetails["$modelName"]['title'];
	$text=$NewsDetails["$modelName"]['text'];
	$image=$NewsDetails["$modelName"]['image'];
	
	$url="/$lang/DynamicPages/t_index/$id";
	$fb_like=$NewsDetails["$modelName"]['fb_like'];
	
	
	if(!empty($image)){
		$image_path="/files/$userFilesFolder/preview/$image";
	}else{
		$image_path="/img/news/hbku_default_news_preview.jpg";
	}
	
	?>
	
	<div class="floatRevClass back_btn" onclick="show_news_details('<?=$backUrl?>')"><?=__('back',true)?></div>
	<!-- <div class="floatClass l_index_title" ><?=strtoupper($title);?></div> -->
	
	
	
	
	<div class="floatClass news_container">
		<div>
			<?php
			if(!empty($image_path)){?>
				
				<div class="floatClass news_image"><img src="<?=$image_path?>" alt=""/></div>
				<div class="floatClass news_index_text_container">
					<div class="floatClass news_index_text"><?=$text?></div>
					
					<div class="floatClass news_bottom_section">
						<?php 
						$full_url=Configure::read('WEBSITE_URL').$url;
						?>
						<?php
						//$this->element('smo/internal_smo_bar',array("pageUrl"=>$full_url,'title'=>$title,"fb_like"=>$fb_like))
						?>
					</div>
				</div>
				
			<?php }else{ ?>
				<div class="floatClass news_index_text_2">
					<div class="floatClass news_index_text_2"><?=$text?></div>
					
					<div class="floatClass news_bottom_section">
						<?php 
						$full_url=Configure::read('WEBSITE_URL').$url;
						?>
						<?php
						//$this->element('smo/internal_smo_bar',array("pageUrl"=>$full_url,'title'=>$title,"fb_like"=>$fb_like))
						
						?>
					</div>
				</div>
			
			<?php }?>
		</div>
	</div>
</div>
<?=$this->element('photo_gallery/photo_gallery',array('images_videos'=>$images_videos,"data"=>$NewsDetails,"main_title"=>$NewsDetails["$modelName"]['title']));?>

<?php 
if(!$this->request->params["isAjax"]){?>

</div>
<?php }?>



<script type="text/javascript">


	$(document).ready(function(){
		$('.news_container').jScrollPane({
			verticalDragMinHeight: 17,
			verticalDragMaxHeight: 17,
			autoReinitialise: true
		});
		
	});
</script>
