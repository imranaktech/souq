
<?php
	echo form_open('', array(
		'method' => 'post',
		'class' => 'sky-form',
	));
?>
    <div class="buttons" style="display:inline-flex;">
        <span class="btn btn-add-to cart" onclick="to_cart(<?php echo $row['product_id']; ?>,event)">
            <i class="fa fa-shopping-cart"></i>
            <?php if($this->crud_model->is_added_to_cart($row['product_id'])=="yes"){ 
                echo translate('added_to_cart');  
                } else { 
                echo translate('add_to_cart');  
                } 
            ?>
        </span>
        <?php 
            $wish = $this->crud_model->is_wished($row['product_id']); 
        ?>
        <span class="btn btn-add-to <?php if($wish == 'yes'){ echo 'wished';} else{ echo 'wishlist';} ?>" onclick="to_wishlist(<?php echo $row['product_id']; ?>,event)">
            <i class="fa fa-heart"></i>
            <span class="hidden-sm hidden-xs">
				<?php if($wish == 'yes'){ 
                    echo translate('_added_to_wishlist'); 
                    } else { 
                    echo translate('_add_to_wishlist');
                    } 
                ?>
            </span>
        </span>
        <?php 
            $compare = $this->crud_model->is_compared($row['product_id']); 
        ?>
        <span class="btn btn-add-to compare btn_compare"  onclick="do_compare(<?php echo $row['product_id']; ?>,event)">
            <i class="fa fa-exchange"></i>
            <span class="hidden-sm hidden-xs">
				<?php if($compare == 'yes'){ 
                    echo translate('_compared'); 
                    } else { 
                    echo translate('_compare');
                    } 
                ?>
            </span>
        </span>
        <?php if($this->crud_model->is_product_affiliation_on($row['product_id']) && $this->session->userdata('user_login') == "yes" && $this->crud_model->get_settings_value('general_settings', 'product_affiliation_set', 'value') == 'ok') { ?>
            <span class="btn btn-add-to btn-warning"
                  data-toggle="collapse" data-target="#affiliate_share_collapse" aria-controls="affiliate_share_collapse" role="button" aria-expanded="false">
            <i class="fa fa-share"></i>
            <span class="hidden-sm hidden-xs">
				<?php
                echo translate('affiliate');
                ?>
            </span>
        </span>
        <?php } ?>
    </div>
<?php if($this->crud_model->is_product_affiliation_on($row['product_id']) && $this->session->userdata('user_login') == "yes" && $this->crud_model->get_settings_value('general_settings', 'product_affiliation_set', 'value') == 'ok') { ?>
    <div class="collapse pt-5" id="affiliate_share_collapse">
        <div class="panel panel-bordered">
            <div class="panel-body">
                <div class="input-group form-group ">
                    <input readonly type="text" class="form-control" id="affiliation_link_text"
                           placeholder="Click to get shareable link" value="<?= $this->crud_model->get_affiliation_link($row['product_id'], $this->session->userdata('user_id'))?>" aria-label="" aria-describedby="">
                    <div class="input-group-btn">
                        <?php if(empty($this->crud_model->get_affiliation_link($row['product_id'], $this->session->userdata('user_id')))) { ?>
                            <button class="btn btn-primary form_btn" type="button"
                                    onclick="affiliate_share(<?php echo $row['product_id']; ?>,event,'affiliation_link_text','<?= translate('getting link') ?>')">
                                <?= translate("Get Link") ?>
                            </button>
                        <?php } ?>
                        <button class="btn btn-outline-secondary form_btn" type="button"
                                onclick="copyText('affiliation_link_text',this,event,'<?= translate('copied') ?>')">
                            <?= translate("copy") ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

    <div class="buttons">
        <div id="share"></div>
    </div>
    <input type="hidden" name="qty" value="1" />
</form>
<div id="pnopoi"></div>
<hr class="page-divider"/>
<script>
	$(document).ready(function() {
		$('#popup-7').find('.closeModal').on('click',function(){
			$('#pnopoi').remove();
		});
		$('#share').share({
			urlToShare: '<?php echo $this->crud_model->product_link($row['product_id']); ?>',
			networks: ['facebook','googleplus','twitter','linkedin','tumblr','in1','stumbleupon','digg'],
			theme: 'square'
		});
	});
</script>
<style>
.t-row{
	display:table-row;
}
</style>