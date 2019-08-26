<div class="maintitle">Careers</div>
<div class="subtitle"><?=$page_subtitle?></div>
		
<?php

$delete_location="/admin/$controllerName/delete_cv/";
$view_location="/admin/$controllerName/view/";
$search_submit="/admin/$controllerName/cvs/$job_id";

$view_name="Cv";

$image2 = $this->html->image('/img/admin/delete.gif', array('title'=> "Delete $view_name", 'alt'=>"Delete", 'border'=> "0"), true);
$image4 = $this->html->image('/img/admin/view.gif', array('title'=> "View Cv", 'alt'=>"Cv", 'border'=> "0"), true);

$th = array (
'',
"<div style='width:185px;text-align:left;'>".$this->Paginator->sort('Name','first_name')."</div>",
"<div style='width:185px;text-align:left;'>".$this->Paginator->sort('Name','last_name')."</div>",
"<div style='width:185px;text-align:left;'>Job</div>",
//"<div style='width:150px;text-align:left;'>Work Place</div>",
$this->Paginator->sort('Submission Date','created'),
);
?>

	<div class="search_div">
			<?php 
			if(!isset($search_phrase))
			$search_phrase="";
		
			echo $this->form->create("Search",array("type"=>"GET","url"=>"$search_submit"));
			echo "<div class='FloatClass'>".$this->form->input("s",array("label"=>false,"class"=>"input_field","style"=>"height:12px;","value"=>$search_phrase))."</div>";
			echo "<div class='FloatClass'>".$this->form->submit("search",array("label"=>false,"class"=>"submit_btn"))."</div>";
			echo $this->form->end();
			?>
		
		</div>
		
			<table border="0" width="800" cellpadding="2" cellspacing="1" class="FloatClass">
			<?php	
			if(!empty($data)){
				echo $this->html->tableHeaders($th);
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
					$output_title = $output[$modelName]['first_name'];
					$output_date=$this->Time->niceShort($output[$modelName]['created']);
					$output_job_id=$output[$modelName]['job_id'];
					if($output_job_id==0)
						$output_job="N/A";
					else $output_job=$jobs['Job']['title'];
					
					/////////////////BUTTONS////////////////
					$del_link=$this->html->link($image2, $delete_location.$output_id, array("escape"=>false,"onClick"=>"delete_entry('$delete_location$output_id','row_$output_id','del_div_$output_id');return false;"),null, false);
					$del_div='<span id="del_div_'.$output_id.'">'.$del_link.'</span>';
					
					$view_link=$this->html->link($image4, $view_location.$output_id, array("escape"=>false), null, false);
					$view_div='<span id="view_div_'.$output_id.'">'.$view_link.'</span>';
					/////////////////END - BUTTONS////////////////
			?>
			<tr style="background-color:#<?php echo  $bgColor?>;" id="row_<?php echo $output_id;?>">
			     <td style="width:150px;padding-left:10px;"><?php echo "$del_div $view_div";?></td>
			     <td style="width:150px;"><?php echo $output_title; ?></td>
			     <td style="width:150px;"><?php echo $output["$modelName"]['last_name']; ?></td>
			     <td style="width:100px;"><?php echo $output_job; ?></td>
			     <td style="width:100px;"><?php echo $output_date; ?></td>
			</tr>
			<?php
				$i++;
				}
			} else {
				
				echo '<div style="float:left;height:20px;width:500px;padding-top:20px;clear:both;" align="left">No Data Available</div>';
			}
			?>
			</table>
		<div class="pagination_container" style="width:450px;">
			<?php echo $this->element('admin/paginator');?>
		</div>

<div style="margin:20px 0px 20px 0px;width:580px;text-align:left; border:solid 1px #72BF44;padding:10px 0px 10px 10px;height:auto;overflow:hidden;clear:both;float:left;">


<div style="float:left;"><img src="/img/admin/delete.gif" alt=""/></div>
<div style="float:left;width:160px;margin-top:2px;">&nbsp;&nbsp;  Delete  <?php echo $view_name;?></div>

<div style="float:left;"><img src="/img/admin/view.gif" alt=""/></div>
<div style="float:left;width:180px;margin-top:2px;">&nbsp;&nbsp;  View <?php echo $view_name;?></div>

</div>