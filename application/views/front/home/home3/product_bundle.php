<!-- PAGE -->
<section class="page-section featured-products sl-featured" style="background-image: linear-gradient(to right top, #051937, #004d7a, #008793, #00bf72, #03A678);">
    <div class="container">
        <h2 class="section-title section-title-lg text-truncate">
            <span>
                <?php echo translate('featured_products');?> 
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