 <?php if(isset($error)): ?>
 <?php echo $error; ?>
 <?php else: ?>
 <?php echo $this->element('admin/media/video-edit',array('video'=>$video,'type'=>'youtube')); ?>
 <?php endif;?>