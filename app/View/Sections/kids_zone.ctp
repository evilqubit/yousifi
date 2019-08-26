<?php 


$title=$data["Shop"]['title'];
$text=$data["Shop"]['text'];
$image_1=$data["Shop"]['image_1'];
$image_2=$data["Shop"]['image_2'];
$image_3=$data["Shop"]['image_3'];
$image_4=$data["Shop"]['image_4'];
$image_5=$data["Shop"]['image_5'];

$image_1="/files/shops/preview/$image_1";
$image_2="/files/shops/preview/$image_2";
$image_3="/files/shops/preview/$image_3";
$image_4="/files/shops/preview/$image_4";
$image_5="/files/shops/preview/$image_5";



$available=$data["Shop"]['available'];
$opening_hours=$data["Shop"]['opening_hours'];
$tel=$data["Shop"]['tel'];
$fax=$data["Shop"]['fax'];
$email=$data["Shop"]['email'];
$url=$data["Shop"]['url'];





?>

<div class="row brand-con">
	<div class="hold-left">
		<img src="<?=$image_1?>" alt="<?=$title?>">
		<div class="info">
			<p><?=$text?></p>
			<ul class="list-style">
				<li>TEl: <?=$tel?></li>
				<li>Fax: <?=$fax?></li>
				<li>email: <?=$email?></li>
			</ul>
			<h2><a href="<?=$url?>"><?=$url?></a></h2>
		</div>
	</div>
	<div class="hold-mid">
		<div class="info">
			<h2>Available in</h2>
			<ul class="list-style">
				<!-- <li>Dbayeh (L2 - d12)</li>
				<li>Sin El Fil (GB - C7)</li>
				<li>Saida (L1 - B6)</li> -->
				<?=$available?>
			</ul>
			<p>Opening hours:<br><strong><?=$opening_hours?></strong></p>
		</div>
		<img src="<?=$image_2?>" alt="<?=$title?>">
		<img src="<?=$image_3?>" alt="<?=$title?>">
	</div>
	<div class="hold-right">
		<div class="bg" style="background-size:cover;  background: url(<?=$image_4?>) no-repeat 50% 50%;" ></div>
		<a class="rss" href="#"><img src="images/ico_rss.png" alt=""></a>
	</div>
</div>