<ul>
	<?php 
	foreach($data as $sub){			
			$id=$sub["DynamicPage"]['id'];
			$title=$sub["DynamicPage"]['title'];
			$children=$sub["DynamicPage"]['has_children'];
			
			
			$has_children_class='';
			if($children == 1){
				$has_children_class='jstree-closed';
			}				
			$page_id="sub_".$id;			
		?>
		
		<li class="<?=$has_children_class?>" id="<?=$page_id?>"  value="<?=$id?>" >						
			<span style="float: left;">
				<span style="margin-right: 5px; margin-left: 5px; float: left;" title="Add this page"  onclick="add_poiter(<?=$id?>)" ><img src="/img/add.png" width="15" height="15" /></span>					
				<span id="text_value_<?=$id?>"><?=$title?></span>
			</span>											
		</li>	
	<?php } ?>	
</ul>
