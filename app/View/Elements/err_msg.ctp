<div class="flashMsgDiv" onclick="$('.flashMsgDiv').fadeOut();">
	<div class="flashMsgAbsolute"><?php echo $message;?></div>
</div>

<script type="text/javascript">
$(document).ready(function(){
		setTimeout("$('.flashMsgDiv').fadeOut()",10000);
});
</script>