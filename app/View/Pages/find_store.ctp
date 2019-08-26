
<?php 

if(!empty($data['Shop'])){
foreach($data['Shop'] as $s){
	$id=$s['Shop']['id'];
	$title=$s['Shop']['title'];
	$url="/Shops/view/$id";
	
	?>
	<div class="floatClass storeSearchResultTitle"><a href="<?=$url?>"><?=$title?></a></div>
	<?php 
}
}
 ?>



<?php 

if(!empty($data['cinema'])){
foreach($data['cinema'] as $s){
	$id=$s['Cinema']['id'];
	$title=$s['Cinema']['title'];
	$url="/Cinemas/view/$id/0";
	
	?>
	<div class="floatClass storeSearchResultTitle"><a href="<?=$url?>"><?=$title?></a></div>
	<?php 
}
}
 ?>
