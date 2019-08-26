<!-- Custom styles for the demo page -->
    <style>
    
    #my_stores_background {
    	opacity: 0 !important;
    }
    img {
        max-width: 100%;
    }
    .well {
       	background-color:#000000;
       	border:none;
        display:none;
        margin:1em;
    }
    pre.prettyprint {
        padding: 9px 14px;
    }
    .fulltable {
        max-width: 100%;
        overflow: auto;
    }
    .container {
        padding-left: 0;
        padding-right: 0;
    }
    .lineheight {
        line-height: 3em;
    }
    .pagetop {
        background: url(http://subtlepatterns.com/patterns/congruent_outline.png) #333;
        background-attachment: fixed;
        color: #fff;
    }
    .page-header {
        border-bottom: none;
    }
    .initialism {
        font-weight: bold;
        letter-spacing: 1px;
        font-size: 12px;
    }
    
    .privacyTitle{
    	color: #ffffff;
    	margin-bottom: 40px;
    	clear: both;
    	font-size:25px;
    	font-family: "spinwerad";
    	
    	
    }
    
     .privacyText{
    	color: #ffffff;
    	margin-bottom: 50px;
    	clear: both;
    	font-family: "DINPro";
    	font-size: 16px;
    	
    }

	.privacyClose{
		float: right;
		color: #ffffff;
		border: none;
		background: none;
		margin-right: -10px;
		margin-bottom: 10px;
		
	}
    </style>
    


	<button class="my_stores_close privacyClose">X</button>
	
    <?php
    
    $title=$branch['Branch']['title'];
	
      ?>
    
    
    <div class="privacyTitle"><?=strtoupper( "lemall"." ".$title)?></div>
    
    <div style="width: 280px; float: left;">
    	<form     enctype="multipart/form-data"   method="post" id="StoreForm" action="/Pages/find_store/">
    		
    		<input type="hidden" name="data[Branch][id]" value="<?=$branch_id?>" />
    				
    		
    		
   			
    		<?php foreach($data['categories'] as $section=>$s){
    					
					$section_title=	$s['title'];
					$categories=$s['categories'];
					?>
					<div class="floatClass checkBoxLabelText" style="margin-bottom: 5px; margin-top: 5px;"><?=ucfirst(strtolower($section_title))?></div>
					<?php 
    				if($section == 'shopping'){
    		
			    		foreach($data['filters'] as $key=>$sub){
			    			
							?>
							
							<div class="floatClass viewStoreCheckBoxContainer" style="margin-left: 10px;">
								<div class="storeLoader" id='storeLoader_<?=$key?>' ><img src="/img/ajax-loader.gif" width="20" height="20" alt=""/></div>
								<input onchange="update_store(<?=$key?>)"  type="checkbox" id='filter_<?=$key?>'  class="css-checkbox med" name="data[Filter][<?=$key?>]" />
								<label  for="filter_<?=$key?>" name="checkbox65_lbl"  class="css-label med elegant checkBoxLabelText"><?=ucfirst(strtolower($sub));?></label>
								<div class="checkboxBottomBorder"></div>
							</div>	
							<?php 
			    		} 
					}	
				
					foreach($categories as $key=>$c){
						
						if($key != 5 && $key != 21){				
						?>
						
						<div class="floatClass viewStoreCheckBoxContainer" style="margin-left: 10px;">
							<div class="storeLoader" id='storeLoader_<?=$key?>' ><img src="/img/ajax-loader.gif" width="20" height="20" alt=""/></div>
							<input onchange="update_store(<?=$key?>)"  type="checkbox" id='category_<?=$key?>'  class="css-checkbox med" name="data[Category][<?=$key?>]" />
							<label for="category_<?=$key?>" name="checkbox65_lbl"  class="css-label med elegant checkBoxLabelText"><?=ucfirst(strtolower($c));?></label>
							<div class="checkboxBottomBorder"></div>
						</div>
				<?php 
						}
				}				
    		} ?>
    		
    		
    		<!-- <?php 
    		foreach($data['cinema'] as $s){
    				foreach($s as $key=>$sub){
				?>
				<div class="floatClass viewStoreCheckBoxContainer">
					<div class="storeLoader" id='storeLoader_<?=$key?>' ><img src="/img/ajax-loader.gif" width="20" height="20" alt=""/></div>
					<input onchange="update_store(<?=$key?>)" type="checkbox" id='category_<?=$key?>'  class="css-checkbox med" name="data[Cinema][<?=$key?>]" />
					<label for="category_<?=$key?>" name="checkbox65_lbl"  class="css-label med elegant checkBoxLabelText"><?=$sub?></label>
					<div class="checkboxBottomBorder"></div>
				</div>
				<?php 
				}
    		} ?> -->
    		
    		
    		
    	</form>
    </div>
    
    
    <div class="floatRevClass col-lg-8 col-md-8 col-sm-6 col-xs-12" style="float: left;  margin-top: 20px;"  id="store_search_result">
    	
    </div>
    
    
    
    
    
    
<script type="text/javascript">
	
			var options = {
				beforeSubmit: function(){
					
					
				},
				resetForm: false,
				success:function(data){
					
					
					$(".storeLoader").hide();
					
					$("#store_search_result").html(data);
					
				}
			};
			$('#StoreForm').ajaxForm(options);
	 		
		
	
	function update_store(id){
		$("#storeLoader_"+id).show();
		$("#StoreForm").submit();
	}
</script>
    
    


