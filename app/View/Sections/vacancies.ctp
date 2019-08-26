<?php 

if($is_ajax == false){
	
	
	if($career_ajax == false){
		echo $this->element("/header/about_us_menu");	
	}
	
	if($career_ajax == false){
		
		echo "<div id='about_sections'>";	
	}	
	
	
}
 ?>



<?php if($career_ajax == false){ ?>
		
		
		
	<div class="floatClass textArea  addTopSpace addBottomSpace" id="FilterContent">
	<?php 	
	$text=$section_details["Section"]['text_1'];
	?>
	<div class="floatClass textArea"><?=$text?></div>


	
		
	 
	 
	 <div class="floatClass " style="width: 980px"  id="paginatedContent">
		<div class="floatClass careerFormTitle" style="width: 480px;"><?=__("Job_vacancies",true)?></div>
		<?php } ?>
		<div class="ajaxLoader"><img src="/img/ajax-loader.gif" width="20" height="20" alt=""/></div>
		<div style="margin-bottom: 10px;" class="paginationDiv floatClass" id="paginationDiv1"><?php echo $this->element('career_paginator',array("paginationDivId"=>"paginationDiv1","modelName"=>'Job'));?></div>
		
		
	<?php 
	
	if(isset($job_details_list) && !empty($job_details_list)){
		
		
		 ?>
		<div class="floatClass careerList">
			
			
			<ul data-direction="vertical" class="-accordion -accordion--basic -accordion--vertical">
	 
			<?php 
			$job_index=0;
			$index=0;
			foreach( $job_details_list as $job){
				$id=$job['Job']['id'];
				$title=$job['Job']['title'];
				$text=$job['Job']['text'];
				
				$onclick="select_job('$id')";
				
				if(isset($selected_job_id) && !empty($selected_job_id)){
					if($selected_job_id == $id){
						$job_index=$index;
					}
				}
				
				?>
				  <li class="-accordion__panel" id="job_list_<?=$id?>" >
				    <span class="-accordion__heading" onclick="<?=$onclick?>"><?=$title?><i class="-icon -icon--right"></i></span>
				    <div class="-accordion__expander">
				    	<div class="" ><?=$text?></div>
				    	<div class=" careerNote" ><?=__("career_note",true)."<a href='mailto:hrd@equinox.com.qa' >hrd@equinox.com.qa”</a>"?></div>
				    </div>
				    
				  </li>			
				<?php 	
				$index++;		
			}		
			?>
			</ul>
		</div>
	<?php }else{?>
		
		<div class="floatClass no_vacancies"><?=__("no_vacancies",true)?></div>
		<?php 
	} ?>
	</div>	
	
	
	<?php 
	
	if(isset($job_details_list) && !empty($job_details_list)){
		?>
		<script type="text/javascript">
	$(document).ready(function(){
		
		$('.-accordion').asAccordion({
		    namespace: '-accordion',
		    // accordion theme. WIP
		    skin: null,
		 
		    // breakpoint for mobile devices. WIP
		    mobile_breakpoint: 768,
		 
		    // initial index panel
		    initialIndex: <?=$job_index?>,
		 	
		    // CSS3 easing effects.
		    easing: 'ease-in-out',
		 
		    // animation speed.
		    speed: 500,
		 
		    // vertical or horizontal
		    direction: 'vertical',
		 
		    // jQuery mouse events. click, mousehover, etc.
		    event: 'click'
		  });
		  
	});
	</script>
	<?php } ?>
	
		
	<?php if($career_ajax == false){ ?>
	</div>	
	</div>	
	<?php } ?>




<script type="text/javascript">
	$(document).ready(function(){
		
		$("#job_list").customSelect();
		$("#nationality_country_id").customSelect();
		$("#gender").customSelect();
		$("#residence_country_id").customSelect();
		
		
		$("#position_country_id").customSelect();
		
		
	});
</script>

