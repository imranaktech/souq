<?php
/**
 * Created by   : Saqib Waheed.
 * User         : saqib_waheed
 * email        : saqib.a.waheed@gmail.com
 * Date         : 1/11/2020
 * Time         : 3:44 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor_model extends CI_Model
{
	/*
	 * default user name = souqpkapp
	 * default password = souqpkapp@786
	 * */
    function __construct()
    {
        parent::__construct();
    }
    public function add($vendor=array())
	{
		$result = 0;
		$record = array(
			"name"=>$vendor["name"],
			"display_name"=>$vendor["store_name"],
			"email"=>$vendor["email"],
			"password"=>sha1($vendor["password"]),
			"phone"=>$vendor["number"],
//			"company"=>$vendor["company"],
			"address1"=>$vendor["address"],
			"status"=>"approved",//approved or pending
//			"city"=>$vendor["city"],
//			"state"=>$vendor["state"],
//			"country"=>$vendor["country"],
//			"zip"=>!empty($vendor["zip_code"])?$vendor["zip_code"]:'',
			"nic_no"=>$vendor["nic_no"],
			"delivery_cities"=>$vendor["delivery_cities"],
		);
		$this->db->insert("vendor",$record);
		if($this->db->insert_id()>0)
		{
			$result=$this->db->insert_id();
		}
		return $result;
	}

    /*group items*/
	public function banners($fields=array(),$keyword="",$conditions = array(),$start=0,$limit=0)
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
	public function categories($fields=array(),$keyword="",$conditions = array(),$start=0,$limit=0)
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
	public function vendors($fields=array(),$keyword="",$conditions = array(),$start=0,$limit=0)
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
	public function brands($fields=array(),$keyword="",$conditions = array(),$start=0,$limit=0)
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
	public function products($fields=array(),$keyword="",$conditions = array(),$condition=array(),$start=0,$limit=0)
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
				$image = dirname(base_url())."/uploads/product_image/product_".$row["product_id"]."_1".".jpg";
				$product = array(
					"id"		=>$row["product_id"],
					"name"		=>$row["title"],
					"image"		=>$image,
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
					"rating"	=>$row["rating_total"]
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
				$product = array(
					"id"		=>$row["product_id"],
					"name"		=>$row["title"],
					"images"	=>$images,
					"video"		=>$row["video"],
					"type"		=>$row["product_type"],
					"category"	=>$this->get_category($row),
					"brand"		=>$this->get_brand($row),
					"featured"	=>($row["featured"]=="ok"?true:false),
					"deal"		=>($row["deal"]=="ok"?"Deal":""),
					"stock"		=>$row["current_stock"],
					"oldprice"	=>$this->get_price($row),
					"newprice"	=>$this->get_new_price($row),
					"discount"	=>$this->get_discount($row),
					"save"		=>$this->calculate_discount($row),
					"currency"	=>"PKR",
				);
				$result = $product;
			}
		}
		return $result;
	}
	/*private functions*/
	private function limit_records($start=0,$limit=0)
	{
		if($start!=0 || $limit!=0)
		{
			if ($start==0 && $limit>0)
			{
				$this->db->limit($limit);
			}elseif ($start>0 && $limit>0){
				$this->db->limit($start,$limit);
			}
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
			foreach ($conditions as $k=>$v)
			{
//				$this->db->where($k,$v);
			}
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
						array_push($result,array("image_url"=>$image));
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
				$dbresult = $this->db->get('vendor_tokens');
				if($dbresult->num_rows()==0)
				{
					$this->db->insert("vendor_tokens",array("device_id"=>$device_id,"token"=>$token));
					$stop=true;
				}
			}
		}
		return $token;
	}
	public function token_authentication($token="")
	{
		$result = false;
		$signin_data = $this->db->get_where('vendor_tokens', array('token' => $token));
		if($signin_data->num_rows()>0)
		{
			$result = true;
		}
		return $result;
	}
	/*Vendor Login / Signup*/
	public function login($email="",$password="",$fcm="")
	{
		$result = array("token"=>"","user_id"=>"");
		if(!empty($email) && !empty($password))
		{
			$signin_data = $this->db->get_where('user', array(
				'email' => $email,
				'password' => sha1($password)
			));
			if ($signin_data->num_rows() > 0) {
				$this->db->where('user_id',$signin_data->row()->user_id);
				$dbresult = $this->db->get('user_tokens');
				if($dbresult->num_rows()==0)
				{
					$result['token'] = $this->generate_user_token($signin_data->row()->user_id);
				}else{
					$result['token'] = $dbresult->row()->token;
				}
				$result['user_id'] = $signin_data->row()->user_id;
				/*update FCM */
				$this->db->update('user',array("fcm"=>$fcm),array('user_id'=>$signin_data->row()->user_id));
			}
		}
		return $result;
	}
}
