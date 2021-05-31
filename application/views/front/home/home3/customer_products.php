<!-- PAGE -->
<section class="page-section featured-products sl-classified" >
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12">
                        <h2 class="section-title section-title-lg section-title-2">
                            <span>
                                <?php echo translate('Health_&_Beauty');?>
                            </span>
                        </h2>
						<div class="carousel-arrow-alt">
							<div class="owl-carousel carousel-arrow" id="home_appliances">
								<?php
								$box_style =  $this->db->get_where('ui_settings',array('ui_settings_id' => 60))->row()->value;
								$limit =  $this->db->get_where('ui_settings',array('ui_settings_id' => 61))->row()->value;
								$todays_deal=$this->crud_model->product_list_set('deal',$limit);
								$i=0;
								foreach($todays_deal as $row){
									echo $this->html_model->product_box($row, 'grid', $box_style);
									$i++;
									if($i==6){
										break;
									}
								}
								?>
							</div>
						</div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</section>
<!-- /PAGE -->
<script>
$(document).ready(function(){
    $(".owl-carousel-3").owlCarousel({
        autoplay: true,
        loop: true,
        margin: 30,
        dots: false,
        nav: true,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        responsive: {
            0: {items: 2},
            479: {items: 2},
            768: {items: 2},
            991: {items: 5},
            1024: {items: 5}
        }
    });
    set_classified_product_box_height();
});

function set_classified_product_box_height(){
    var max_title = 0;
    $('.sl-classified .caption-title').each(function(){
        var current_height= parseInt($(this).css('height'));
        if(current_height >= max_title){
            max_title = current_height;
        }
    });
    if (max_title > 0) {
        $('.sl-classified .caption-title').css('height',max_title);
    }
}
</script>
