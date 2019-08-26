<div class="floatClass col-lg-12 col-md-12 col-sm-12 col-xs-12 internalContent">
	<?php
	$text=$page_details['DynamicPage']['text'];
	 ?>
	<div class="internalText">
		<div class="internalTopBorder col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
		<?php  echo $text ?>

		<div class="floatClass careerList col-lg-12 col-md-12 col-sm-12 col-xs-12">

			<div class="floatClass  contactUsBranchesContainer col-lg-9 col-md-9 col-sm-12 col-xs-12">

				<div class="floatClass  col-lg-12 col-md-12 col-sm-12 col-xs-12">


					<div class="floatClass contactHeaderBorder"></div>
					<div class="floatClass contactHeaderInternalContainer col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<?php

							$head_id=$contact_branches['head']['DynamicPage']['id'];
							$show_room_id=0;
							if(isset($contact_branches['show_room'][0]['DynamicPage']['id'])){
								$show_room_id=$contact_branches['show_room'][0]['DynamicPage']['id'];
							}
						?>
						<div onclick="show_contact_branch('head' , '<?=$head_id?>')" class="floatClass contactHeaderTitle " id="head"><?=__("Head Office",true)?></div>
						<div class="floatClass ContactHeaderSeperator"></div>
						<div onclick="show_contact_branch('showroom','<?=$show_room_id?>')" class="floatClass contactHeaderTitle" id="Showrooms"><?=__("Showrooms",true)?></div>
					</div>
					<div class="floatClass contactHeaderBorder"></div>

					<div class="floatClass contactBranchesElement col-lg-12 col-md-12 col-sm-12 col-xs-12">

						<?php foreach($contact_branches['show_room'] as $b){
							$id=$b['DynamicPage']['id'];
							$title=$b['DynamicPage']['title'];

							?>

							<div class="floatClass subBranchTitle" id="subBranchTitle_<?=$id?>" onclick="show_contact_sub_branch('<?=$id?>')" ><?=$title?></div>

							<?php
						} ?>

						<div class="floatClass contactBranchesLoader"><img src="/img/ajax-loader.gif" width="20" height="20" /> </div>
					</div>
				</div>

				<div id="contact_details_content" class="floatClass contact_details_content col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>

			</div>

			<!-- contact form -->
			<div class="floatClass contactFormContainer col-lg-3 col-md-3 col-sm-12 col-xs-12">

				<div class="floatClass contactFormHeaderTitle col-lg-12 col-md-12 col-sm-12 col-xs-12"><?=__("For any inquiry fill your information form below:",true)?></div>

				<?php echo $this->form->create('Contact',array("url"=>array("controller"=>"Contacts","action"=>"save_contact"),"id"=>"contact")); ?>

					<div class="floatClass ContactFormRow"><?php echo $this->form->input('name',
					array("class"=>"required  ContactInput Input defaultInvalid","label"=>false,"escape"=>false
					 ,'id'=>'f_name' , 'placeholder'=>'Full Name' )); ?>
					</div>

					<div class="floatClass ContactFormRow"><?php echo $this->form->input('email',
					array("class"=>"required email  ContactInput Input defaultInvalid","label"=>false,"escape"=>false
					 ,'id'=>'email' , 'placeholder'=>'Email' )); ?>
					</div>

					<div class="floatClass ContactFormRow"><?php echo $this->form->input('message',
					array("class"=>"required  ContactTextArea Input defaultInvalid","label"=>false,"escape"=>false , 'type'=>'textArea'
					 ,'id'=>'message' , 'placeholder'=>'Message' )); ?>
					</div>

					<div class=" ContactFormRow floatClass g-recaptcha" data-sitekey="6LdH6RkTAAAAAFa4zeNEdA7wXt66J0_9WHNHnt5y"></div>

					<div class="ContactFormRow floatClass">
						<div class="submitBtn">
							<?php
							$send=__("SUBMIT",true);
							echo $this->form->input($send, array('class'=>'floatClass JobSubmit' , 'type'=>'submit' ,'label'=>false , 'escape'=>false));  ?>
                                        <?php echo $this->Session->flash(); ?>
						</div>
						<div class="floatClass jobSubmitloader"><img src="/img/ajax-loader.gif" width="20" height="20" /></div>

					</div>
					<div id="msg" class="FormStatus" onclick="$('#msg').fadeOut();" style="display:none;"></div>
				<?php echo $this->form->end(); ?>
			</div>
		</div>
	</div>
</div>

<script>

show_contact_branch('head' , '<?=$head_id?>');

        $('#contact').validate({
        rules: {
            name: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                email: true
            },
            hiddenRecaptcha: {
                 required: function() {
                     if(grecaptcha.getResponse() == '') {
                        console.log(1);
                         return true;
                     } else {
                        console.log(0);
                         return false;
                     }
                 }
            }
        },
        messages: {
            name: {
                required: "Please enter your first name",
                minlength: "Please enter full name"
            },
            email: "Please enter a valid email address",
            purpose_id: "Please select purpose",
            hiddenRecaptcha: {
                checkCaptcha: "Your Captcha response was incorrect. Please try again."
            }
        }
    });
</script>
