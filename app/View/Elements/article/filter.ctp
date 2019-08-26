

<style type="text/css">
	 .customSelect {
    /* This is the default class that is used */
    /* Put whatever custom styles you want here */
    }
    .customSelect.customSelectHover {
    /* Styles for when the select box is hovered */
    }
    .customSelect.customSelectOpen {
    /* Styles for when the select box is open */
    }
    .customSelect.customSelectFocus {
    /* Styles for when the select box is in focus */
    }
    .customSelectInner {
    /* You can style the inner box too */
    }
</style>
<?php 
	$url="/$lang/Sections/articles";
	 ?>

<div class="ArticleFilterContainer">
	
	<div class="floatClass articleYearFilter">			
		<select  id="articleYearList" onchange="update_filter_year()" class="articleYearList floatClass" name="data[Page]">		
		<?php
		
		if(!isset($selected_year) || $selected_year == 0){
		?>
			<option value="" selected="selected" style="display:none"><?=__("year",true)?></option>
		<?php
		}
		
		
		$year_title=__("year",true);
		$selected_category_id=0;
		$year_index=0;
		foreach($category_list as $year=>$month){
			$year_formated=$this->NumbersFormat->formatNumber($year,$locale,0);
			
			$selected='';
			if(isset($selected_year)){
				if($year == $selected_year){
					$selected='selected';
				}
			}
			
			$year_id='';
			if($year_index == 0){
				$year_id='first_year';
			}
			
			?>
			<option id="<?=$year_id?>" value="<?=$year?>" <?=$selected?>><?="$year_title ".$year_formated?></option>
		<?php 
			$year_index++;			
		}
		?>
		</select>	
	</div>
	
	<div class="floatClass articleYearFilter">	
		<select onchange="articleFind('<?=$url?>')"  id="articleMonthList" class="articleYearList floatClass" name="data[Page]">	
		
		<?php
		
		if(!isset($selected_month) || $selected_month == 0){
		?>
			<option value="" selected="selected" style="display:none"><?=ucwords(__("month",true))?></option>
		<?php
		} ?>
			
			<?php 
			$month_index=0;
			for ($m = 1;$m < 13; $m++){
				
					$selected='';
					if(isset($selected_month)){
						if($m == $selected_month){
							$selected='selected';
						}
					}
				$month_formated=$this->NumbersFormat->get_month_name($m,$locale,array("month_format"=>"long"));
				
				$month_id='';
				if($month_index == 0){
					$month_id='first_month';
				}
			
			?>
					
				<option id="<?=$month_id?>" value="<?=$m?>" <?=$selected?>><?=$month_formated?></option>
			<?php $month_index++; } ?>
	
		</select>
	</div>
	<!--<div class="floatClass articleYearFilter">	
		<?php 
//		$index=1;
//		foreach($category_list as $year=>$month){
//			$display="";
//			if(isset($selected_year)){
//				if($year == $selected_year){
//					$display="";
//				}else{
//					$display="none";
//				}
//			}else{
//				if($index > 1){
//					$display="none";
//				}
//			}
//			
			
			?>
		<div class="articleMonthListContainer" id="articleMonthListContainer_<?//=$year?>" style="display: <?//=$display?>" >	
			<select  id="articleMonthList_<?//=$year?>" class="articleYearList floatClass" name="data[Page]">		
				<?php
				
//				$selected_category_id=0;
//				foreach($category_list[$year] as $month){
//					
//					
//					$selected='';
//					if(isset($selected_month)){
//						if($month == $selected_month){
//							$selected='selected';
//						}
//					}
//					
//			
//					$month_formated=$this->NumbersFormat->get_month_name($month,$locale);
					?>
					<option value="<?//=$month?>" <?//=$selected?>><?//=$month_formated?></option>
				<?php 				
//				}
				?>
			</select>
		</div>
		<script type="text/javascript">
			$("#articleMonthList_<?//=$year?>").customSelect();
		</script>
		
		<?php
//		$index++; 		 		
//		}
		?>
	</div>-->
	
	<div class="floatClass articleFind" onclick="articleFind('<?=$url?>')"><?=__("Search",true)?> </div>
	<div class="floatClass filterAjax"><img src="/img/ajax-loader.gif" width="20" height="20p" alt=""/></div>
</div>


<script type="text/javascript">
	$(document).ready(function (){
		$("#articleYearList").customSelect();
		$("#articleMonthList").customSelect();
	});
</script>