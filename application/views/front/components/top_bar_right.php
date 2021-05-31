<style>

#hov_top_bar_log1:hover, #hov_top_bar1:active {background: #01403A;}
#hov_top_bar_reg2:hover, #hov_top_bar1:active {background: #01403A;}
#hov_top_bar1:hover, #hov_top_bar1:active {background: #00b16a;font-size: 115%;}
#hov_top_bar2:hover, #hov_top_bar2:active {background: #00b16a;font-size: 115%;}
#hov_top_bar3:hover, #hov_top_bar3:active {background: #00b16a;font-size: 115%;}
#hov_top_bar4:hover, #hov_top_bar4:active {background: #00b16a;font-size: 115%;}
#hov_top_bar1,#hov_top_bar2,#hov_top_bar3,#hov_top_bar4{
  font-variant: small-caps;}
</style>
            <ul class="list-inline">
                <?php
                    if($this->session->userdata('user_login')!='yes'){ 
                ?>
                <!--Login-->
                <li class="dropdown currency">
                	<a id="hov_top_bar_log1" href="#" class="dropdown-toggle" data-toggle="dropdown">
                	    <?php echo translate('login');?><i class="fa fa-angle-down"></i>
                    </a>
                	<ul role="menu" class="dropdown-menu">
                    	<li class="icon-user">
                    	    <a id="hov_top_bar1" href="<?php echo base_url(); ?>home/login_set/login" > 
                    	    <?php echo translate('customer_login');?>
                    	    </a>
                    	  </li>
                    	<li class="icon-user">
                    	    <a id="hov_top_bar2" href="<?php echo base_url(); ?>vendor" target="_blank" class="vendor_login_btn">
                            <?php echo translate('vendor_login');?>
                    	    </a>
                    	  </li>
                    </ul>
                </li>
                <!--Login-->
                <?php
                	if ($this->crud_model->get_type_name_by_id('general_settings','58','value') !== 'ok') {
				?>
                <li class="icon-user">
                    <a href="<?php echo base_url(); ?>home/login_set/registration">
                        <span><?php echo translate('registration');?></span>
                    </a>
                </li>
                <?php
					}else{
				?>
				<!--Registration-->
                <li class="dropdown currency">
                	<a id="hov_top_bar_reg2" href="#" class="dropdown-toggle" data-toggle="dropdown">
					<?php echo translate('registration');?><i class="fa fa-angle-down"></i>
                    </a>
                	<ul role="menu" class="dropdown-menu">
                    	<li>
                            <a id="hov_top_bar3" href="<?php echo base_url(); ?>home/login_set/registration">
                                <?php echo translate('customer_registration');?>
                            </a>
                        </li>
                        <li>
                            <a id="hov_top_bar4" href="<?php echo base_url(); ?>home/vendor_logup/registration">
                                <?php echo translate('vendor_registration');?>
                            </a>
                        </li>
                    </ul>
                </li>
				<!--EndRegistration-->
                <?php
					}
				?>
                <?php } else {  
                            if ($this->crud_model->get_type_name_by_id('general_settings','84','value') == 'ok') { ?>

                <li class="icon-user">
                    <a href="<?php echo base_url(); ?>home/profile/part/wallet">
                        <i class="fa fa-money"></i> <span><?php echo translate('wallet');?><?php echo ' - '.currency($this->wallet_model->user_balance()); ?></span>
                    </a>
                </li>
                <?php } ?>
                <li class="icon-user">
                    <a href="<?php echo base_url(); ?>home/profile/">
                        <span><?php echo translate('my_profile');?></span>
                    </a>
                </li>
                <li class="icon-user">
                    <a href="<?php echo base_url(); ?>home/profile/part/wishlist">
                        <span><?php echo translate('wishlist');?></span>
                    </a>
                </li>
                <li class="icon-user">
                    <a href="<?php echo base_url(); ?>home/faq">
                        <?php echo translate('faq');?>
                    </a>
                </li>
                <li class="icon-user">
                    <a href="<?php echo base_url(); ?>home/logout/">
                        <span><?php echo translate('logout');?></span>
                    </a>
                </li>
                <?php }?>
            </ul>