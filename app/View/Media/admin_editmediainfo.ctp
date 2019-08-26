  <!--base css styles-->
        <link rel="stylesheet" href="/js/jquery/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="/js/jquery/bootstrap/bootstrap-responsive.min.css">
        <link rel="stylesheet" href="/js/jquery/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="/js/jquery/normalize/normalize.css">
<!--flaty css styles-->
        <link rel="stylesheet" href="/css/admin/flaty.css">
         <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>-->
        <script>window.jQuery || document.write('<script src="/assets/jquery/jquery-1.10.1.min.js"><\/script>')</script>
         <span id='msg'></span>
         <div class="control-group">
      
         <div class="controls">
         <h3>Select Language  <?php echo $this->element('admin/lang-toggle',array('languages'=>$languages)); ?></h3>
         </div>
        </div>
<?php echo $this->Form->create('Media',array('id'=>'imgforminfo','class'=>'form-horizontal','inputDefaults' => array('label' => false,'div' => false)));?>
 
        
    <?php
        echo $this->Form->input('id');?>
        
        <?php 
        
        
        foreach($languages as $config){
				$local=$config['Language']['locale'];
				$language=$config['Language']['language'];
				$direction=$config['Language']['direction'];
				$code=$config['Language']['code'];
				 ?>

<span class="language <?php echo $code; ?>">

 <div >                                           
<?php echo $this->Form->input('Media.title.'.$local,array('class'=>'input-xlarge','required'=>'','dir'=>$direction,

		'label' => array(
        'class' => 'control-label',
        'text' => 'Title ('.$language.')'
    )));?>
  </div>

 <div style="padding-top:20px;" > 
<?php echo $this->Form->input('Media.caption.'.$local,array('class'=>'input-xlarge','required'=>'','dir'=>$direction,

		'label' => array(
        'class' => 'control-label',
        'text' => 'Caption ('.$language.')'
    )));?>
                                                
  </div>
                   			                                
</span>     
<?php } ?> 
     <div class="form-actions">
            <input id='submitButton' style="margin-top:20px;" type="submit" class="btn btn-primary" value="Save">
        </div>                                     
</from>







 
<script>

$('#submitButton').click( function() {

	url = $('#imgforminfo').attr('action');
    $.ajax({
        url: url,
        type: 'post',
        data: $('form#imgforminfo').serialize(),
        success: function(data) {
                   $('#msg').html('<div class="alert alert-success">Info Saved !</div>');
                   
           
         
                 }
    });
    
    return false;
    
    
});
</script>
