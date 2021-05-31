<!--<div style="position: absolute;width: 100%;height: 100%; z-index: 9999999999; background: #cd6e00">-->
<!--    <h1 style="height: 100vh;text-align: center">Under Development</h1>-->
<!--</div>-->
<style>
    .form-login .form-control
    {
        height: 34px;
    }
</style>
<section class="page-section color get_into">
    <div class="container">
        <div class="row margin-top-0">
            <div class="col-sm-6 col-sm-offset-3">
<!--                <div class="logo_top">-->
<!--                    <a href="--><?php //echo base_url()?><!--">-->
<!--                        <img class="img-responsive" src="--><?php //echo $this->crud_model->logo('home_bottom_logo'); ?><!--" alt="Shop" style="z-index:200">-->
<!--                    </a>-->
<!--                </div>-->
				<?php
                    echo form_open(base_url() . 'home/registration/add_info/', array(
                        'class' => 'form-login',
                        'method' => 'post',
                        'id' => 'sign_form'
                    ));
                    $fb_login_set = $this->crud_model->get_type_name_by_id('general_settings','51','value');
                    $g_login_set = $this->crud_model->get_type_name_by_id('general_settings','52','value');
                ?>
                	<div class="row box_shape">
                        <div class="title">
                            <?php echo translate('customer_registration');?>
                            <div class="option">
                            	<?php echo translate('already_a_customer ? click_to');?>
                                <?php
									if ($this->crud_model->get_type_name_by_id('general_settings','58','value') !== 'ok') {
								?>
                                <a href="<?php echo base_url(); ?>home/login_set/login"> 
                                    <?php echo translate('login');?>!
                                </a>
                                <?php
									}else{
								?>
                                <a href="<?php echo base_url(); ?>home/login_set/login">
                                    <?php echo translate('login');?><!--! --><?php /*echo translate('login');*/?>
                                </a>
<!--                                --><?php //echo translate('_or_');?>
<!--                                <a href="--><?php //echo base_url(); ?><!--home/vendor_logup/registration"> -->
<!--                                    --><?php //echo translate('sign_up');?><!--! --><?php //echo translate('as_vendor');?>
<!--                                </a>-->
                                <?php
									}
								?>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control required" name="username" type="text" placeholder="<?php echo translate('first_name');?> *" data-toggle="tooltip" title="<?php echo translate('first_name');?> *">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control required" name="surname" type="text" placeholder="<?php echo translate('last_name');?>" data-toggle="tooltip" title="<?php echo translate('last_name');?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control emails required" name="email" type="email" placeholder="<?php echo translate('email');?> *" data-toggle="tooltip" title="<?php echo translate('email');?> *">
                            </div>
                            <div id='email_note'></div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group" style="width: 100%;">
                                    <select name="phone_code" style="width: 25%;height: 34px;float: left">
                                        <?php
                                        $countries = $this->db->get_where("ws_country",array("calling_code !="=>""))->result_array();
                                        foreach ($countries as $countrys)
                                        {
                                            if($countrys['calling_code']=='0092'){
                                            echo "<option value='".$countrys['calling_code']."'>".$countrys['country_name']." (".$countrys['calling_code'].")"."</option>";
                                            }
                                        }
                                        foreach ($countries as $country)
                                        {
                                            echo "<option value='".$country['calling_code']."'>".$country['country_name']." (".$country['calling_code'].")"."</option>";
                                        }
                                        ?>
                                    </select>
                                    <input style="width: 75%;" class="form-control" name="phone" id="pone" type="text" placeholder="<?php echo translate('phone');?> *" data-toggle="tooltip" title="<?php echo translate('phone');?> *">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <input class="form-control pass1 required" style=" width: 227px;" type="password" name="password1" placeholder="<?php echo translate('password');?> (minimum 8 characters) *" data-toggle="tooltip" title="<?php echo translate('password');?> (minimum 8 chracters) *">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default reveal" type="button"><i class="glyphicon glyphicon-eye-open"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <input class="form-control pass2 required" type="password" name="password2" placeholder="<?php echo translate('confirm_password');?> *" data-toggle="tooltip" title="<?php echo translate('confirm_password');?> *">
                                    <span class="input-group-btn">
                                            <button class="btn btn-default reveal" type="button"><i class="glyphicon glyphicon-eye-open"></i></button>
                                    </span>
                                </div>
                            </div>
                            <div id='pass_note'></div> 
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="form-control required" name="address1" type="text" placeholder="<?php echo translate('address_line_1');?> *" data-toggle="tooltip" title="<?php echo translate('address_line_1');?> *">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="form-control required" name="address2" type="text" placeholder="<?php echo translate('address_line_2');?>" data-toggle="tooltip" title="<?php echo translate('address_line_2');?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control required" type="text" name="city" placeholder="<?php echo translate('city');?> *" data-toggle="tooltip" title="<?php echo translate('city');?> *">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control required" type="text" name="state" placeholder="<?php echo translate('Province');?> *" data-toggle="tooltip" title="<?php echo translate('Province');?> *">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
<!--                                <input class="form-control required" type="text" name="country" placeholder="--><?php //echo translate('country');?><!--" data-toggle="tooltip" title="--><?php //echo translate('country');?><!--">-->
                            <select style="width: 100%; height: 34px;" name="country" required="required">
                                <option value="">Select Country *</option>
                                <?php
                                $countries = $this->db->get("ws_country")->result_array();
                                foreach ($countries as $country)
                                {
                                    echo "<option value='".$country['country_name']."'>".$country['country_name']."</option>";
                                }
                                ?>
                            </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="">
                                <input class="form-control" name="zip" type="text" placeholder="<?php echo translate('postal_code');?>" data-toggle="tooltip" title="<?php echo translate('postal_code');?>">
                            </div>
                        </div>
                        <div class="col-md-12 terms">
                            <input  name="terms_check" type="checkbox" value="ok" > 
                            <?php echo translate('i_agree_with');?>
                            <a href="<?php echo base_url();?>home/legal/terms_conditions" target="_blank">
                                <?php echo translate('terms_&_conditions');?>
                            </a>
                        </div>
                        <?php
							if($this->crud_model->get_settings_value('general_settings','captcha_status','value') == 'ok'){
						?>
                        <div class="col-md-12">
                            <div class="outer required">
                                <div class="form-group">
                                    <?php echo $recaptcha_html; ?>
                                </div>
                            </div>
                        </div>
                        <?php
							}
						?>
                        <div class="col-md-12">
                            <span class="btn btn-theme-sm btn-block btn-theme-dark pull-right logup_btn" onclick="validaType()" data-ing='<?php echo translate('registering..'); ?>' data-msg="">
                                <?php echo translate('register');?>
                            </span>
                        </div>
                        <!--- Facebook and google login -->
                        <?php if($fb_login_set == 'ok' || $g_login_set == 'ok'){ ?>
                            <div class="col-md-12 col-lg-12">
                                <h2 class="login_divider"><span>or</span></h2>
                            </div>
                        <?php if($fb_login_set == 'ok'){ ?>
                            <div class="col-md-12 col-lg-6 <?php if($g_login_set !== 'ok'){ ?>mr_log<?php } ?>">
                                <?php if (@$user): ?>
                                    <a class="btn btn-theme btn-block btn-icon-left facebook" href="<?= $url ?>">
                                        <i class="fa fa-facebook"></i>
                                        <?php echo translate('sign_in_with_facebook');?>
                                    </a>
                                <?php else: ?>
                                    <a class="btn btn-theme btn-block btn-icon-left facebook" href="<?= $url ?>">
                                        <i class="fa fa-facebook"></i>
                                        <?php echo translate('sign_in_with_facebook');?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php } if($g_login_set == 'ok'){ ?>  
                            <div class="col-md-12 col-lg-6 <?php if($fb_login_set !== 'ok'){ ?>mr_log<?php } ?>">
                                <?php if (@$g_user): ?>
                                    <a class="btn btn-theme btn-block btn-icon-left google" style="background:#ce3e26" href="<?= $g_url ?>">
                                        <i class="fa fa-google"></i>
                                        <?php echo translate('sign_in_with_google');?>
                                    </a>
                               <?php else: ?>
                                    <a class="btn btn-theme btn-block btn-icon-left google" style="background:#db4a39;height: 51px;color: white;"  href="<?= $g_url ?>">
                                        <i class="fa fa-google"></i>
                                        <?php echo translate('sign_in_with_google');?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php
                                }
                            }
                        ?>
                    </div>
            	</form>
            </div>
        </div>
    </div>
</section>
<style>
	.get_into .terms a{
		margin:5px auto;
		font-size: 14px;
		line-height: 24px;
		font-weight: 400;
		color: #00a075;
		cursor:pointer;
		text-decoration:underline;
	}
	
	.get_into .terms input[type=checkbox] {
		margin:0px;
		width:15px;
		height:15px;
		vertical-align:middle;
	}
</style>
<script type="text/javascript">
    function validaType(){
        
        var pone = document.getElementById("pone").value;
        if(parseInt(pone.length)<=9){ alert('please enter 10 digits Phone Number');
        document.getElementById("pone").value = "";return false; }
        if(parseInt(pone.length)>=11){ alert('please enter 10 digits Phone Number');
        document.getElementById("pone").value = "";return false; }
    }
    </script>
<script>
    $(".reveal").on('click',function() {
        var $pwd = $(".pwd");
        $pwd = $(this).parent().prev('input');
        if ($pwd.attr('type') === 'password') {
            $pwd.attr('type', 'text');
        } else {
            $pwd.attr('type', 'password');
        }
    });
</script>
<script src="<?php echo base_url('template/front/js/input-groups.min.js');?>"></script>