
<?php 
	if($this->crud_model->get_type_name_by_id('general_settings','62','value') == 'ok'){
		include 'category_menu.php';
	}
?>
<?php
include 'top_banner.php';
?>

<?php
	if($this->crud_model->get_type_name_by_id('ui_settings','59','value') == 'ok'){
		include 'todays_deal.php';
	}
?>
<?php
if ($this->crud_model->get_type_name_by_id('general_settings','82','value') == 'ok') {
	if($this->crud_model->get_type_name_by_id('ui_settings','40','value') == 'ok'){
		include 'product_bundle.php';
	}
}
if($this->crud_model->get_type_name_by_id('general_settings','50','value') == 'ok'){
	if($this->crud_model->get_type_name_by_id('ui_settings','39','value') == 'ok'){
		include 'customer_products.php';
	}
}
?>
<?php
	if($this->crud_model->get_type_name_by_id('ui_settings','24','value') == 'ok'){
		include 'featured_products.php';
	}
?>
<?php
//	if ($this->crud_model->get_type_name_by_id('general_settings','82','value') == 'ok') {
//		if($this->crud_model->get_type_name_by_id('ui_settings','40','value') == 'ok'){
//			include 'product_bundle.php';
//		}
//	}
//	if($this->crud_model->get_type_name_by_id('general_settings','83','value') == 'ok'){
//		if($this->crud_model->get_type_name_by_id('ui_settings','43','value') == 'ok'){
//			include 'customer_products.php';
//		}
//	}
?>
<?php 
	if ($this->crud_model->get_type_name_by_id('general_settings','58','value') == 'ok') {
		if($this->crud_model->get_type_name_by_id('ui_settings','25','value') == 'ok'){
			include 'vendors.php';
		}
	}
?>

<?php 
	if($this->crud_model->get_type_name_by_id('ui_settings','26','value') == 'ok'){
		include 'blog.php';
	}
?>
<?php
	if($this->crud_model->get_type_name_by_id('ui_settings','50','value') == 'ok'){
		include 'special_products.php';
	}
?>
<?php 
include 'category_product1.php';
?>
<?php
include 'category_products2.php';
?>
<?php 
	if ($this->crud_model->get_type_name_by_id('general_settings','68','value') == 'ok') {
		if($this->crud_model->get_type_name_by_id('ui_settings','23','value') == 'ok'){
			include 'brands.php';
		}
	}
?>

