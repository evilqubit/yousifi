<?php if($isAjax == false){ ?>

	<div class="floatClass col-lg-3  internalLeftMenu">
		<?=$this->element("/header/left_menu")?>
	</div>

	<div class="floatClass col-lg-9 col-md-12 col-sm-12 col-xs-12 internalContent">
		<?php  } ?>
		<?php
			$text=$page_details['DynamicPage']['text'];
		?>

		<div class="internalText">
			<div class="internalTopBorder col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
			<?php  echo $text ?>
		</div>

<?php if($isAjax == false){ ?>
	</div>
<?php  } ?>