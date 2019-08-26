<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>In Touch - CMS</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="shortcut icon" href="/img/favicon.html">
        
       <?php require_once(WWW_ROOT.'css/admin/requiredcss.php'); ?>
       <?php require_once(WWW_ROOT.'js/admin/requiredjs.php'); ?>
       <!-- <script type="text/javascript" src="/js/admin/jquery.php"></script> -->
       
       <link rel="stylesheet" href="/js/jquery/color_picker/css/colorpicker.css" type="text/css" />

		<script type="text/javascript" src="/js/jquery/color_picker/colorpicker.js"></script>
		<script type="text/javascript" src="/js/jquery/color_picker/eye.js"></script>
		<script type="text/javascript" src="/js/jquery/color_picker/utils.js"></script>


	   	
		    

    
    </head>
    <body>


        <!-- BEGIN Navbar -->
        <div id="navbar" class="navbar">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <!-- BEGIN Brand -->
                    <a href="#" class="brand">
                        <small>
                         
                            <img style="height:27px; margin-top:-6px;" src="/img/admin/theme/logo.png?<?php echo rand(); ?>"/>
                            
                        </small>
                    </a>
                    <!-- END Brand -->

                    <!-- BEGIN Responsive Sidebar Collapse -->
                    <a href="#" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
                        <i class="icon-reorder"></i>
                    </a>
                    <!-- END Responsive Sidebar Collapse -->

                    <!-- BEGIN Navbar Buttons -->
                    <ul class="nav flaty-nav pull-right">
             
                    
                    
                       

                      
					<script>
    (function($){
        $(window).load(function(){   
			
            //$("#notificationMsg").mCustomScrollbar();
        });
    })(jQuery);
</script>
                        <!-- BEGIN Button User -->
                        <li class="user-profile">
                        <?php  //$user = $this->Session->read('Auth.Admin');
                          
                        
                         ?>
                        	<a href="/admin/administrators/logout">
                                        <i class="icon-off"></i>
                                        Logout
                                    </a>
                            
                        </li>
                        <!-- END Button User -->
                    </ul>
                    <!-- END Navbar Buttons -->
                </div><!--/.container-fluid-->
            </div><!--/.navbar-inner-->
        </div>
        <!-- END Navbar -->
                

            
        <!-- BEGIN Container -->
        <div class="container-fluid" id="main-container">
            <!-- BEGIN Sidebar -->
           <?php
           
           
          echo  $this->element("/admin/menu")?>
            <!-- END Sidebar -->

            <!-- BEGIN Content -->
            <div id="main-content">
            
			<?php echo $this->Session->flash(); ?>
			
			<div style="width: 1100px;">
			
			<?php echo $this->fetch('content'); ?>
             </div>   
           
                <link href="/js/jquery/hover/css/hover-min.css" rel="stylesheet">
              
                <footer>
                <?php //echo $this->element('sql_dump'); ?>
                    <p><?php echo date('Y'); ?> © Powered By <a class="hover-shadow" href="http://cyberchisel.com" target="_blank" rel="hover-shadow"><img width="22" height="25" src="/img/utility/cyberfooter.png"/></a> Cyber Chisel SAL </p>
                </footer>

                <a id="btn-scrollup" class="btn btn-circle btn-large" href="#"><i class="icon-chevron-up"></i></a>
            </div>
            <!-- END Content -->
        </div>
        <!-- END Container -->

        <script>
	       $('#<?php echo $this->params['controller']."-".$this->params['action'] ?>').attr('class','active');
	        
        </script>

<script>


$( document ).ready(function() {



 
});









</script>  


<div id="my_popup" class="well" >
		<div style="display: none;" id="layerLoader">
			<div style="width:100%; text-align: center; clear: both; margin: 0 auto;"><img src="/img/ajax-loader.gif" width="40" height="40" alt=""/> </div>
			<div style="width:100%; text-align: center; margin: 0 auto; color: #ffffff; font-size: 20px; margin-top: 20px">	<?=__('Loading_content');?></div>
		</div>
		<div id="my_popup_content"></div>
	</div>
	
	

         
        
        <!--flaty scripts-->
        <script src="/js/admin/flaty.js?wwasdws22dd2666w"></script>
		
    </body>
</html>

<?php //echo $this->element("sql_dump"); ?>
