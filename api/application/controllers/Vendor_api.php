<?php
class Vendor_api extends REST_Controller {
	/*
	 * Signup
	 * Login
	 * Select monthly subscription packages
	 * English/Urdu language
	 * Select delivery cities
	 * Add new product (category,sub category,images,videos,title,description)
	 * new orders
	 * completed orders
	 * canceled orders
	 * update order status
	 * Select main category
	 * */
	public function add_product(){
		$result = array("success"=>false,"message"=>"");
		$param = $this->input->post();
		if ($this->check_authentication()){
			if($this->is_logged_in())
			{
				$images = $_FILES;
				$images_count = count($images['images']['name']);
				$colors = !empty($param["colors"])?json_encode(explode(",",$param["colors"])):"";
				$rgb_colors = array();
				if(!empty($colors))
				{
					foreach (json_decode($colors) as $hex)
					{
						if(!empty($hex))
						{
							array_push($rgb_colors,$this->hexToRGB($hex));
						}
					}
				}
				$sizes = !empty($param["sizes"])?json_encode(explode(",",$param["sizes"])):"";
				$added_by=json_encode(array("type"=>"vendor","id"=>$param["vendor_id"]));
				$product = array(
					"title"=>$param["title"],
					"product_type"=>$param["product_type"],
					"added_by"=>$added_by,
					"category"=>$param["category"],
					"sub_category"=>$param["sub_category"],
					"description"=>$param["description"],
					"color"=>json_encode($rgb_colors),
					"size"=>$sizes,
					"num_of_imgs"=>$images_count,
					"sale_price"=>$param["sale_price"],
					"status"=>"ok",
					"brand"=>$param["brand"],
					"current_stock"=>$param["stock"],
					"unit"=>$param["unit"],
				);
				$this->db->insert("product",$product);
				$product_id = $this->db->insert_id();
				if($product_id>0)
				{
					$this->load->library('upload');
					for ($i=0; $i<$images_count; $i++)
					{
						$_FILES['images']['name']= "product_".$product_id."_".($i+1).".jpg"; //Product_112_1_thumb.jpg ,Product_112_1.jpg
						$_FILES['images']['type']= $images['images']['type'][$i];
						$_FILES['images']['tmp_name']= $images['images']['tmp_name'][$i];
						$_FILES['images']['error']= $images['images']['error'][$i];
						$_FILES['images']['size']= $images['images']['size'][$i];
//
//						$config['upload_path']          = $_SERVER['DOCUMENT_ROOT'].'/uploads/product_image/';
//						$config['allowed_types']        = 'jpg';
//						$config['max_size']             = 10240; // in kilobyte , 1024KB =1MB
//						$config['max_width']            = 1024;
//						$config['max_height']           = 768;
//						$this->upload->initialize($config);
//						if (!$this->upload->do_upload('images'))
//						{
//							$result["message"].=$this->upload->display_errors();
//						}
						$im             = new Imagick();
						$im->readimage($_FILES['images']['tmp_name']);
						$im->setImageFormat('jpg');
						$im->writeImage($_SERVER['DOCUMENT_ROOT'].'/uploads/product_image/'."product_".$product_id."_".($i+1).".jpg");
					}
					$result["success"]=true;
					$result["message"]="Product added!";
				}else{
					$result["message"]="Something went wrong!";
				}
			}else{
				$result["message"]="Please login to continue!";
			}
		}else{
			$result["message"]="Authentication failed!";
		}
		return $this->json_return($result);
	}
	public function add_product1(){
		$result = array("success"=>false,"message"=>"");
		$param = $this->input->post();
		if ($this->check_authentication()){
			if($this->is_logged_in())
			{
				$images = $_FILES;
				$images_count = count($images['images']['name']);
				$colors = !empty($param["colors"])?json_encode(explode(",",$param["colors"])):"";
				$rgb_colors = array();
				if(!empty($colors))
				{
					foreach (json_decode($colors) as $hex)
					{
						if(!empty($hex))
						{
							array_push($rgb_colors,$this->hexToRGB($hex));
						}
					}
				}
				$sizes = !empty($param["colors"])?json_encode(explode(",",$param["sizes"])):"";
				$added_by=json_encode(array("type"=>"vendor","id"=>$param["vendor_id"]));
				$product = array(
					"title"=>$param["title"],
					"product_type"=>$param["product_type"],
					"added_by"=>$added_by,
					"category"=>$param["category"],
					"sub_category"=>$param["sub_category"],
					"description"=>$param["description"],
					"color"=>json_encode($rgb_colors),
					"size"=>$sizes,
					"num_of_imgs"=>$images_count,
					"sale_price"=>$param["sale_price"],
					"status"=>"ok",
					"brand"=>$param["brand"],
					"current_stock"=>$param["stock"],
					"unit"=>$param["unit"],
				);
				$this->db->insert("product",$product);
				$product_id = $this->db->insert_id();
				if($product_id>0)
				{
					$this->load->library('upload');
					for ($i=0; $i<$images_count; $i++)
					{
						/*image convertor*/
						$config["image_library"] = "ImageMagick";
						$config["library_path"]="/usr/bin";
						$config["source_image"]=$images['images']['tmp_name'][$i];
						$config["new_image"]=$images['images']['tmp_name'][$i];
						$this->load->library("image_lib",$config);
						/*image convertor end...*/
						$_FILES['images']['name']= "product_".$product_id."_".($i+1).".jpg"; //Product_112_1_thumb.jpg ,Product_112_1.jpg
						$_FILES['images']['type']= $images['images']['type'][$i];
						$_FILES['images']['tmp_name']= $images['images']['tmp_name'][$i];
						$_FILES['images']['error']= $images['images']['error'][$i];
						$_FILES['images']['size']= $images['images']['size'][$i];

						$config['upload_path']          = $_SERVER['DOCUMENT_ROOT'].'/uploads/product_image/';
						$config['allowed_types']        = 'jpg';
						$config['max_size']             = 10240; // in kilobyte , 1024KB =1MB
						$config['max_width']            = 1024;
						$config['max_height']           = 768;
						$this->upload->initialize($config);
						if (!$this->upload->do_upload('images'))
						{
							$result["message"].=$this->upload->display_errors();
						}
					}
					$result["success"]=true;
					$result["message"]="Product added!";
				}else{
					$result["message"]="Something went wrong!";
				}
			}else{
				$result["message"]="Please login to continue!";
			}
		}else{
			$result["message"]="Authentication failed!";
		}
		return $this->json_return($result);
	}
	public function get_products(){
		$result = array("success"=>false,"message"=>"","products"=>array());
		$param = $this->input->post();
		if ($this->check_authentication()){
			if($this->is_logged_in())
			{
				$allProducts = $this->db->get("product")->result_array();
				$vendorProducts = array();
				/*records limit */
				$default_limit = 10;
				$start=!empty($param["start"])?(is_numeric($param["start"])?$param["start"]:0):0;
				$limit=!empty($param["limit"])?(is_numeric($param["limit"])?$param["limit"]:($start+$default_limit)):($start+$default_limit);
				$counter = 0;
				foreach ($allProducts as $product) {
					$addedBy = json_decode($product["added_by"],true);
					if($addedBy["type"]=="vendor" && $addedBy["id"]==$param["vendor_id"])
					{
						$counter++;
						if($counter>=$start && $counter<=$limit)
						{
							$image = dirname(base_url())."/uploads/product_image/product_".$product["product_id"]."_1".".jpg";
							$vendor_single_product = array(
								"product_id"=>$product["product_id"],
								"image"=>$image,
								"title"=>$product["title"],
								"description"=>$product["description"],
								"stock"=>$product["current_stock"],
								"unit"=>$product["unit"],
								"product_type"=>$product["product_type"],
								"sale_price"=>$product["sale_price"],
								"currency"=>$this->currency()
							);
							array_push($vendorProducts,$vendor_single_product);
						}
					}
					if(($start+$counter)==($start+$limit))
					{
						break;
					}
				}
				$result["products"]=$vendorProducts;
				if(count($vendorProducts)>0)
				{
					$result["success"]=true;
					$result["message"]=count($vendorProducts)." records found!";
				}else{
					$result["message"]="Records not found!";
				}
			}else{
				$result["message"]="Please login to continue!";
			}
		}else{
			$result["message"]="Authentication failed!";
		}
		return $this->json_return($result);
	}
	public function get_pending_sku(){
		$result = array("success"=>false,"message"=>"");
		if ($this->check_authentication()){
			if($this->is_logged_in())
			{
				$result["message"]="Api is Under Construction!";
			}else{
				$result["message"]="Please login to continue!";
			}
		}else{
			$result["message"]="Authentication failed!";
		}
		return $this->json_return($result);
	}
	public function get_rejected_sku(){
		$result = array("success"=>false,"message"=>"");
		if ($this->check_authentication()){
			if($this->is_logged_in())
			{
				$result["message"]="Api is Under Construction!";
			}else{
				$result["message"]="Please login to continue!";
			}
		}else{
			$result["message"]="Authentication failed!";
		}
		return $this->json_return($result);
	}
	public function get_orders(){
		$result = array("success"=>false,"message"=>"","orders"=>array());
		$param = $this->input->post();
		if ($this->check_authentication()){
			if($this->is_logged_in())
			{
				$this->db->order_by("sale_id","desc");
				$sales = $this->db->get('sale')->result_array();
				$vendor_sales = array();
				/*records limit */
				$default_limit = 10;
				$start=!empty($param["start"])?(is_numeric($param["start"])?$param["start"]:0):0;
				$limit=!empty($param["limit"])?(is_numeric($param["limit"])?$param["limit"]:($start+$default_limit)):($start+$default_limit);
				$counter = 0;
				foreach ($sales as $sale)
				{
					$sale_products = json_decode($sale["product_details"],true);
					$vendor_products=array();
					$vTotalPrice = 0;
					foreach ($sale_products as $product)
					{
						if(!empty($product["id"]))
						{
							$added_by = $this->db->get_where("product",array('product_id' => $product["id"]));
							if($added_by->num_rows()>0)
							{
								$added_by = json_decode($added_by->row()->added_by, true);
								if($added_by["type"]=="vendor" && $added_by["id"]==$param["vendor_id"])
								{
									array_push($vendor_products,$product);
								}
							}
						}
					}
					/*sale total*/
					foreach ($vendor_products as $vp)
					{
						$vTotalPrice+=$vp["subtotal"];
					}
					/*add sale to vendor*/
					if(count($vendor_products)>0)
					{
						if($counter>=$start && $counter<=$limit)
						{
							/*status*/
							$status=(array)json_decode($sale["delivery_status"]);
							foreach ($status as $s)
							{
								if(isset($s->vendor) && $s->vendor==$param["vendor_id"])
								{
									$status=$s->status;
									break;
								}
							}
//							if(is_array(json_decode($sale["delivery_status"])))
//							{
//
//							}else{
//								$status=$sale["delivery_status"];
//							}
							$single_sale=array(
								"order_id"=>$sale["sale_id"]."",
								"order_no"=>$sale["sale_code"]."",
								"order_status"=>$status,
								"order_time"=>date("d/M/Y h:i",$sale["sale_datetime"])."",
								"total_items"=>count($vendor_products)."",
								"subtotal"=>$this->currency($vTotalPrice)."",
								"image"=>$vendor_products[0]["image"],
							);
							array_push($vendor_sales,$single_sale);
						}
						$counter++;
					}
					/*break the loop */
					if(($start+$counter)==($start+$limit))
					{
						break;
					}
				}
				if(count($vendor_sales)>0)
				{
					$result["success"]=true;
					$result["message"]=count($vendor_sales)." orders found!";
					$result["orders"]=$vendor_sales;
				}else{
					$result["message"]="Orders not found!";
				}
			}else{
				$result["message"]="Please login to continue!";
			}
		}else{
			$result["message"]="Authentication failed!";
		}
		return $this->json_return($result);
	}
	public function get_pending_orders(){
		$result = array("success"=>false,"message"=>"");
		if ($this->check_authentication()){
			if($this->is_logged_in())
			{
				$result["message"]="Api is Under Construction!";
			}else{
				$result["message"]="Please login to continue!";
			}
		}else{
			$result["message"]="Authentication failed!";
		}
		return $this->json_return($result);
	}
	public function get_categories()
	{
		$result = array("success"=>false,"message"=>"","categories"=>array());
		$param = $this->input->post();
		if ($this->check_authentication()){
			if($this->is_logged_in())
			{
				$allCategories = $this->db->get("category")->result_array();
				foreach ($allCategories as $category)
				{
					$cat = array(
						"id"=>$category["category_id"],
						"name"=>$category["category_name"]
					);
					array_push($result["categories"],$cat);
				}
				if(count($allCategories)>0)
				{
					$result["success"]=true;
					$result["message"]=count($allCategories)." records found!";
				}else{
					$result["message"]="Records not found!";
				}

			}else{
				$result["message"]="Please login to continue!";
			}
		}else{
			$result["message"]="Authentication failed!";
		}
		return $this->json_return($result);
	}
	public function get_subcategories()
	{
		$result = array("success"=>false,"message"=>"","subcategories"=>array());
		$param = $this->input->post();
		if ($this->check_authentication()){
			if($this->is_logged_in())
			{
				$this->db->where("category",$param["category_id"]);
				$allCategories = $this->db->get("sub_category")->result_array();
				foreach ($allCategories as $category)
				{
					$cat = array(
						"id"=>$category["sub_category_id"],
						"name"=>$category["sub_category_name"]
					);
					array_push($result["subcategories"],$cat);
				}
				if(count($allCategories)>0)
				{
					$result["success"]=true;
					$result["message"]=count($allCategories)." records found!";
				}else{
					$result["message"]="Records not found!";
				}

			}else{
				$result["message"]="Please login to continue!";
			}
		}else{
			$result["message"]="Authentication failed!";
		}
		return $this->json_return($result);
	}
	public function get_brands()
	{
		$result = array("success"=>false,"message"=>"","brands"=>array());
		$param = $this->input->post();
		if ($this->check_authentication()){
			if($this->is_logged_in())
			{
				$allBrands = $this->db->get("brand")->result_array();
				foreach ($allBrands as $brand)
				{
					$cat = array(
						"id"=>$brand["brand_id"],
						"name"=>$brand["name"]
					);
					array_push($result["brands"],$cat);
				}
				if(count($allBrands)>0)
				{
					$result["success"]=true;
					$result["message"]=count($allBrands)." records found!";
				}else{
					$result["message"]="Records not found!";
				}

			}else{
				$result["message"]="Please login to continue!";
			}
		}else{
			$result["message"]="Authentication failed!";
		}
		return $this->json_return($result);
	}
	public function get_single_product()
	{
		$result = array("success"=>false,"message"=>"");
		$param = $this->input->post();
		if ($this->check_authentication()){
			if($this->is_logged_in())
			{
				$product = $this->db->get_where("product",array("product_id"=>$param["product_id"]))->row();
				if(!empty($product))
				{
					$product_array=array(
						"id"=>$product->product_id,
						"title"=>$product->title,
						"description"=>html_escape($product->description),
						"category"=>"",
						"sub_category"=>"",
						"brand"=>"",
						"category_id"=>"",
						"subcategory_id"=>"",
						"brand_id"=>"",
						"stock"=>$product->current_stock,
						"unit"=>$product->unit,
						"sale_price"=>$product->sale_price,
						"currency"=>$this->currency(),
						"discount"=>!empty($product->discount)?($product->discount_type=="percent"?$product->discount."%":$this->currency($product->discount)):"0",
						"tax"=>!empty($product->tax)?($product->tax_type=="percent"?$product->tax."%":$this->currency($product->tax)):"0",
						"shipping"=>!empty($product->shipping)?$this->currency($product->shipping):"0",
						"is_color_available"=>false,
						"color"=>"",
						"is_size_available"=>false,
						"size"=>"",
						"images"=>""
					);
					$product_array["category_id"]=$product->category."";
					$product_array["subcategory_id"]=$product->sub_category."";
					$product_array["brand_id"]=$product->brand."";
					/*product category*/
					if($product->category>0)
					{
						$this->db->select("category_name");
						$dbrow = $this->db->get_where("category",array("category_id"=>$product->category))->row();
						if($dbrow)
						{
							$product_array["category"]=$dbrow->category_name."";
						}
					}
					/*product sub category*/
					if($product->sub_category>0)
					{
						$this->db->select("sub_category_name");
						$dbrow = $this->db->get_where("sub_category",array("sub_category_id"=>$product->sub_category))->row();
						if($dbrow)
						{
							$product_array["sub_category"]=$dbrow->sub_category_name."";
						}
					}
					/*product brand*/
					if($product->brand>0)
					{
						$this->db->select("name");
						$dbrow = $this->db->get_where("brand",array("brand_id"=>$product->brand))->row();
						if($dbrow)
						{
							$product_array["brand"]=$dbrow->name."";
						}
					}
					/*product color*/
					if(!empty($product->color))
					{
						$color_array = array();
						foreach (json_decode($product->color) as $color)
						{
							array_push($color_array,array("color_code"=>$this->rgbaToHex($color)));
						}
						$product_array["is_color_available"]=true;
						$product_array["color"]=$color_array;
					}
					/*product size*/
					if(!empty($product->size))
					{
						$size_array = array();
						foreach (json_decode($product->size) as $size)
						{
							array_push($size_array,array("size_code"=>$size));
						}
						$product_array["is_size_available"]=true;
						$product_array["size"]=$size_array;
					}
					/*product images*/
					if($product->num_of_imgs>0)
					{
						$images =  array();
						for ($i=0;$i<$product->num_of_imgs;$i++)
						{
							$image = dirname(base_url())."/uploads/product_image/product_".$product->product_id."_".($i+1).".jpg";
							array_push($images,array("image_url"=>$image));
						}
						$product_array["images"]=$images;
					}
					$result["success"]=true;
					$result = array_merge($result,$product_array);
				}else{
					$result["message"]="Product details not found!";
				}
			}else{
				$result["message"]="Please login to continue!";
			}
		}else{
			$result["message"]="Authentication failed!";
		}
		return $this->json_return($result);
	}
	public function get_single_order()
	{
		$result = array("success"=>false,"message"=>"",
			"id"=>"",
			"order_no"=>"",
			"order_time"=>"",
			"total_items"=>"",
			"products"=>array(),
			"shipping"=>"",
			"tax"=>"",
			"discount"=>"",
			"total"=>"",
			"grand_total"=>"",
			);
		$param = $this->input->post();
		if ($this->check_authentication()) {
			if ($this->is_logged_in())
			{
				$result["message"]="API is under development!";
			}else{
				$result["message"]="Please login to continue!";
			}
		}else{
			$result["message"]="Authentication failed!";
		}
		return $this->json_return($result);
	}
	public function change_order_status()
	{
		$result = array("success"=>false,"message"=>"");
		$param = $this->input->post();
		if ($this->check_authentication()){
			if($this->is_logged_in())
			{
				/*validate request*/
				$reauired_param = array("payment_status","delivery_status","comment");
				$payment_status = array("due","paid","canceled");
				$delivery_status=array("pending","delivered","canceled","shipped");
				$param_validation = true;
				foreach ($reauired_param as $rp)
				{
					if (empty($param[$rp]))
					{
						$result["message"]=$rp." is required";
						$param_validation=false;
						break;
					}
				}
				if ($param_validation && !in_array(strtolower($param["payment_status"]),$payment_status))
				{
					$result["message"]="invalid payment status... you can use only one of them ".(implode(",",$payment_status));
					$param_validation=false;
				}
				if ($param_validation && !in_array(strtolower($param["delivery_status"]),$delivery_status))
				{
					$result["message"]="invalid delivery status... you can use only one of them ".(implode(",",$delivery_status));
					$param_validation=false;
				}
				/*update data*/
				if($param_validation)
				{
//					$sale = array(
//						"payment_status"=>json_encode(array("vendor"=>$param["vendor_id"],"status"=>$param["payment_status"])),
//						"delivery_status"=>json_encode(array("vendor"=>$param["vendor_id"],"status"=>$param["delivery_status"],"comment"=>$param["comment"],"delivery_time"=>time()))
//					);
//					$this->db->where("sale_id",$param["order_id"]);
//					$this->db->update("sale",$sale);
//					if($this->db->affected_rows()>0)
//					{
//						$result["success"]=true;
//						$result["message"]="Order Status updated!";
//					}
					$result["success"]=$this->change_vendor_order_status($param["vendor_id"],$param["order_id"],$param["delivery_status"],$param["payment_status"]);
					$result["message"]="Order Status updated!";
				}
			}else{
				$result["message"]="Please login to continue!";
			}
		}else{
			$result["message"]="Authentication failed!";
		}
		return $this->json_return($result);
	}
	public function get_cities()
	{
		$result = array("success"=>false,"message"=>"","cities"=>array());
		if ($this->check_authentication()){
			$cities = $this->db->get_where("ws_city",array('country_code'=>'PK'))->result_array();
			foreach ($cities as $city)
			{
				$result["cities"][]=array('id'=>$city['id'],'name'=>$city['city_name']);
			}
			if (count($cities))
			{
				$result["success"]=true;
				$result["message"]=count($cities)." results found!";
			}else{
				$result["message"]="No results found!";
			}
		}else{
			$result["message"]="Authentication failed!";
		}
		return $this->json_return($result);
	}
	public function get_home_stats()
	{
		$result = array("success"=>false,"message"=>"",
			"total_products"=>"0",
			"total_sales"=>"0",
			"total_orders"=>"0",
			"pending_orders"=>"0",
			"shipped_orders"=>"0",
			"delivered_orders"=>"0",
			"cancelled_orders"=>"0",
		);
		$param = $this->input->post();
		if ($this->check_authentication()){
			if($this->is_logged_in())
			{
				/*stats....*/
				$vendor_id = $param["vendor_id"];
				$vendor_total_products = $this->get_vendor_total_products($vendor_id);
				$vendor_total_sale = $this->currency($this->format_number($this->get_vendor_total_sale($vendor_id)));
				$vendor_total_orders = $this->get_vendor_total_orders($vendor_id);
				$vendor_delivered_orders = $this->get_vendor_delivered_orders($vendor_id);
				$vendor_pending_orders = $this->get_vendor_pending_orders($vendor_id);
				$vendor_shipped_orders = $this->get_vendor_shipped_orders($vendor_id);

				$result["total_products"] = $vendor_total_products."";
				$result["total_sales"] = $vendor_total_sale."";
				$result["total_orders"] = $vendor_total_orders."";
				$result["delivered_orders"] = $vendor_delivered_orders."";
				$result["pending_orders"] = $vendor_pending_orders."";
				$result["shipped_orders"] = $vendor_shipped_orders."";

				$result["success"]=true;

			}else{
				$result["message"]="Please login to continue!";
			}
		}else{
			$result["message"]="Authentication failed!";
		}
		return $this->json_return($result);
	}
	public function get_pendig_orders()
	{
		$result = array("success"=>false,"message"=>"","orders"=>array());
		$param = $this->input->post();
		if ($this->check_authentication()){
			if($this->is_logged_in())
			{
				$vendor_id = $param["vendor_id"];
				$this->db->order_by("sale_id","desc");
				$sales = $this->db->get('sale')->result_array();
				$vendor_sales = array();
				/*records limit */
				$default_limit = 10;
				$start=!empty($param["start"])?(is_numeric($param["start"])?$param["start"]:0):0;
				$limit=!empty($param["limit"])?(is_numeric($param["limit"])?$param["limit"]:($start+$default_limit)):($start+$default_limit);
				$counter = 0;
				foreach ($sales as $sale)
				{
					/*check status..*/
					$vendor_delivery_status = $this->get_vendor_delivery_status($vendor_id,$sale["sale_id"]);
					if($vendor_delivery_status!="pending")
					{
						continue;
					}
					/*fetch order details..*/
					$sale_products = json_decode($sale["product_details"],true);
					$vendor_products=array();
					$vTotalPrice = 0;
					foreach ($sale_products as $product)
					{
						if(!empty($product["id"]))
						{
							$added_by = $this->db->get_where("product",array('product_id' => $product["id"]));
							if($added_by->num_rows()>0)
							{
								$added_by = json_decode($added_by->row()->added_by, true);
								if($added_by["type"]=="vendor" && $added_by["id"]==$param["vendor_id"])
								{
									array_push($vendor_products,$product);
								}
							}
						}
					}
					/*sale total*/
					foreach ($vendor_products as $vp)
					{
						$vTotalPrice+=$vp["subtotal"];
					}
					/*add sale to vendor*/
					if(count($vendor_products)>0)
					{
						if($counter>=$start && $counter<=$limit)
						{
							/*status*/
							$status = $vendor_delivery_status;
							$single_sale=array(
								"order_id"=>$sale["sale_id"]."",
								"order_no"=>$sale["sale_code"]."",
								"order_status"=>$status,
								"order_time"=>date("d/M/Y h:i",$sale["sale_datetime"])."",
								"total_items"=>count($vendor_products)."",
								"subtotal"=>$this->currency($vTotalPrice)."",
								"image"=>$vendor_products[0]["image"],
							);
							array_push($vendor_sales,$single_sale);
						}
						$counter++;
					}
					/*break the loop */
					if(($start+$counter)==($start+$limit))
					{
						break;
					}
				}
				if(count($vendor_sales)>0)
				{
					$result["success"]=true;
					$result["message"]=count($vendor_sales)." orders found!";
					$result["orders"]=$vendor_sales;
				}else{
					$result["message"]="Orders not found!";
				}
			}else{
				$result["message"]="Please login to continue!";
			}
		}else{
			$result["message"]="Authentication failed!";
		}
		return $this->json_return($result);
	}
	public function get_completed_orders()
	{
		$result = array("success"=>false,"message"=>"","orders"=>array());
		$param = $this->input->post();
		if ($this->check_authentication()){
			if($this->is_logged_in())
			{
				$vendor_id = $param["vendor_id"];
				$this->db->order_by("sale_id","desc");
				$sales = $this->db->get('sale')->result_array();
				$vendor_sales = array();
				/*records limit */
				$default_limit = 10;
				$start=!empty($param["start"])?(is_numeric($param["start"])?$param["start"]:0):0;
				$limit=!empty($param["limit"])?(is_numeric($param["limit"])?$param["limit"]:($start+$default_limit)):($start+$default_limit);
				$counter = 0;
				foreach ($sales as $sale)
				{
					/*check status..*/
					$vendor_delivery_status = $this->get_vendor_delivery_status($vendor_id,$sale["sale_id"]);
					if($vendor_delivery_status!="delivered")
					{
						continue;
					}
					/*fetch order details..*/
					$sale_products = json_decode($sale["product_details"],true);
					$vendor_products=array();
					$vTotalPrice = 0;
					foreach ($sale_products as $product)
					{
						if(!empty($product["id"]))
						{
							$added_by = $this->db->get_where("product",array('product_id' => $product["id"]));
							if($added_by->num_rows()>0)
							{
								$added_by = json_decode($added_by->row()->added_by, true);
								if($added_by["type"]=="vendor" && $added_by["id"]==$param["vendor_id"])
								{
									array_push($vendor_products,$product);
								}
							}
						}
					}
					/*sale total*/
					foreach ($vendor_products as $vp)
					{
						$vTotalPrice+=$vp["subtotal"];
					}
					/*add sale to vendor*/
					if(count($vendor_products)>0)
					{
						if($counter>=$start && $counter<=$limit)
						{
							/*status*/
							$status = $vendor_delivery_status;
							$single_sale=array(
								"order_id"=>$sale["sale_id"]."",
								"order_no"=>$sale["sale_code"]."",
								"order_status"=>$status,
								"order_time"=>date("d/M/Y h:i",$sale["sale_datetime"])."",
								"total_items"=>count($vendor_products)."",
								"subtotal"=>$this->currency($vTotalPrice)."",
								"image"=>$vendor_products[0]["image"],
							);
							array_push($vendor_sales,$single_sale);
						}
						$counter++;
					}
					/*break the loop */
					if(($start+$counter)==($start+$limit))
					{
						break;
					}
				}
				if(count($vendor_sales)>0)
				{
					$result["success"]=true;
					$result["message"]=count($vendor_sales)." orders found!";
					$result["orders"]=$vendor_sales;
				}else{
					$result["message"]="Orders not found!";
				}
			}else{
				$result["message"]="Please login to continue!";
			}
		}else{
			$result["message"]="Authentication failed!";
		}
		return $this->json_return($result);
	}
	public function get_shipped_orders()
	{
		$result = array("success"=>false,"message"=>"","orders"=>array());
		$param = $this->input->post();
		if ($this->check_authentication()){
			if($this->is_logged_in())
			{
				$vendor_id = $param["vendor_id"];
				$this->db->order_by("sale_id","desc");
				$sales = $this->db->get('sale')->result_array();
				$vendor_sales = array();
				/*records limit */
				$default_limit = 10;
				$start=!empty($param["start"])?(is_numeric($param["start"])?$param["start"]:0):0;
				$limit=!empty($param["limit"])?(is_numeric($param["limit"])?$param["limit"]:($start+$default_limit)):($start+$default_limit);
				$counter = 0;
				foreach ($sales as $sale)
				{
					/*check status..*/
					$vendor_delivery_status = $this->get_vendor_delivery_status($vendor_id,$sale["sale_id"]);
					if($vendor_delivery_status!="shipped")
					{
						continue;
					}
					/*fetch order details..*/
					$sale_products = json_decode($sale["product_details"],true);
					$vendor_products=array();
					$vTotalPrice = 0;
					foreach ($sale_products as $product)
					{
						if(!empty($product["id"]))
						{
							$added_by = $this->db->get_where("product",array('product_id' => $product["id"]));
							if($added_by->num_rows()>0)
							{
								$added_by = json_decode($added_by->row()->added_by, true);
								if($added_by["type"]=="vendor" && $added_by["id"]==$param["vendor_id"])
								{
									array_push($vendor_products,$product);
								}
							}
						}
					}
					/*sale total*/
					foreach ($vendor_products as $vp)
					{
						$vTotalPrice+=$vp["subtotal"];
					}
					/*add sale to vendor*/
					if(count($vendor_products)>0)
					{
						if($counter>=$start && $counter<=$limit)
						{
							/*status*/
							$status = $vendor_delivery_status;
							$single_sale=array(
								"order_id"=>$sale["sale_id"]."",
								"order_no"=>$sale["sale_code"]."",
								"order_status"=>$status,
								"order_time"=>date("d/M/Y h:i",$sale["sale_datetime"])."",
								"total_items"=>count($vendor_products)."",
								"subtotal"=>$this->currency($vTotalPrice)."",
								"image"=>$vendor_products[0]["image"],
							);
							array_push($vendor_sales,$single_sale);
						}
						$counter++;
					}
					/*break the loop */
					if(($start+$counter)==($start+$limit))
					{
						break;
					}
				}
				if(count($vendor_sales)>0)
				{
					$result["success"]=true;
					$result["message"]=count($vendor_sales)." orders found!";
					$result["orders"]=$vendor_sales;
				}else{
					$result["message"]="Orders not found!";
				}
			}else{
				$result["message"]="Please login to continue!";
			}
		}else{
			$result["message"]="Authentication failed!";
		}
		return $this->json_return($result);
	}
	public function get_order_detail()
	{
		$result = array(
			'success' => false,
			"message" => "Something went wrong",
			"order_no"=>"",
			"name"=>"",
			"address"=>"",
			"phone"=>"",
			"order_status"=>"",
			"order_time"=>"",
			"my_order_product"=>array(),
			"total_products"=>"",
			"shipping"=>"0",
			"tax"=>"0",
			"discount"=>"0",
			"total"=>"0",
			"grand_total"=>"0"
		);
		$params		= $this->input->post();
		if ($this->check_authentication()) {
			/*get cart products*/
			if($this->is_logged_in())
			{
				$dbresult = $this->db->get_where("sale",array("sale_id"=>$params["order_id"]));
				if($dbresult->num_rows()>0)
				{
					$myorder = $dbresult->row_array();
					$status = $this->get_vendor_delivery_status($params["vendor_id"],$params["order_id"]);
					$address = (array)json_decode($myorder["shipping_address"]);
					$products = (array)json_decode($myorder["product_details"]);
					$orderProducts = array();
					$total=0;
					$grand_total=0;
					$tax=0;
					$shipping=0;
					$buyer_name = is_array($address)?(!empty($address["firstname"])?$address["firstname"]:"Na"):"Na";
					$buyer_phone = is_array($address)?(!empty($address["phone"])?$address["phone"]:"N/a"):"Na";
					$buyer_address = is_array($address)?(!empty($address["address1"])?$address["address1"]:"Na"):"Na";
					foreach ($products as $p)
					{
						$product_owner = json_decode($this->get_type_name_by_id("product",$p->id,"added_by"));
						if($product_owner->id==$params["vendor_id"])
						{
							$color = !empty(json_decode($p->option)->color->value)?json_decode($p->option)->color->value:"";
							$size = !empty(json_decode($p->option)->size->value)?json_decode($p->option)->size->value:"";
							$price = $p->price;//number_format($p->price,2,".",",");
							$quantity = $p->qty;
							$subtotal = $p->subtotal;//number_format($p->subtotal,2,".",",");
							$product_tax = $p->tax;//number_format($p->tax,2,".",",");
							$product_discount = $this->get_product_discount($p->id);
							/*get vendor details*/
							$added_by_id = "";
							$added_by_name = "";
							$added_by_phone = "";
							$productDetails = $this->db->get_where("product",array('product_id' => $p->id));
							if($productDetails->num_rows()>0)
							{
								$added_by = json_decode($productDetails->row()->added_by, true);
								if($added_by["type"]=="vendor")
								{
									$added_by_id = $added_by["id"];
									/*get vendor*/
									$vendor = $this->db->get_where("vendor",array("vendor_id"=>$added_by_id))->row();
									if(!empty($vendor->vendor_id))
									{
										$added_by_name = $vendor->display_name;
										$added_by_phone = $vendor->phone;
									}
								}else{

								}
							}
							$total+=($price*$quantity);
							$grand_total+=$subtotal;

							$tax+=$product_tax;
							$pr = array(
								"id"=>$p->id."",
								"name"=>$p->name."",
								"image"=>$p->image."",
								"vendor_id"=>$added_by_id."",
								"vendor_name"=>$added_by_name."",
								"vendor_phone"=>$added_by_phone."",
								"rating"=>$productDetails->row()->rating_total."",
								"color"=>$color."",
								"size"=>$size."",
								"quantity"=>$p->qty."",
								"currency"=>"PKR",
								"price"=>number_format($price,2,".",","),
								"shipping"=>number_format($this->get_shipping_cost($p->id),2,".",","),
								"tax"=>number_format($product_tax,2,".",","),
								"subtotal"=>number_format($subtotal,2,".",","),
								"save"=>number_format($product_discount,2,".",",").""
							);
							array_push($orderProducts,$pr);
						}
					}
					$result = array(
						'success' => true,
						"message" => "",
						"order_no" => $myorder["sale_code"]."",
						"name"=>$buyer_name."",
						"address"=>$buyer_address."",
						"phone"=>$buyer_phone."",
						"order_status"=>$status."",
						"order_time"=>date("Y-m-d",$myorder{"sale_datetime"}),
						"my_order_product"=>$orderProducts,
						"total_products"=>count($orderProducts)."",
						"currency"=>"PKR",
						"shipping"=>number_format($shipping,2,".",","),//$myorder["shipping"]."",
						"tax"=>number_format($tax,2,".",","),//$myorder["vat"]."",
						"discount"=>"0",
						"total"=>number_format($total,2,".",","),//$myorder["grand_total"],
						"grand_total"=>number_format($grand_total,2,".",",")//$myorder["grand_total"]
					);
				}

			}else{
				$result["message"]="please login to continue";
			}
		} else {
			$result["message"] = "Authentication failed!";
		}
		$this->json_return($result);
	}
	public function update_product1()
	{
		$result = array("success"=>false,"message"=>"");
		$param = $this->input->post();
		if ($this->check_authentication()){
			if($this->is_logged_in())
			{
				$product_id = $param["product_id"];
				/*product images*/
				$images = $_FILES;
				$images_count = !empty($images['images']['name'])?count($images['images']['name']):0;
				/*product variations*/
				$colors = !empty($param["colors"])?json_encode(explode(",",$param["colors"])):"";
				$sizes = !empty($param["colors"])?json_encode(explode(",",$param["sizes"])):"";
				/*product*/
				$product = array(
					"title"=>$param["title"],
					"product_type"=>$param["product_type"],
					"category"=>$param["category"],
					"sub_category"=>$param["sub_category"],
					"description"=>$param["description"],
					"color"=>$colors,
					"size"=>$sizes,
					"sale_price"=>$param["sale_price"],
					"brand"=>$param["brand"],
					"current_stock"=>$param["stock"],
					"unit"=>$param["unit"],
				);
				$this->db->where("product_id",$product_id);
				$this->db->update("product",$product);
				if($this->db->affected_rows()>0)
				{
					/*data inserted success*/
				}
				/*Remove old images*/
				if($images_count>0)
				{
					/*getting old images*/
					$previous_images_count = $this->get_type_name_by_id("product",$product_id,'num_of_imgs');
					/*remove old images*/
					if($previous_images_count>0)
					{
						for ($i=1;$i<=$previous_images_count;$i++)
						{
							$img_link = $_SERVER['DOCUMENT_ROOT']."/uploads/product_image/product_".$product_id."_".$i.".jpg";
							if(file_exists($img_link))
							{
								unlink( $img_link );
							}
						}
					}
				}
				/*upload new images*/
				if($images_count>0)
				{
					$this->load->library('upload');
					for ($i=0; $i<$images_count; $i++)
					{
						$_FILES['images']['name']= "product_".$product_id."_".($i+1).".jpg"; //Product_112_1_thumb.jpg ,Product_112_1.jpg
						$_FILES['images']['type']= $images['images']['type'][$i];
						$_FILES['images']['tmp_name']= $images['images']['tmp_name'][$i];
						$_FILES['images']['error']= $images['images']['error'][$i];
						$_FILES['images']['size']= $images['images']['size'][$i];

						$config['upload_path']          = $_SERVER['DOCUMENT_ROOT'].'/uploads/product_image/';
						$config['allowed_types']        = 'jpg';
//						$config['max_size']             = 10240; // in kilobyte , 1024KB =1MB
//						$config['max_width']            = 1024;
//						$config['max_height']           = 768;
						$this->upload->initialize($config);
						if ($this->upload->do_upload('images'))
						{
							/*successful upload code*/
						}
					}

					$this->db->where("product_id",$product_id);
					$this->db->update("product",array("num_of_imgs"=>$images_count));
				}
				$result["success"]=true;
				$result["message"]="Product updated!";

			}else{
				$result["message"]="Please login to continue!";
			}
		}else{
			$result["message"]="Authentication failed!";
		}
		return $this->json_return($result);
	}
	public function update_product()
	{
		$result = array("success"=>false,"message"=>"");
		$param = $this->input->post();
		if ($this->check_authentication()){
			if($this->is_logged_in())
			{
				$product_id = $param["product_id"];
				/*product images*/
				$images = $_FILES;
				$images_count = !empty($images['images']['name'])?(is_array($images['images']['name'])?count(array_filter($images['images']['name'])):0):0;
//				$images_count = count(array_filter($images['images']['name']));
				/*product variations*/
				$colors = !empty($param["colors"])?json_encode(explode(",",$param["colors"])):"";
				$rgb_colors = array();
				if(!empty($colors))
				{
					foreach (json_decode($colors) as $hex)
					{
						if(!empty($hex))
						{
							array_push($rgb_colors,$this->hexToRGB($hex));
						}
					}
				}
				$sizes = !empty($param["colors"])?json_encode(explode(",",$param["sizes"])):"";
				/*product*/
				$product = array(
					"title"=>$param["title"],
					"product_type"=>$param["product_type"],
					"category"=>$param["category"],
					"sub_category"=>$param["sub_category"],
					"description"=>$param["description"],
					"color"=>json_encode($rgb_colors),
					"size"=>$sizes,
					"sale_price"=>$param["sale_price"],
					"brand"=>$param["brand"],
					"current_stock"=>$param["stock"],
					"unit"=>$param["unit"],
				);
				$this->db->where("product_id",$product_id);
				$this->db->update("product",$product);
				if($this->db->affected_rows()>0)
				{
					/*data inserted success*/
				}
				/*Remove old images*/
				if($images_count>0)
				{
					/*getting old images*/
					$previous_images_count = $this->get_type_name_by_id("product",$product_id,'num_of_imgs');
					/*remove old images*/
					if($previous_images_count>0)
					{
						for ($i=1;$i<=$previous_images_count;$i++)
						{
							$img_link = $_SERVER['DOCUMENT_ROOT']."/uploads/product_image/product_".$product_id."_".$i.".jpg";
							if(file_exists($img_link))
							{
								unlink( $img_link );
							}
						}
					}
				}
				/*upload new images*/
				if($images_count>0)
				{
					$this->load->library('upload');
					for ($i=0; $i<$images_count; $i++)
					{
						$_FILES['images']['name']= "product_".$product_id."_".($i+1).".jpg"; //Product_112_1_thumb.jpg ,Product_112_1.jpg
						$_FILES['images']['type']= $images['images']['type'][$i];
						$_FILES['images']['tmp_name']= $images['images']['tmp_name'][$i];
						$_FILES['images']['error']= $images['images']['error'][$i];
						$_FILES['images']['size']= $images['images']['size'][$i];

//						$config['upload_path']          = $_SERVER['DOCUMENT_ROOT'].'/uploads/product_image/';
//						$config['allowed_types']        = 'jpg';
//						$config['max_size']             = 10240; // in kilobyte , 1024KB =1MB
//						$config['max_width']            = 1024;
//						$config['max_height']           = 768;
//						$this->upload->initialize($config);
//						if ($this->upload->do_upload('images'))
//						{
//							/*successful upload code*/
//						}
						$im             = new Imagick();
						$im->readimage($_FILES['images']['tmp_name']);
						$im->setImageFormat('jpg');
						$im->writeImage($_SERVER['DOCUMENT_ROOT'].'/uploads/product_image/'."product_".$product_id."_".($i+1).".jpg");
					}

					$this->db->set("num_of_imgs",$images_count);
					$this->db->where("product_id",$product_id);
					$dbImageResult = $this->db->update("product");
				}
				$result["success"]=true;
				$result["message"]="Product updated!";

			}else{
				$result["message"]="Please login to continue!";
			}
		}else{
			$result["message"]="Authentication failed!";
		}
		return $this->json_return($result);
	}
	public function delete_product()
	{
		$result = array("success"=>false,"message"=>"");
		$param = $this->input->post();
		if ($this->check_authentication()){
			if($this->is_logged_in())
			{
				$product_id = $param["product_id"];
				if(!empty($product_id) && $product_id>0)
				{
					$this->db->where("product_id",$product_id);
					$this->db->delete('product');
					if($this->db->affected_rows()>0)
					{
						$result["success"]=true;
						$result["message"]="Product removed!";
					}else{
						$result["message"]="something went wrong!";
					}
				}
			}else{
				$result["message"]="Please login to continue!";
			}
		}else{
			$result["message"]="Authentication failed!";
		}
		return $this->json_return($result);
	}

	/*Vendor Login and Signup*/
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Vendor_model');
	}
	public function index()
	{
		$result = array("Api"=>"SouqPk Vendor API","Version"=>"1.0");
		$this->json_return($result);
	}
	public function signup()
	{
		$result = array("success"=>false,"message"=>"","vendor_id"=>"0");
		if($this->check_authentication())
		{
			$param = $this->input->post();
			$file_validation = $this->validate_vendor_signup_uploads($_FILES["nic_file"]);
			$validation = $this->validate_vendor_signup($param);
			if($validation["success"])
			{
				if($file_validation["success"])
				{
					$vendor_signup = $this->Vendor_model->add($param);
					if($vendor_signup)
					{
						$result["success"]=true;
						$result["message"]="Vendor Registration success";
						$result["vendor_id"]=$vendor_signup."";
						/*upload nic file*/
						move_uploaded_file($_FILES['nic_file']['tmp_name'], '../uploads/vendor_nic_image/vendor_nic_'.$vendor_signup.'.jpg');
					}else{
						$result["message"]="Something went wrong.";
					}
				}else{
					$result["message"]=$file_validation["message"];
				}
			}else{
				$result["message"]=$validation["message"];
			}
		}else{
			$result["message"]="Authentication failed!";
		}
		$this->json_return($result);
	}
	private function validate_vendor_signup($vendor=array())
	{
		$result = array("success"=>false,"message"=>"");
		$required_columns = array("name","store_name","email","password","number","address","delivery_cities","nic_no");
		if(!empty($vendor["email"]) && filter_var($vendor["email"], FILTER_VALIDATE_EMAIL))
		{
			$dbresult = $this->db->get_where("vendor",array("email"=>$vendor["email"]));
			if($dbresult->num_rows()>0)
			{
				$result["message"]="Email Already Exist!";
			}else{
				foreach ($required_columns as $v)
				{
					if(empty($vendor[$v]) || (is_numeric($vendor[$v]) && $vendor[$v]==0))
					{
						$result["message"]=$v." is required";
						return $result;
					}
				}
				$result["success"]=true;
			}
		}else{
			$result["message"]="email address not valid.";
		}
		return $result;
	}
	private function validate_vendor_signup_uploads($files)
	{
		$result = array("success"=>false,"message"=>"");
		$count_files = !empty($files["name"])?(is_array($files["name"])?count($files["name"]):1):0;
		if($count_files>0)
		{
			$result["success"]=true;
		}else{
			$result["message"]="please upload cnic front and back side image in one file!";
		}
		return $result;
	}
	public function login()
	{
		$result = array("success"=>false,"message"=>"","vendor_id"=>"0");
		$param = $this->input->post();
		if ($this->check_authentication()){
			$login_details = array('email' => $param["email"],'password' => sha1($param["password"]));
			$signin_data = $this->db->get_where('vendor',$login_details);
			if ($signin_data->num_rows() > 0)
			{
				$signin_data = $signin_data->row_array();
				/*update fcm token*/
				$this->fcm_update($param["fcm_token"], $signin_data["vendor_id"]);
				/*checkc is session already*/
				$last_session = $this->db->get_where("vendor_session",array("vendor_id"=>$signin_data["vendor_id"],"expired"=>0));
				if($last_session->num_rows()>0)
				{
					$this->db->where(array("vendor_id"=>$signin_data["vendor_id"],"expired"=>0));
					$this->db->update("vendor_session",array("expired"=>1));
				}
				$session = array(
					"vendor_id"=>$signin_data["vendor_id"],
					"access_token"=>$param["access_token"],
					"created_at"=>date("Y-m-d h:i:s"),
				);
				$this->db->insert('vendor_session',$session);
				if($this->db->insert_id()>0)
				{
					$result["success"]=true;
					$result["message"]="Login Success!";
					$result["vendor_id"]=$signin_data["vendor_id"]."";
				}else{
					$result["message"]="Login Failed.Session not created!";
				}
			}else{
				$result["message"]="Invalid Login Details!";
			}
		}else{
			$result["message"]="Authentication failed!";
		}
		return $this->json_return($result);
	}
	private function fcm_update($fcm,$vendor_id)
	{
		$result = false;
		if(!empty($fcm))
		{
			/*check is exists on another account*/
			$previous_account = $this->db->get_where("vendor",array("fcm_token"=>$fcm));
			if($previous_account->num_rows()>0)
			{
				$previous_account = $previous_account->result_array();
				/*clear fcm from previous accounts*/
				foreach ($previous_account as $pa)
				{
					$this->db->where("fcm_token",$fcm);
					$this->db->update("vendor",array("fcm_token"=>""));
				}
			}
			/*update fcm*/
			$this->db->where("vendor_id",$vendor_id);
			$this->db->update("vendor",array("fcm_token"=>$fcm));
		}
		return $result;
	}
	/*Vendor and Device Authentication*/
	public function authenticate()
	{
		$result = array("success"=>false,"message"=>"","access_token"=>"");
		$headers = $this->input->request_headers();
		if(empty($headers['device_id']))
		{
			$headers = $this->input->post();
		}
		if(!empty($headers['device_id']))
		{
			$device_id = $headers['device_id'];
			$device_token = $this->Vendor_model->generate_device_token($device_id);
			$result["success"] = true;
			$result["message"] = "";
			$result["access_token"] = $device_token;
		}
		$this->json_return($result);
	}
	protected function check_authentication()
	{
		$result = false;
		$headers = $this->input->request_headers();
		if(empty($headers['access_token']))
		{
			$headers = $this->input->post();
		}
		if(!empty($headers['access_token']))
		{
			$model_result = $this->Vendor_model->token_authentication($headers['access_token']);
			if($model_result){
				$result = true;
			}
		}
		return $result;
	}
	protected function is_logged_in(){
		$result = false;
		$headers = $this->input->request_headers();
		if(empty($headers['access_token']))
		{
			$headers = $this->input->post();
		}
		if(!empty($headers['access_token']) && !empty($headers["vendor_id"]))
		{
			$vendor_session = $this->db->get_where("vendor_session",array("vendor_id"=>$headers['vendor_id'],"access_token"=>$headers['access_token']));
			if($vendor_session->num_rows()>0)
			{
				$result=true;
			}
		}
		return $result;
	}
	private function limit_records($param=array())
	{
		$start=!empty($param["start"])?(is_numeric($param["start"])?$param["start"]:0):0;
		$limit=!empty($param["limit"])?(is_numeric($param["limit"])?$param["limit"]:0):0;
		$default_limit = 10;
		if($start!=0 || $limit!=0)
		{
			if ($start==0 && $limit>0)
			{
				$this->db->limit($limit);
			}elseif ($start>0 && $limit>0){
				$this->db->limit($limit,$start);
			}else
			{
				$this->db->limit($default_limit,$start);
			}
		}else{
			$this->db->limit($default_limit);
		}
	}
	private function get_vendor_sales($vendor_id=0)
	{
		$result = array();
		if($vendor_id>0)
		{
			$sales = $this->db->get('sale')->result_array();
			foreach ($sales as $sale)
			{
				$sale_products = json_decode($sale["product_details"],true);
				$vendor_products=array();
				$vTotalPrice = 0;
				foreach ($sale_products as $product)
				{
					if(!empty($product["id"]))
					{
						$added_by = $this->db->get_where("product",array('product_id' => $product["id"]));
						if($added_by->num_rows()>0)
						{
							$added_by = json_decode($added_by->row()->added_by, true);
							if($added_by["type"]=="vendor" && $added_by["id"]==$vendor_id)
							{
									array_push($vendor_products,$product);
							}
						}
					}
				}
				/*sale total*/
				foreach ($vendor_products as $vp)
				{
					$vTotalPrice+=$vp["subtotal"];
				}
				/*add sale to vendor*/
				if(count($vendor_products)>0)
				{
					$delivery_status = (array) json_decode($sale["delivery_status"]);
					$status = "";
					foreach ($delivery_status as $ds)
					{
						if(!empty($ds->vendor) && $ds->vendor==$vendor_id)
						{
							$status = $ds->status;
						}
					}
					$single_sale=array(
						"order_id"=>$sale["sale_id"]."",
						"order_no"=>$sale["sale_code"]."",
						"order_status"=>$status,
						"order_time"=>date("d/M/Y h:i",$sale["sale_datetime"])."",
						"total_items"=>count($vendor_products)."",
						"currency"=>$this->currency(),
						"subtotal"=>$vTotalPrice."",
						"grand_total"=>$vTotalPrice."",
						"image"=>$vendor_products[0]["image"],
					);
					array_push($result,$single_sale);
				}
			}
		}
		return $result;
	}
	private function get_vendor_delivery_status($vendor_id=0,$sale_id=0)
	{
		$result = "";
		if($vendor_id>0 && $sale_id>0)
		{
			$sale = $this->db->get_where("sale",array("sale_id"=>$sale_id))->row();
			if(!empty($sale->sale_id))
			{
				$status = json_decode($sale->delivery_status);
				foreach ($status as $st)
				{
					if(!empty($st->vendor))
					{
						if($st->vendor=$vendor_id)
						{
							$result = $st->status;
							break;
						}
					}
				}
			}
		}
		return $result;
	}
	private function get_product_price($product_id)
	{
		$price = $this->get_type_name_by_id('product', $product_id, 'sale_price');
		$discount = $this->get_type_name_by_id('product', $product_id, 'discount');

		$price = is_numeric($price) ? $price : 0.00;
		$discount = is_numeric($discount) ? $discount : 0.00;

		$discount_type = $this->get_type_name_by_id('product', $product_id, 'discount_type');

		$number = 0.00;
		if ($discount_type == 'amount') {
			$number = ($price - $discount);
		}
		if ($discount_type == 'percent') {
			$number = ($price - ($discount * $price / 100));
		}

		return is_numeric($number) ? number_format((float)$number, 2, '.', '') : 0.00;
	}
	private function get_shipping_cost($product_id)
	{
		$price = $this->get_type_name_by_id('product', $product_id, 'sale_price');
		$shipping = $this->get_type_name_by_id('product', $product_id, 'shipping_cost');
		$shipping_cost_type = $this->get_type_name_by_id('business_settings', '3', 'value');
		if ($shipping_cost_type == 'product_wise') {
			if ($shipping == '') {
				return 0;
			} else {
				return ($shipping);
			}
		}
		if ($shipping_cost_type == 'fixed') {
			return 0;
		}
	}
	private function get_product_tax($product_id)
	{
		$price = $this->get_type_name_by_id('product', $product_id, 'sale_price');
		$tax = $this->get_type_name_by_id('product', $product_id, 'tax');
		$tax_type = $this->get_type_name_by_id('product', $product_id, 'tax_type');
		if ($tax_type == 'amount') {
			if ($tax == '') {
				return 0;
			} else {
				return $tax;
			}
		}
		if ($tax_type == 'percent') {
			if ($tax == '') {
				$tax = 0;
			}
			return ($tax * $price / 100);
		}
	}
	private function get_product_discount($product_id)
	{
		$price = $this->get_type_name_by_id('product', $product_id, 'sale_price');
		$discount = $this->get_type_name_by_id('product', $product_id, 'discount');

		$price = is_numeric($price) ? $price : 0.00;
		$discount = is_numeric($discount) ? $discount : 0.00;

		$discount_type = $this->get_type_name_by_id('product', $product_id, 'discount_type');

		$number = 0.00;
		if($discount>0)
		{
			if ($discount_type == 'amount') {
				$number = ($price - $discount);
			}
			if ($discount_type == 'percent') {
				$number = ($price - ($discount * $price / 100));
			}
		}

		return is_numeric($number) ? number_format((float)$number, 2, '.', '') : 0.00;
	}
	function get_type_name_by_id($type, $type_id = '', $field = 'name')
	{
		if ($type_id != '')
		{
			$l = $this->db->get_where($type, array(
				$type . '_id' => $type_id
			));
			$n = $l->num_rows();
			if ($n > 0) {
				return $l->row()->$field;
			}
		}
	}
	private function hexToRGB($hex="")
	{
		$result ="";
		if(!empty($hex))
		{
//			$hex = "#ff9900";
			list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
			$result ="rgba($r,$g,$b,1)";
		}
		return $result;
	}
	private function rgbaToHex($rgba="")
	{
		$result = "";
		$str = substr($rgba,strpos($rgba,"(")+1,(strpos($rgba,")")-strpos($rgba,"(")));
		$matches = explode(",",$str);
		$sHexValue = "";
		$count = 0;
		foreach ($matches as $m)
		{
			$count++;
			if($count<4)
			{
				$sc=dechex($m);
				if(strlen($sc)==1)
				{
					$sc = "0".$sc;
				}
				$sHexValue.=$sc;
			}
		}
//		$iRed   = (int) $matches[0];
//		$iGreen = (int) $matches[1];
//		$iBlue  = (int) $matches[2];

//		$sHexValue = dechex($iRed) . dechex($iGreen) . dechex($iBlue);
		$result = "#".$sHexValue;
		return $result;
	}
	private function convertImageToJpg()
	{
		$this->load->library('image_magician');
	}
	private function change_vendor_order_status($vendor_id,$order_id,$status,$payment_status)
	{
		/*get order status*/
		$order_status = $this->db->get_where("sale",array("sale_id"=>$order_id))->row();
		if(!empty($order_status->delivery_status))
		{
			$delivery_result = "";
			$order_delivery_status = (array)json_decode($order_status->delivery_status);
			$order_payment_status = (array)json_decode($order_status->delivery_status);
			$delivery_result = $order_delivery_status;
			$payment_result = $order_payment_status;
			foreach ($order_delivery_status as $k=>$ds)
			{
				if(isset($ds->vendor) && $ds->vendor==$vendor_id)
				{
					$delivery_result[$k]->status=$status;
				}
			}
			foreach ($order_payment_status as $k=>$ds)
			{
				if(isset($ds->vendor) && $ds->vendor==$vendor_id)
				{
					$payment_result[$k]->status=$status;
				}
			}
			$this->db->where("sale_id",$order_id);
			$this->db->update("sale",array("payment_status"=>json_encode($payment_result),"delivery_status"=>json_encode($delivery_result)));
			return true;
		}
		return false;
	}

	/*testing...*/
	public function file_upload_test()
	{
		$file =$_FILES['images'];
		$config["image_library"] = "ImageMagick";
		$config["library_path"]="/usr/bin";
		$config["source_image"]=$file['tmp_name'];
		$config["new_image"]=$file['tmp_name'].".jpg";
		$this->load->library("image_lib",$config);

		$im             = new Imagick();
		$im->readimage($file['tmp_name']);
		$im->setImageFormat('jpeg');
		$im->writeImage($_SERVER['DOCUMENT_ROOT'].'/uploads/product_image/product_100_1_0.jpeg');
	}
	private function format_number($number)
	{
		return number_format($number,2,".",",");
	}
	/*home counters*/
	private function get_vendor_total_products($vendor_id=0)
	{
		$result =0;
		if($vendor_id>0)
		{
			$added_by = array("type"=>"vendor","id"=>$vendor_id);
			$this->db->where("added_by",json_encode($added_by));
			$products = $this->db->get("product")->result_array();
			$result = count($products);
		}
		return $result;
	}
	private function get_vendor_total_sale($vendor_id=0)
	{
		$result =0;
		if($vendor_id>0)
		{
			$vendor_sales = $this->get_vendor_sales($vendor_id);
			foreach ($vendor_sales as $vendor_sale)
			{
				$result+=$vendor_sale["grand_total"];
			}
		}
		return $result;
	}
	private function get_vendor_total_orders($vendor_id=0)
	{
		$result =0;
		if($vendor_id>0)
		{
			$vendor_sales = $this->get_vendor_sales($vendor_id);
			$result = count($vendor_sales);
		}
		return $result;
	}
	private function get_vendor_delivered_orders($vendor_id=0)
	{
		$result =0;
		if($vendor_id>0)
		{
			$vendor_sales = $this->get_vendor_sales($vendor_id);
			foreach ($vendor_sales as $vendor_sale)
			{
				if($vendor_sale["order_status"]==strtolower("delivered"))
				{
					$result++;
				}
			}
		}
		return $result;
	}
	private function get_vendor_pending_orders($vendor_id=0)
	{
		$result =0;
		if($vendor_id>0)
		{
			$vendor_sales = $this->get_vendor_sales($vendor_id);
			foreach ($vendor_sales as $vendor_sale)
			{
				if($vendor_sale["order_status"]==strtolower("pending"))
				{
					$result++;
				}
			}
		}
		return $result;
	}
	private function get_vendor_shipped_orders($vendor_id=0)
	{
		$result =0;
		if($vendor_id>0)
		{
			$vendor_sales = $this->get_vendor_sales($vendor_id);
			foreach ($vendor_sales as $vendor_sale)
			{
				if($vendor_sale["order_status"]==strtolower("shipped"))
				{
					$result++;
				}
			}
		}
		return $result;
	}
}
