<?php
	ob_start ("ob_gzhandler");
	header("Content-Type: text/css");
	header("Cache-Control: public\r\n");
	
	print (file_get_contents("./default.css"));
	
	print (file_get_contents("./SlickNav-master/dist/slicknav.css"));
	print (file_get_contents("./uicustom/jquery-ui.min.css"));
	
	print (file_get_contents("./slick/slick.css"));
	print (file_get_contents("./slick/slick-theme.css"));
	
	print (file_get_contents("./accordion/accordion.css"));
	
	print (file_get_contents("./bootstrap/css/bootstrap.css"));
	
	
	print (file_get_contents("./fancybox/jquery.fancybox.css"));
	
	print (file_get_contents("./jquery.bxslider/jquery.bxslider.css"));
	
	
	//ob_flush();
	
	$fileName="css_cached.css";
	$fh = fopen("./{$fileName}", "w+");
	chmod("./{$fileName}", 0644);
	$data = ob_get_clean();
	 
	fwrite($fh, $data);
	fclose($fh);
//  
	