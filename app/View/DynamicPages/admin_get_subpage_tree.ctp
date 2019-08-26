<?php if($type == 'section'){ ?>
	<ul>
		<?php 
		foreach($parentsList as $sub){			
				$id=$sub["DynamicPage"]['id'];
				$title=$sub["DynamicPage"]['title'];
				$children=$sub["DynamicPage"]['has_children'];
				
				$dynamic_pages_relation_id='parent';
				if(isset($sub['DynamicPageRelation']['id'])){
					$dynamic_pages_relation_id=$sub['DynamicPageRelation']['id'];
				}
				
				
				
				if(isset($sub['DynamicPageRelation']['main_parent_id']) && !empty($sub['DynamicPageRelation']['main_parent_id'])){
					$main_parent_id=$sub['DynamicPageRelation']['main_parent_id'];
				}else{
					$main_parent_id=$id;
				}
				
				$has_children_class='';
				if($children == 1){
					$has_children_class='jstree-closed';
				}
				
				$page_id="$main_parent_id"."_".$id."_".$dynamic_pages_relation_id;		
			?>
			
			<li class="<?=$has_children_class?>" id="<?=$page_id?>"  value="<?=$id?>" >						
				<span style="float: left;">
					<span style="margin-right: 5px; margin-left: 5px; float: left;" title="Add this page"  onclick="add_subject_poiter('<?=$id?>', '<?=$dynamic_pages_relation_id?>')" ><img src="/img/add.png" width="15" height="15" /></span>					
					<span id="text_value_<?=$id?>"><?=$title?></span>
				</span>											
			</li>	
		<?php } ?>	
	</ul>
<?php }else{ ?>


	<ul>
		<?php 
		foreach($roles_parentsList as $sub){			
				$id=$sub["DynamicPage"]['id'];
				$title=$sub["DynamicPage"]['title'];
				$children=$sub["DynamicPage"]['has_children'];
				
				if(isset($sub['DynamicPageRelation']['main_parent_id']) && !empty($sub['DynamicPageRelation']['main_parent_id'])){
					$main_parent_id=$sub['DynamicPageRelation']['main_parent_id'];
				}else{
					$main_parent_id=$id;
				}
				
				$has_children_class='';
				if($children == 1){
					$has_children_class='jstree-closed';
				}				
				$page_id="$main_parent_id"."_".$id;			
			?>
			
			<li class="<?=$has_children_class?>" id="<?=$page_id?>"  value="<?=$id?>" >						
				<span style="float: left;">
					<span style="margin-right: 5px; margin-left: 5px; float: left;" title="Add this page"  onclick="add_subject_poiter('<?=$id?>' , '<?=$page_id?>')" ><img src="/img/add.png" width="15" height="15" /></span>					
					<span id="text_value_<?=$id?>"><?=$title?></span>
				</span>											
			</li>	
		<?php } ?>	
	</ul>
<?php } ?>