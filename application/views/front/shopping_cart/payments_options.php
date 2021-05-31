    <?php 
        $system_title = $this->db->get_where('general_settings',array('type' => 'system_title'))->row()->value;
        $total = $this->cart->total(); 
        if ($this->crud_model->get_type_name_by_id('business_settings', '3', 'value') == 'product_wise') { 
            $shipping = $this->crud_model->cart_total_it('shipping'); 
        } elseif ($this->crud_model->get_type_name_by_id('business_settings', '3', 'value') == 'fixed') { 
            $shipping = $this->crud_model->get_type_name_by_id('business_settings', '2', 'value'); 
        } 
        $tax = $this->crud_model->cart_total_it('tax'); 
        $grand = $total + $shipping + $tax; 
        //echo $grand; 
    ?>
    <?php
        $p_set = $this->db->get_where('business_settings',array('type'=>'paypal_set'))->row()->value; 
        $c_set = $this->db->get_where('business_settings',array('type'=>'cash_set'))->row()->value; 
        $s_set = $this->db->get_where('business_settings',array('type'=>'stripe_set'))->row()->value;
        $c2_set = $this->db->get_where('business_settings',array('type'=>'c2_set'))->row()->value; 
        $vp_set = $this->db->get_where('business_settings',array('type'=>'vp_set'))->row()->value;
        $pum_set = $this->db->get_where('business_settings',array('type'=>'pum_set'))->row()->value;
        $ssl_set = $this->db->get_where('business_settings',array('type'=>'ssl_set'))->row()->value;
        $balance = $this->wallet_model->user_balance();
        
    ?> 

<div class="row">
    <?php
        if($p_set == 'ok'){ 
    ?>
   
    <?php
        } if($s_set == 'ok'){
    ?>
    
    
    <?php
        } if($c2_set == 'ok'){
    ?>
   
    <?php
        }if($vp_set == 'ok'){
    ?>
    
    <?php
        }if($pum_set == 'ok'){
    ?>
    
    <?php
        }
        /* if($ssl_set == 'ok'){
    ?>
    <div class="cc-selector col-sm-3">
        <input id="mastercardc4" style="display:block;" type="radio" name="payment_type" value="sslcommerz"/>
        <label class="drinkcard-cc" style="margin-bottom:0px; width:100%; overflow:hidden; " for="mastercardc4" onclick="radio_check('mastercardc4')">
                <img src="<?php echo base_url(); ?>template/front/img/preview/payments/sslcommerz.jpg" width="100%" height="100%" style=" text-align-last:center;" alt="<?php echo translate('sslcommerz');?>" />
               
        </label>
    </div>
    <?php
        } */ if($c_set == 'ok'){
            if($this->crud_model->get_type_name_by_id('general_settings','68','value') == 'ok'){
    ?>
    <div class="cc-selector col-sm-2"></div>
    <div class="cc-selector col-sm-8">
        <input id="mastercard" style="display:block;" type="radio" name="payment_type" value="cash_on_delivery"/>
        <label class="drinkcard-cc" style="margin-bottom:0px; width:100%; overflow:hidden; " for="mastercard" onclick="radio_check('mastercard')">
            <img src="<?php echo base_url(); ?>template/front/img/preview/payments/cash.jpg" width="100%" height="100%" style=" text-align-last:center;" alt="<?php echo translate('cash_on_delivery');?>" />
               
        </label>
    </div>
    <div class="cc-selector col-sm-2"></div>
    <?php 
            }
        }
    ?>
    <?php 
    if ($this->crud_model->get_type_name_by_id('general_settings','84','value') == 'ok') {
        if ($this->session->userdata('user_login') == 'yes') {
    ?>
    <div class="cc-selector col-sm-3">
        <input id="mastercarddd" style="display:block;" type="radio" name="payment_type" value="wallet"/>
        <label class="drinkcard-cc" style="margin-bottom:0px; width:100%; overflow:hidden; text-align:center;" for="mastercarddd" onclick="radio_check('mastercarddd')">
            <img src="<?php echo base_url(); ?>template/front/img/preview/payments/wallet.jpg" width="100%" height="100%" style=" text-align-last:center;" alt="<?php echo translate('wallet');  ?> : <?php echo currency($this->wallet_model->user_balance()); ?>" />
            <span style="position: absolute;margin-top: -8%;margin-left: -26px;color: #000000;"><?php echo currency($this->wallet_model->user_balance()); ?></span>
        </label>
    </div>
    <?php
        }
    }    
    ?>
</div>
<style>
.cc-selector input{
    margin:0;padding:0;
    -webkit-appearance:none;
       -moz-appearance:none;
            appearance:none;
}
 
.cc-selector input:active +.drinkcard-cc
{
    opacity: 1;
    border:4px solid #169D4B;
}
.cc-selector input:checked +.drinkcard-cc{
    -webkit-filter: none;
    -moz-filter: none;
    filter: none;
    border:4px solid black;
}
.drinkcard-cc{
    cursor:pointer;
    background-size:contain;
    background-repeat:no-repeat;
    display:inline-block;
    -webkit-transition: all 100ms ease-in;
    -moz-transition: all 100ms ease-in;
    transition: all 100ms ease-in;
    -webkit-filter:opacity(.5);
    -moz-filter:opacity(.5);
    filter:opacity(.5);
    transition: all .6s ease-in-out;
    border:4px solid transparent;
    border-radius:5px !important;
}
.drinkcard-cc:hover{
    -webkit-filter:opacity(1);
    -moz-filter: opacity(1);
    filter:opacity(1);
    transition: all .6s ease-in-out;
    border:4px solid #8400C5;
            
}

</style>