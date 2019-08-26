<div class="input-append">
	<form id="AlbumAdminIndexForm" accept-charset="utf-8" method="GET" action="<?=$search_location?>">											        
	    <?php										
		echo $this->Form->input('s', array('name'=>'s','class'=>'input-large',"value"=>$search_phrase,'div' => false,'label' => false,));
		echo $this->Form->submit(__('Search'), array('class'=>'btn btn-primary','div' => false,'id'=> 'goSearch'));
		echo $this->Form->reset(__('Reset'), array('class'=>'btn btn-primary','div' => false, 'type'=>'reset', 'id'=> 'resetSearch', 'value'=> __('Reset')));
		echo $this->Form->end();
	?>
</div>
<script>
	$(document).ready(function(){
		$('#resetSearch').click(function(){
			if($(this).siblings('#s').val()==''){
				return false;
			} else {
				window.location = window.location.pathname;
			}
		});
		$('#goSearch').click(function(){
			if($(this).siblings('#s').val()==''){
				return false;
			}
		});
	});
</script>