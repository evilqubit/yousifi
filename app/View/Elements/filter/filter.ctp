<?php 
if(isset($show_filter) &&  $show_filter == 1 && !empty($filter_list)){
	?>
	
	<div class="filter-trigger">filter<span class="close-ico"></span></div>
	<div class="filter clearfix" style="min-height: 100px;">
		<form action="/Shops/filter" method="get">
			<div class="left">
				
				<?php
				
				$filter_counts=count($filter_list);
				$first_part= ceil($filter_counts/2);
				$second_part= $filter_counts - $first_part;
				
				$index=1;
				
				echo "<fieldset>";
				foreach($filter_list as $fi){
					
					$id=$fi['Filter']['id'];
					$title=$fi['Filter']['title'];
					
					
					if($index > $first_part ){
						break;
					}
					?>
					<input type="checkbox" name="data[Filter][]" value="<?=$id?>"><label class="check-box"><?=$title?></label>
					<?php
					$index++;
					
					
				}
				echo "</fieldset>";
				
				
				
				
				
				
				$index2=1;
				echo "<fieldset>";
				foreach($filter_list as $fi){
					
					$id=$fi['Filter']['id'];
					$title=$fi['Filter']['title'];
					
					
					if($index2 >= $index ){
						
					
					?>
					<input type="checkbox" name="data[Filter][]" value="<?=$id?>"><label class="check-box"><?=$title?></label>
					<?php
					}
					$index2++;
					
					
				}
				echo "</fieldset>";
				
				 ?>
				
					
				
				<!-- <fieldset>
					<input type="checkbox"><label class="check-box">lingerie</label>
					<input type="checkbox"><label class="check-box">shoes and bags</label>
				</fieldset> -->
			</div>
			
			
			<?php if($active_main_menu == 'shopping' || $active_main_menu == 'cafes_and_restaurants'){ ?>
				<div class="right">
					<label class="note">Select Branch</label>
					<select name="data[Branch]">
						
						<option style="text-transform: uppercase;" value="0" ><?=__("ALL BRANCHES",true)?></option>
						<?php foreach($branch_list as $key=>$br){
							?>
							<option style="text-transform: uppercase;" value="<?=$key?>" ><?=strtoupper($br)?></option>
							<?php 
						} ?>
						
					</select>
					<input placeholder="Or type keyword" name="data[text]" type="text">
					
					
					
					
					
					<input type="hidden" name="data[Category_id]" value="<?=$active_sub_category?>" />
					<input type="hidden" name="data[Section_id]" value="<?=$section_id?>" />
					
					
					<button class="btn btn-success" type="submit">Search</button>
				</div>
			<?php } ?>
		</form>
	</div>

	<?php 
}
 ?>