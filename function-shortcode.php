<?php

function simpleSlider( $atts ) { ?>
<style>

  .inner__slider {
    position: relative;
  }
  .item__slider {
    position: absolute;
    top: 35%;
    left: 5%;
    z-index: 2;
  }
  .item__slider h2 {
    color: #fff;
  }
  .item__slider p {
    color: #e3e3e3;
    width: 60%;
    margin-bottom:25px;
  }
  .inner__slider:before {
    content: '';
    width: 100%;
    background: #000000a3;
    height: 100%;
    display: block;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 1;
  }
  
  .btn__slider{
    background:#fff;
    border:1px solid #fff;
    padding:16px 32px;
    color:#28303d;
    transition:all .3s ease-in-out;
    z-index: 2;
  }
  .btn__slider:hover{
    background:transparent;
    border:1px solid #fff;
    color:#fff;
    transition:all .3s ease-in-out;
  }
</style>	
<div class="container__slider">
<?php
    $no = 1 ;
    $show_all_data = allData('slider');
    foreach($show_all_data as $data ) :
    ?>
    <div class="inner__slider">
        <div class="item__slider">
            <h2><?php echo $data->head_slider; ?></h2>
            <p><?= $data->desc_slider ?></p>
            <?php if($data->status_btn == 1) :?>
             <a href="<?php echo $data->button_link;?>" target="_blank" class="btn__slider">Learn More</a> 
            <?php else : ?>
            <?php endif?>
        </div>
		    <?php $upload_dir = wp_upload_dir(); ?>
        <img class="table-img" src="<?php echo $upload_dir['baseurl'] .'/SliderDirectory/'. $data->images; ?>">

    </div>
    <?php endforeach; ?>
</div>

<?php } 
add_shortcode( 'simpleSlider', 'simpleSlider' );