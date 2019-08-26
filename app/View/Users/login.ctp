<!--absolute & transparent-->
<div class="loginBox"></div>	
<!--absolute & not transparent-->
<div class="loginBoxContent">
		
		<div class="fbLoginDiv"><img src="/img/spacer.gif" alt="" style="border:none;" class="fbLoginBtn" /></div>
		
		
		<div class="itiviLoginDiv">
			<div class="itiviLoginDivTitle"><?php echo __("login_using_itivi");?></div>
		 	<?php echo $this->form->create('Login',array('id'=>"loginForm",'url'=>array('controller'=>'users','action'=>'login'),'inputDefaults'=>array('escape'=>false,"label"=>false,'class'=>"registerField required" ,"div"=>false)));?>
		 	
		 	<?php $val = strtoupper(__("email",true));?>
		 		<fieldset class="inputRow" style="">
					<label id="loginEmailLabel" for="emailLogin" onclick="$(this).next().focus()"><?=$val?></label>
					<?php echo $this->form->input("email",array('class'=>"registerField required email","onkeypress"=>"hide_label(this)","onblur"=>"show_hide_label(this)","onfocus"=>"show_hide_label(this)"));?>
				</fieldset>
				
		 	<?php $val = strtoupper(__("password",true));?>
		 		<fieldset class="inputRow" style="">
					<label id="loginpwdLabel" for="pwdLogin" onclick="$(this).next().focus()"><?=$val?></label>
					<?php echo $this->form->input("password",array("type"=>"password","onkeypress"=>"hide_label(this)","onblur"=>"show_hide_label(this)","onfocus"=>"show_hide_label(this)"));?>
				</fieldset>
				
		 	<?php 
		 		
		 		
//		 		echo $this->form->input("email",array('class'=>"registerField required email"));
		 		//echo $this->form->input("password",array("type"=>"password"));
		 	?>
			
				<div class="loginSubmitDiv">
					<div class="notMemberdiv"><a href="/users/register"><?php echo __("not_member",true);?></a></div>
					<div class="forgotPwdDiv"><a href="/users/forgot_pwd"><?php echo __("forgot_pwd",true);?></a></div>
					<?php echo $this->form->submit(" ",array("class"=>"loginBtn","escape"=>false,"div"=>false));?>
				</div>
		
			 <?php echo $this->form->end(); ?>
		</div>
	 
	</div>
	
<script type="text/javascript">
$(document).ready(function() {
//	$("#loginForm").validate();
		
		
		
		
	
		$('.fbLoginBtn').click(function(e) {
			e.preventDefault();
			/*console.log('trying to login using FB');*/

            FB.login(function(response) {
                if (response.authResponse) {
                    /*console.log('Welcome!  Fetching your information.... ');*/
                    FB.api('/me', function(response) {
                        /*console.log('Good to see you, ' + response.name + '.');*/
                        document.location.href = '/users/fb_login/1';
                    });
                } else {
                    /*console.log('User cancelled login or did not fully authorize.');*/
                }
            }, {scope : 'email,user_birthday,user_hometown,user_mobile_phone'});
		});
		
		
		
		
		var direct_login = '<?=$direct_login?>';
		
		if(direct_login == 1){
			
			setTimeout(function(){$('.fbLoginBtn').trigger('click');},2000);
			
		}
});
</script>