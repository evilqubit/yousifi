<?php echo $this->fetch('content'); ?>
<script type="text/javascript">
<?php if(isset($seoData)){ ?>
	document.title = '<?php echo $seoData['SeoManagement']['title'];?>';
	<?php } ?>
</script>



<script type="text/javascript">
		$(document).ready(function(){
			$(".number").each(function(){
					$(this).keydown(function(e){
						remove_alpha(this,e);
					});
				});
				
				$(".domain").each(function(){
					$(this).blur(function(){
						remove_numbers(this);
					});
					
					$(this).keypress(function(){
						remove_numbers(this);
					});
				});
				
				<?php if(isset($locale) && $locale == "ara"){ ?>
					bindArabicParser();
				<?php } ?>
		});
	</script>