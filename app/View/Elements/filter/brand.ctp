<?php 
if(isset($show_brand)){
		if($show_brand == 1){
			?>
			<div class="select-brand tablet-no"><p>Select Brand</p>
				<select>
					
					<?php 
					foreach($brand_list as $b){
						$id=$b['Shop']['id'];
						$title=$b['Shop']['title'];
						
						$slug=$b['SeoManagement']['slug'];
						$url="/Shops/view/$id/$slug";
						$selected='';
						
						if($id== $selected_brand){
							$selected='selected="selected"';
						}
						
						?>
						<option <?=$selected?> onchange="update_brand('<?=$url?>')" ><?=$title?></option>
						<?php 
						
					}
					
					?>
					
				
				</select>
			</div>
			
			<?php 
		}
	}

	?>