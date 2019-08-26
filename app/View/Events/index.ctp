<?php 
if(!$this->request->params["isAjax"]){?>

<div id='tabsContent' class="floatClass">
<?php }?>

<!-- <div style="margin-top:40px;">
	<div class="floatClass about_top_logo"><?=strtoupper(__("News",true))?></div>
	<div class="floatClass news_bottom_logo"><?=strtoupper(__("Events",true))?></div>
</div> -->
<div class="tabsContentLoader"><img src="/img/ajax-loader.gif" alt=""/></div>
<div class="floatClass news_event_outer_container">

		<?php 
		if(!empty($data)){
		?>
		<div class="floatClass albumContainer" id="paginatedContent">
			<!-- <div class="paginationDiv" id="paginationDiv1"><?php echo $this->element('paginator',array("paginationDivId"=>"paginationDiv1","modelName"=>$modelName));?></div> -->
	
			<div class="floatClass" style=" width: 980px; clear: both;">
				<?php 
				$row_index=0;
				$index=1;
				$total=count($data);
				foreach ($data as $news){
					$id = $news["News"]['id'];
					$title = $news["News"]['title'];
					
					//$new_title = $this->Text->truncate($title,37,array("...",true));
					// $new_title = explode(" ", $title);
					// $counter=count($new_title);
					// if($counter > 6){
						// $after_title=implode(" ", $new_title);
						// //get only the words from 0 to 5
						// $new=array_splice($new_title, 0,6);
						// $after_title=implode(" ", $new);
					// }else{
						// $after_title=implode(" ", $new_title);
					// }
					
					
					if($lang == 'ar'){
						$new_title= $this->Text->truncate($title,35,array("...",true , 'exact'=>false));
					}else{
						$new_title= $this->Text->truncate($title,43,array("...",true , 'exact'=>false));
					}
					
								
					$img = $news["News"]['image'];
					$short = $news["News"]['short'];
					$date = $news["News"]['date'];
					
					
					if(!empty($img)){
						$image_path="/files/news/list/$img";
					}else{
						$image_path="/img/news/hbku_default_news_list.jpg";
					}
					
					$full_date='';
					if(!empty($date)){
						$daten=$this->time->format('j-n-Y',$date);
					
						$fdate=explode("-", $daten);
					
						$full_date .= $this->NumbersFormat->formatNumber($fdate[0] ,$locale,0)."-";
						$full_date .= $this->NumbersFormat->formatNumber($fdate[1] ,$locale,0)."-";
						$full_date .= $this->NumbersFormat->formatNumber($fdate[2] ,$locale,0);
					
					}
						
						
					
					
					
					$fb_like = $news["News"]['fb_like'];
					$page_id=$this->params['paging']["$modelName"]['page'];
					//print_r($this->params['paging']["$modelName"]);
					$url="/$lang/News/view_news/$id/$page_id";
				 
					$margin='';
					if (($index % 3) == 0){
						if($lang == 'en'){
							$margin='margin-right:0px';	
						}else{
							$margin='margin-left:0px';
						}
						
					}
				  ?>
				<div class="floatClass news_event_content" style=" <?=$margin?>">
					<div class="news_inner_content_with_overflow">
						<div class="news_inner_content" id="news_<?=$id?>">
							<div class="floatClass news_inner_title_container">
								<div class="floatClass news_inner_title" onclick="show_news_short('<?=$id?>','<?=$fb_like?>' ,'<?=$page_id?>')"><?=$new_title?></div>
								<div class="floatClass news_up_arrow" id="arrow_<?=$id?>" onclick="show_news_short('<?=$id?>','<?=$fb_like?>' ,'<?=$page_id?>')"></div>
							</div>
							
							<div class="floatClass news_inner_date"><?=$full_date?></div>
							<div class="floatClass news_inner_short"><?=$short?></div>
							<div id="news_inner_social_media_<?=$id?>">
								
							</div>
							
						</div>
					</div>
					<div class="floatClass news_img"><a href="<?=$url?>"><img src="<?=$image_path;?>" alt=""/></a></div>
				</div>
							
				<?php 
					$index++;
				}?>
					
					
				</div>	
			<div class="paginationDiv floatRevClass" id="paginationDiv2"><?php echo $this->element('paginator',array("paginationDivId"=>"paginationDiv2","modelName"=>$modelName));?></div>
		</div>
	
		<?php
	
	}else{
		echo __("no_data",true);
	}
	?>
</div>
<?php 
if(!$this->request->params["isAjax"]){?>

</div>
<?php }?>


<script type="text/javascript">


	$(document).ready(function(){
		
	
	$('.news_inner_title').hover(function(){
		$(this).addClass('newsMouseOverActive');
		
	},function(){
		$(this).removeClass('newsMouseOverActive');
	});
	});
</script>
