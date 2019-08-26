<div class="floatClass mainMenuContainer col-lg-12 col-md-12 col-sm-12 col-xs-12">
	
	
	<div class="mainMenuInnerContainer container">
	
		<div id="mMenu"></div>
		<!-- <div id="nav"> -->
			<ul id="menu">						
				<?php
				
				
				$home="/";
				$about_us="/$lang/DynamicPages/about_us/";
				$our_business="/$lang/DynamicPages/business/our_business_local/";
				$our_brands="/$lang/DynamicPages/our_brands/";
				$news_events="/$lang/DynamicPages/news_events_landing/";
				$careers="/$lang/DynamicPages/careers/";
				$contact="/$lang/DynamicPages/contact_us/";
				
				
				$online_shopping=$social_media_links['SocialMedia']['shop_online'];
											
				
				 ?>
				
				<li><div class="menuSeperator  visible-lg floatClass"></div><a class="floatClass "  id="home"  href="<?=$home?>"><?=strtoupper(__("home",true))?></a> <div class="menuSeperator  visible-lg floatClass"></div></li>
				
				<li><a class="floatClass"  id="about_us"  href="<?=$about_us?>"><?=strtoupper(__("about_us",true))?></a><div class="menuSeperator floatClass visible-lg"></div></li>
				<li><a class="floatClass"  id="our_business"  href="<?=$our_business?>"><?=strtoupper(__("our_businees",true))?></a> <div class="menuSeperator floatClass visible-lg"></div></li>
				<li><a class="floatClass"  id="our_brands"  href="<?=$our_brands?>"><?=strtoupper(__("our_brands",true))?></a> <div class="menuSeperator floatClass visible-lg"></div></li>
				<li><a class="floatClass"  id="news_events"  href="<?=$news_events?>"><?=strtoupper(__("news_events",true))?></a><div class="menuSeperator floatClass visible-lg"></div></li>
				<li><a class="floatClass"  id="careers"  href="<?=$careers?>"><?=strtoupper(__("careers",true))?></a><div class="menuSeperator floatClass visible-lg"></div></li>
				<li><a class="floatClass"  id="contact_us"  href="<?=$contact?>"><?=strtoupper(__("contact_us",true))?></a><div class="menuSeperator  visible-lg floatClass"></div></li>
				
				<li><a class="floatClass hidden-lg" href="<?=$online_shopping?>"><?=strtoupper(__("shop_online",true))?></a></li>
				
				<li class="shopOnline visible-lg floatRevClass"><a target="_blank" class="floatClass "  id="shop_online"  href="<?=$online_shopping?>"><?=strtoupper(__("shop_online",true))?></a></li>
			</ul>	
		</div>		
	<!-- </div> -->
</div>
			
			
		
		
	
<script type="text/javascript">
	$(document).ready(function(){		
		
		
		
		
		$('#menu').slicknav({
			prependTo:'#mMenu'
			
		});


		
		
		var controller='<?=$this->params['controller'];?>';
		var action='<?=$this->params['action'];?>';
		
		<?php
		if(isset($this->params['pass'][0])){
		 ?>
		var pass='<?=$this->params['pass'][0];?>';
		<?php } ?>
		
		switch(controller){			
			case'pages':{
				if(action == 'display' ){
					
					$('#home').addClass('mainMenuActive');		
				}	
	
				break;
			}	
			
			case'DynamicPages':{
				if(action == 'about_us' ){
					$('#about_us').addClass('mainMenuActive');		
				}	
				if(action == 'business'){
					$('#our_business').addClass('mainMenuActive');
				}
				
				if(action == 'our_brands'){
					$('#our_brands').addClass('mainMenuActive');
				}
				
				if(action == 'news_events_landing' || action == 'news_events_listing'  || action == 'news_events_view'){
					$('#news_events').addClass('mainMenuActive');
				}
				
				if(action == 'careers' ){
					$('#careers').addClass('mainMenuActive');
				}
				
				if(action == 'contact_us' ){
					$('#contact_us').addClass('mainMenuActive');
				}
				
				break;
			}	
		
		}		
	});
</script>

