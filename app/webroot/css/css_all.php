<?php
	ob_start ("ob_gzhandler");
	header("Content-Type: text/css");
	header("Cache-Control: public\r\n");
	
	print (file_get_contents("bootstrap.min.css"));
	
	print (file_get_contents("sticky-footer.css"));
	
	print (file_get_contents("style.css"));
	
	//print (file_get_contents("style.css"));
	
	print (file_get_contents("default.css"));
	
	print (file_get_contents("./checkbox/default.css"));
	
	print (file_get_contents("./black_and_white/black_and_white.css"));
	
	print (file_get_contents("./multi_select/jquery.multiselect.css"));
	print (file_get_contents("./uicustom/uicustom.css"));
	
	
	//print (file_get_contents("jquery.bxslider.css"));
	
	//ob_flush();
	
	$fileName="css_cached.css";
	$fh = fopen("./{$fileName}", "w+");
	chmod("./{$fileName}", 0644);
	$data = ob_get_clean();
	
	fwrite($fh, $data);
	fclose($fh);
	
	
	ob_flush();
