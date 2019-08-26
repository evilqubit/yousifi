<div class="holder-inner">
	
	
				<?php
				$title=$explore_overview['Banner']['id'];
				$image=$explore_overview['Banner']['image'];
				$text=$explore_overview['Banner']['text'];
				$url=$explore_overview['Banner']['url_1'];
				
				$img="/files/banners/preview/$image";
				 ?>
				<div class="overview">
					<h3 class="styled">Overview</h3>
					<img src="<?=$img?>" alt="">
					<p><?=$text?> <a href="<?=$url?>">more</a></p>
					<a class="btn btn-black btn-xs" href="/Sections/our_location">Our locations</a>
					<a class="btn btn-primary btn-xs" href="/Sections/leasing">Leasing</a>
				</div>
				
				
				
				
				<!-- static banner  -->
				<div class="banner">					
					<?php
					$url='#';
					$img='';
					if(isset($explore_static_banner)  && !empty($explore_static_banner)){
						$url=$explore_static_banner['Banner']['url_1'];
						$title=$explore_static_banner['Banner']['title'];
						$image=$explore_static_banner['Banner']['image'];
						
						$img="/files/banners/preview/$image";
					}
					 ?> 
					 <a href="<?=$url?>"><img src="<?=$img?>" alt=""></a>
				</div>
				
				
				
				
				<div class="holder">
					<h3 class="styled">Dining at lemall</h3>
					<div class="slider">
						<ul class="bxslider">
							
							<?php
							foreach($explore_dinning as $b){
								$title=$b['Banner']['title'];
								$url=$b['Banner']['url_1'];
								$image=$b['Banner']['image'];
								
								$img="/files/banners/preview/$image";
								
								$a_start='';
								$a_end='';
								if(!empty($url)){
									$a_start="<a href='$url' >";
									$a_end="</a>";
								}
								
								?>
								<li><?=$a_start?> <img src="<?=$img?>" alt=""><?=$a_end?> </li>
								<?php 
								}
							
							 ?>
							
							
							
						</ul>
					</div>
					<a class="btn btn-black btn-xs" href="/Sections/index/cafes_and_restaurants">View all restaurants</a>
				</div>
				
				
				
				<!-- cinema  -->
				<div class="gallery">
					<h3 class="styled">Showing now in cinemall</h3>
					<div class="carousel">
						<ul class="Cinema_bxslider">
							
							<?php 
							
							$total=count($showing_now);
							foreach($showing_now as $sn){
								
								$id=$sn["Cinema"]['id'];
								$title=$sn["Cinema"]['title'];
								$image=$sn["Cinema"]['image_1'];
								
								//print_R($id);
								
								$img="/files/cinemas/thumb/$image";
								$url='';
								
								?>
							
								<li style="width: 108px !important"> <a href="<?=$url?>"> <img src="<?=$img?>" alt=""> </a> </li>
								
								
								<!-- <li> <a href="<?=$url?>"> <img src="<?=$img?>" alt=""> </a> </li>
								<li> <a href="<?=$url?>"> <img src="<?=$img?>" alt=""> </a> </li>
								<li> <a href="<?=$url?>"> <img src="<?=$img?>" alt=""> </a> </li>
								<li> <a href="<?=$url?>"> <img src="<?=$img?>" alt=""> </a> </li>
								<li> <a href="<?=$url?>"> <img src="<?=$img?>" alt=""> </a> </li> -->
							<?php 
							}
							?>
						</ul>
					</div>
				</div>
			</div>
			


<script type="text/javascript">
	$(document).ready(function(){
		
		$('.Cinema_bxslider').bxSlider({
			minSlides: 6,
			maxSlides: 6,
			slideWidth: 108,
			slideMargin: 14,
			moveSlides: 1,
			infiniteLoop:false,
		});
	

	});
</script>