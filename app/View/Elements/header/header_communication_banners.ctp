<style>
    .bx-wrapper .bx-viewport{
        background: no-repeat;
        border: none;
        left: 0px;
        box-shadow: 0px;
    }
</style>

<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
  <?php foreach ($home_banners as $key => $banner) {
    $active = ($key == 0) ? 'active' : '' ; ?>
        <li data-target="#carousel-example-generic" data-slide-to="<?=$key?>" class="<?=$active?>"></li>
    <? } ?>
  </ol>
  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <?php foreach ($home_banners as $key => $banner) {
                $id=$banner['Banner']['id'];
                $title=$banner['Banner']['title'];
                $text=$banner['Banner']['text'];

                $link=$banner["Banner"]['url'];
                $img=$banner['Banner']['image'];

                $active = ($key == 0) ? 'active' : '' ;

                if($lang == 'en'){
                    $title= $this->Text->truncate($title,50,array("...",true , 'exact'=>false));
                }else{
                    $title= $this->Text->truncate($title,50,array("...",true , 'exact'=>false));
                }

                $text= $this->Text->truncate($text,300,array("...",true , 'exact'=>false));

                if(!empty($img)){
                    $img="/files/banners/preview/$img";

                    // $image_size=getimagesize(WWW_ROOT.$img);

                    // $width=$image_size[0];
                    // $height=$image_size[1];

                }

                if(!empty($link)){

                    if(substr($link,0,7) != "http://" ){
                            $link = "http://$link";
                        }

                    $aStart="<a href='$link'>";
                    $aEnd='</a>';

                }else{
                    $aStart="";
                    $aEnd='';
                }
            ?>


    <div class="item <?=$active?>">
      <img src="<?=$img?>" style='width:100%' alt="...">
      <div class="carousel-caption">
        <h3><?=$title?></h3>
        <?=$text?>
      </div>
    </div>
    <?php } ?>
    ...
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<!--
<div class="features" style="clear: both;`">
    <div class="slider">
        <ul class="Headerbxslider">

            <?php

            foreach($home_banners as $banner){
                $id=$banner['Banner']['id'];
                $title=$banner['Banner']['title'];
                $text=$banner['Banner']['text'];

                $link=$banner["Banner"]['url'];
                $img=$banner['Banner']['image'];



                if($lang == 'en'){
                    $title= $this->Text->truncate($title,50,array("...",true , 'exact'=>false));
                }else{
                    $title= $this->Text->truncate($title,50,array("...",true , 'exact'=>false));
                }

                $text= $this->Text->truncate($text,300,array("...",true , 'exact'=>false));



                if(!empty($img)){
                    $img="/files/banners/preview/$img";

                    $image_size=getimagesize(WWW_ROOT.$img);

                    $width=$image_size[0];
                    $height=$image_size[1];

                }


                if(!empty($link)){

                    if(substr($link,0,7) != "http://" ){
                            $link = "http://$link";
                        }

                    $aStart="<a href='$link'>";
                    $aEnd='</a>';

                }else{
                    $aStart="";
                    $aEnd='';
                }
            ?>
            <li style="left: 0px;">
                <?=$aStart?>

                <img class='img-responsive' src="<?=$img?>" alt="" style='width:100%'/>
                <img class='img-responsive' style=" width:100%;position: absolute; z-index: 2; top: 120px;display:none" src="/img/header_shadow.png" alt="" />

                <?=$aEnd?>



                <?php if(!empty($title) && !empty($text)){ ?>
                <div class="bx-caption">
                    <div class="info">
                        <div class="floatClass bxsliderTitle"><?=$aStart?> <?=$title?> <?=$aEnd?></div>
                        <div class="floatClass bxsliderText hidden-sm hidden-xs"><?=$aStart?> <?=$text?> <?=$aEnd?></div>
                    </div>
                </div>
                <?php } ?>

            </li>

            <?php  } ?>
        </ul>
    </div>
</div>
 -->

<script type="text/javascript">
    $(document).ready(function(){


        $('.Headerbxslider').bxSlider({
          // mode: 'horizontal',
          // pager :true,
          // controls:true,
          autoStart:true,
          auto:true,
          autoControls: true,
          // captions: true,
          // speed:500,
          // pause:8000
        });
    });
</script>