

<style>
	.language .input{
		margin-bottom: 10px;
	}
</style>
<?php 


echo $this->Form->input("SeoManagement.model_name",array('value'=>$modelName,'type'=>'hidden'));
echo $this->Form->input("SeoManagement.field_id",array('value'=>$fieldId,'type'=>'hidden'));

if(isset($this->request->data["SeoManagement"]["id"]) && !empty($this->request->data["SeoManagement"]["id"])){
	echo $this->Form->input("SeoManagement.id",array('value'=>$this->request->data["SeoManagement"]["id"],'type'=>'hidden'));
}
				

$model='SeoManagement';	
foreach($languages as $language => $config){
	
	$local=$config['Language']['locale'];
	$language=$config['Language']['language'];
	$direction=$config['Language']['direction'];
	$code=$config['Language']['code'];
	
	
	 ?>
<span class="language <?php echo $code; ?>">



<?php echo $this->Form->input($model.'.title.'.$local,array('type'=>'text','class'=>'', 'dir'=>$direction,

		'label' => array(
        'class' => 'control-label',
        'text' => 'Title ('.$language.')'
    )));?>
 
    
<?php echo $this->Form->input($model.'.slug.'.$local,array('type'=>'text','class'=>'', 'dir'=>$direction,

		'label' => array(
        'class' => 'control-label',
        'text' => 'Slug Line ('.$language.')'
    )));?>



                                   			
<?php echo $this->Form->input($model.'.keywords.'.$local,array('id'=>'tag-input-1','type'=>'text','class'=>'input-xlarge', 'dir'=>$direction,

		'label' => array(
        'class' => 'control-label',
        'text' => 'Keywords ('.$language.')'
    )));?>
                                             
                                      
                                      
<?php echo $this->Form->input($model.'.description.'.$local,array('type'=>'textarea','class'=>'input-xlarge', 'dir'=>$direction,

		'label' => array(
        'class' => 'control-label',
        'text' => 'Description ('.$language.')'
    )));?>
                                             
</span> 
<?php } ?> 