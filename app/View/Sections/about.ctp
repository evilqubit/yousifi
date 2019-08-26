<div class="row about-con">
	
	<?php 
	
	$main_title=$section_details['Section']['internal_title'];
	$text_1=$section_details['Section']['text_1'];
	$text_2=$section_details['Section']['text_2'];
	
	?>
	
	
	<div class="hold" style="position: relative; z-index: 1">
		<div class="right-info style-2" style="padding: 0px;">
			<!-- <div class="holder">
				<h3><span class="line-1">are</span><span class="line-2">you</span><span class="line-3">in<em>?</em></span></h3>
			</div> -->
			<?php
			if(!empty($images_larg_list)){
				foreach($images_larg_list as $im){
					$title=$im['Image']['title'];
					$image=$im['Image']['image'];
					
					$url=$im['Image']['url'];
					$image="/files/sections/preview/$image";
					$aStart="";
					$aEnd="";
					if(!empty($url)){
						$aStart="<a style='display:block;' href='$url'>";
						$aEnd="</a>";
					}
					
					
					if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
					        $url = "http://" . $url;
					    }
					
					?>
					<?php echo $aStart; ?>
						<img src="<?=$image?>" alt="<?=$title?>">
					<?php echo $aEnd;?>
					<?php 
				}
			}
			 ?>
		</div>
	</div>
	<div class="info" style="position: relative;">
		<div class="pics">
			
			<?php
			if(!empty($images_small_list)){
				foreach($images_small_list as $im){
					$title=$im['Image']['title'];
					$image=$im['Image']['image'];
					
					$url=$im['Image']['url'];
					$image="/files/sections/preview/$image";
					$aStart="";
					$aEnd="";
					if(!empty($url)){
						$aStart="<a href='$url'>";
						$aEnd="</a>";
					}
					?>
					<?php echo $aStart; ?>
						<img src="<?=$image?>" alt="<?=$title?>">
					<?php echo $aEnd;?>
					<?php 
				}
			}
			 ?>
			<!-- <img src="images/31.jpg" alt="">
			<img src="images/32.jpg" alt="">
			<img src="images/33.jpg" alt=""> -->
		</div>
		<div class="main-info">
			<h2><?=$main_title?></h2>
			<!-- <h3>Welcome to LeMall, a project by Acres Holding.</h3> -->
			<p><?=$text_1?></p>
			
			<div class="facts">
				<!-- <h4>Quick Facts</h4>
				<p><span>Opening Hours:</span> 10am to 12am for restaurants - 10am to 10pm for shops, <br>7 days a week.</p> -->
				<p><?=$text_2?></p>
			</div>
			<div class="accordion-content">
				
				
				<?php
				
				foreach($section_related_entries as $r){
					$title=$r['SectionRelatedEntry']['title'];
					$text=$r['SectionRelatedEntry']['text'];
					?>
					
					
					
					<div class="accordion-item">
						<p class="trigger"><?=$title?></p>
						<div class="accordion-info" >
							<p><?=$text?></p>
						</div>
					</div>
					
					<?php 
				}
				 ?>
				
				<!-- <div class="accordion-item">
					<p class="trigger">Title one goes here</p>
					<div class="accordion-info">
						<p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.</p>
					</div>
				</div>
				<div class="accordion-item">
					<p class="trigger">Title one goes here</p>
					<div class="accordion-info">
						<p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.</p>
					</div>
				</div> -->
			</div>
		</div>
	</div>
</div>