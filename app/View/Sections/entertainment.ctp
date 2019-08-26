<div class="row entertainment">
	<ul class="entertainment-menu type-2">
		<?php 
		foreach($cinema_category_list as $cinema_cat){
			$id=$cinema_cat['Category']['id'];
			$title=$cinema_cat['Category']['title'];
			$slug=$cinema_cat['SeoManagement']['slug'];
			
			$url="/Sections/entertainment/$id/$slug";
			
			$class='';
			if($id == $active_category_id){
				$class='current';
			}
			
			?>
			
			<li class="<?=$class?>"><a href="<?=$url?>"><?=$title?></a></li>
			<?php 
			
		}
		 ?>
		
		
		<!-- <li><a href="#">coming soon</a></li>
		<li><a href="#">movies out this thursday</a></li> -->
	</ul>
	<section class="entertainment-list">
		
		
		<?php 
		foreach($movies_list as $movie){
			$id=$movie['Cinema']['id'];
			$title=$movie['Cinema']['title'];
			$image=$movie['Cinema']['image_1'];
			$slug=$movie['SeoManagement']['slug'];
			$vip=$movie['Cinema']['vip'];
			$_3d=$movie['Cinema']['3d'];
			
			$show_time=$movie['ShowTime'];
			
			$view_url="/Cinemas/view/$id/1/$slug/";
			$showtime_url="/Cinemas/view/$id/0/$slug/";
			
			$image = "/files/cinemas/list/$image";
			?>
			
			
			<article style="height: 323px;">
				<img src="<?=$image?>" alt="<?=$title?>">
				
				<div class="cinemaFeatures" >
				<?php if($vip == 1){ ?>
				<span class="vip">VIP</span>
				<?php } ?>
				
				<?php if($_3d == 1){
					$margin='';	
					if($vip == 1){
						$margin='2px';
					}
					
					 ?>
				<span class="vip" style="margin-left: <?=$margin?>">3D</span>
				<?php } ?>
				</div>
				
				<div class="hover">
					<a class="btn btn-primary" href="<?=$view_url?>">view trailer</a>
					<?php if(isset($show_time) && !empty($show_time)){ ?>
						<a class="btn btn-primary" href="<?=$showtime_url?>">showtimes</a>
					<?php } ?>
				</div>
			</article>
		
		
			<?php 
			
		}
		
		?>
		
		
	</section>            
</div>