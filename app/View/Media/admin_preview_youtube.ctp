<?php  if($this->Youtube->url($url)): ?>
 <div>
 <strong>Is this the video ?</strong>
 </div>
 <br>
<?php echo $this->Youtube->url($url); ?>
<?php else: ?>
<div>
<strong>Invalid Youtube Url</strong>
</div>
<br>
<?php endif; 
?>