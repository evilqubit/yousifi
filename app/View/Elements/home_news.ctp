<div class="floatClass home_news_event_outer_container">
	<div class="home_news_event_container">
		<!-- <div class="hcmPrev"><div class="floatClass hcmPrevArrow"></div></div> -->
		<div class="floatClass" id="homeNewsCycle">
			
			<!-- /////////// excutive content		//////// -->
			
			
			<div style='clear: both;'>
			<?php
			if(!empty($excutiveSection)){
					$title=$excutiveSection['HomeBox']['title'];
					$text=$excutiveSection['HomeBox']['text'];
					$image_title=$excutiveSection['HomeBox']['botton_title'];
					$url='/ExecutiveMasterE&R';
					 ?>
					<div class="floatClass home_news_event_content" >
						<div class="floatClass excutive_text_content">
							
							<div class="floatClass latest_news">
								<a href="<?=$url?>">
									<span class="news_font">
										<?php 
									
									//if($lang =='en'){
										// $new_title = explode(" ", $title);
										// $counter=count($new_title);
										// if($counter > 5){
											// $after_title=implode(" ", $new_title);
											// //get only the words from 0 to 5
											// $new=array_splice($new_title, 0,6);
											// $after_title=implode(" ", $new);
										// }else{
											// $after_title=implode(" ", $new_title);
										// }
										$new_title= $this->Text->truncate($title,37,array("...",true , 'exact'=>false));
										
										
									echo $new_title?>
									</span>
								</a>
							</div>
							<div class="floatClass excutive_details_content">
								
								<div class="floatClass excutive_text_details">
									<a href="<?=$url?>">
									<?php 
									if($lang =='en'){
										$new_text= $this->Text->truncate($text,511,array(" ",true));
									}else{
										$new_text= $this->Text->truncate($text,511,array(" ",true));
									}
									echo $new_text?></a>
									
								</div>
								
								
							</div>
							<div class="floatClass HomeApplicationFileElement">
					 			<div class="floatClass HomeApplicationFileIcon"></div>
					 			<div class="floatRevClass HomeApplicationFileElementText"><a href="<?=$url?>"><?php
					 					$bottom_title = explode(" ", $image_title);
										$counter=count($bottom_title);
										if($counter > 5){
											$after_title=implode(" ", $bottom_title);
											//get only the words from 0 to 5
											$new=array_splice($bottom_title, 0,5);
											$after_title=implode(" ", $new);
										}else{
											$after_title=implode(" ", $bottom_title);
										}
					 			
					 					echo strtoupper($after_title)?></a>
					 			</div>
					 		</div>
							
						</div>
						
						
					</div>
					<!-- ./////news 	////  -->
					
					<?php 
					$row_index=0;
					
					foreach ($home_news as $news){
						$id = $news["News"]['id'];
						$title = $news["News"]['title'];
						$img = $news["News"]['image'];
						$short = $news["News"]['short'];
						$fb_like = $news["News"]['fb_like'];
		
						$url="/$lang/News/view_news/$id/0";
						$readMore_url="/$lang/News/index/";
						
						
						if(!empty($img)){
							$image_path="/files/news/thumb/$img";
						}else{
							$image_path="/img/news/hbku_default_news_thumb.jpg";
						}
							
					
						if($row_index == 1)break;
					  ?>
					<div class="floatClass home_news_event_content" style="margin: 0px;">
						<div class="floatClass news_text_content">
							<div class="floatClass latest_news">
								<a href="<?=$url?>">
									<span class="news_font"><?=__('News_Events',true);?></span>
								</a>
							</div>
							<div class="floatClass news_details_content">
								<div class="floatClass news_title"><a href="<?=$url?>">
									<?php 
									
									
										// $new_title = explode(" ", $title);
										// $counter=count($new_title);
										// if($counter > 5){
											// $after_title=implode(" ", $new_title);
											// //get only the words from 0 to 5
											// $new=array_splice($new_title, 0,5);
											// $after_title=implode(" ", $new);
										// }else{
											// $after_title=implode(" ", $new_title);
										// }
									$new_title= $this->Text->truncate($title,37,array("...",true , 'exact'=>false));
									//echo $after_title."..."
									echo $new_title;
									?></a>
								</div>
								<div class="floatClass news_text_details">
									<a href="<?=$url?>">
									<?php 
									if($lang =='en'){
										$new_text= $this->Text->truncate($short,195,array("...",true));
									}else{
										$new_text= $this->Text->truncate($short,150,array("...",true));
									}
									
									echo $new_text?></a>
									
								</div>
								
								
							</div>
							<div class="floatClass home_news_bottom_section">
								<?php $full_url=Configure::read('WEBSITE_URL').$url;?>
								<div class="floatClass readmore"><a href="<?=$url?>"><?=__('read more',true)?></a></div>
							</div>
						</div>
						<div class="floatClass home_news_img"><a href="<?=$url?>"><img src="<?=$image_path?>" alt=""/></a></div>
					</div>
					<?php $row_index++;}
						echo "</div>";

			}else{	 ?>
					
			
			
			
			
			
			
			
			
			<!--///////////////////////////////////////////////  -->
			<?php 
			$row_index=0;
			$index=1;
			$total=count($home_news);
			foreach ($home_news as $news){
				$id = $news["News"]['id'];
				$title = $news["News"]['title'];
				$img = $news["News"]['image'];
				$short = $news["News"]['short'];
				$fb_like = $news["News"]['fb_like'];
				
				
				if(!empty($img)){
					$image_path="/files/news/thumb/$img";
				}else{
					$image_path="/img/news/hbku_default_news_thumb.jpg";
				}
						
						
				$url="/$lang/News/view_news/$id/0";
				
				$readMore_url="/$lang/News/index/";
			 if (($row_index % 2) == 0){
				echo "<div style='clear: both;'>";
				}
			 $margin='';
			 if (($index % 2) == 0){
			 	if($lang =='en'){
			 		$margin="margin-right: 0px"; 
			 	}else{
			 		$margin="margin-left: 0px";
			 	}
				//$margin='0px';
				}
			 
			  ?>
			<div class="floatClass home_news_event_content" style="<?=$margin?>">
				<div class="floatClass news_text_content">
					
					<div class="floatClass latest_news">
						<a href="<?=$url?>">
							<?php
							if($index ==1) echo __('Latest',true);?>
							
							<?php if($index == 2) {?>
								<span class="news_font"><?=__('Events',true);?></span>
							<?php }else{ ?>
								<span class="news_font"><?=__('News',true);?></span>
							<?php }?>
							
						</a>
					</div>
					<div class="floatClass news_details_content">
						<div class="floatClass news_title"><a href="<?=$url?>">
							<?php 
							
							//if($lang =='en'){
								// $new_title = explode(" ", $title);
								// $counter=count($new_title);
								// if($counter > 5){
									// $after_title=implode(" ", $new_title);
									// //get only the words from 0 to 5
									// $new=array_splice($new_title, 0,5);
									// $after_title=implode(" ", $new);
								// }else{
									// $after_title=implode(" ", $new_title);
								// }
								
								$new_title= $this->Text->truncate($title,37,array("...",true , 'exact'=>false));
								
								//$new_title = $this->Text->truncate($title,45,array("...",true));
							// }else{
								// $new_title = $this->Text->truncate($title,55,array("...",true));
							// }
							//echo $after_title."..."
							echo $new_title;
							?></a>
						</div>
						<div class="floatClass news_text_details">
							<a href="<?=$url?>">
							<?php 
							if($lang =='en'){
								$new_text= $this->Text->truncate($short,195,array("...",true));
							}else{
								$new_text= $this->Text->truncate($short,150,array("...",true));
							}
							echo $new_text?></a>
							
						</div>
						
						
					</div>
					<div class="floatClass home_news_bottom_section">
						<?php 
						
						$full_url=Configure::read('WEBSITE_URL').$url;
						?>
						<div class="floatClass readmore"><a href="<?=$url?>"><?=__('read more',true)?></a></div>
						<?php
						//$this->element('smo/smo_bar',array("pageUrl"=>$full_url,'title'=>$title,"fb_like"=>$fb_like))
						?>
					</div>
				</div>
				<div class="floatClass home_news_img"><a href="<?=$url?>"><img src="<?=$image_path;?>" /></a></div>
				<!-- <img src="/files/header_communication_banners/preview/<?php echo $hcmImg;?>" title="" alt=""/> -->
			</div>
						
			<?php 
			$index++;
			$row_index++;
			if ((($row_index % 2) == 0) || ($row_index == $total)){
				echo "</div>";
			} ?>
			
			<?php }
			
			}?>
		</div>
		
		<!-- <div class="hcmNext"><div class="floatClass hcmNextArrow"></div></div> -->
	</div>
	<!-- <div class="floatRevClass HomeReadmore"><a href="<?=$readMore_url?>"><?=__('read more',true)?></a></div> -->
	
	<!-- <div class="floatRevClass  homeNewsNavigationContainer">
		<div class="floatClass news_nav_prev" onclick="$('#homeNewsCycle').cycle('prev');"></div>
		<div  id="nav"></div>
		<div class="floatClass news_nav_next" onclick="$('#homeNewsCycle').cycle('next');"></div>
	</div> -->
</div>




<script type="text/javascript">




$(document).ready(function(){

});
</script>

<!--
		$("#homeNewsCycle").cycle({
		fx:"scrollHorz",
		timeout:0,
		
  		after:  function(currSlideElement, nextSlideElement, options, forwardFlag){
  			
  			if(options.currSlide != 0){
  				//FB.XFBML.parse();
  			}
	   	// 
	   },
		pager:"#nav",
		cleartypeNoBg: true,
		pagerAnchorBuilder: function(index, el) {
			index=parseInt(index)+1;
			var new_index=index;
			<?php  if ($lang == 'ar'){?>
				new_index=parse_arabic_numbers(index);
			<?}?>
			
	        return "<a class='news_nav_elemnt'>"+new_index+"</a>";
  			 }
    	
	});
	
	 -->