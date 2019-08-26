<div class="maintitle">Users</div>
<div class="subtitle">List Users</div>

<?php 
$add_location="/admin/$controllerName/add//";
 $edit_location="/admin/$controllerName/edit/";
$delete_location="/admin/$controllerName/delete/";
$show_location="/admin/$controllerName/activate/";
$hide_location="/admin/$controllerName/deactivate/";
$search_submit="/admin/$controllerName/index/";
$order_location="/admin/$controllerName/ajax_order/";
$view_location="/admin/images/index/";

$view_name="User";

$th = array (
'',
$this->Paginator->sort('email','Email'),
// $this->Paginator->sort('name','Name'),

$this->Paginator->sort('created','Created'),
$this->Paginator->sort('modified','Last Modified')
);

$image1 = $this->Html->image('/img/admin/edit.gif', array('title'=> "Edit $view_name", 'alt'=>"Edit", 'border'=> "0"), true);
$image2 = $this->Html->image('/img/admin/delete.gif', array('title'=> "Delete $view_name", 'alt'=>"Delete", 'border'=> "0"), true);
$image3 = $this->Html->image('/img/admin/add.gif', array('title'=> "Add $view_name", 'alt'=>"Add",'style'=>'margin-left:10px;margin-bottom:-5px;' , 'border'=> "0"), true);
$image4 = $this->Html->image('/img/admin/gallery.gif', array('title'=> "View Images", 'alt'=>"View" , 'border'=> "0"), true);
$image5 = $this->Html->image('/img/admin/greenlight.gif', array('title'=> "Reject "." $view_name", 'alt'=>"visible" , 'border'=> "0",'style'=>'margin-top:1px;'), true);
$image6 = $this->Html->image('/img/admin/redlight.gif', array('title'=>"Approve "."$view_name", 'alt'=> __("admin_hidden",true)."$view_name", 'border'=> "0",'style'=>'margin-top:1px;'), true);
$image7 = $this->html->image('/img/admin/arrow.png', array('title'=> "Order $view_name", "class"=>"handle", 'alt'=>"Order",'style'=>'margin-right:10px;cursor:move' , 'border'=> "0"), true);


$image8 = $this->Html->image('/img/admin/add.gif', array('title'=> "Add related children", 'alt'=>"Add related children",'style'=>'margin-left:0px;' , 'border'=> "0"), true);

?>


<!-- <div id="info" style="width:550px;float:left;margin-top:10px;clear:left;">Drag and drop the sections with &nbsp; <img src="/img/admin/arrow.png" alt=""/> &nbsp; to change the order.</div>
<button class="FloatClass submit_btn" style="clear:both;margin-bottom:10px;" onclick="window.location='/admin/<?=$controllerName?>/index/1'">Order all entries</button> -->


<div class="add_page">
  <?php  echo $this->Html->link($image8." Add $view_name", $add_location, array('style'=>'text-decoration:none;','escape'=>false)); ?>
</div>


	<div class="search_div">
		<?php 
			if(!isset($search_phrase))
			$search_phrase="";
		
			echo $this->Form->create("Search",array("type"=>"GET","url"=>"$search_submit"));
			echo "<div class='FloatClass'>".$this->Form->input("s",array("label"=>false,"class"=>"input_field","style"=>"height:12px;","value"=>$search_phrase))."</div>";
			echo "<div class='FloatClass'>".$this->Form->submit("search",array("label"=>false,"class"=>"submit_btn"))."</div>";
			echo $this->Form->end();
		?>
	</div>
	<table border="0" width="1045"  cellpadding="1" cellspacing="1" class="FloatClass" id="sortable_list">
			<?php	
			if(!empty($data)){
				echo "<thead>".$this->Html->tableHeaders($th)."</thead>";
				$i=0;
				foreach ($data as $output)
				{
					if($i%2==0){
						$bgColor="F4F4F4";
					}
					else{
						$bgColor="FFFFFF";
					}
					$output_id = $output[$modelName]['id'];
					$output_email= $output[$modelName]['email'];
					// $output_fname = $output[$modelName]['name'];
					
					//$output_country_id = $output[$modelName]['country_id'];
					// if(isset($country_list["$output_country_id"]))
						// $output_country_name=$country_list["$output_country_id"];
					// else $output_country_name = "";
// 					
					// $output_ip = $output[$modelName]['ip'];
					
					$output_created=$this->Time->niceShort($output[$modelName]['created']);
					$output_date=$this->Time->niceShort($output[$modelName]['modified']);
					
					// $output_status=$output[$modelName]["approved"];
					
					/////////////////BUTTONS////////////////
					 $edit_link=$this->Html->link($image1, $edit_location.$output_id, array("escape"=>false), null, false);
					 $edit_div='<span id="edit_div_'.$output_id.'">'.$edit_link.'</span>';

					// $view_link=$this->Html->link($image4, $view_location.$output_albumId, array("escape"=>false), null, false);
					// $view_div='<span id="view_div_'.$output_id.'">'.$view_link.'</span>';
					
					$del_link=$this->Html->link($image2, $delete_location.$output_id, array("escape"=>false,"onClick"=>"delete_entry('$delete_location$output_id','row_$output_id','del_div_$output_id');return false;"),null, false);
					$del_div='<span id="del_div_'.$output_id.'">'.$del_link.'</span>';
					
					$active=$this->Html->link($image5, $hide_location.$output_id, array("onClick"=>"change_status_with_confirm('$hide_location$output_id','active_div_$output_id','archive_div_$output_id');return false;",'escape'=>false), null, false);
					$archived=$this->Html->link($image6, $show_location.$output_id, array("onClick"=>"change_status_with_confirm('$show_location$output_id','archive_div_$output_id','active_div_$output_id');return false;",'escape'=>false), null, false);
					
					// if($output_status==1){
						// $active_div="<span id='active_div_$output_id'>$active</span>";
						// $archived_div="<span id='archive_div_$output_id' style='display:none'>$archived </span>";
					// }else{
						// $active_div="<span id='active_div_$output_id'  style='display:none'>$active</span>";
						// $archived_div="<span id='archive_div_$output_id'>$archived </span>";
					// }
					
					/////////////////END - BUTTONS////////////////
				
			?>
	
			<tr style="background-color:#<?php echo $bgColor?>;" id="row_<?php echo $output_id;?>">
			     <td style="width:120px;padding-right:0px;"><?php echo "$edit_div $del_div  ";?></td>
			     <td style="width:185px;text-align:center;"><?php echo $output_email; ?></td>
			     <!-- <td style="width:185px;text-align:center;"><?php echo $output_fname; ?></td> -->
			     <!-- <td style="width:185px;text-align:center;"><?php echo $output_lname; ?></td>
			   
			     <td style="width:185px;text-align:center;"><?php echo $output_country_name; ?></td>
			     <td style="width:185px;text-align:center;"><?php echo $output_ip; ?></td> -->
			     
			     <td style="width:185px;text-align:center;"><?php echo $output_created; ?></td>
			     <td style="width:185px;text-align:center;"><?php echo $output_date; ?></td>
			</tr>
			<?php
				$i++;
				}
			} else {
				
				echo '<div style="float:left;height:20px;width:500px;padding-top:20px;clear:both;" align="left">No Data Available</div>';
			}
			?>
	</table>
	
	<div class="pagination_container" style="width:1000px;">
		<?php echo $this->element('admin/paginator');?>
	</div>
	
<div style="margin:20px 0px 20px 0px;width:560px;text-align:left; border:solid 1px #72BF44;padding:10px 0px 10px 10px;height:auto;overflow:hidden;clear:both;float:left;">
	<div style="float:left;clear:both;margin-bottom:10px;">
		<!-- <div style="float:left;"><img src="/img/admin/edit.gif" alt=""/></div>
		<div style="float:left;width:240px;margin-top:2px;">&nbsp;&nbsp;  Edit  <?php echo $view_name;?></div> -->
		
		<div style="float:left;"><img src="/img/admin/delete.gif" alt=""/></div>
		<div style="float:left;width:240px;margin-top:2px;">&nbsp;&nbsp;  Delete  <?php echo $view_name;?></div>
		
		<!-- <div style="float:left;clear:left;margin-top:20px;"><img src="/img/admin/greenlight.gif" alt=""/></div>
		<div style="float:left;width:240px;margin-top:20px;">&nbsp;&nbsp;  <?php echo "Approved. click to reject "." $view_name";?></div>
		
		<div style="float:left;margin-top:20px;"><img src="/img/admin/redlight.gif" alt=""/></div>
		<div style="float:left;width:240px;margin-top:20px;">&nbsp;&nbsp;  <?php echo "Rejected. click to approve "." $view_name";?></div> -->

	</div>
</div>
<script type="text/javascript"> 
$(document).ready(function() {
	$("#sortable_list tbody").sortable({
		handle : '.handle',
		update : function () {
			var order = $('#sortable_list tbody').sortable('serialize');
			$("#info").load("/admin/<?php echo $controllerName;?>/ajax_order?"+order);
		}
	});
});
</script>