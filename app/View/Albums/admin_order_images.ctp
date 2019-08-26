<div class="maintitle"><?=$page_title?></div>
<div class="subtitle">List of <?=$page_subtitle?></div>

<?php 
$add_location="/admin/$controllerName/add/";
$edit_location="/admin/$controllerName/edit/";
$delete_location="/admin/$controllerName/delete/";
$show_location="/admin/$controllerName/show/";
$hide_location="/admin/$controllerName/hide/";



$view_name=$page_subtitle;


$th = array ("<tr><th></th><th>title</th><th>view</th></tr>");
		




$image1 = $this->html->image('/img/admin/edit.gif', array('title'=> "Edit $view_name", 'alt'=>"Edit", 'border'=> "0"), true);
$image2 = $this->html->image('/img/admin/delete.gif', array('title'=> "Delete $view_name", 'alt'=>"Delete", 'border'=> "0"), true);
$image3 = $this->html->image('/img/admin/add.gif', array('title'=> "Add $view_name", 'alt'=>"Add",'style'=>'margin-left:10px;margin-bottom:-5px;' , 'border'=> "0"), true);
$image5 = $this->html->image('/img/admin/greenlight.gif', array('title'=> "Click to Hide $view_name", 'alt'=>"Click to Hide $view_name" , 'border'=> "0",'style'=>'margin-top:1px;'), true);
$image6 = $this->html->image('/img/admin/redlight.gif', array('title'=> "Click to Show $view_name", 'alt'=>"Click to Show $view_name", 'border'=> "0",'style'=>'margin-top:1px;'), true);
$image7 = $this->html->image('/img/admin/arrow.png', array('title'=> "Order $view_name", "class"=>"handle", 'alt'=>"Order",'style'=>'margin-right:10px;cursor:move' , 'border'=> "0"), true);
$image8 = $this->html->image('/img/admin/on_home.gif', array('title'=> "Click to remove $view_name from homepage popup message", "class"=>"handle", 'alt'=>"Remove",'style'=>'margin-right:10px;cursor:pointer' , 'border'=> "0"), true);
$image9 = $this->html->image('/img/admin/on_home_off.gif', array('title'=> "Click to add $view_name to homepage popup message", "class"=>"handle", 'alt'=>"Add",'style'=>'margin-right:10px;cursor:pointer' , 'border'=> "0"), true);



?>



<!-- <div class="add_page" style="width:500px; float:left; height:35px;margin:0;"><?php echo $this->html->link($image3." Add $view_name", $add_location."/".$sectionNumber, array("escape"=>false,'style'=>'text-decoration:none;'), null, false);?></div> -->

<div id="info" style="width:550px;float:left;margin-top:10px;clear:left;">Drag and drop the Profile with &nbsp; <img src="/img/admin/arrow.png" alt=""/> &nbsp; to change the order.</div>
<!-- <button class="FloatClass submit_btn" style="clear:both;margin-bottom:10px;" onclick="window.location='/admin/<?=$controllerName?>/index/1/<?=$sectionNumber?>'">Order all entries</button> -->
	
	<table border="0" width="900" cellpadding="1" cellspacing="1" class="FloatClass" id="sortable_list">
			<?php	
			if(!empty($data)){
				
				echo "<thead><tr><th></th><th>Title</th><th>View</th></tr></thead>";
				
				$i=0;
				foreach ($data as $output)
				{
					if($i%2==0){
						$bgColor="F4F4F4";
					}
					else{
						$bgColor="FFFFFF";
					}
										
					$output_id = $output["Image"]['id'];
					$output_title = $output["Image"]['title'];
					$output_image = $output["Image"]['image'];
				
			?>
			<tr style="background-color:#<?php echo $bgColor?>;" id="row_<?php echo $output_id;?>">
			     <td style="width:20px;padding-right:0px;"><?php echo "$image7 ";?></td>
			     <td style="width:185px;text-align:center;"><?php echo $output_title; ?></td>
		     	 <td style="width:185px;text-align:center;">
		     		<img class="logo1"  src="/files/<?=$folderName;?>/thumb/<?php echo $output_image;?>" alt="" border="0" />
		     	 </td>
				
			      
			     
			</tr>
			<?php
				$i++;
				}
			} else {
				
				echo '<div style="float:left;height:20px;width:500px;padding-top:20px;clear:both;" align="left">No Data Available</div>';
			}
			?>
	</table>
		
<div style="margin:20px 0px 20px 0px;width:560px;text-align:left; border:solid 1px #72BF44;padding:10px 0px 10px 10px;height:auto;overflow:hidden;clear:both;float:left;">

	<div style="float:left;clear:both;">
		<div style="float:left;"><img src="/img/admin/arrow.png" alt=""/></div>
		<div style="float:left;width:160px;margin-top:2px;">&nbsp;&nbsp; Order <?php echo $view_name;?></div>
	</div>
</div>

<script type="text/javascript"> 
$(document).ready(function() {
	$("#sortable_list tbody").sortable({
		handle : '.handle',
		update : function () {
			var order = $('#sortable_list tbody').sortable('serialize');
			$("#info").load("/admin/<?php echo $controllerName;?>/images_ajax_order?"+order);
		}
	});
});
</script>