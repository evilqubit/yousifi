<div class="floatClass footerFirstContainer">

	<div class="container">
		<div class="floatClass col-lg-1 col-md-1" style="width: 110px;"></div>
		<div class="floatCalss col-lg-4 col-md-4 col-sm-12 col-xs-12 footerLeftContainer">

			<?php
			$text=$footer_details['DynamicPage']['short'];
			$url=$footer_details['DynamicPage']['footer_email'];
			?>

			<div class=" footerStayIntouch"><?=__("Stay In Touch",true)?></div>
			<div class="floatClass footerSeparator visible-lg"></div>
			<div class=" footerContactText">
				<div class="floatClass"><?=$text?></div>
				<div class="floatClass footerEmail col-md-12 col-sm-12 col-xs-12"><a href="mailto:<?=$url?>"><?=$url?></a></div>
			</div>
		</div>


		<div class="floatCalss col-lg-5 col-md-5 col-sm-12 col-xs-12">
			<div class=" footersubscribe"><?=__("Subscribe to our Newsletter",true)?></div>
			<div class="floatClass footerSeparator visible-lg"></div>
			<div class=" footerNewsletter">


				<?php echo $this->form->create('newsletter',array("url"=>array("controller"=>"Pages","action"=>"register_newsletter"),"id"=>"newsletterForm")); ?>

					<div class="floatClass newsLetterRow"><?php echo $this->form->input('name',
					array("class"=>"required  newsletterInput Input defaultInvalid","label"=>false,"escape"=>false
					 ,'id'=>'name' , 'placeholder'=>'Enter your name' )); ?>
					</div>

					<div class="floatClass newsLetterRow"><?php echo $this->form->input('email',
					array("class"=>"required  newsletterInput defaultInvalid","label"=>false,"escape"=>false
					 ,'id'=>'email' , 'placeholder'=>'Enter your email address' )); ?>
					</div>

					<div class=" newsLetterRow floatClass g-recaptcha" data-sitekey="6LdH6RkTAAAAAFa4zeNEdA7wXt66J0_9WHNHnt5y"></div>

					<div class="newsLetterRow floatClass">
						<div class="newsletterSubmitBtn">
							<?php
							$send=__("SUBMIT",true);
							 echo $this->form->input($send, array('class'=>'floatClass newsLetterSubmit' , 'type'=>'submit' ,'label'=>false , 'escape'=>false));  ?>
						 </div>
						 <div class="floatClass newsletterAjaxLoader"><img src="/img/ajax-loader.gif" width="20" height="20" /></div>
						 <div id="news_letter_msg" class="FormStatus" onclick="$('#msg').fadeOut();" style="display:none;"></div>
					</div>

				<?php echo $this->form->end(); ?>

				<script type="text/javascript">
				function validation(){
					var text2='<?=__('This field is required',true)?>';
					jQuery.validator.addMethod("defaultInvalid", function(value, element) {
						return value != element.defaultValue;
					}, text2 );

					return $('#newsletterForm').valid();
				}
				$(document).ready(function() {
						var options = {
							beforeSubmit: function(){
								$(".newsletterSubmitBtn").hide();
								$(".newsletterAjaxLoader").show();


								// if($("#footerCap").length  == 0){
								// 	$.ajax({
								// 			url: "/DynamicPages/get_footer_captcha/",
								// 			beforeSend:function(data){

								// 			},
								// 			success: function(data){

								// 				$("#news_letter_recaptcha_container").html(data);

								// 			},
								// 			complete: function(){

								// 				$(".newsletterSubmitBtn").show();
								// 				$(".newsletterAjaxLoader").hide();
								// 			}
								// 		});

								// 	return false;
								// }

								var valid = validation();
									if (valid == 1){
										return true;
									}
									else{
										$(".newsletterSubmitBtn").show();
										$(".newsletterAjaxLoader").hide();
										return false;
									}
							},
							resetForm: false,
							success:function(data){
								var text='';
								if(data == 1){
									text ='<?=__("newsletter_msg_1",true)?>';
								}
								if(data == 2){
									text ='<?=__("newsletter_msg_2",true)?>';
								}

								if(data == 5){
									text ='<?=__("visual_code",true)?>';
								}
								// if(data == 3){
									// text ='<?=__("email_sent",true)?>';
									// $('#newsletterForm').clearForm();
									// $('#newsletterForm').resetForm();
								// }

								if(data == 10){
									text ='<?=__("newsletter_msg_10",true)?>';
								}
								$('#news_letter_msg').html(text);
								$('#news_letter_msg').show();

								$(".newsletterSubmitBtn").show();
								$(".newsletterAjaxLoader").hide();

							}
						};
							$('#newsletterForm').ajaxForm(options);
					 		$("#newsletterForm").addClass('requiredField');
				});
				</script>
			</div>
		</div>
	</div>
</div>

<div class="floatClass footerSecondContainer">

	<div class="container">
		<div class="floatClass copyRight">Copyright <?=date("Y")?>. All Rights Reserved to Easa Hussain Al Yousifi & Sons Co.</div>

		<div class="floatRevClass intouch"><a target="_bllank" " href="http://www.intouchmena.com/">Website Design and Development by intouch</a></div>
	</div>
</div>
