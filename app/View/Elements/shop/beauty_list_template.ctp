<div class="row beauty-con">
	<div style="background-color:#1e1e1e; min-height: 720px;"  class="hold left logos items-list type-2" >
		<!-- <ul class="logos"> -->
			<?php 
			foreach($shop_details_list as $sh){
				$id=$sh['Shop']['id'];
				$title=$sh['Shop']['title'];
				$image=$sh['Shop']['image_5'];
				$slug=$sh['SeoManagement']['slug'];
				$image="/files/shops/preview/$image";
				
				$url="/Shops/view/$id/$slug";
				?>
				
				<div class="col-xs-12 col-sm-6 col-lg-6" style="border-bottom: 1px solid #404040; position: relative;" id="list_<?=$id?>">
					<div  class="topLayer"></div>
					<div style="position: relative; z-index: 1;">
						<a href="<?=$url?>" id='src_<?=$id?>' >
							<span class="holder">
								<span class="hold-inner bwWrapper">
									<span class="pic"><img id="<?=$id?>" src="<?=$image?>" alt=""></span>
								</span>
							</span>
						</a>
					</div>
				</div>
				
				<script type="text/javascript">
					$('#list_<?=$id?>').hover(function(){
						
						$("#list_<?=$id?>").find(".topLayer").hide();
						
					},function(){
						$("#list_<?=$id?>").find(".topLayer").show();
					});
				</script>
				<?php 
			}
			?>
			
		<!-- </ul> -->
	</div>
	
	<?php 
	
	if(!empty($category_details)){
	$image=$category_details['Category']['image'];
	$image="/files/categories/preview/$image";
	
	 ?>
	<div class="hold right"><a  style="background-image: url('<?=$image?>')" href="#"></a></div>
	<?php } ?>
</div>


<script type="text/javascript">
		
	$(document).ready(function(){
		$('.bwWrapper').BlackAndWhite({
			hoverEffect:true,
			webworkerPath: false,
			onImageReady:function(img) {
				
				//alert($(img).parent().attr());
	            // this callback gets executed anytime an image is converted
	        }
		});
	});
</script>