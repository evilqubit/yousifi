<!-- BEGIN Main Content -->



<?php

$p=$this->request->data["$modelName"]["position"];
$post=$job_position["$p"];


$g=$data['AppliedCv']['gender'];
if($g == "Male"){
	$gender='Male';
}else{
	$gender='Female';
}


$job='';
if(isset($data['AppliedCv']['job']) && !empty($data['AppliedCv']['job']) && $data['AppliedCv']['job'] != 0 ){
	$job=$data['AppliedCv']['job'];
}

$main_url=Configure::read('WEBSITE_URL');

$cv_download_url=$main_url."/admin/Jobs/download/$id/cv";
$photo_download_url=$main_url."/admin/Jobs/download/$id/photo";
$passport_download_url=$main_url."/admin/Jobs/download/$id/passport";
$portfolio_download_url=$main_url."/admin/Jobs/download/$id/portfolio";

$cv_down='';
if(isset($data['AppliedCv']['cv']) && !empty($data['AppliedCv']['cv'])){
	$file=$data['AppliedCv']['cv'];
	$cv_down="$cv_download_url";
}


$photo_down='';
if(isset($data['AppliedCv']['photo']) && !empty($data['AppliedCv']['photo'])){
	$file=$data['AppliedCv']['photo'];
	$photo_down="$photo_download_url";
}


$passport_down='';
if(isset($data['AppliedCv']['passport']) && !empty($data['AppliedCv']['passport'])){
	$file=$data['AppliedCv']['passport'];
	$passport_down="$passport_download_url";
}

$portfolio_down='';
if(isset($data['AppliedCv']['portfolio']) && !empty($data['AppliedCv']['portfolio'])){
	$file=$data['AppliedCv']['portfolio'];
	$portfolio_down="$portfolio_download_url";
}






$experience_r=$data['AppliedCv']['retail_experience'];

if($experience_r == 1){
	$experience='Yes';
}else{
	$experience='No';
}



?>


<div class="row-fluid">
                    <div class="span12">
                        <div class="box">
                            <div class="box-title">
                                <h3><i class="icon-table"></i><?=$page_title?></h3>
                                <div class="box-tool">

                                </div>
                            </div>
                          <div class="box-content">
                              	<div class="cv_box" style="clear: both; margin-bottom: 10px; float:left;">
									<div class="label" style=" float: left; margin-right: 10px">Name</div>
									<div class="cv_div" style="float: left;"><?php echo $this->request->data["$modelName"]["full_name"]; ?></div>
								</div>

								<div class="cv_box"style="clear: both; margin-bottom: 10px; float:left;">
									<div class="label"  style=" float: left; margin-right: 10px">Email</div>
									<div class="cv_div" style="float: left;"><?php echo $this->request->data["$modelName"]["email"]?></div>
								</div>


								<?php if(isset($job) && !empty($job) ){ ?>

									<div class="cv_box"style="clear: both; margin-bottom: 10px; float:left;">
										<div class="label"  style=" float: left; margin-right: 10px">Job</div>
										<div class="cv_div" style="float: left;"><?php echo $job?></div>
									</div>
								<?php } ?>

								<div class="cv_box"style="clear: both; margin-bottom: 10px; float:left;">
									<div class="label"  style=" float: left; margin-right: 10px">Phone</div>
									<div class="cv_div" style="float: left;"><?php

										if(empty($this->request->data["$modelName"]["phone"])){
											echo "N/A";
										}else{
											echo $this->request->data["$modelName"]["phone"];
										}

										?></div>
								</div>


								<div class="cv_box"style="clear: both; margin-bottom: 10px; float:left;">
									<div class="label"  style=" float: left; margin-right: 10px">nationality country</div>
									<div class="cv_div" style="float: left;"><?php echo $this->request->data["$modelName"]["nationality_country"]?></div>
								</div>


								<div class="cv_box"style="clear: both; margin-bottom: 10px; float:left;">
									<div class="label"  style=" float: left; margin-right: 10px">Gender</div>
									<div class="cv_div" style="float: left;"><?php echo $gender?></div>
								</div>

								<div class="cv_box"style="clear: both; margin-bottom: 10px; float:left;">
									<div class="label"  style=" float: left; margin-right: 10px">Residence country</div>
									<div class="cv_div" style="float: left;"><?php echo $this->request->data["$modelName"]["residence_country"]?></div>
								</div>

								<div class="cv_box"style="clear: both; margin-bottom: 10px; float:left;">
									<div class="label"  style=" float: left; margin-right: 10px">Address</div>
									<div class="cv_div" style="float: left;"><?php echo $this->request->data["$modelName"]["address"]?></div>
								</div>

								<div class="cv_box"style="clear: both; margin-bottom: 10px; float:left;">
									<div class="label"  style=" float: left; margin-right: 10px">Date of birth </div>
									<div class="cv_div" style="float: left;"><?php echo $this->request->data["$modelName"]["dob"]?></div>
								</div>


								<div class="cv_box"style="clear: both; margin-bottom: 10px; float:left;">
									<div class="label"  style=" float: left; margin-right: 10px">Position </div>
									<div class="cv_div" style="float: left;"><?php echo $post?></div>
								</div>

								<div class="cv_box"style="clear: both; margin-bottom: 10px; float:left;">
									<div class="label"  style=" float: left; margin-right: 10px">Experience </div>
									<div class="cv_div" style="float: left;"><?php echo $experience?></div>
								</div>

								<div class="cv_box"style="clear: both; margin-bottom: 10px; float:left;">
									<div class="label"  style=" float: left; margin-right: 10px">Retail/fashion experience</div>
									<div class="cv_div" style="float: left;"><?php echo $this->request->data["$modelName"]["experience"]?></div>
								</div>


								<div class="cv_box"style="clear: both; margin-bottom: 10px; float:left;">
									<div class="label" style="border:0px;padding:0px; float: left; margin-right: 10px">CV</div>
									<div class="cv_div" style="float: left;">
										<?php if(isset($cv_down) && !empty($cv_down)){?>
											<a href="<?=$cv_down?>" title="download"><span class="FloatClass"><?php echo $this->request->data["$modelName"]["cv"]; ?></span></a>
										<?php }else{
											echo "N/A";
										} ?>
									</div>
								</div>


								<div class="cv_box"style="clear: both; margin-bottom: 10px; float:left;">
									<div class="label" style="border:0px;padding:0px; float: left; margin-right: 10px">Photo</div>
									<div class="cv_div" style="float: left;">
										<?php if(isset($photo_down) && !empty($photo_down)){?>
											<a href="<?=$photo_down?>" title="download"><span class="FloatClass"><?php echo $this->request->data["$modelName"]["photo"]; ?></span></a>
										<?php }else{
											echo "N/A";
										} ?>
									</div>
								</div>


								<div class="cv_box"style="clear: both; margin-bottom: 10px; float:left;">
									<div class="label" style="border:0px;padding:0px; float: left; margin-right: 10px">passport </div>
									<div class="cv_div" style="float: left;">
										<?php if(isset($passport_down) && !empty($passport_down)){?>
											<a href="<?=$passport_down?>" title="download"><span class="FloatClass"><?php echo $this->request->data["$modelName"]["passport"]; ?></span></a>
										<?php }else{
											echo "N/A";
										} ?>
									</div>
								</div>


								<div class="cv_box"style="clear: both; margin-bottom: 10px; float:left;">
									<div class="label" style="border:0px;padding:0px; float: left; margin-right: 10px">portfolio</div>
									<div class="cv_div" style="float: left;">
										<?php if(isset($portfolio_down) && !empty($portfolio_down)){?>
											<a href="<?=$portfolio_down?>" title="download"><span class="FloatClass"><?php echo $this->request->data["$modelName"]["portfolio"]; ?></span></a>
										<?php }else{
											echo "N/A";
										} ?>
									</div>
								</div>


                                <div class="clearfix"></div>



                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Main Content -->


<!-- Modal -->

<!-- <div id="modal-1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel1">Publish to Facebook</h3>
        </div>
        <div id="facebook_publish"class="modal-body">

        </div>

 </div> -->

 <!-- <div id="modal-2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel1">Publish to Twitter</h3>
        </div>
        <div id="twitter_publish"class="modal-body">

        </div>

 </div> -->

 <script>

	 $('.fb-pub').click(function(){

		 var url = $(this).attr('data-url');

		 url = encodeURIComponent(url);

		 var redirect = '<?php echo  $this->here ?>';

		 $('#facebook_publish').load('/admin/facebook/publish/?url='+url+'&&redirect='+redirect);

	 });


	  $('.tw-pub').click(function(){

		 var url = $(this).attr('data-url');

		 url = encodeURIComponent(url);

		 var redirect = '<?php echo  $this->here ?>';

		 $('#twitter_publish').load('/admin/tweets/publish/?url='+url+'&&redirect='+redirect);

	 });



 </script>











<!-- End Modal -->


<script>



// When the document is ready set up our sortable with it's inherant function(s)
    $(document).ready(function() {






    });


</script>