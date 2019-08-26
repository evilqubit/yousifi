<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Login - In Touch CMS</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
		
		
       	<script type="text/javascript" src="/js/jquery/jquery-1.10.1.min.js"></script>
        <!--base css styles-->
        <link rel="stylesheet" href="/js/jquery/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="/js/jquery/bootstrap/bootstrap-responsive.min.css">
        <link rel="stylesheet" href="/js/jquery/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="/css/admin/normalize/normalize.css">
		
		
        <!--page specific css styles-->

        <!--flaty css styles-->
        <link rel="stylesheet" href="/css/admin/flaty.css?asdasdasd">
        <link rel="stylesheet" href="/css/admin/flaty-responsive.css">
		
		 <script type="text/javascript" src="/js/jquery/jquery-validation/dist/jquery.validate.min.js"></script>
		<script type="text/javascript" src="/js/jquery/jquery-validation/dist/additional-methods.min.js"></script>
		

        <link rel="shortcut icon" href="img/favicon.html">

        
        
        
        
         <script src="/js/jquery/modernizr/modernizr-2.6.2.min.js"></script>
        
       
    </head>
    <body class="login-page">
        <?php echo $this->Session->flash(); ?>	
        
        <div>
			<?php echo $this->fetch('content'); ?>
		</div>	
		
			
		
		
        <script src="/js/jquery/bootstrap/bootstrap.min.js"></script>
        
        <script type="text/javascript">
            function goToForm(form)
            {
                $('.login-wrapper > form:visible').fadeOut(500, function(){
                    $('#form-' + form).fadeIn(500);
                });
            }
            $(function() {
                $('.goto-login').click(function(){
                    goToForm('login');
                });
                $('.goto-forgot').click(function(){
                    goToForm('forgot');
                });
                $('.goto-register').click(function(){
                    goToForm('register');
                });
            });
        </script>
    </body>
</html>
