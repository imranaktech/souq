<style>
    .form-login .form-control
    {
        height: 34px;
    }
</style>
<section class="page-section color get_into">
    <div class="container">
        <div class="row margin-top-0">
            <div class="col-sm-6 col-sm-offset-3 col-lg-6">
                <div class="logo_top">
                    <a href="<?php echo base_url()?>">
                        <img class="img-responsive" src="<?php echo $this->crud_model->logo('home_bottom_logo'); ?>" alt="Shop" style="z-index:200">
                    </a>
                </div>
				<?php
                    echo form_open(base_url() . 'home/vendor_logup/add_info/', array(
                        'class' => 'form-login',
                        'method' => 'post',
                        'id' => 'sign_form'
                    ));
                ?>
                	<div class="row box_shape">
                        <div class="title">
                            <?php echo translate('vendor_registration');?>
                            <div class="option">
                            	<?php echo translate('already_a_vendor_?_click_to_');?>
                                <a href="<?php echo base_url(); ?>vendor" target="_blank" class="vendor_login_btn">
                                    <?php echo translate('login');?> <?php /*echo translate('as_vendor');*/?>
                                </a>
<!--                            	--><?php //echo translate('not_a_member_yet_?_click_to_');?>
<!--                                <a href="--><?php //echo base_url(); ?><!--home/login_set/registration"> -->
<!--                                    --><?php //echo translate('sign_up');?><!-- --><?php //echo translate('as_customer');?>
<!--                                </a>!-->
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control required" name="name" type="text" placeholder="<?php echo translate('name');?> *" data-toggle="tooltip" title="<?php echo translate('name');?> *">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control required" name="display_name" type="text" placeholder="<?php echo translate('store_name');?>" data-toggle="tooltip" title="<?php echo translate('store_name');?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="form-control emails required" name="email" type="email" placeholder="<?php echo translate('email');?> *" data-toggle="tooltip" title="<?php echo translate('email');?> *">
                            </div>
                            <div id='email_note'></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <input class="form-control pass1 required" style=" width: 227px;" type="password" name="password1" min="8" placeholder="<?php echo translate('password');?> (minimum 8 characters) *" data-toggle="tooltip" title="<?php echo translate('password');?> *">
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
                                <div class="input-group" style="width: 100%;">
                                    <select name="phone_code"  id="phone_code" style="width: 25%;height: 34px;float: left">
                                        <?php
                                            $default_calling_code = "0092";
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
                                    <input style="width: 75%;" class="form-control phone required" name="phone" id="pone" type="text" placeholder="<?php echo translate('phone_number xxxx-xxx-xxxxxxx');?> *" data-toggle="tooltip" title="<?php echo translate('phone');?> *">
                                </div>
                            </div>
                            <div id='email_note'></div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="form-control" name="company" type="text" placeholder="<?php echo translate('company');?> *" data-toggle="tooltip" title="<?php echo translate('company');?> *">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="form-control required" name="address1" type="text" placeholder="<?php echo translate('address_line_1');?> *" data-toggle="tooltip" title="<?php echo translate('address_line_1');?> *">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="form-control " name="address2" type="text" placeholder="<?php echo translate('address_line_2');?>" data-toggle="tooltip" title="<?php echo translate('address_line_2');?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control required" name="city" type="text" placeholder="<?php echo translate('city');?> *" data-toggle="tooltip" title="<?php echo translate('city');?> *">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control required" name="state" type="text" placeholder="<?php echo translate('Province');?> *" data-toggle="tooltip" title="<?php echo translate('Province');?> *">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
<!--                                <input class="form-control required" name="country" type="text" placeholder="--><?php //echo translate('country');?><!-- *" data-toggle="tooltip" title="--><?php //echo translate('country');?><!-- *">-->
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
                            <div class="form-group">
                                <input class="form-control" name="zip" type="text" placeholder="<?php echo translate('postal_code');?>" data-toggle="tooltip" title="<?php echo translate('postal_code');?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="form-control nic_number required" name="nic_no" id="nic_no" data-inputmask="'mask': '99999-9999999-9'" type="text" placeholder="<?php echo translate('nic_number XXXXX-XXXXXXX-X');?> *" data-toggle="tooltip" title="<?php echo translate('nic_number');?> *">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nic_copy" class="btn" Style="text-align: left; white-space: pre-line;">
                                    UPLOAD CNIC (FRONT SIDE IN JPG/JPEG/PNG FORMATS ONLY) *
                                </label>
                                <input class="form-control nic_copy required" name="nic_copy" id="nic_copy" onchange="validateFileType()" type="file" accept="image/jpg" placeholder="<?php echo translate('nic_copy');?> *" data-toggle="tooltip" title="<?php echo translate('nic_copy');?> *">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <input  name="terms_check" type="checkbox" value="ok" > 
                            <?php echo translate('i_agree_with');?>
                            <a href="<?php echo base_url();?>home/legal/sale_terms_conditions" target="_blank">
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
                    </div>
            	</form>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    function validaType(){
        var pone = document.getElementById("pone").value;
        if(parseInt(pone.length)<=9){ alert('please enter 10 digits Phone Number');
        document.getElementById("pone").value = "";return false; }
        if(parseInt(pone.length)>=11){ alert('please enter 10 digits Phone Number');
        document.getElementById("pone").value = "";return false; }
    }
    </script>
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
    function validateFileType(){
        var fileName = document.getElementById("nic_copy").value;
        var idxDot = fileName.lastIndexOf(".") + 1;
        var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
        // var phone = document.getElementById("phone").value;
        // for (var i=0;i<phone.length;i++)
        // {
        //     if(i>10){
        //         alert('please enter 10 digits Phone Number');
        //       document.getElementById("phone").value = "";
                
        //     }
        // } 
        
		if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
            var sizeinbytes = document.getElementById('nic_copy').files[0].size;
            // alert(sizeinbytes);
            if(sizeinbytes > 2000000) {
                alert('Please select image size less than 2 MB');
               document.getElementById("nic_copy").value = "";
            }
            //TO DO
        }else{
            alert("Only jpg/jpeg and png files are allowed!");
            document.getElementById("nic_copy").value = "";
        }   
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
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
<script>
    $(":input").inputmask();

    $(document).ready(function (e) {
        phone_mask();
        $(document).on("change","#phone_code",function (e) {
        phone_mask();
        });
    });
    function phone_mask() {
        var phone_code = $("#phone_code").val();
        var phone = $("#phone");
        var mask = "";
        // for (var i=0;i<phone_code.length;i++)
        // {
        //     mask+="9"
        // }
        mask+="-999-9999999";
        var im = new Inputmask(mask);
        im.mask(phone);
        phone.val();
    }
</script>
