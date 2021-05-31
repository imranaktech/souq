<!-- PAGE -->
<?php if ($this->db->get_where('general_settings', array('general_settings_id' => '58'))->row()->value == 'ok'and $this->db->get_where('general_settings', array('general_settings_id' => '81'))->row()->value == 'ok'){ ?>
<section class="page-section image testimonials vendors image_delay" data-src="<?php echo base_url(); ?>uploads/others/parralax_vendor.jpg"  style="background: url(<?php echo img_loading(); ?>) center top no-repeat; background-attachment:fixed;display: none; background-size:cover;">
    <div class="container" style="margin-top:40px !important; margin-bottom:40px !important;">
        <h2 class="section-title section-title-2">
            <span>
             	<?php echo $this->db->get_where('ui_settings',array('ui_settings_id' => 17))->row()->value;?>
            </span>
        </h2>
        <div class="partners-carousel">
            <div class="brand-carousel carousel-arrow">
                <?php
					$limit =  $this->db->get_where('ui_settings',array('ui_settings_id' => 21))->row()->value;
                    $this->db->limit($limit);
                    $this->db->where('status','approved');
                    $this->db->order_by("vendor_id", "desc");
                    $vendors=$this->db->get('vendor')->result_array();
                    foreach($vendors as $row){
                ?>
                <div class="p-item">
                    <a href="<?php echo base_url(); ?>home/vendor_profile/<?php echo $row['vendor_id']; ?>">
                        <?php
                        if(!file_exists('uploads/vendor_logo_image/logo_'.$row['vendor_id'].'.png')){
                        ?>
                        <img  class="image_delay" src="<?php echo img_loading(); ?>" data-src="<?php echo base_url(); ?>uploads/vendor_logo_image/default.jpg" alt="">
                        <?php
                            } else {
                        ?>
                        <img  class="image_delay" src="<?php echo img_loading(); ?>" data-src="<?php echo base_url(); ?>uploads/vendor_logo_image/logo_<?php echo $row['vendor_id']; ?>.png" />
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
<script>
    $(document).ready(function(){
        $(".partners").owlCarousel({
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
                768: {items: 4},
                991: {items: 6},
                1024: {items: 6}
            }
        });
    });
</script>
<!-- /PAGE -->
<?php } ?>