<div class="holder-inner" style="background-color: #1e1e1e;">
				<div class="brand-gallery">
					<div class="carousel">
						<ul class="brand-carousel_new">
							
							
							<?php
							
							$index=0;
							foreach($shop_list as $shop){
								$id=$shop["Shop"]['id'];
								$title=$shop["Shop"]['title'];
								$top_layer_image=$shop["Shop"]['image_5'];
								$main_bottom_layer_image=$shop["Shop"]['bottom_layer_image'];
								$bottom_layer_text=$shop["Shop"]['bottom_layer_text'];
								
								
								$top_layer_image="/files/shops/thumb/$top_layer_image";
								$bottom_layer_image="/files/shops/preview/$main_bottom_layer_image";
								
								// $top_layer_image="/images/18.png";
								// $bottom_layer_image="/images/bottom.jpg";
								
								
								$bottom_layer_text= $this->Text->truncate($bottom_layer_text,195,array("...",'exact' => false));


								
								if($index > 4){
									$top_src="asrc='$top_layer_image'";
									
									$bottom_src="asrc='$bottom_layer_image'";
								}else{
									$top_src="src='$top_layer_image'";
									$bottom_src="src='$bottom_layer_image'";
								}
								
								
								$url="/Shops/view/$id";
								
								if(!empty($main_bottom_layer_image)){
								
								?>
								
								
								<!-- <li>
									<img src="images/18.png" alt="">
									<p>Phasellus vel nulla nec arcu consectetur gravida auctor quis metus. Nullam a dolor erat. Curabitur ac tincidunt odio. Vivamus auctor lacus eget ante tempus tristique.</p>
									<a class="btn btn-black btn-xs" href="#">Find out more</a>
								</li> -->
								
								
								
								<li  class="active mainLayer" style="padding-top:404px; background-position: center center; background-repeat: no-repeat; background: url(); ">
									<div style="top:0px; position: absolute; z-index: 999;"><img  class="bottom_slide_<?=$index?>"  <?=$bottom_src?> alt=""></div>
									<div class="homeShopTopLayer" style="z-index: 999999;" >
										<!-- <img style="margin-top: 304px;" src="<?=$top_layer_image?>" alt=""> -->
										<img  class="slide_<?=$index?>" style="margin-top: 198px; " <?=$top_src?> alt="">
										
										
									</div>
									
									<a style="width: 174px; height: 673px; position: relative; z-index: 1111; top:0px; left: 0px;" href="<?=$url?>"></a>
									<!-- <img src="<?=$top_layer_image?>" alt=""> -->
									<p style="background-color: transparent; position: relative; z-index: 99999; min-height: 190px;"><?=$bottom_layer_text?></p>
									<a style="position: relative;z-index: 99999;" class="btn btn-black btn-xs" href="<?=$url?>">Find out more</a>
									
									<script type="text/javascript">
										$('.mainLayer').hover(function(){
											
											$(this).find(".homeShopTopLayer").hide();
											
										},function(){
											$(this).find(".homeShopTopLayer").show();
										});
										
										
									</script>
								</li>
								<?php 
								$index++;
								}
							}
							
							 ?>
						</ul>
					</div>
				</div>
			</div>
			

<script type="text/javascript">
	$(document).ready(function (){
		$('.brand-carousel_new').bxSlider({
		minSlides: 2,
		maxSlides: 5,
		slideWidth: 174,
		slideMargin: 0,
		moveSlides: 1,
		onSlideNext : function(slideElement, oldIndex, newIndex){
			
			console.log(oldIndex);
			console.log(newIndex);
			index=newIndex+4;
			console.log(index);
			if ($(".slide_"+index).attr("asrc")) {
	          $(".slide_"+index).attr("src", $(".slide_"+index).attr("asrc"));
	          
	          $(".bottom_slide_"+index).attr("src", $(".bottom_slide_"+index).attr("asrc"));
	          
	          
	          
	        }
		},
		
		
		
		
	   onSlidePrev :  function($slideElement, oldIndex, newIndex){ 
	   		
			index=newIndex;
			console.log(index);
			if ($(".slide_"+index).attr("asrc")) {
	          $(".slide_"+index).attr("src", $(".slide_"+index).attr("asrc"));
	          
	          $(".bottom_slide_"+index).attr("src", $(".bottom_slide_"+index).attr("asrc"));
	          
	          
	          
	        }
	   	}
	});
	});
	
</script>