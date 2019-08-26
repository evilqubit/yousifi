<div class="login-wrapper">
         
    <form method="post" id="form-login" name="loginform" action='/administrators/login' accept-charset="utf-8"> <div style="display:none;"><input type="hidden" name="_method" value="POST"/></div>                <img width="100" height="38" src="/img/admin/theme/logo.png"/>
               
                
               
                <hr/>
                <div class="control-group">
                    <div class="controls">
          
                       <?php  echo $this->Form->input('Administrator.username',array('placeholder'=>'Username', 'label'=>false, 'class'=>'input-block-level required')); ?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
             
                        <?php echo  $this->Form->input('Administrator.password',array('placeholder'=>'Password', 'label'=>false,'class'=>'input-block-level required'));?>
                    </div>
                </div>
             
                <div class="control-group">
                    <div class="controls">
                        
                       <?php echo $this->Form->input('Sign In',array('type'=>'submit','label'=>false,'class'=>'btn btn-primary input-block-level')); ?> 
                    </div>
                </div>
            
                <?php echo $this->Session->flash(); ?>
                
            
                                                           
                <hr/>
                <!-- <p class="clearfix">
                    <a href="#" class="goto-forgot pull-left">Forgot Password?</a>
                 
                </p> -->
            </form>  
   
  </div>
<script type="text/javascript">
$(document).ready(function(){
    $("#form-login").validate();
    
 

});
</script>