<header id="header">
		<div class="container">
			<div class="row">
				<a href="/" id="logo" title="LeMall">LeMall</a>
				<ul class="head-bar">
					<li id="about"><a href="/Sections/about">About LeMall</a></li>
					<li id="careers"><a href="/Sections/careers">Careers</a></li>
					<li id="leasing"><a href="/Sections/leasing">Leasing</a></li>
					<li id="contact"><a href="/Sections/contact">Contact Us</a></li>
				</ul>
				<div class="menu-trigger"></div>
				<nav id="menu">
					<ul>
						<li id="shopping" ><a href="/Sections/index/shopping">Shopping</a></li>
						<li id="cafes_and_restaurants"><a href="/Sections/index/cafes_and_restaurants">Cafes &amp; Restaurants</a></li>
						<li id="beauty"><a href="/Sections/index/beauty">Beauty</a></li>
						<li id="entertainment"><a href="/Sections/index/entertainment">Entertainment</a></li>
						<li id="services"><a href="/Sections/services">Services</a></li>
						<!-- /Sections/services -->
						<!-- <li id="loyalty"><a href="#">Loyalty</a></li>
						<li><a href="#">media room</a></li> -->
						<li id="our_location"><a href="/Sections/our_location">Our Locations</a></li>
						<?=$this->element("/search/search")?>
					</ul>
				</nav>
				<!-- / navigation -->
				
				<?php
				
					if(isset($active_main_menu)){	
						
						if($active_main_menu == 'shopping' || $active_main_menu == 'cafes_and_restaurants' || $active_main_menu == 'beauty'){
						?>
						
						<?php if($active_main_menu == 'shopping'){ ?>
							<div class="sub-menu-trigger">Shopping</div>
						<?php  } ?>
						<?php if($active_main_menu == 'cafes_and_restaurants'){ ?>
							<div class="sub-menu-trigger">Cafes &amp; Restaurants</div>
						<?php  } ?>
						<?php if($active_main_menu == 'beauty'){ ?>
							<div class="sub-menu-trigger">Beauty</div>
						<?php  } ?>
						
						<?php
						$class='';
						if(isset($temp_id) && ($temp_id == 2)){
							$class='type-2';
						}
						 ?>
						
						
						<div class="sub-menu <?=$class?>" >
							<ul>
								
								<?php
								foreach($section_categories_list as $sub_cat){
									$id=$sub_cat['Category']['id'];
									$title=$sub_cat['Category']['title'];
									$section_id=$sub_cat['Category']['section_id'];
									$slug=$sub_cat['SeoManagement']['slug'];
									
									
									if(isset($temp_id) && ($temp_id == 2)){
										$url="/Shops/temp_2/$section_id/$id/$slug";
									}else{
										$url="/Shops/index/$section_id/$id/$slug";
									}
									
									
									
									$active_class='';
									if(isset($active_sub_category)){
										if($active_sub_category == $id){
											$active_class='current';
										}
									}
									
									
									?>
									
									<li class="<?=$active_class?>" ><a href="<?=$url?>"><?=$title?></a></li>
									<?php 
								}
								 ?>
								
							</ul>
						</div>
						
						
						
						
						<?php
							//show brand filter
							echo $this->element("/filter/brand");
							
							
						}elseif($active_main_menu == 'careers' || $active_main_menu == 'vacancies' || $active_main_menu =='job_application' ){
							////////////////////////////////////////////			careers		///////////////////////
							?>
							
							
							
							<!-- <div class="sub-menu" >
								<ul>
									
									<?php
									//print_r($section_categories_list);exit;
									foreach($section_categories_list as $key=>$sub_cat){
										
										$title=$sub_cat['title'];
										$cat_section=$sub_cat['section'];
										$slug=$sub_cat['slug'];
										
										
										if($key == 2){
											$url="/Sections/$cat_section/0/$slug";
										}else{
											$url="/Sections/$cat_section/$slug";
										}
										
										
										
										
										$active_class='';
										if(isset($active_main_menu)){
											if($active_main_menu == $cat_section){
												$active_class='current';
											}
										}
										
										
										?>
										
										<li class="<?=$active_class?>" ><a href="<?=$url?>"><?=$title?></a></li>
										<?php 
									}
									 ?>
									
								</ul>
							</div> -->
						
						
							<?php 
							
						}elseif($active_main_menu == 'entertainment' || $active_main_menu == 'kids_zone' || $active_main_menu == 'events' || $active_main_menu == 'entertainment_landing'){
							////////////////////////////////////////////			entertainment		///////////////////////
							?>
							
							
							<div class="sub-menu-trigger">Entertainment</div>
							
							
							<div class="sub-menu" >
								<ul>
									
									<?php
									//print_r($section_categories_list);exit;
									foreach($section_categories_list as $key=>$sub_cat){
										
										$title=$sub_cat['title'];
										$cat_section=$sub_cat['section'];
										// $slug=$sub_cat['slug'];
										
										
										if($cat_section == 'kids_zone'){
											
											$url="/Shops/$cat_section";
										}else{
											$url="/Sections/$cat_section";
										}
										
										
										
										$active_class='';
										if(isset($active_main_menu)){
											if($active_main_menu == $cat_section){
												$active_class='current';
											}
										}
										
										
										?>
										
										<li class="<?=$active_class?>" ><a href="<?=$url?>"><?=$title?></a></li>
										<?php 
									}
									 ?>
									
								</ul>
							</div>
						
						
							<?php 
							
						}elseif($active_main_menu == 'leasing'){
							////////////////////////////////////////////			entertainment		///////////////////////
							?>
							
							
							<!-- <div class="sub-menu" >
								<ul>
									
									<?php
									//print_r($section_categories_list);exit;
									foreach($section_categories_list as $key=>$sub_cat){
										
										$title=$sub_cat['title'];
										$cat_section=$sub_cat['section'];
										// $slug=$sub_cat['slug'];
										
										
										$url="/Sections/$cat_section";
										
										
										$active_class='';
										if(isset($active_main_menu)){
											if($active_main_menu == $cat_section){
												$active_class='current';
											}
										}
										
										
										?>
										
										<li class="<?=$active_class?>" ><a href="<?=$url?>"><?=$title?></a></li>
										<?php 
									}
									 ?>
									
								</ul>
							</div> -->
						
						
							<?php 
							
						}
					}

					//// filter element
					echo $this->element("/filter/filter");

					?>

			</div>
		</div>
	</header>
	





<?php
if(!isset($active_main_menu)){
	$active_main_menu='';
}

 ?>
<script type="text/javascript">
	$(document).ready(function(){
		
		var active_main_menu='<?=$active_main_menu?>';
		
		
		
		switch(active_main_menu){
			
			case'shopping':{
				
				$('#shopping').addClass('current');
					
				break;
			}
			
			case'cafes_and_restaurants':{
				
				$('#cafes_and_restaurants').addClass('current');
					
				break;
			}
			case'beauty':{
				
				$('#beauty').addClass('current');
					
				break;
			}
			
			case'careers':{
				
				$('#careers').addClass('current');
					
				break;
			}
			
			case'vacancies':{
				
				$('#careers').addClass('current');
					
				break;
			}
			
			case'job_application':{				
				$('#careers').addClass('current');
					
				break;
			}
			
			
			case'services':{				
				$('#services').addClass('current');
					
				break;
			}
			
			case'about':{				
				$('#about').addClass('current');
					
				break;
			}
			
			case'contact':{				
				$('#contact').addClass('current');
					
				break;
			}
			
			case'entertainment':{				
				$('#entertainment').addClass('current');
					
				break;
			}
			
			case'entertainment_landing':{				
				$('#entertainment').addClass('current');
					
				break;
			}
			
			
			
			case'kids_zone':{				
				$('#entertainment').addClass('current');
					
				break;
			}
			case'events':{				
				$('#entertainment').addClass('current');
					
				break;
			}

			case'our_location':{				
				$('#our_location').addClass('current');
					
				break;
			}
			case'leasing':{				
				$('#leasing').addClass('current');
					
				break;
			}
			
		}
		
		
	});
	
	
</script>
