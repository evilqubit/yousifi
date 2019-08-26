<style>
	.jstree-default .jstree-icon:empty {
		float: left;
	}
	
	.new_page {
		width: auto;
		height: auto;
		border: 1px solid #000000;
		border-radius: 3px; 
		margin: 3px 0 3px 5px;
		padding:2px 2px 2px 2px;
		float:left;
		background-color: #e4e4e4;
	}
	.multiple_page_title {
		font-family: Arial;
		color: #000000;
		font-size: 14px;
	}
	.remove_multiple_btn {
		margin-left:2px;
		cursor: pointer;
		color: #000000;
	}
</style>

<div class="control-group "   style="margin-bottom:10px; width: 960px; border: none; " >
	<label class="control-label" for="JobPublish"> 
		<div> <?=$container_title?></div>
		
	</label>
	<div style=" position: relative; padding: 3px;  width: 600px; min-height: 20px; border: 1px solid #000000; font-size: 15px; " id="event_result_<?=$feild_id?>" class="event_result">
		<div id="event_result_clickable_area_<?=$feild_id?>"   style="cursor:pointer; z-index: 1;  position: absolute; height: 100%; width: 100%;"></div>
		
		<div style="position: relative; z-index: 2;" id="event_result_content_<?=$feild_id?>">
		
		
			<?php
			
			if(!empty($pointer)){
				$page_id=$pointer['DynamicPage']['id'];
				$title=$pointer['DynamicPage']['title'];
				
				?>
				<span class="new_page">
					<span class="multiple_page_title"><?=$title?></span>				
					<input type="hidden" value="<?=$page_id?>" name="data[<?=$feild_model?>][<?=$feild_name?>]">
				</span>
				<?php 
			}	
			 ?>
		 </div>
	 </div>
	
	
		
	<!-- <div onclick="show_tree('jstreeList_<?=$feild_id?>')" style="background-color:#fb3838; color: #ffffff;cursor: pointer;float: left;font-size: 15px; margin-left: 5px; margin-top: 5px; text-align: center;width: 140px; ">Select <?=$container_title?></div>
	 -->
	 
	<div id="arrow_up_<?=$feild_id?>" class="arrow_up" style="display: none;" onclick="show_tree('<?=$feild_id?>')" ><img title="click to hide entries" src="/img/admin/arrow_up.png" /></div>
	<div id="arrow_down_<?=$feild_id?>"  class="arrow_down" onclick="show_tree('<?=$feild_id?>')" ><img   title="click to list entries" src="/img/admin/arrow_down.png" /></div>
	
	
	<div style="margin-left: 170px; display: none; clear: both;" id="jstreeList_<?=$feild_id?>">
		 
	
		
		
		<!-- <div class="searchFeildContainer " style="float: left;">
			<input style="width: <?=$searchFeild_width?>" type="text" id="plugins4_q_<?=$feild_id?>" value="" class="searchFeild" placeholder="search..."  />
		</div> -->
		
		
		<div class="JsTreeSearch"  id="JsTreeSearch_<?=$feild_id?>" style=" height: 200px; width: 800px;">
			
			<div id="jstree_<?=$feild_id?>" class="demo plugin-demo" style="clear: both;" >
				
			</div>
				
		</div>
	</div>
</div>









<script type="text/javascript">
	
	function show_tree(feild_id){
		if($("#jstreeList_"+feild_id).is(":hidden")){
			$("#jstreeList_"+feild_id).slideDown();
			$("#arrow_up_"+feild_id).show();
			$("#arrow_down_"+feild_id).hide();
		}else{
			$("#jstreeList_"+feild_id).slideUp();
			$("#arrow_up_"+feild_id).hide();
			$("#arrow_down_"+feild_id).show();
		}
		
	}
	
	
	
	function add_poiter(id){
		
		selection_title=$("#text_value_"+id).html();
		
		var page='';
		
		
		page +='<span class="new_page" >';
		page +='<span class="multiple_page_title">'+selection_title+'</span>';
		page +='<input id="selected_page" type="hidden" name="data[<?=$feild_model?>][<?=$feild_name?>]" value="'+id+'" />';
		page +='</span>';
		
		// console.log(page);
		
		$('#show_onHomePage').show();
		
		$("#event_result_content_<?=$feild_id?>").html(page);
		
	}
	
	function remove_multiple_page(id){	
		$("#"+id).fadeOut();
		$("#"+id).remove();		
	}
	
	
	
	
	function clear_data_feild(){
		$("#<?=$feild_id?>").val('');
		$(".event_result").html('');
	}

	$(document).ready(function (){
		$("#event_result_clickable_area_<?=$feild_id?>").click(function(){
			show_tree('<?=$feild_id?>');
		});
		
		
		 $("#jstree_<?=$feild_id?>").jstree({
		   
		    "core" : {
			    "multiple" : false, // dont allow multi selection
			    "animation" : 0,
			    'data' : {
				    'url' : '/admin/DynamicPages/get_parent_tree/<?=$section?>',
				    'data' : function (node) {
				    	//console.log(node);
				    	//selected_id=node.id;
				    	res=node.id;
				    	if(res != '#'){
				    		// res=selected_id.split("_");
				    		
				    		return { 'id' : res };
				    	} 
				     
				    }
				  }
			  }
		  });
			
		});
			
	
</script>