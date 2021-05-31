<!-- PAGE -->
<section class="page-section brands-2" style="display: none;">
    <div class="container">
        <h2 class="section-title section-title-2">
            <span><?php echo translate('our_available_brands');?></span>
        </h2>
        <div class="partners-carousel">
            <div class="brand-carousel carousel-arrow">
                <?php
					$limit =  $this->db->get_where('ui_settings',array('ui_settings_id' => 22))->row()->value;
                    $this->db->limit($limit);
                    $this->db->order_by("brand_id", "desc");
                    $brands=$this->db->get('brand')->result_array();
                    foreach($brands as $row){
                ?>
                <div class="p-item">
                    <a href="<?php echo base_url(); ?>home/category/0/0-<?php echo $row['brand_id']; ?>">
                        <?php
                        if(file_exists('uploads/brand_image/'.$row['logo'])){
                        ?>
                        <img class="image_delay" src="<?php echo img_loading(); ?>" data-src="<?php echo base_url();?>uploads/brand_image/<?php echo $row['logo']; ?>" alt=""/> 
                        <?php
                            } else {
                        ?>
                        <img  class="image_delay" src="<?php echo img_loading(); ?>" data-src="<?php echo base_url(); ?>uploads/brand_image/default.jpg" />
                        <?php
                            }
                        ?>
                    </a>
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
    $(".brand-carousel").owlCarousel({
        autoplay: false,
        autoplayHoverPause: true,
        loop: true,
        margin: 0,
        dots: false,
        nav: true,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        responsive: {
            0: {items: 3},
            479: {items: 3},
            768: {items: 5},
            991: {items: 6},
            1024: {items: 6},
            1280: {items: 8}
        }
    });
});
</script>