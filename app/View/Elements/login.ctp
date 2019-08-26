<div class="floatClass loginBtn">
	
	<?php if(isset($userInfo) && !empty($userInfo)){
		?>
		<div class="floatClass LogOutIcon"  onclick="openLoginArea()"> <img src="/img/spacer.gif" width="18" height="18" alt=""/> </div>
	
		<!-- <div class="floatClass loginUserName">
			
			<?php 
			$welcome=__("Welcome",true);
			$user=$welcome." ".$userInfo['User']['name'];
			echo $user;
			
			$m_titles=$menu_titles['hbku_employee'];
			?>
		</div> -->
		
		<div class="employeeMenuContainer">
			<div class="floatClass employeeMenuTitle"><a href="/<?=$lang?>/DynamicPages/employee"> <?=$m_titles?></a></div>
			<div class="floatRevClass employeeSectionMenuArrow" ><img src="/img/spacer.gif" width="" height="" alt=""/></div>
		</div>
		<div class="floatClass loginTitle" id="logout"   ><a href="/users/logout"> <?=__("LOGOUT")?></a></div>
	
	<?php }else{?>
		<div class="floatClass LoginIcon"  onclick="openLoginArea()"> <img src="/img/spacer.gif" width="18" height="18" alt="" /> </div>
	
		<div class="floatClass loginTitle" id="login" onclick="openLoginArea()"><?=__("LOGIN")?></div>
	<?php } ?>
	
	
	
	<div class="loginFormContainer">
		
		 	<?php echo $this->form->create('User',array('id'=>"loginForm",'url'=>array('controller'=>'users','action'=>'login'),'inputDefaults'=>array('escape'=>false,"label"=>false,'class'=>"registerField required" ,"div"=>false)));?>
		 	
		 
		 	<div class="LoginRow floatClass">
				<label class="floatClass login_label"><?=__("Username",true)?></label>
				<div class="floatClass loging_field_contaainer"><?php echo $this->form->input('email',array("class"=>"required  loginInput defaultInvalid","label"=>false,"escape"=>false
				)); ?>
				</div>
			</div>
			
			<div class="LoginRow floatClass">
				<label class="floatClass login_label"><?=__("Password",true)?></label>
				<div class="floatClass loging_field_contaainer"><?php echo $this->form->input('password',array( "type"=>"password", "class"=>"required  loginInput defaultInvalid","label"=>false,"escape"=>false
				 )); ?>
				</div>
			</div>
				
				

			
				<div class="floatClass loginSubmitDiv">
					<?php $login=__("LOGIN",true); ?>
					<?php echo $this->form->submit("$login",array("class"=>"loginSubmitBtn","escape"=>false,"div"=>false));?>
				</div>
		
			 <?php echo $this->form->end(); ?>
		
		
	</div>
</div>

<script type="text/javascript">
	
	$(document).ready(function (){
		
		$('#loginForm').valid();
	});
	function openLoginArea(){
		if($(".loginFormContainer").is(':hidden')){
			$(".loginFormContainer").show();
		}else{
			$(".loginFormContainer").hide();
		}
	}
	
</script>