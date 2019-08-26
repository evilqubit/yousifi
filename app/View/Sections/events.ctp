<div class="row events">
	
	
	
	<div class="info" style="position: relative;">
		
		<?php 
		$title=$section_details['Section']['internal_title'];
		
		?>
		<h2><?=$title?></h2>
		<section >
			
			<?php
			foreach( $data as $job){
				$id=$job['Event']['id'];
				$title=$job['Event']['title'];
				$text=$job['Event']['short'];
				
				$image=$job['Event']['image'];
				$image="/files/events/thumb/$image";
				
				$start_date=$job['Event']['start_date'];
				$end_date=$job['Event']['end_date'];
				
				
				$url="";
				
				
				
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
				
				<?php 
			//}
			 ?>
				<article style="float: left; clear: both;">
					<div style="float:left; width: 149px; margin-right: 20px; margin-bottom: 10px;">
						<img src="<?=$image?>" alt="<?=$title?>">
					</div>
					<div class="infos" style="float: left; ">
						<div class="internal_event-info" style="float: left; text-align: left; clear: both; width: 100%;">
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
						<div style="float: left; text-align: left; clear: both;">
							<h3><?=$title?></h3>
							<p><?=$text?></p>
						</div>
						
					</div>
					<!-- <a class="btn btn-success" href="<?=$url?>">apply</a> -->
				</article>			
			<?php } ?>
	
		</section>
	</div>
	
	<div class="hold" style="position: relative; z-index: 1; float: right;">
		<div class="right-info style-2" style="padding: 0px;">
		<?php echo $this->element("/right_side_banners/right_side_banners") ?>
		</div>
	</div>
	
</div>