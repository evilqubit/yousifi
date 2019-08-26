<?php
	ob_start ("ob_gzhandler");
	header("Content-Type: text/css");
	header("Cache-Control: public\r\n");
	
	print (file_get_contents("bootstrap.min.css"));
	
	print (file_get_contents("sticky-footer.css"));
	
	print (file_get_contents("style.css"));
	ob_flush();
	
//	$fh = fopen("./css_cached.css", "wb");
// 	$data = ob_get_clean();
//	fwrite($fh, $data);
//	fclose($fh);
