
<section class="page-section color get_into">
    <div class="container" id="login">
        <div class="row margin-top-0">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="logo_top">
                    <a href="<?php echo base_url()?>">
                    	<img class="img-responsive" src="<?php echo $this->crud_model->logo('home_bottom_logo'); ?>" alt="Shop" style="z-index:200">
                    </a>
                </div>
                <?php
                    echo form_open(base_url() . 'home/login/do_login/', array(
                        'class' => 'form-login',
                        'method' => 'post',
                        'id' => 'login_form'
                    ));
                    $fb_login_set = $this->crud_model->get_type_name_by_id('general_settings','51','value');
                    $g_login_set = $this->crud_model->get_type_name_by_id('general_settings','52','value');
                ?>
                    <div class="row box_shape">
                        <div class="title">
                            <?php echo translate('sign_in');?>
                            <div class="option">
                            	<?php echo translate('not_a_member_yet_?');?>
                                <a href="<?php echo base_url(); ?>home/login_set/registration"> 
                                    <?php echo translate('sign_up_now!');?>
                                </a>
                            </div>
                        </div>
                        <hr>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <input class="form-control email" type="email" name="email" value="<?php echo !empty($email)?$email:''; ?>"  placeholder="<?php echo translate('email');?>">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <input class="form-control" type="password" name="password" value="<?php echo !empty($password)?$password:''; ?>"  placeholder="<?php echo translate('password');?>">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default reveal" type="button" style="height: 50px; width: 50px;"><i class="glyphicon glyphicon-eye-open"></i></button>
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-3 col-sm-3 col-xs-12 text-left pull-left">
                            <div class="input-group" style="line-height: 20px;">
                                <label for="remember-me"><?php echo translate('remember_me');?></label>
                                <input  name="remember-me" type="checkbox" id="remember-me" style="margin-top:0px;height: 20px;float: left;">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-3 col-sm-3 col-xs-12 text-right pull-right">
                            <span class="forgot-password" style="cursor:pointer;" onClick="set_html('login','forget')">
                                <?php echo translate('forgot_your_password_?');?>
                            </span>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <span class="btn btn-theme-sm btn-block btn-theme-dark pull-right login_btn enterer">
                                <?php echo translate('login');?>
                            </span>
                        </div>
                        <?php if($fb_login_set == 'ok' || $g_login_set == 'ok'){ ?>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <h2 class="login_divider"><span>or</span></h2>
                            </div>
                        <?php if($fb_login_set == 'ok'){ ?>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 <?php if($g_login_set !== 'ok'){ ?>mr_log<?php } ?>">
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
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 <?php if($fb_login_set !== 'ok'){ ?>mr_log<?php } ?>">
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
    
    <div class="container" id="forget" style="display:none">
        <div class="row margin-top-0">
            <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12">
                <?php
                    echo form_open(base_url() . 'home/login/forget/', array(
                        'class' => 'form-login',
                        'method' => 'post',
                        'id' => 'forget_form'
                    ));
                ?>
                    <div class="row box_shape">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <input class="form-control" type="email" name="email" placeholder="<?php echo translate('email_address');?>">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
                            <span class="forgot-password pull-left" style="cursor:pointer;" onClick="set_html('forget','login')">
                                <?php echo translate('login');?>
                            </span>
                            <span class="btn btn-primary btn-sm forget_btn enterer">
                                <?php echo translate('submit');?>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</section>
<script>
function set_html(hide,show){
	$('#'+show).show('fast');
	$('#'+hide).hide('fast');
}
</script>
<style>
.g-icon-bg {
background: #ce3e26;
}
.g-bg {
background: #de4c34;
height: 37px;
margin-left: 41px;
width: 166px;
}
</style>
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