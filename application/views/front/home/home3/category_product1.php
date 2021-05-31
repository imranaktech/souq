<!-- PAGE -->
<?php 
$categories=json_decode($this->crud_model->get_settings_value('ui_settings','home_categories'),true);
	if(count($categories)!==0){
		foreach($categories as $row){
			if($this->crud_model->if_publishable_category($row['category'])){ ?>
<section class="page-section home_appliances-products sl-home_appliances" style="background-color: #f9f9f9;">
    <div class="container">
        <h2 class="section-title section-title-lg section-title-2">
            <span>
            	<?php echo translate($this->crud_model->get_type_name_by_id('category',$row['category'],'category_name')); ?>
            
            </span>
        </h2>
		<div class="home_appliances-products-carousel">
			<div class="owl-carousel carousel-arrow home_applices_slider" id="home_appliances<?php echo $row['category']; ?>">
				<?php
				if(!empty($row['sub_category'])){
					$j=0;
					foreach($row['sub_category'] as $row2){
    					$box_style =  $this->db->get_where('ui_settings',array('ui_settings_id' => 34))->row()->value;
    					$products= $this->crud_model->product_list_set('sub_category',6,$row2);
    					foreach($products as $row3){ 
    					    echo $this->html_model->product_box($row3,'grid', $box_style);
    					}    
					    $j++;
					}    
				}
				?>
			</div>
		</div>
    </div>
</section>
<!-- /PAGE -->

<?php } } } ?>
<script>
    jQuery(document).ready(function () {
        $(".home_applices_slider").each(function(){
            var id = $(this).attr('id');
            // $('#home_appliances').owlCarousel({
            $('#'+id).owlCarousel({
            autoplay: true,
            autoplayHoverPause: true,
            loop:true,
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
                1024: {items: 6}
            }
        });
        });
    });
</script>z