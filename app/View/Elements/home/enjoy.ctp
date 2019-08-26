<div class="holder-inner">
	<div class="events">
		<h3 class="styled">latest events</h3>
		<ul>
			
			
			<?php
					foreach($enjoy_events as $event){
						$id=$event['Event']['id'];
						$title=$event['Event']['title'];
						$start_date=$event['Event']['start_date'];
						$end_date=$event['Event']['end_date'];
						
						
						$is_one_day=0;
						if($start_date == $end_date){
							$is_one_day=1;
							$s_day=split("-", $start_date);
							$month=$s_day[1];
							$day=$s_day[2];

						}else{
							
							$s_day=split("-", $start_date);
							$month=$s_day[1];
							$start_day=$s_day[2];
							
							
							$e_day=split("-", $end_date);
							$month=$e_day[1];
							$end_day=$e_day[2];
						}
						
						$monthName = date('F', mktime(0, 0, 0, $month, 10)); // March
					?>
					
					<li>
							<div class="event-info">
								<p class="month"><?=strtoupper($monthName)?></p>
								
								<?php 
								if($is_one_day == 0){
									?>
									<p class="day dark"><?=$start_day?></p><p class="day dark"><?=$end_day?></p>
									<?php 
								}else{?>
									<p class="day"><?=$day?></p>
								<?php 	
								}
								?>
								
							</div>
							<p class="text"><?=$title?></p>
						</li>
			<?php 
					}
			?>		
							
							
			<!-- <li>
				<div class="event-info"><p class="month">April</p><p class="day">11</p></div>
				<p class="text">We havea winner! congratulations to geogio Bassil!</p>
			</li>
			<li>
				<div class="event-info"><p class="month">April</p><p class="day dark">7</p><p class="day dark">11</p></div>
				<p class="text">We havea winner! congratulations to geogio Bassil!</p>
			</li>
			<li>
				<div class="event-info"><p class="month">April</p><p class="day dark">7</p><p class="day dark">11</p></div>
				<p class="text">We havea winner! congratulations to geogio Bassil!</p>
			</li>
			<li>
				<div class="event-info"><p class="month">April</p><p class="day">11</p></div>
				<p class="text">We havea winner! congratulations to geogio Bassil!</p>
			</li>
			<li>
				<div class="event-info"><p class="month">April</p><p class="day dark">7</p><p class="day dark">11</p></div>
				<p class="text">We havea winner! congratulations to geogio Bassil!</p>
			</li> -->
		</ul>
	</div>
	
	
	
	<div class="event-detail">
		
		<div class="holder">
			<h3 class="styled">kids activities</h3>
			
			<?php
			$url='#';
			$img='';
			if(isset($enjoy_static_banner)  && !empty($enjoy_static_banner)){
				$url=$enjoy_static_banner['Banner']['url_1'];
				$title=$enjoy_static_banner['Banner']['title'];
				$text=$enjoy_static_banner['Banner']['text'];
				$image=$enjoy_static_banner['Banner']['image'];
				
				$img="/files/banners/preview/$image";
			}
			 ?> 
			 <a href="<?=$url?>"><img src="<?=$img?>" alt=""></a>
			
			<!-- <img src="images/12.png" alt=""> -->
			<h3><?=$title?></h3>
			<p><?=$text?><a href="<?=$url?>">more</a></p>
		</div>
		<div class="holder">
			<h3 class="styled">kids activities</h3>
			<div class="slider">
				<ul class="bxslider">
					
					<?php
					foreach($kids_activity as $b){
						$title=$b['Banner']['title'];
						$text=$b['Banner']['text'];
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
						<li><?=$a_start?> <img src="<?=$img?>" alt=""><?=$a_end?>							
							<p><?=$text?><a href="<?=$url?>">more</a></p>	
						</li>
						<?php 
						}
					
					 ?>
							 
							 
					<!-- <li><img src="images/12.png" alt=""></li>
					<li><img src="images/12.png" alt=""></li>
					<li><img src="images/12.png" alt=""></li> -->
				</ul>
			</div>
			
		</div>
	</div>
</div>


