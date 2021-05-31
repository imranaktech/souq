<!-- BREADCRUMBS -->
<section class="page-section breadcrumbs">
    <div class="container">
        <div class="page-header">
            <h2 class="section-title section-title-lg">
                <span>
                    <?php 
					if($type=='terms_conditions'){
						echo translate('terms_&_condition');
					}
					elseif($type=='privacy_policy'){
						echo translate('privacy_policy');
					}
					elseif($type=='sale_terms_conditions'){
						echo translate('sale_terms_&_condition');
					}
					?>
                </span>
            </h2>
        </div>
    </div>
</section>
<!-- /BREADCRUMBS -->

<!-- PAGE -->
<section class="page-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            	<?php echo $this->db->get_where('general_settings', array( 'type' => $type ))->row()->value; ?>
            </div>
        </div>
    </div>
</section>
<!-- /PAGE -->