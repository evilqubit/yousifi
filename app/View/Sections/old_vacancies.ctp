<div class="row vacancies">
	<div class="hold" style="position: relative; z-index: 1">
		<div class="right-info style-2" style="padding: 0px; background: none;">
			<!-- <div class="holder">
				<h3><span class="line-1">are</span><span class="line-2">you</span><span class="line-3">in<em>?</em></span></h3>
			</div> -->
			<?php
			if(!empty($images_list)){
				foreach($images_list as $im){
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
	<div class="info">
		
		<?php 
		$title=$section_details['Section']['title'];
		
		?>
		<h2><?=$title?></h2>
		<section>
			
			<?php
			foreach( $job_list as $job){
				$id=$job['Job']['id'];
				$title=$job['Job']['title'];
				$text=$job['Job']['text'];
				
				$url="/Sections/job_application/$id";
				
				?>
				
				<?php 
			//}
			 ?>
				<article>
					<h3><?=$title?></h3>
					<p><?=$text?></p>
					<a class="btn btn-success" href="<?=$url?>">apply</a>
				</article>			
			<?php } ?>
			<!-- <article>
				<h3>salesman</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
				<a class="btn btn-success" href="#">apply</a>
			</article>
			<article>
				<h3>salesman</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
				<a class="btn btn-success" href="#">apply</a>
			</article>
			<article>
				<h3>salesman</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
				<a class="btn btn-success" href="#">apply</a>
			</article>
			<article>
				<h3>salesman</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
				<a class="btn btn-success" href="#">apply</a>
			</article>
			<article>
				<h3>salesman</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
				<a class="btn btn-success" href="#">apply</a>
			</article>
			<article>
				<h3>salesman</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
				<a class="btn btn-success" href="#">apply</a>
			</article>
			<article>
				<h3>salesman</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
				<a class="btn btn-success" href="#">apply</a>
			</article> -->
		</section>
	</div>
</div>