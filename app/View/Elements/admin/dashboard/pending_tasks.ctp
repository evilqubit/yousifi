<!--////////////////////////////////////////////////			pendding tasks  			///////////////////////////////////////  -->

<?php 

$approve_location="/admin/Chains/approve_post/";
$reject_location="/admin/Chains/reject_post/";
$preview_location="/admin/DynamicPages/view_queue/";

$view_name="Post";

$image1 = $this->html->image('/img/spacer.gif', array('class'=>'dashBosrdEdit', 'title'=> "Edit $view_name", 'alt'=>"Edit", 'border'=> "0"), true);
$image2 = $this->html->image('/img/spacer.gif', array('class'=>'delete', 'title'=> "Delete $view_name", 'alt'=>"Delete", 'border'=> "0"), true);
$image3 = $this->html->image('/img/spacer.gif', array('class'=>'add', 'title'=> "Add $view_name", 'alt'=>"Add",'style'=>'margin-left:10px;margin-bottom:-5px;' , 'border'=> "0"), true);

$image5 = $this->Html->image('/img/spacer.gif', array('class'=>'dashBosrdGreenlight', 'title'=> "Approve", 'alt'=>"visible" , 'border'=> "0",'style'=>'margin-top:1px;'), true);
$image6 = $this->Html->image('/img/spacer.gif', array('class'=>'dashBosrdRedlight', 'title'=>"Reject", 'alt'=> __("admin_hidden",true)."$view_name", 'border'=> "0",'style'=>'margin-top:1px;'), true);

$image7 = $this->html->image('/img/spacer.gif', array('class'=>'arrow', 'title'=> "Order $view_name", "class"=>"handle", 'alt'=>"Order",'style'=>'margin-right:10px;cursor:move' , 'border'=> "0"), true);
$image8 = $this->html->image('/img/spacer.gif', array('class'=>'order', 'title'=> "Click to order of images  in $view_name ", "class"=>"handle", 'alt'=>"Add",'style'=>'margin-right:10px;cursor:pointer' , 'border'=> "0"), true);
$image11 = $this->html->image('/img/spacer.gif', array('class'=>'on_home_off', 'title'=> "Show $modelName on homepage", 'alt'=>"Show",'style'=>'margin-right:10px; cursor:pointer;' , 'border'=> "0"), true);
$image10 = $this->html->image('/img/spacer.gif', array('class'=>'on_home', 'title'=> "Hide  $modelName from homepage", 'alt'=>"Show",'style'=>'margin-right:10px; cursor:pointer;' , 'border'=> "0"), true);
$image12 = $this->html->image('/img/admin/title_logo.jpg', array('title'=> "list users of this $modelName", 'alt'=>"Show",'style'=>'margin-right:10px; cursor:pointer;' , 'border'=> "0"), true);
$image13 = $this->html->image('/img/admin/prev.gif', array('title'=> "go back to group list", "class"=>"", 'alt'=>"",'style'=>'margin-right:10px; margin-top:5px;' , 'border'=> "0"), true);
$image14 = $this->html->image('/img/spacer.gif', array('class'=> "view", 'alt'=>"","title"=>"Preview Post",'border'=> "0"), true);
?>
<div class="pendding_tasks">
	
	
	<div class="dashboardHeaderContainerPendingTasks">
		<div class="dashboardHeaderIconPendingTasks"></div>
		<div class="dashboardHeaderTextPendingTasks">Pending tasks <div class="dashboardPendingTaskSeeAll"><a href="/admin/Chains/pending_task_list">+See All</a></div></div>
		
	</div>
	
	<div class="penddingTaskContainer">
		<div>
			<?php 
				$i=0; 
				$readMoreTask='/admin/Chains/pending_task_list';
				$total_count=count($data);
				
				if(!empty($data)){
					foreach($data as $output){
						
						
						$output_id = $output['ActiveQueue']['id'];
						$module_name = $output['Module']['module'];
						$moduleId = $output['Module']['id'];
						
						
						
						$output_type = $output['ActiveQueue']['action_type'];
						$module_name = $output['ActiveQueue']['module_name'];
						
						if(empty($module_name)){
							$module_name= $output['Module']['module'];
							$output_module_name= $output['Module']['title'];
							$model= substr($module_name, 0, -1);
						}else{
							$output_module_name=$module_name;
							$module_name=$module_name."s";
							$model= substr($module_name, 0, -1);
							
						}
						
						
						$unserialize_data=array();
						$unserialize_data= unserialize($output['ActiveQueue']['data']);
						
						
						//print_r($unserialize_data);exit;
						
						if(isset($unserialize_data["$model"]['title']['eng'])){		
							$output_name =$unserialize_data["$model"]['title']['eng'];
						}else{				
							$output_name = $unserialize_data["$model"]['title'];
						}
						
						
						
						$output_date=$this->Time->niceShort($output['ActiveQueue']['modified']);
						
						
						
						$edit_location="/admin/$module_name/edit_queue/";
						
	
						
						
						/////////////////BUTTONS////////////////
						$edit_link=$this->Html->link($image1, $edit_location.$output_id, array("escape"=>false), null, false);
						$edit_div='<div style="float:left; margin-top:4px; margin-right:3px;" id="edit_div_'.$output_id.'">'.$edit_link.'</div>';
	
						
						
						$active=$this->Html->link($image5, $approve_location.$output_id, array("onClick"=>"approve_disapprove_with_confirm('$approve_location$output_id','row_$output_id','active_div_$output_id' ,'approve');return false;",'escape'=>false), null, false);
						$archived=$this->Html->link($image6, $reject_location.$output_id, array("onClick"=>"approve_disapprove_with_confirm('$reject_location$output_id','row_$output_id','archive_div_$output_id' , 'reject');return false;",'escape'=>false), null, false);
						
						
						$active_div="<div style='float:left; margin-top:2px;' id='active_div_$output_id'>$active</div>";
						$archived_div="<div style='float:left; margin-top:2px;' id='archive_div_$output_id' >$archived </div>";
							
						if($moduleId == 4){
							$prev_link=$this->Html->link($image14, $preview_location.$output_id, array("escape"=>false), null, false);
							$prevDiv = '<div style="float:left; margin-top:4px; margin-right:3px;">'.$prev_link.'</div>';
						}else{
							$prevDiv = "";
						}
						
						/////////////////END - BUTTONS////////////////
					
						if($i%2==0){
							$bgColor="F4F4F4";
						}
						else{
							$bgColor="FFFFFF";
						}
						$i++;
						
						
						$main_title="$model "."called"." ".$output_name." has been "." $output_type"." on ".$output_date;
				?>
				
					<div class="pendingTaskConatinerTitle" style="background-color:<?="#".$bgColor?> " id="row_<?php echo $output_id;?>">
						<div class="TaskTitleContainer"><a href="<?=$edit_location.$output_id?>"> <?=$main_title?> </a></div>
						<div class="pendingTaskAction"><?php echo "$edit_div  $prevDiv $active_div  $archived_div"?></div>					
					</div>
				<?php  }
				}else{
					echo '<div style="float:left;height:20px;width:400px;padding-top:20px;clear:both;" align="left">No Tasks Available</div>';
				}				
	 ?>
	 			<?php if( $total_count > 7){ ?>
		 			<div class="pendingTaskConatinerTitle" style="background-color:<?="#".$bgColor?> ">
						<div class="readMoreTask"><a href="<?=$readMoreTask?>">See All</a></div>
					</div>
	 			<?php  } ?>
		</div>
		
	</div>
	
</div>