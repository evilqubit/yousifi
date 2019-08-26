<style type="text/css">
	 .customSelect {
    /* This is the default class that is used */
    /* Put whatever custom styles you want here */
    }
    .customSelect.customSelectHover {
    /* Styles for when the select box is hovered */
    }
    .customSelect.customSelectOpen {
    /* Styles for when the select box is open */
    }
    .customSelect.customSelectFocus {
    /* Styles for when the select box is in focus */
    }
    .customSelectInner {
    /* You can style the inner box too */
    }
</style>

<div class="searchInStoreMainContainer">
	<div class="searchInStoreInternalContainer">
		<?php 	
		
		$default_search_text=__('store_search_val',true);
		
		$arabic_s="&#1575;&#1576;&#1581;&#1579; &#1593;&#1606; &#1575;&#1604;&#1605;&#1578;&#1580;&#1585;";
		if(isset($search_text) && !empty($search_text)){
			
		}else{
			$search_text=$default_search_text;
		}
		
		if(isset($is_search_by_alpha)){
			if($is_search_by_alpha == 1){
				$search_text=$default_search_text;
			}else{
				
			}
		
		}
		
		$c_val_search_id = "StoreTSearchInputId";
		?>
		<?php echo $this->form->create("Page",array("url"=>array("controller"=>"Pages","action"=>"shop_search")  ,'id'=>'shop_search')); ?>
	
				
		<div class="floatClass store_search_text_area_mainContainer">			
			<?php 
			echo $this->form->input("search_text",
			array(
			 "escape"=>false,
			 "label"=>false,
			 "class"=>"store_search_text_area floatClass",
			 'id'=>$c_val_search_id,
			 "onfocus"=>"change_default('$c_val_search_id','$search_text',this.value,false);",
			 "onblur"=>"change_default('$c_val_search_id','$search_text',this.value,true);",
			 "value"=>$search_text));?>
		
		</div>
		
		<div class="floatClass store_search_category_list_container">			
			<select id="category_list_id" class="store_search_category_list floatClass" name="data[Page][store_category_id]">
			
			<option style="color:#000000" value="" ><?=__("Categories",true)?></option>
			
			<?php
			
			foreach($home_categories_list as $c){
				$section_id=$c['section']['id'];
				$section_title=$c['section']['title'];
				$section_color=$c['section']['color'];
				
				$categories='';
				if(isset($c['categories'])){
					$categories=$c['categories'];
				}
				
				
				$selected='';
				if(isset($selected_category_id) && !empty($selected_category_id) && $type =='s'){
					if($selected_category_id == $section_id){
						$selected='selected="selected"';
					}
				}
					
				?>
				
				<option <?=$selected?> style="color: <?="#".$section_color?>" value="<?="s_".$section_id?>" ><?=$section_title?></option>
				
				
				<?php 
				if(isset($categories) && !empty($categories)){
				foreach($categories as $cat){
					$cat_id=$cat['id'];
					$cat_title=$cat['title'];
					
					$selected='';
					if(isset($selected_category_id) && !empty($selected_category_id) && $type =='c'){
						if($selected_category_id == $cat_id){
							$selected='selected="selected"';
						}
					}
					
					?>
					<option <?=$selected?> style="padding-left: 15px;" value="<?="c_".$cat_id?>"><?=$cat_title?></option>
					<?php 				
				}}
			}
			
			 ?>
			</select>	
		</div>
		
		
		<div class=" floatClass"><input class="cat_search_area_button"   value="<?=strtoupper(__('search',true));?>" type="submit" /> </div>
		     
		<?php echo $this->form->end();?>
	</div>
	
	
	
	
	<?php $arabicAlphabet = array("\xD8\xA7","\xD8\xA8","\xD8\xAA","\xD8\xAB","\xD8\xAC","\xD8\xAD","\xD8\xAE","\xD8\xAF","\xD8\xB0","\xD8\xB1","\xD8\xB2","\xD8\xB3","\xD8\xB4","\xD8\xB5","\xD8\xB6","\xD8\xB7","\xD8\xB8","\xD8\xB9","\xD8\xBA","\xD9\x81","\xD9\x82","\xD9\x83","\xD9\x84","\xD9\x85","\xD9\x86","\xD9\x87","\xD9\x88","\xD9\x8A");?>
	<div class="searchInStoreAlphabeticInternalContainer">
		<div class="floatClass searchAlphabeticBrowes"><?=__('browse')?></div>
		<?php 
		if($lang == "ar"){			
			foreach ($arabicAlphabet as $letter){
				$url="/$lang/Pages/shop_search/$letter";
				echo "<div class='floatClass alphabetLetterAr'><a href='$url'>$letter</a></div>";
			}
		}
		else{			
			foreach (range('A', 'Z') as $letter) {
				$url="/$lang/Pages/shop_search/$letter";
			    echo "<div class='floatClass alphabetLetter'><a href='$url'>$letter</a></div>";
			}
		}
		?>
		<?php $url="/$lang/Pages/shop_search/1"; ?>
		<div class="floatClass searchAlphabeticBrowesAll"><a href="<?=$url?>"><?=__('all')?></a></div>
	</div>
</div>

<script type="text/javascript">
	
	


	$(document).ready(function (){
		$("#category_list_id").customSelect();
		
		
		$('#shop_search').submit(function() {
		 	StoreSearchInputId_text=$("#StoreTSearchInputId").val();
		 	
		 	<?php if($lang == 'en'){
		 		?>
		 		default_text='<?=$default_search_text?>';
		 		<?php 
		 	}else{?>
		 		
		 		
		 		default_text='\u0627\u0628\u062D\u062B \u0639\u0646 \u0627\u0644\u0645\u062A\u062C\u0631';
		 		
		 		<?php 
		 	} ?>
		 	
		 	if(StoreSearchInputId_text === default_text){
		 		
		 		$("#StoreTSearchInputId").val('');
		 	}
		});

	});
</script>