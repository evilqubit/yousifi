<li class="search-trigger">search
	<div class="drop-search">
		<form action="/Pages/search" method="post">
			
			
			<div style="width: 1031px; float:left;">
				<fieldset>
					<label>Select branch</label>
					<select name="data[Search][branch_id]">
						
						<option value="">ALL BRANCHES</option>
						<?php 
						foreach($main_branches as $key=>$branch){						
							?>						
							<option value="<?=$key?>"><?=strtoupper($branch)?></option>
							<?php 
						}
						
						?>
						
						
					</select>
				</fieldset>
				<fieldset>
					<label>Select Section</label>
					<select id="section_filter" name="data[Search][section_id]" onchange="update_search_section()">
						
						<option value="">All SECTIONS</option>
						
						<?php 
						foreach($main_sections as $key=>$section){						
							?>						
							<option value="<?=$key?>"><?=strtoupper($section)?></option>
							<?php 
						}
						
						?>
						
					</select>
				</fieldset>
				
				<fieldset id="search_category_filter" >
					
				</fieldset>
				
				<!-- <fieldset>
					<label>Select shop</label>
					<select><option>GAP</option><option>Sin el Fil</option><option>Sin el Fil</option></select>
				</fieldset> -->
				
				
				
				<fieldset>
					<label>Or type keyword</label>
					<input type="text" name="data[Search][search_text]">
				</fieldset>
			
			</div>
			
			
			
			<button class="btn btn-primary btn-sm" type="submit">Search</button>
			<div id="searchLoader" style="display: none; margin-left: 280px;"> <img src="/img/ajax-loader.gif" width="20" height="20" alt=""/></div>
		</form>
	</div>
</li>