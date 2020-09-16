<?php
$partners = get_objects($conn, $table_name='partners', $filter_set=array('is_active'=>1));
?>
<div id="top-brands" class="wow fadeInUp mar-t-60">
    <div class="container">
        <div class="carousel-holder">
            <div class="title-nav">
                <h1>Our Partners</h1>
                <div class="nav-holder">
                    <a href="#prev" data-target="#owl-brands" class="slider-prev btn-prev fa fa-angle-left"></a>
                    <a href="#next" data-target="#owl-brands" class="slider-next btn-next fa fa-angle-right"></a>
                </div>
            </div>
            <div id="owl-brands" class="owl-carousel brands-carousel">
                <?php
                if(isset($partners) && $partners->num_rows > 0){
                    foreach($partners as $p){ ?>
                <div class="carousel-item">
                    <a href="javascript:void(0)">
                        <img src="<?=BASE_URL.$p['image']?>" alt="<?=$p['name']?>" />
                    </a>
                </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>