<!-- PAGE -->
<section class="page-section special-products hidden-xs hidden-sm" style="display: none !important;">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h4 class="section-title section-title-2">
                    <span>
                        <?php echo translate('latest_products');?>
                    </span>
                </h4>
                <?php
                    $latest=$this->crud_model->product_list_set('latest',4);
                    foreach($latest as $row){
                ?>
                <div class="product-box-sm product-box-sm-2">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="<?php echo $this->crud_model->product_link($row['product_id']); ?>" class="d-block">
                                <img class="img-responsive image_delay" style="width:100%;" src="<?php echo img_loading(); ?>" data-src="<?php echo $this->crud_model->file_view('product',$row['product_id'],'100','','thumb','src','multi','one');?>" alt="">
                            </a>
                        </div>
                        <div class="col-md-8">
                            <div class="inro-section">
                                <h4 class="title text-truncate">
                                    <a href="<?php echo $this->crud_model->product_link($row['product_id']); ?>">
                                    <?php echo $row['title']; ?>
                                    </a>
                                </h4>
                                <p>
                                    <a href="<?php echo base_url(); ?>home/category/<?php echo $row['category']; ?>">
                                    <?php echo $this->crud_model->get_type_name_by_id('category',$row['category'],'category_name'); ?>
                                    </a>
                                </p>
                            </div>
                            <?php $rating = $this->crud_model->rating($row['product_id']); ?>
                            <div class="rateit" data-rateit-value="<?= $rating ?>" data-rateit-ispreset="true" data-rateit-readonly="true" ></div>
                            <div class="price p-0">
                                <span>
                                    <?php echo currency($this->crud_model->get_product_price($row['product_id'])); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
            <div class="col-md-4">
                <h4 class="section-title section-title-2">
                    <span>
                        <?php echo translate('recently_viewed');?>
                    </span>
                </h4>
                <?php
                    $recently_viewed=$this->crud_model->product_list_set('recently_viewed',4);
                    foreach($recently_viewed as $row){
                ?>
                <div class="product-box-sm product-box-sm-2">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="<?php echo $this->crud_model->product_link($row['product_id']); ?>">
                                <img class="img-responsive image_delay" style="width:100%;" src="<?php echo img_loading(); ?>" data-src="<?php echo $this->crud_model->file_view('product',$row['product_id'],'100','','thumb','src','multi','one');?>" alt="">
                            </a>
                        </div>
                        <div class="col-md-8">
                            <div class="inro-section">
                                <h4 class="title text-truncate">
                                    <a href="<?php echo $this->crud_model->product_link($row['product_id']); ?>">
                                    <?php echo $row['title']; ?>
                                    </a>
                                </h4>
                                <p>
                                    <a href="<?php echo base_url(); ?>home/category/<?php echo $row['category']; ?>">
                                    <?php echo $this->crud_model->get_type_name_by_id('category',$row['category'],'category_name'); ?>
                                    </a>
                                </p>
                            </div>
                            <?php $rating = $this->crud_model->rating($row['product_id']); ?>
                            <div class="rateit" data-rateit-value="<?= $rating ?>" data-rateit-ispreset="true" data-rateit-readonly="true" ></div>
                            <div class="price p-0">
                                <span>
                                    <?php echo currency($this->crud_model->get_product_price($row['product_id'])); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
            <div class="col-md-4">
                <h4 class="section-title section-title-2">
                    <span>
                        <?php echo translate('most_viewed');?>
                    </span>
                </h4>
                <?php
                    $most_viewed=$this->crud_model->product_list_set('most_viewed',4);
                    foreach($most_viewed as $row){
                ?>
                <div class="product-box-sm product-box-sm-2">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="<?php echo $this->crud_model->product_link($row['product_id']); ?>">
                                <img class="media-object img-responsive pull-left image_delay" style="width:100%;"  src="<?php echo img_loading(); ?>" data-src="<?php echo $this->crud_model->file_view('product',$row['product_id'],'100','','thumb','src','multi','one');?>" alt="">
                            </a>
                        </div>
                        <div class="col-md-8">
                            <div class="inro-section">
                                <h4 class="title text-truncate">
                                    <a href="<?php echo $this->crud_model->product_link($row['product_id']); ?>">
                                    <?php echo $row['title']; ?>
                                    </a>
                                </h4>
                                <p>
                                    <a href="<?php echo base_url(); ?>home/category/<?php echo $row['category']; ?>">
                                    <?php echo $this->crud_model->get_type_name_by_id('category',$row['category'],'category_name'); ?>
                                    </a>
                                </p>
                            </div>
                            <?php $rating = $this->crud_model->rating($row['product_id']); ?>
                            <div class="rateit" data-rateit-value="<?= $rating ?>" data-rateit-ispreset="true" data-rateit-readonly="true" ></div>
                            <div class="price p-0">
                                <span>
                                    <?php echo currency($this->crud_model->get_product_price($row['product_id'])); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</section>
<!-- /PAGE -->

<script>
$(document).ready(function(){
    setTimeout(function(){
        set_special_product_box();
    },500);
});

function set_special_product_box(){
    var max_height = 0;
    $('.product-box-sm').each(function(){
        var current_height= parseInt($(this).css('height'));
        if(current_height >= max_height){
            max_height = current_height;
        }
    });
    $('.product-box-sm').css('height',max_height);
    
    var max_title=0;
    $('.special-products .inro-section').each(function(){
        var current_height= parseInt($(this).css('height'));
        if(current_height >= max_title){
            max_title = current_height;
        }
    });
    $('.special-products .inro-section').css('height',max_title);

    $('[data-toggle="tooltip"]').tooltip({placement:"auto"});
}
</script>
