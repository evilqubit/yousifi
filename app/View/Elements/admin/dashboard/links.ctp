<div class="dashboard_Links">
	<div class="dashboardHeaderContainerLinks">
		<div class="dashboardHeaderIconLinks"></div>
		<div class="dashboardHeaderTextLinks">Links Statistics</div>
	</div>
	
	<div class="LinksMainContainer" id="LinksMainContainer">
		
		<div class="linksChartFormContainer">
			<?php echo $this->form->create('ExternalLink',array("url"=>array("controller"=>"ExternalLinks","action"=>"get_link_details"),"id"=>"FileBaseForm")); ?>
			
			<div class="internal_row floatClass ">
				<div class="internal_label floatClass">Link</div>	
				
				<select id="ms" multiple="multiple" name="data[ExternalLink][]" class="form-control required">
					<?php 
					foreach($externalLinkList as $value=>$list){

						?>
					 <option value="<?=$value?>"><?=$list?></option>
						
					<?php }
					
					
					?>				
       		 	</select>
        
        		
				<!-- <div class="internal_div"><?php echo $this->form->input("ExternalLink.link_id",array(				
				'label'=>false,'class'=>"required internal_input",'options'=>$externalLinkList  , 'id'=>'links_list'));?>
				</div>	 -->			
			</div>
			
			
			<div class="internal_row" >
				<div class="internal_label">Date From</div>		
				<div class="calendarIcon"></div>	
				<?php echo $this->form->input("ExternalLink.date_from",array('label'=>false,"type"=>"text","id"=>"link_date_from","class"=>"required internal_input","value"=>date("Y-m-d")));?>
			</div>
			
			<div class="internal_row" >	
				<div class="internal_label">Date To</div>	
				<div class="calendarIcon"></div>			
				<?php echo $this->form->input("ExternalLink.date_to",array('label'=>false,"type"=>"text","id"=>"link_date_to","class"=>"required internal_input","value"=>date("Y-m-d",strtotime('1 months'))));?>
			</div>
			
			
			<div class="linkRefreshBtn" onclick="$('#FileBaseForm').submit();"></div>
			<div class="linkRefreshBtnLoader" style="display: none;"> <img src="/img/ajax-loader.gif" width="20" height="20" alt=""/></div>
			
			<?php echo $this->form->end();?>
		</div>
		
		<div id="linksChart" style="650px; float: left;">
			<div id="chratLoader" style="display: none;">Loading Links Statistics <img src="/img/ajax-loader.gif" width="20" height="20" alt=""/></div>
			<div id='linksChartContainer'></div>
		</div>
		
	</div>
	
	
</div>


<script type="text/javascript">


function validation(){
	
	jQuery.validator.addMethod("defaultInvalid", function(value, element) {
		return value != element.defaultValue;
	}, "This field is required.");
	
	return $('#FileBaseForm').valid();
}


// function update_linkChart(){
// 		
		// var link_date_to=$("#link_date_to").val();
		// var link_date_from=$("#link_date_from").val();
		// var links_list=$("#links_list").val();
		// var valid = validation();
// 		
		// $(".linkRefreshBtnLoader").show();
		// $(".linkRefreshBtn").hide();
		// if(valid == 1){
			// $.ajax({
				// url: '/admin/ExternalLinks/get_link_details/'+links_list+"/"+link_date_from+"/"+link_date_to,
				// beforeSend:function(data){
					// $(".linkRefreshBtnLoader").show();
					// $("#linksChartContainer").html('');
					// $("#chratLoader").show();
// 					
				// },
				// success: function(data){
// 					
					// $('#linksChartContainer').html(data);
// 					
				// },
				// complete: function(){
					// $(".linkRefreshBtnLoader").hide();
					// $(".linkRefreshBtn").show();
					// $("#chratLoader").hide();
				// }
			// });
// 			
			// return false;
// 		
		// }else{
			// $(".linkRefreshBtnLoader").hide();
			// $(".linkRefreshBtn").show();
			// return false;
		// }
// 		
	// }
	
	
	function startup(){
		$('#ms').multipleSelect('checkAll');
		$('#FileBaseForm').submit();		
	}
	$(document).ready(function(){
		
	//update_linkChart();
	
	
	
	
	
	
	var options = {
			beforeSubmit: function(){
				// var link_date_to=$("#link_date_to").val();
				// var link_date_from=$("#link_date_from").val();
				// var links_list=$("#links_list").val();
				// var valid = validation();
				
				$(".linkRefreshBtnLoader").show();
				$(".linkRefreshBtn").hide();
				
				$(".linkRefreshBtnLoader").show();
				$("#linksChartContainer").html('');
				$("#chratLoader").show();
		
				var valid = validation();
					if (valid == 1){
						return true;
					}
					else{
						$(".linkRefreshBtnLoader").hide();
						$(".linkRefreshBtn").show();
						return false;
						//return false;
					}
			},
			resetForm: false,
			success:function(data){
				$('#linksChartContainer').html(data);
				
				$(".linkRefreshBtnLoader").hide();
				$(".linkRefreshBtn").show();
				$("#chratLoader").hide();
			}
		};
		$('#FileBaseForm').ajaxForm(options);
 		$("#FileBaseForm").addClass('requiredField');
	 		
	 		
	 		
	
	$(function() {
        $('#ms').multipleSelect();
    });
	
	$(".linkRefreshBtnLoader").show();
	$(".linkRefreshBtn").hide();
	
	$(".linkRefreshBtnLoader").show();
	$("#linksChartContainer").html('');
	$("#chratLoader").show();
				
	 setTimeout(function(){startup();}, 5000);
	
	$("#link_date_from").datepicker({ changeYear: true, dateFormat: 'yy-mm-dd'});
 	
 	
 	$("#link_date_to").datepicker({ changeYear: true, dateFormat: 'yy-mm-dd'});
 	
 	
 		
		
	});	
	
	
</script>



