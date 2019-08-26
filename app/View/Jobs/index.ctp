<div class="floatClass internal_container">
	
	<div class="floatClass contactUsTitle_logo"><?=strtoupper(__('Careers',true))?></div>
	<div style="clear: both;">
	<div class="floatClass Jobs_container">
		<div>
			<div class="flaotClass jobsText"><?=$data["DynamicPage"]['text']?></div>
			
			<div class="floatClass jobListConatainer">
				<?php if(isset($jobs) && !empty($jobs)){?>
				<div class="floatClass jobListHeaderTitle"><?=strtoupper(__('Job vacancies',true))?></div>
				<?php } ?>
				<?php 
					$total=count($jobs);
					$index=0;
					$row_index=0;
					if(isset($jobs) && !empty($jobs)){
					foreach ($jobs as $job){
							$id = $job["$modelName"]["id"];
							$title = $job["$modelName"]["title"];
							$text = $job["$modelName"]["text"];
							
						
						
					if (($row_index % 3) == 0){
							echo "<div style='clear: both;'>";}
					?>
					
					<div class="floatClass job_list_container">
						<div class="floatClass job_title"><?=$title?></div>
						<div class="floatClass job_list_text"><?=$text?></div>
					</div>
					<?php 
					
					 
					$row_index++;
					if (($row_index % 3) == 0 || ($total == $row_index)){
						echo "</div>";
					}
					
					}
					}
				?>
				
			</div>
			<?php if(isset($jobs) && !empty($jobs)){?>
			<div class="floatClass applyContainer">
				<?php $url=Configure::read('job');
				if(!empty($url)){
				?>
				
				<div class="apply_btn"><a target="_blank" href="<?=$url?>"><?=strtoupper(__('applay now',true))?></a></div>
				<?php } ?>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
</div>

<script type="text/javascript">


	$(document).ready(function(){
		$('.Jobs_container').jScrollPane({
			verticalDragMinHeight: 17,
			verticalDragMaxHeight: 17,
			autoReinitialise: true
		});
		
	});
</script>
