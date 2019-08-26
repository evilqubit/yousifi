<?php 


if(isset($data)){
	

if($data['type'] == 'video'){
	
	echo $this->element('admin/media/video-edit',array('video'=>$video,'type'=>'video'));

	
}
elseif($data['type'] == 'youtube'){
	
  echo $this->element('admin/media/video-edit',array('video'=>$video,'type'=>'youtube'));

	
}



	
	
}	
	



	
	
?>