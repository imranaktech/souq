<?php 
	$contact_address =  $this->db->get_where('general_settings',array('type' => 'contact_address'))->row()->value;
	$contact_phone =  $this->db->get_where('general_settings',array('type' => 'contact_phone'))->row()->value;
	$contact_email =  $this->db->get_where('general_settings',array('type' => 'contact_email'))->row()->value;
	$contact_website =  $this->db->get_where('general_settings',array('type' => 'contact_website'))->row()->value;
	$contact_about =  $this->db->get_where('general_settings',array('type' => 'contact_about'))->row()->value;
	
	$facebook =  $this->db->get_where('social_links',array('type' => 'facebook'))->row()->value;
	$googleplus =  $this->db->get_where('social_links',array('type' => 'google-plus'))->row()->value;
	$twitter =  $this->db->get_where('social_links',array('type' => 'twitter'))->row()->value;
	$skype =  $this->db->get_where('social_links',array('type' => 'skype'))->row()->value;
	$youtube =  $this->db->get_where('social_links',array('type' => 'youtube'))->row()->value;
	$pinterest =  $this->db->get_where('social_links',array('type' => 'pinterest'))->row()->value;
	
	$footer_text =  $this->db->get_where('general_settings',array('type' => 'footer_text'))->row()->value;
	$footer_category =  json_decode($this->db->get_where('general_settings',array('type' => 'footer_category'))->row()->value);
?>
<footer class="footer1">
	<div class="footer1-widgets" style="    background-image: linear-gradient(to right top, #051937, #004d7a, #008793, #00bf72, #03A678);">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-sm col-xs-12">
                    <div class="widget widget-categories">
                        <h4 class="widget-title"><?php echo translate('useful_links');?></h4>
                        <ul>
                            <li>
                                <a href="<?php echo base_url(); ?>home/" class="link"><?php echo translate('home');?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>home/category/0/0-0" class="link"><?php echo translate('all_products');?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>home/featured" class="link"><?php echo translate('featured_products');?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>home/contact/" class="link"><?php echo translate('contact');?>
                                </a>
                            </li>
                            <?php
                            $this->db->where('status','ok');
                            $all_page = $this->db->get('page')->result_array();
                            foreach($all_page as $row){
                                ?>

                                <?php
                            }
                            ?>
                        </ul>
                    </div>
				</div>

                <div class="col-lg-3 col-md-3 col-sm-sm col-xs-12">
                    <div class="widget">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <h4 class="widget-title"><?php echo translate('connect_with_us');?></h4>
                                <ul class="social-nav model-2" style="float: left;margin-top: 10px">
                                    								<?php
                                    								if ($facebook != '') {
                                    								?>
                                    								<li style="border-top: none;"><a href="https://www.facebook.com/souqpkofficial/" target="_blank" class="facebook social_a"><i class="fa fa-facebook"></i></a></li>
                                    								<?php
                                    								} if ($twitter != '') {
                                    								?>
																		<li style="border-top: none;"><a href="https://www.instagram.com/officialsouqpk/" target="_blank" class="google-plus social_a"><i class="fa fa-instagram"></i></a></li>
                                    								<?php
                                    								} if ($googleplus != '') {
                                    								?>

                                    								<!--<li style="border-top: none;"><a href="<?php echo $linkedin;?>" class="linkedin-social_a" target="_blank" style="background: #01a8e7;"><i class="fa fa-linkedin"></i></a></li>-->
                                    								
                                    								<li style="border-top: none;"><a href="https://www.souqpk.com/" class="linkedin-social_a" target="_blank" style="background: #01a8e7;"><i class="fa fa-linkedin"></i></a></li>
                                    								<?php
                                    								} if ($youtube != '') {
                                    								?>
                                                                        <li style="border-top: none;"><a href="https://www.youtube.com/channel/UC7kt59H0pRSsU1N2-W45mqQ/featured" target="_blank" class="youtube-plus social_a" style="background: #e91600;"><i class="fa fa-youtube"></i></a></li>
                                    								<?php
                                    								}
                                    								?>
                                    							</ul>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>

				<div class="col-lg-3 col-md-3 col-sm-sm col-xs-12">
					<div class="widget widget-categories">
						<h4 class="widget-title"><?php echo translate('CUSTOMER_APP');?></h4>
                        <a href="https://apps.apple.com/ae/app/souq-pk/id1516997737"><img  class="image_delay" src="" data-src="<?php echo base_url(); ?>uploads/apple-play.png" style="width:200px;margin-left: -25px;" /></a>
                        <a href="https://play.google.com/store/apps/details?id=com.ingenious.mysouqpk"><img  class="image_delay" src=""  data-src="<?php echo base_url(); ?>uploads/google-play.png" style="width:200px;margin-left: -25px;" /></a>

<!--<map name="CUSTOMER_APP" >-->
<!--  <area shape="rect" coords="0,0,200,55"   alt="CUSTOMER_APP" href="computer.htm" >-->
<!--  <area shape="rect"  coords="0,40,200,150" alt="CUSTOMER_APP" href="https://play.google.com/store/apps/details?id=com.ingenious.mysouqpk"  >-->
<!--</map>-->
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-sm col-xs-12">
					<div class="widget contact">
						<h4 class="widget-title"><?php echo translate('VENDOR_APP');?></h4>
                        <a href="https://apps.apple.com/ae/app/souq-pk-vendor-app/id1515004938"><img  class="image_delay" src="" data-src="<?php echo base_url(); ?>uploads/apple-play.png" style="width:200px;margin-left: -25px;" usemap=""/></a>
                        <a href="https://play.google.com/store/apps/details?id=app.souqpk.vendorapp"><img  class="image_delay" href="https://play.google.com/store/apps/details?id=app.souqpk.vendorapp"  src="" data-src="<?php echo base_url(); ?>uploads/google-play.png" style="width:200px;margin-left: -25px;" usemap="#CUSTOMER_APP"/></a>
                        <!--<img  class="image_delay" src="" data-src="<?php echo base_url(); ?>uploads/app-store-google-play-png-Sq.png" style="width:200px;margin-left: -25px;"usemap="#VENDOR_APP"/>-->

<!--<map name="VENDOR_APP" >-->
<!--  <area shape="rect" coords="0,0,200,55"   alt="VENDOR_APP" href="computer.htm" >-->
<!--  <area shape="rect"  coords="0,40,200,100" alt="VENDOR_APP" href="https://play.google.com/store/apps/details?id=app.souqpk.vendorapp"  >-->
<!--</map>-->
					</div>
				</div>

			</div>
		</div>
	</div>
	<div class="footer1-meta">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-xs-12">
					<div class="copyright" version="Currently <?= demo()?'demo':''?> v<?php echo $this->db->get_where('general_settings',array('type'=>'version'))->row()->value; ?>">
						<?php echo date('Y'); ?> &copy; 
						<?php echo translate('all_rights_reserved'); ?> @ 
						<a href="<?php echo base_url(); ?>">
							<?php echo $system_title; ?>
						</a> 
							| 
						<a href="<?php echo base_url(); ?>home/page/terms_conditions" class="link">
							<?php echo translate('terms_&_condition'); ?>
						</a> 
							| 
						<a href="<?php echo base_url(); ?>home/legal/privacy_policy" class="link">
							<?php echo translate('privacy_policy'); ?>
						</a>
					</div>
				</div>
				<div class="col-md-4 hidden-xs hidden-sm">
					<div class="payments" style="font-size: 30px;">
						<ul>
							<li><img src="<?php echo base_url(); ?>uploads/others/payment.png"></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
<style>
.link:hover{
	text-decoration:underline;
}
.model-2 a {
	margin: 0px 1px;
	height: 32px;
	width: 32px;
	line-height: 32px;

}
</style>
