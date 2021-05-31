<?php
	$categories=json_decode($this->crud_model->get_settings_value('ui_settings','home_categories'),true);
	if(count($categories)!==0){
		foreach($categories as $row){
			if($this->crud_model->if_publishable_category($row['category'])){
?>
<!-- PAGE -->
<section class="page-section">
    <div class="container">
        <div class="row mx-0 d-lg-flex">
        	<div class="col-md-3 px-0" >
        		<div class="home-3-category d-flex align-items-center h-100" style="background-image: url('<?php echo $this->crud_model->file_view('category',$row['category'],'','','no','src','',''); ?>');">
        			<div>
	        			<h2><?php echo $this->crud_model->get_type_name_by_id('category',$row['category'],'category_name'); ?></h2>
	        			<a href="<?php echo base_url(); ?>home/category/<?php echo $row['category']; ?>" class="btn"><?php echo translate('browse_all');?></a>
        			</div>
        		</div>
        	</div>
            <div class="col-md-12 px-0">
                <div class="tabs-wrapper content-tabs home3_category_box">
                    <ul class="nav nav-tabs">
                        <?php
						if(!empty($row['sub_category'])){
							$i=0;
                        	$sub_categories=$row['sub_category'];
							foreach($sub_categories as $row1){
						?>
                        <li class="<?php if($i==0){ echo 'active';}?>">
                            <a href="#tab<?php echo $row1; ?>" data-toggle="tab">
                                <?php echo $this->crud_model->get_type_name_by_id('sub_category',$row1,'sub_category_name'); ?>
                            </a>
                        </li>
                        <?php
                        	$i++;
							}
						}
						?>
                    </ul>
                    <div class="tab-content">
                    	<?php
						if(!empty($row['sub_category'])){
							$j=0;
							foreach($sub_categories as $row2){
						?>
                        <div class="tab-pane fade <?php if($j==0){ echo 'in active';}?>" id="tab<?php echo $row2; ?>">
                            <div id="category-carousel-<?php echo $row2; ?>" class="category-carousel owl-theme carousel-arrow-alt">
                            	<?php
									$box_style =  $this->db->get_where('ui_settings',array('ui_settings_id' => 34))->row()->value;
									$products= $this->crud_model->product_list_set('sub_category',6,$row2);
									foreach($products as $row3){
								?>

                                	<?php echo $this->html_model->product_box($row3,'grid', $box_style); ?>

                                <?php
									}
								?>
                            </div>
                        </div>
                        <?php
							$j++;
							}
						}
						?>
                    </div>
                    <!-- End-->
                    
                <!-- Ens -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /PAGE -->
<?php
			}
		}
	}
?>
<script>
$(document).ready(function(){

    $('.category-carousel').owlCarousel({
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
            768: {items: 3},
            991: {items: 3},
            1024: {items: 4}
        }
    });

});



</script>
<style>
@media(max-width: 768px) {
	.nav-tabs>li {
		float: none;
		text-align:center;
	}
}
</style>
