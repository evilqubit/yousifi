<!-- BEGIN Main Content -->


<style>
	.box > .box-title {
    background-color: #b6d1f2;
    text-shadow: 0 1px 0 #aecef4;
}
.box .box-title {
    padding: 10px;
}
*::-moz-selection {
    background: none repeat scroll 0 0 #3e4349;
    color: #fff;
}

.box .box-title h3 {
    color: #fff;
    display: inline-block;
    line-height: 20px;
    margin: 0;
}
h3 {
    font-size: 22px;
    font-weight: 400;
    margin: 8px 0;
}

.icon-table:before {
    
}
[class^="icon-"]:before, [class*=" icon-"]:before {
    display: inline-block;
    text-decoration: inherit;
}
.box .box-title h3 > i {
    margin-right: 10px;
}
[class*=" icon-"], [class^="icon-"] {
    display: inline-block;
    text-align: center;
}
[class^="icon-"], [class*=" icon-"] {
    background-image: none;
    background-position: 0 0;
    background-repeat: repeat;
    display: inline;
    height: auto;
    line-height: normal;
    margin-top: 0;
    vertical-align: baseline;
    width: auto;
}
[class^="icon-"], [class*=" icon-"] {
    font-family: FontAwesome;
    font-style: normal;
    font-weight: normal;
    text-decoration: inherit;
}

.label, .badge {
    background-color: #bbb;
    text-shadow: none;
}

.box .box-content {
    background: none repeat scroll 0 0 #e9f0f9;
    padding: 10px;
    float: left;
    width: 98%;
}
*::-moz-selection {
    background: none repeat scroll 0 0 #3e4349;
    color: #fff;
}
</style>

<div class="row-fluid" style="background: none repeat scroll 0 0 #e9f0f9;">
    <div class="span12">
        <div class="box">
            <div class="box-title">
                <h3><i class="icon-table"></i><?=$page_title?></h3>
                <div class="box-tool">
                 
                </div>
            </div>
          <div class="box-content">
            	
            	<!-- <div class="cv_box" style="clear: both; margin-bottom: 10px; float:left;">
					<div class="label" style=" float: left; margin-right: 10px">Inquiry</div>
					<div class="cv_div" style="float: left;"><?php echo $this->data['ContactDepartment']["title"]; ?></div>
				</div>
            	
            	<div class="cv_box" style="clear: both; margin-bottom: 10px; float:left;">
					<div class="label" style=" float: left; margin-right: 10px">Subject</div>
					<div class="cv_div" style="float: left;"><?php echo $this->data[$modelName]["subject"]; ?></div>
				</div> -->
				
              	<div class="cv_box" style="clear: both; margin-bottom: 10px; float:left;">
					<div class="label" style=" float: left; margin-right: 10px">Name</div>
					<div class="cv_div" style="float: left;"><?php echo $this->data[$modelName]["name"]; ?></div>
				</div>
				
				
				
				<div class="cv_box"style="clear: both; margin-bottom: 10px; float:left;">
					<div class="label"  style=" float: left; margin-right: 10px">Email</div>
					<div class="cv_div" style="float: left;"><?php echo $this->request->data["$modelName"]["email"]?></div>
				</div>
				
				<!-- <div class="cv_box" style="clear: both; margin-bottom: 10px; float:left;">
					<div class="label" style=" float: left; margin-right: 10px">Company</div>
					<div class="cv_div" style="float: left;"><?php 
					
					if(empty($this->data[$modelName]["company"])){
						echo "N/A";
					}else{
						echo $this->data[$modelName]["company"]; 
					}
					?></div>
				</div> -->
				<br />
				
				<!-- <div class="cv_box"style="clear: both; margin-bottom: 10px; float:left;">
					<div class="label"  style=" float: left; margin-right: 10px">Phone</div>
					<div class="cv_div" style="float: left;"><?php 
					
					if(empty($this->request->data["$modelName"]["phone"])){
						echo "N/A";
					}else{
						echo $this->request->data["$modelName"]["phone"];
					}
					?></div>
				</div> -->
				
				<div class="cv_box"style="clear: both; margin-bottom: 10px; float:left;">
					<div class="label"  style=" float: left; margin-right: 10px">Message</div>
					<div class="cv_div" style="float: left;"><?php echo $this->request->data["$modelName"]["message"]?></div>
				</div>
				
				
				<div class="cv_box"style="clear: both; margin-bottom: 10px; float:left;">
					<div class="label"  style=" float: left; margin-right: 10px">Date</div>
					<div class="cv_div" style="float: left;"><?php echo $this->request->data["$modelName"]["created"]?></div>
				</div>
				
				<!-- <div class="cv_box"style="clear: both; margin-bottom: 10px; float:left;">
					<div class="label"  style=" float: left; margin-right: 10px">Date</div>
					<div class="cv_div" style="float: left;"><?php  echo $this->Time->niceShort($this->data[$modelName]['created']);?></div>
				</div> -->
				<!-- <div class="cv_box">
					<div class="label" style="">Website</div>
					<div class="cv_div"><?php echo $this->request->data["$modelName"]["website"]?></div>
				</div> -->
				<!-- <div class="cv_box"style="clear: both; margin-bottom: 10px; float:left;">
					<div class="label" style="border:0px;padding:0px; float: left; margin-right: 10px">CV</div>
					<div class="cv_div" style="float: left;"><a href="/admin/jobs/download/<?php echo $this->request->data["$modelName"]["id"]; ?>" title="download"><span class="FloatClass"><?php echo $this->request->data["$modelName"]["cv"]; ?></span></a></div>
				</div> -->
            
                
                
                <div class="clearfix"></div>
                
				

            </div>
        </div>
    </div>
</div>
                <!-- END Main Content -->
          
          
<!-- End Modal -->
                
                
<script>



// When the document is ready set up our sortable with it's inherant function(s) 
    $(document).ready(function() {

     
    }); 
  
</script>