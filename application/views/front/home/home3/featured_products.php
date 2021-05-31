<!-- PAGE -->
<style>
    .featured-products .caption-title span{
        color: #ffffff !important;
    }
    .featured-products .caption .buttons span{
        border: 1px solid #ffffff;
    }
    .featured-products .caption .buttons span:hover{
        border: 1px solid #ffffff;
    }
    .featured-products .caption .buttons span i{
        color: #ffffff;
    }
</style>
<section class="page-section featured-products sl-featured" style="display: none">
    <div class="container">
        <h2 class="section-title section-title-lg section-title-2">
            <span>
            	<?php echo translate('latest_products');?>
            </span>
        </h2>
        <div class="carousel-arrow-alt">
            <div class="owl-carousel carousel-arrow" id="featured-products-carousel">
                <?php
					$box_style =  $this->db->get_where('ui_settings',array('ui_settings_id' => 29))->row()->value;
					$limit =  $this->db->get_where('ui_settings',array('ui_settings_id' => 20))->row()->value;
                    $featured=$this->crud_model->product_list_set('featured',$limit);
                    foreach($featured as $row){
                		echo $this->html_model->product_box($row, 'grid', $box_style);
					}
                ?>
            </div>
        </div>
    </div>
</section>
<!-- /PAGE -->
<div class="page-section featured-products sl-featured">
<div class="container-fluid">
    <div class="row">
        <a href="http://souqpk.com/home/vendor_logup/registration"><img src="https://ingenious.pk/images/want-to-sell-web-banner.png" alt="" style="width:100%"></a>
    </div>
</div>
</div>
