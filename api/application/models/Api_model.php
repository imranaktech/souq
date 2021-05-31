<?php
/**
 * Created by   : Saqib Waheed.
 * User         : saqib_waheed
 * email        : saqib.a.waheed@gmail.com
 * Date         : 1/11/2020
 * Time         : 3:44 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	public function add($vendor=array())
	{
		$result = false;
		$record = array(
			"username"=>$vendor["name"],
			"surname"=>$vendor["name"],
			"email"=>$vendor["email"],
			"phone"=>$vendor["phone"],
			"password"=>sha1($vendor["password"]),
//			"address1"=>$vendor["address"],
//			"status"=>"pending",//approved or pending
//			"city"=>$vendor["city"],
//			"state"=>$vendor["state"],
//			"country"=>$vendor["country"],
//			"zip"=>$vendor["zip_code"],
		);
		$this->db->insert("user",$record);
		if($this->db->insert_id()>0)
		{
			$result=true;
		}
		return $result;
	}
	public function update_profile($vendor=array())
	{
		$result = false;
		$record = array(
			"username"=>$vendor["name"],
			"surname"=>$vendor["name"],
			"phone"=>$vendor["phone"],
		);
		if(!empty($vendor["password"]))
		{
			$record["password"]=sha1($vendor["password"]);
		}
		$this->db->where("user_id",$vendor["user_id"]);
		$this->db->update("user",$record);
		if($this->db->affected_rows()>0)
		{
			$result=true;
		}
		return $result;
	}
	public function login($data=array())
	{
		$result = array();
		$this->db->where(array("email"=>$data["email"],"password"=>sha1($data["password"])));
		$user = $this->db->get("user");
		if($user->num_rows()==1)
		{
			$user=$user->row_array();
			$session=$this->set_login_session($user,$data["access_token"]);

			if($session)
			{
				$result=$user;
			}
		}
		return $result;
	}
	private function set_login_session($user=array(),$access_token="")
	{
		$result = false;
		if(count($user)>0 && $access_token!="")
		{
			/*checkc is session already*/
			$last_session = $this->db->get_where("user_session",array("user_id"=>$user["user_id"],"expired"=>0));
			if($last_session->num_rows()>0)
			{
				$this->db->where(array("user_id"=>$user["user_id"],"expired"=>0));
				$this->db->update("user_session",array("expired"=>1));
			}
			$session = array(
				"user_id"=>$user["user_id"],
				"access_token"=>$access_token,
				"created_at"=>date("Y-m-d h:i:s"),
			);
			$this->db->insert('user_session',$session);
			if($this->db->insert_id()>0)
			{
				$result=true;
			}
		}
		return $result;
	}
    /*group items*/
	public function banners($fields=array(),$keyword="",$start=0,$limit=0)
	{
		$result = array();
		$this->selecct_fields($fields);
		$this->limit_records($start,$limit);
		//Search category
		if(!empty($keyword))
		{
//			$this->db->like("category_name",$keyword);
		}
		$this->db->where("status", "ok");
		$this->db->where("uploaded_by", "admin");
		$dbresult = $this->db->get("slides");
		if($dbresult->num_rows()>0)
		{
			$dbresult = $dbresult->result_array();
			foreach ($dbresult as $row)
			{
				$image = dirname(base_url())."/uploads/slides_image/slides_".$row['slides_id'].".jpg";
				$slide = array(
					"id"	=>$row["slides_id"],
					"image"	=>$image,
				);
				array_push($result,$slide);
			}
		}
		return $result;
	}
	public function categories($fields=array(),$keyword="",$start=0,$limit=0)
	{
		$result = array();
		$this->selecct_fields($fields);
		$this->limit_records($start,$limit);
		//Search category
		if(!empty($keyword))
		{
			$this->db->like("category_name",$keyword);
		}
		$dbresult = $this->db->get("category");
		if($dbresult->num_rows()>0)
		{
			$dbresult = $dbresult->result_array();
			foreach ($dbresult as $row)
			{
				$image = dirname(base_url())."/uploads/category_image/".$row["banner"];
				$category = array(
					"id"	=>$row["category_id"],
					"name"	=>$row["category_name"],
					"image"	=>$image,
				);
				array_push($result,$category);
			}
		}
		return $result;
	}
	public function vendors($fields=array(),$keyword="",$start=0,$limit=0)
	{
		$result = array();
		$this->selecct_fields($fields);
		$this->limit_records($start,$limit);
		//Search category
		if(!empty($keyword))
		{
			$search_array = array('name' => $keyword, 'email' => $keyword, 'company' => $keyword, 'display_name' => $keyword, 'phone' => $keyword);
			$this->db->like($search_array);
		}
		$dbresult = $this->db->get("vendor");
		if($dbresult->num_rows()>0)
		{
			$dbresult = $dbresult->result_array();
			foreach ($dbresult as $row)
			{
				$logo = dirname(base_url())."/uploads/vendor_logo_image/logo_".$row["vendor_id"].".jpg";
				$banner = dirname(base_url())."/uploads/vendor_banner_image/banner_".$row["vendor_id"].".jpg";
				$vendor = array(
					"id"		=>$row["vendor_id"],
					"banner"	=>$banner,
					"logo"		=>$logo,
					"name"		=>$row["name"],
					"details"	=>$row["details"],
					"phone"		=>$row["phone"],
				);
				array_push($result,$vendor);
			}
		}
		return $result;
	}
	public function brands($fields=array(),$keyword="",$start=0,$limit=0)
	{
		$result = array();
		$this->selecct_fields($fields);
		$this->limit_records($start,$limit);
		//Search category
		if(!empty($keyword))
		{
			$search_array = array('name' => $keyword);
			$this->db->like($search_array);
		}
		$dbresult = $this->db->get("brand");
		if($dbresult->num_rows()>0)
		{
			$dbresult = $dbresult->result_array();
			foreach ($dbresult as $row)
			{
				$logo = dirname(base_url())."/uploads/brand_image/".$row["logo"];
				$brand = array(
					"id"		=>$row["brand_id"],
					"name"		=>$row["name"],
					"logo"		=>$logo
				);
				array_push($result,$brand);
			}
		}
		return $result;
	}
	public function products($fields=array(),$keyword="",$condition=array(),$start=0,$limit=0)
	{
		$result = array();
		$this->selecct_fields($fields);
		$this->limit_records($start,$limit);
		//Search category
		if(!empty($keyword))
		{
			$search_array = array('title' => $keyword);
			$this->db->like($search_array);
		}
		$this->db->where("status","ok");
		$this->apply_conditions($condition);
		$dbresult = $this->db->get("product");
		if($dbresult->num_rows()>0)
		{
			$dbresult = $dbresult->result_array();
			foreach ($dbresult as $row)
			{
//				$added_by = json_decode($row["added_by"]);
//				$vendor = array("id"=>"","display_name"=>"","contact"=>"");
				$image = dirname(base_url())."/uploads/product_image/product_".$row["product_id"]."_1".".jpg";
//				if($added_by->type="vendor")
//				{
//					/*get vendor details*/
//					$vendor["id"] = $added_by->id;
//					$vendor["display_name"] = $this->get_type_name_by_id("vendor",$added_by->id,"display_name");
//					$vendor["contact"] = $this->get_type_name_by_id("vendor",$added_by->id,"phone");
//				}
				$color = $this->get_product_color($row);
				$size = $this->get_product_size($row);

				$is_variable = count($color)>0?true:(count($size)>0?true:false);
				$product = array(
					"id"		=>$row["product_id"],
					"name"		=>$row["title"],
					"image"		=>$image,
//					"vendor_id"			=>$vendor["id"],
//					"vendor_name"		=>$vendor["display_name"],
//					"vendor_contact"	=>$vendor["contact"],
//					"type"		=>$row["product_type"],
//					"category"	=>$this->get_category($row),
//					"brand"		=>$this->get_brand($row),
					"featured"	=>($row["featured"]=="ok"?true:false),
//					"deal"		=>($row["deal"]=="ok"?"Deal":""),
//					"stock"		=>$row["current_stock"],
//					"oldprice"	=>$this->get_price($row),
					"newprice"	=>$row["sale_price"],
					"discount"	=>$this->get_discount($row),
					"save"		=>$this->calculate_discount($row),
					"currency"	=>"PKR",
					"rating"	=>$row["rating_total"],
					"is_variable"=>$is_variable,
				);
				array_push($result,$product);
			}
		}
		return $result;
	}
	public function subcategories($fields=array(),$condition=array(),$keyword="",$start=0,$limit=0)
	{
		$result = array();
		$this->selecct_fields($fields);
		$this->limit_records($start,$limit);
		//Search category
		if(!empty($keyword))
		{
			$search_array = array('sub_category_name' => $keyword);
			$this->db->like($search_array);
		}
		$this->apply_conditions($condition);
		$dbresult = $this->db->get("sub_category");
		if($dbresult->num_rows()>0)
		{
			$dbresult = $dbresult->result_array();
			foreach ($dbresult as $row)
			{
				$logo = dirname(base_url())."/uploads/sub_category_image/".$row["banner"];
				$brand = array(
					"id"		=>$row["sub_category_id"],
					"name"		=>$row["sub_category_name"],
					"image"		=>$logo
				);
				array_push($result,$brand);
			}
		}
		return $result;
	}
	/*single item*/
	public function product($product_id=0)
	{
		$result = "";
		if($product_id>0)
		{
			$this->apply_conditions(array("product_id"=>$product_id));
			$dbresult = $this->db->get("product");
			if($dbresult->num_rows()>0)
			{
				$row = $dbresult->row_array();
				$images = $this->get_product_images($row);
				$color = $this->get_product_color($row);
				$size = $this->get_product_size($row);

//				$is_variable = count($color)>0?true:(count($size)>0?true:false);
				$product = array(
					"id"		=>$row["product_id"],
					"name"		=>$row["title"],
					"description"=>$this->html_remove($row["description"]),
					"sliders"	=>$images,
					"video"		=>(empty($row["video"])?"":$row["video"]),
					"type"		=>$row["product_type"],
					"category"	=>$this->get_category($row),
					"brand"		=>$this->get_brand($row),
					"rating"	=>$row["rating_total"],
					"featured"	=>($row["featured"]=="ok"?true:false),
					"deal"		=>($row["deal"]=="ok"?"Deal":""),
					"stock"		=>$row["current_stock"],
					"is_color"	=>(count($color)>0?true:false),
					"color"		=>$color,
					"is_size"	=>(count($size)>0?true:false),
					"size"		=>$size,
					"oldprice"	=>$this->get_price($row),
					"newprice"	=>$this->get_new_price($row),
					"tax"		=>$this->get_product_tax($row),
					"discount"	=>$this->get_discount($row),
					"save"		=>$this->calculate_discount($row),
					"currency"	=>"PKR",
//					"is_variable"=>$is_variable,
				);
				/*vendor details*/
				$added_by = json_decode($row["added_by"]);
				$vendor = array("id"=>"","display_name"=>"","contact"=>"");
				if($added_by->type="vendor" && $this->is_logged_in())
				{
					/*get vendor details*/
					$vendor["id"] = $added_by->id;
					$vendor["display_name"] = $this->get_type_name_by_id("vendor",$added_by->id,"display_name");
					$vendor["contact"] = $this->get_type_name_by_id("vendor",$added_by->id,"phone");
				}else{
					$vendor["id"] = "";
					$vendor["display_name"] = "Login To View Vendor contact Details";
					$vendor["contact"] = "";
				}
				$product["vendor_id"]=$vendor["id"]."";
				$product["vendor_name"]=$vendor["display_name"]."";
				$product["vendor_contact"]=$vendor["contact"]."";
				/*vendor details end...*/
				$result = $product;
			}
		}
		return $result;
	}
	/*private functions*/
	private function limit_records($start=0,$limit=0)
	{
		$start=$start;
		$limit=$limit;
		$default_limit = 50;
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
	private function selecct_fields($fields=array())
	{
		if(count($fields)>0)
		{
			$this->db->select(implode(",",$fields));
		}
	}
	private function apply_conditions($conditions = array())
	{
		if(!empty($conditions) && is_array($conditions) && count($conditions)>0)
		{
			$this->db->where($conditions);
		}
	}
	/*product functions*/
	private function get_price($product=array())
	{
		$result = "0";
		if(count($product)>0)
		{
			$result = $product["sale_price"];
		}
//		$result = empty($product["unit"])?$this->currency($result):$this->currency($result)."/".$product["unit"];
		return $result;
	}
	private function get_new_price($product=array())
	{
		$result = "0";
		if(count($product)>0)
		{
			if($product["discount"]>0)
			{
				if($product["discount_type"]=="percent")
				{
					$price = $product["sale_price"]-($product["sale_price"]*($product["discount"]/100));
					$result = $price;
				}else{
					$price = $product["sale_price"]-$product["discount"];
					$result = $price;
				}
			}else{
				$result = $product["sale_price"];
			}
		}
//		$result = empty($product["unit"])?$this->currency($result):$this->currency($result)."/".$product["unit"];
		$result = number_format($result, 2, '.', ',');
		return $result;
	}
	private function calculate_discount($product=array())
	{
		$result = "0";
		if(count($product)>0)
		{
			if($product["discount"]>0)
			{
				if($product["discount_type"]=="percent")
				{
					$price = $product["sale_price"]-($product["sale_price"]*($product["discount"]/100));
					$result = $price;
				}else{
					$price = $product["sale_price"]-$product["discount"];
					$result = $price;
				}
			}
		}
		return $this->currency($result);
	}
	private function get_discount($product=array())
	{
		$result = "0";
		if(count($product)>0)
		{
			if($product["discount"]>0)
			{
				if($product["discount_type"]=="percent")
				{
					$discount = $product["discount"]."%";
					$result = $discount;
				}else{
					$discount = $this->currency($product["discount"]);
					$result = $discount;
				}
				$result.=" off";
			}
		}
		return $result;
	}
	private function currency($price=0)
	{
		$result = "0";
		if($price>0)
		{
			$dbresult = $this->db->get_where("business_settings",array("type"=>"currency"))->row();
			if(!empty($dbresult->value))
			{
				$currency_symbol = $this->db->get_where("currency_settings",array("currency_settings_id"=>$dbresult->value))->row();
				if(!empty($currency_symbol->symbol))
				{
					$result = trim($currency_symbol->symbol)." ".$price;
				}
			}
		}
		return $result;
	}
	private function get_brand($product=array())
	{
		$result = "";
		if(count($product)>0)
		{
			$this->db->select("name");
			$brand = $this->db->get_where("brand",array("brand_id"=>$product["brand"]))->row();
			if(!empty($brand->name))
			{
				$result = $brand->name;
			}
		}
		return $result;
	}
	private function get_category($product=array())
	{
		$result = "";
		if(count($product)>0)
		{
			$this->db->select("category_name");
			$category = $this->db->get_where("category",array("category_id"=>$product["category"]))->row();
			if(!empty($category->category_name))
			{
				$result = $category->category_name;
			}
		}
		return $result;
	}
	private function get_product_images($product=array())
	{
		$result = array();
		if(count($product)>0)
		{
			if($product["num_of_imgs"]>0)
			{
				for ($i=1;$i<=$product["num_of_imgs"];$i++)
					{
						$image = dirname(base_url())."/uploads/product_image/product_".$product["product_id"]."_".$i."".".jpg";
						if(file_exists("/uploads/product_image/product_".$product["product_id"]."_".$i."".".jpg"))
						{
						}
						array_push($result,array("image"=>$image));
					}
			}
			if(count($result)==0)
			{
				$image = dirname(base_url())."/uploads/product_image/default.jpg";
				array_push($result,array("image"=>$image));
			}
		}
		return $result;
	}
	private function get_product_color($product=array())
	{
		$result = array();
		if(count($product)>0)
		{
			if(!empty($product["color"]))
			{
				$color = json_decode($product["color"]);

				foreach($color as $c)
				{
					$hex = $this->rgbaToHex($c);
					array_push($result,array("color_code"=>$hex));
				}
			}
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
	private function get_product_size($product=array())
	{
		$result = array();
		if(count($product)>0)
		{
			if(!empty($product["size"]))
			{
				$size = (array)json_decode($product["size"],true);
				if(count($size)>0)
				{
					foreach ($size as $s)
					{
						array_push($result,array("size_code"=>$s));
					}
				}
			}
		}
		return $result;
	}
	private function get_product_tax($product=array())
	{
		$result = "0";
		if(count($product)>0)
		{
			if($product["tax"]>0)
			{
				if($product["tax_type"]=="percent")
				{
					$tax = $product["tax"]."%";
					$result = $tax;
				}else{
					$tax = $this->currency($product["tax"]);
					$result = $tax;
				}
			}
		}
		return $result;
	}
	/*authentication*/
	public function generate_device_token($device_id='')
	{
		$this->load->helper('string');
		$stop = false;
		$token = "";
		if(!empty($device_id))
		{
			while (!$stop)
			{
				$token = random_string("alnum",30);
				$this->db->where('token',$token);
				$dbresult = $this->db->get('device_tokens');
				if($dbresult->num_rows()==0)
				{
					$this->db->insert("device_tokens",array("device_id"=>$device_id,"token"=>$token));
					$stop=true;
				}
			}
		}
		return $token;
	}
	public function token_authentication($token="")
	{
		$result = false;
		$signin_data = $this->db->get_where('device_tokens', array('token' => $token));
		if($signin_data->num_rows()>0)
		{
			$result = true;
		}
		return $result;
	}
	/*Cart*/
	public function get_product_for_cart($product=array())
	{
		$result = array();
		if(!empty($product["product_id"]) && $product["product_id"]>0)
		{
			$dbresult = $this->db->get_where("product",array("product_id"=>$product["product_id"]));
			if($dbresult->num_rows()>0)
			{
				$dbresult = $dbresult->row_array();
				$color = !empty($product["color"])?$product["color"]:"";
				$size = !empty($product["size"])?$product["size"]:"";
				$image = dirname(base_url())."/uploads/product_image/product_".$dbresult["product_id"]."_1".".jpg";
				$price = $dbresult["sale_price"]*$product["quantity"];
				$discount = 0;
				$tax = $dbresult["tax"];
				$shipping=empty($dbresult["shipping_cost"])?0:$dbresult["shipping_cost"];
				$subTotal =$price;
				if(!empty($tax) && $tax>0)
				{
					if($dbresult["tax_type"]="percent")
					{
						$subTotal += $price*($tax/100);
					}else{
						$subTotal += $tax;
					}
				}
				if(!empty($discount) && $discount>0)
				{
					if($dbresult["discount_type"]=="percent")
					{
						$subTotal -= $price*($discount/100);
					}else{
						$subTotal -= $discount;
					}
				}
				if(!empty($discount) && $discount>0)
				{
					$subTotal += $shipping;
				}
				$p = array (
					'id' => $product["product_id"],
					'qty' => $product["quantity"],
					'option' => '{"color":{"title":"Color","value":"'.$color.'"},"size":{"title":"Size","value":"'.$size.'"}}',
					'price' => $dbresult["sale_price"],
					'name' => $dbresult["title"],
					'shipping' => "PKR ".$shipping,
					'tax' => $tax,
					'tax_type' => $dbresult["tax_type"],
					'discount' => $discount,
					'discount_type' => $dbresult["discount_type"],
					'image' => $image,
					'coupon' => $dbresult["title"],
					'rowid' => 'd09bf41544a3365a46c9077ebb5e35c3',
					'subtotal' => $subTotal,
				);
				$result[time()]=$p;
			}
		}
		return $result;
	}

	/*check login status*/
	public function is_logged_in()
	{
		$result = false;
		$access_token = $this->input->post("access_token");
		if(!empty($access_token))
		{
			$last_session = $this->db->get_where("user_session",array("access_token"=>$access_token,"expired"=>0));
			if($last_session->num_rows()>0)
			{
				$result=true;
			}
		}
		return $result;
	}
	/*script functions*/
	function get_type_name_by_id($type, $type_id = '', $field = 'name')
	{
		if ($type_id != '') {
			$l = $this->db->get_where($type, array(
				$type . '_id' => $type_id
			));
			$n = $l->num_rows();
			if ($n > 0) {
				return $l->row()->$field;
			}
		}
	}
	private function html_remove($content="")
	{
		$result = "";
		if(!empty($content))
		{
			$result = strip_tags($content);
		}
		return $result;
	}
}
