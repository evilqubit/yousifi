<!-- table body -->

<div class="table2sort table2sortSub"   id="table2sort_<?=$parent_id?>">
  
 <?php 
 
 $sort_table_id="table2sort_$parent_id";
 
 if(!empty($data)){
 	
	



	
	
	
	 $index=0;
	 foreach($data as $newsEntry){
	 	$id=$newsEntry["$modelName"]['id'];
		$visible=$newsEntry["$modelName"]['visible'];
		$edit_location="/admin/$controllerName/edit_2/$id/";
		$delete_location="/admin/$controllerName/delete/";
		$show_location="/admin/$controllerName/show/";
		$hide_location="/admin/$controllerName/hide/";
		$order_location="/admin/$controllerName/order_images/";

	 	
	 	
		
		$title=$newsEntry["$modelName"]['title'];
		
		
		
		$title= $this->Text->truncate($title,60,array("...",true , 'exact'=>false));
		
	 	$modified=$newsEntry["$modelName"]['modified'];
		
		//$add_location="/admin/$controllerName/add_2/$parent_type/$main_parent_id/";
		
		
				
										
	
		
		$back_color='';
		if(($index%2) == 0){
			$back_color='#ffffff';
		}else{
			$back_color='#';
		}
		
		$index++;
		
		$sub_uniqe_id=$id;
		
		
		//print_r($visible);exit;
		if($visible==1){
			
			$active_div= "<span id='active_div_$sub_uniqe_id'><a class='btn btn-small show-tooltip' title='Hide' onclick='change_status(\"/admin/$controllerName/hide/$id\",\"active_div_$sub_uniqe_id\",\"archive_div_$sub_uniqe_id\");return false;' href='/admin/$controllerName/hide/$id'><i class='icon-eye-open'></i></a></span>";											
			$archived_div= "<span id='archive_div_$sub_uniqe_id' style='display:none'><a  class='btn btn-small show-tooltip' title='Show' onclick='change_status(\"/admin/$controllerName/show/$id\",\"archive_div_$sub_uniqe_id\",\"active_div_$sub_uniqe_id\");return false;' href='/admin/$controllerName/hide/$id'><i class='icon-eye-close'></i></a></span>";
			
		}else{
			$active_div= "<span id='active_div_$sub_uniqe_id' style='display:none'><a class='btn btn-small show-tooltip' title='Hide' onclick='change_status(\"/admin/$controllerName/hide/$id\",\"active_div_$sub_uniqe_id\",\"archive_div_$sub_uniqe_id\");return false;' href='/admin/$controllerName/hide/$id'><i class='icon-eye-open'></i></a></span>";											
			$archived_div= "<span id='archive_div_$sub_uniqe_id' ><a  class='btn btn-small show-tooltip' title='Show' onclick='change_status(\"/admin/$controllerName/show/$id\",\"archive_div_$sub_uniqe_id\",\"active_div_$sub_uniqe_id\");return false;' href='/admin/$controllerName/hide/$id'><i class='icon-eye-close'></i></a></span>";
			
		}	
		
		
		
		$delete_location="/admin/$controllerName/delete/$id";								
		//$del_div="<a class='btn btn-small btn-danger show-tooltip' title='Delete' onclick='delelte_all(\"$delete_location\",\"row_$sub_uniqe_id\",\"del_div_$id\");return false;' href='$delete_location'>Delete</a>";
		$del_div="<a class='btn btn-small btn-danger show-tooltip' title='Delete' onclick='delete_entry(\"$delete_location\",\"row_$id\",\"del_div_$id\");return false;' href='/admin/$controllerName/delete/$id'>Delete</a>";
		
		
		$row_class="row_$sub_uniqe_id";
	 	?>
	 	<div  class="table-flag-orange subRow <?=$row_class?>" style="background-color: <?=$back_color?>"  id="row_<?php echo $id;?>">
		    <div  class="subrowContainer">
		        <div class="handle" style="width: 35%; float: left;"><?php echo $title ?></div>	
		        
	            							          
		        <div class="handle"  style="width: 20%; float: left;"><?php echo $modified ?></div>
		      
		        <div class=""  style="width: 40%; float: left; text-align: right">
		            <div class="btn-group">
		            <div class="accordAjaxLoader" id="accordAjaxLoader_<?=$sub_uniqe_id?>" ><img src="/img/ajax-loader.gif" width="20" height="20" /></div>
		           
		          
		           
		            <div class="btn btn-small show-tooltip btn-success" style="background-color: #b6d1f2; margin-right: 2px;" onclick="get_dynamicPages_subchildren( '<?=$id?>' )" title="Manage pages">Manage pages</div>
		            
		            
		            
		           
								               	
								               	
		           	
		            
		            								                
		           
		            <a class="btn btn-small show-tooltip" href="<?=$edit_location."/$id"?>" title="Edit"><i class="icon-edit"></i></a>	
		            
		            <?=$del_div?>	
		            <?=$active_div?> <?=$archived_div?>                  
		            </div>
		        </div>									            			           
		    </div>
		    <div  style="display: none;" id="sub_<?=$sub_uniqe_id?>"></div>
	    </div>
	    <!-- 	 -->									        
	  <?php 
	$index++;
		}
	  }else{
	  	
		echo "<div style='font-family:arial; font-size:16px; color:#ffffff; padding:5px; background-color:#248dc1'> no children found </div>";
		
	  }
	  

 ?>
</div>

<script>

// When the document is ready set up our sortable with it's inherant function(s) 
$(document).ready(function() {
	
	
	
    
	$("#table2sort_<?=$parent_id?>").sortable({
		handle : '.handle',
		 zIndex: 9999,
         
        tolerance: "pointer",
        distance: 1 ,
		update : function () {
			var order = $('#table2sort_<?=$parent_id?>').sortable('serialize');
			
			$("#info").load("/admin/<?php echo $controllerName;?>/ajax_order/<?=$section?>/page:<?=$page_number?>?"+order);
		}
	});
});  
</script>