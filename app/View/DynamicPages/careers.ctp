<?php if($isAjax == false){ ?>
	<div class="floatClass col-lg-12 col-md-12 col-sm-12 col-xs-12 internalContent">
		<?php  } ?>
		<?php
		$text=$page_details['DynamicPage']['text'];
		 ?>

		<div class="internalText">
			<div class="internalTopBorder col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
			<?php  echo $text ?>




			<div class="floatClass careerList col-lg-8 col-md-12 col-sm-12 col-xs-12">
				<?php

				if(!empty($job_list)){
					?>

					<div class="floatClass col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="floatClass jobListHeaderTitle col-lg-12 col-md-12 col-sm-12 col-xs-12"><?=__("Job vacancies",true)?></div>
						<div class="floatClass jobListHeaderBorder col-lg-3 col-md-3 col-sm-12 col-xs-12"></div>
					</div>
					<div class="flaotClass jobListContainer  col-lg-12 col-md-12 col-sm-12 col-xs-12">

						<?php

						foreach($job_list as $job){
							$id=$job['Job']['id'];
							$title=$job['Job']['title'];
							$text=$job['Job']['text'];

							$url="/$lang/DynamicPages/job_details/$id";
							?>


							<div class="floatClass jobListAccord col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div id="jobListAccordTitle_<?=$id?>" onclick="show_job_details('<?=$url?>', '<?=$id?>')" class="floatClass jobListAccordTitle col-lg-12 col-md-12 col-sm-12 col-xs-12"><?=$title?></div>

								<div id="jobListAjaxLoader_<?=$id?>" class="floatClass jobListAjaxLoader"><img src="/img/ajax-loader.gif" width="20" height="20" /></div>
								<div id="jobDetailsTextContainer_<?=$id?>" class="floatClass jobDetailsTextContainer col-lg-12 col-md-12 col-sm-12 col-xs-12">


								</div>
							</div>


							<?php

						}
						?>
					</div>
					<?php
				}
				 ?>
			</div>
		</div>

<?php if($isAjax == false){ ?>
	</div>
<?php  } ?>