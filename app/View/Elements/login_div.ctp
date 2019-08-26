<?php if(!isset($UserInfo)){ ?>
	<a href="/users/register">Register</a>
	<a href="/users/login">Login</a>
	
	<div class="fb-login-button" data-show-faces="false" data-width="200" data-max-rows="1" on-login="top.location = '/users/fb_login/1'" data-scope="email"></div>

<?php }else{ 
			echo "<div class='welcomeDiv'><a href='/users/edit_profile'>".__("welcome",true)." ".$UserInfo["User"]["fname"]." ".$UserInfo["User"]["lname"]."</a></div>";
			echo "<div class='logoutDiv'><a href='/users/logout'>".__("logout",true)."</a></div>";
	?>

<?php } ?>