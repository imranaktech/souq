<?php
    foreach($all_vendors as $row){
?>
<div class="col-md-4 col-sm-6 col-xs-12">
    <div class="vendor-details" itemscope itemtype="http://schema.org/Store">
        <div class="vendor-banner">
            <?php if(file_exists('uploads/vendor_banner_image/banner_'.$row['vendor_id'].'.jpg')){?>
                <img itemprop="logo" src="<?php echo base_url();?>uploads/vendor_banner_image/banner_<?php echo $row['vendor_id'];?>.jpg"/>
            <?php }else{?>
                <img src="<?php echo base_url();?>uploads/vendor_banner_image/default.jpg"/>    
            <?php }?>
        </div>
        <div class="vendor-profile">
            <h3>
                <a href="<?php echo $this->crud_model->vendor_link($row['vendor_id']); ?>">
                 <span itemprop="name"><?php echo $row['display_name'];?></span>
                </a>
            </h3>
            <h5 itemprop="address"><?php echo $row['address1'];?></h5>
            <h5>
                <strong><?php echo translate('email'); ?>: </strong><span itemprop="email"><?php echo $row['email'];?></span>
                <?php
                    if($row['phone'] !== NULL){
                ?>
                <strong><?php echo translate('phone'); ?>: </strong><span itemprop="telephone"><?php echo $row['phone'];?></span>
                <?php
                    }
                ?>
            </h5>
        </div>
        <div class="vendor-products">
            <div class="vendor-btn">
                <a href="<?php echo $this->crud_model->vendor_link($row['vendor_id']); ?>" class="btn btn-custom btn-block btn-theme">
                    <?php echo translate('visit');?>
                </a>
            </div>
        </div>
    </div>
    <div class="vendor-photo">
        <?php if(file_exists('uploads/vendor_logo_image/logo_'.$row['vendor_id'].'.png')){?>
        <img src="<?php echo base_url();?>uploads/vendor_logo_image/logo_<?php echo $row['vendor_id'];?>.png" />
        <?php }else{?>
            <img src="<?php echo base_url();?>uploads/vendor_logo_image/default.jpg"/>
        <?php }?>
    </div>
</div>
<?php
    }
?>

<div class="col-md-12 col-sm-12 col-xs-12 text-center pagination-wrapper" style="padding-top: 10px">  
    <?php echo $this->ajax_pagination->create_links(); ?>
</div>

