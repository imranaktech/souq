<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_api extends REST_Controller {
	/*
	 * splash screen
	 * signup
	 * signup with fb/gmail
	 * login
	 * about us
	 * contact us
	 * english urdu language
	 * select delivery cities
	 * categories
	 * sub categories
	 * products (description , image ,video)
	 * vendors
	 * cod
	 * custom notes with order
	 * privacy policy
	 * terms and conditions
	 * shipping & return policy
	 * */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Api_model');
	}
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function home()
	{
		$result = array('success' => false, "message" => "Something went wrong",
			"sliders" => array(),
			"brands"=>array(),
			"featured_products"=>array(),
			"shops"=>array(),
			"products"=>array(),
			"categories"=>array());

		if ($this->check_authentication()) {
			$result["success"] = true;
			$result["message"] = "";
			$result["sliders"]				= $this->Api_model->banners(array(),"",0,3);
			$result["brands"]				= $this->Api_model->brands(array(),"",0,50);
			$result["featured_products"]	= $this->Api_model->products(array(),"",array("featured"=>"ok"),0,50);
			$result["shops"]				= $this->Api_model->vendors(array(),"",0,50);
			$result["products"]				= $this->Api_model->products(array(),"","",0,50);
			$result["categories"]			= $this->Api_model->categories(array(),"",0,50);
		} else {
			$result["message"] = "Authentication failed!";
		}
		$this->json_return($result);
	}
	/*static pages*/
	public function about_us()
	{
		$result = array('success' => false, "message" => "Something went wrong", "title" => "", "sub_title" => "", "description" => "");

		$this->json_return($result);
	}
	public function contact_us()
	{
		$result = array('success' => false, "message" => "Something went wrong", "title" => "", "sub_title" => "", "description" => "");

		$this->json_return($result);
	}
	public function privacy_policy()
	{
		$result = array('success' => false, "message" => "Something went wrong", "title" => "", "sub_title" => "", "description" => "");

		$this->json_return($result);
	}
	public function terms_and_conditions()
	{
		$result = array('success' => false, "message" => "Something went wrong", "title" => "", "sub_title" => "", "description" => "");

		$this->json_return($result);
	}
	public function shipping_return_policy()
	{
		$result = array('success' => false, "message" => "Something went wrong", "title" => "", "sub_title" => "", "description" => "");

		$this->json_return($result);
	}
	/*group data*/
	public function categories()
	{
		$result = array('success' => false, "message" => "Something went wrong", "categories" => array());
		$params		= $this->input->post();
		$keyword	= empty($params["keyword"])?"":$params["keyword"];
		$start		= empty($params["start"])?"":$params["start"];
		$limit		= empty($params["limit"])?"":$params["limit"];

		if ($this->check_authentication()) {
			$records = $this->Api_model->categories(array(),$keyword,$start,$limit);
			if(count($records)>0)
			{
				$result["success"] = true;
				$result["message"] = count($records)." records found";
				$result["categories"] = $records;
			}else{
				$result["success"] = false;
				$result["message"] = "Categories not found!";
			}
		} else {
			$result["message"] = "Authentication failed!";
		}
		$this->json_return($result);
	}
	public function subCategories()
	{
		$result = array('success' => false, "message" => "Something went wrong", "subcategories" => array());
		$params		= $this->input->post();
		$keyword	= empty($params["keyword"])?"":$params["keyword"];
		$start		= empty($params["start"])?"":$params["start"];
		$limit		= empty($params["limit"])?"":$params["limit"];
		$category_id= empty($params["category_id"])?0:$params["category_id"];

		if ($this->check_authentication()) {
			$records = $this->Api_model->subcategories(array(),array("category"=>$category_id),$keyword,$start,$limit);
			if(count($records)>0)
			{
				$result["success"] = true;
				$result["message"] = count($records)." records found";
				$result["subcategories"] = $records;
			}else{
				$result["success"] = false;
				$result["message"] = "subcategories not found!";
			}
		} else {
			$result["message"] = "Authentication failed!";
		}
		$this->json_return($result);
	}
	public function vendors()
	{
		$result = array('success' => false, "message" => "Something went wrong", "shops" => array());
		$params		= $this->input->post();
		$keyword	= empty($params["keyword"])?"":$params["keyword"];
		$start		= empty($params["start"])?"":$params["start"];
		$limit		= empty($params["limit"])?"":$params["limit"];

		if ($this->check_authentication()) {
			$records = $this->Api_model->vendors(array(),$keyword,$start,$limit);
			if(count($records)>0)
			{
				$result["success"] = true;
				$result["message"] = count($records)." records found";
				$result["shops"] = $records;
			}else{
				$result["success"] = false;
				$result["message"] = "vendors not found!";
			}
		} else {
			$result["message"] = "Authentication failed!";
		}
		$this->json_return($result);
	}
	public function brands()
	{
		$result = array('success' => false, "message" => "Something went wrong", "brands" => array());
		$params		= $this->input->post();
		$keyword	= empty($params["keyword"])?"":$params["keyword"];
		$start		= empty($params["start"])?"":$params["start"];
		$limit		= empty($params["limit"])?"":$params["limit"];

		if ($this->check_authentication()) {
			$records = $this->Api_model->brands(array(),$keyword,$start,$limit);
			if(count($records)>0)
			{
				$result["success"] = true;
				$result["message"] = count($records)." records found";
				$result["brands"] = $records;
			}else{
				$result["success"] = false;
				$result["message"] = "brands not found!";
			}
		} else {
			$result["message"] = "Authentication failed!";
		}
		$this->json_return($result);
	}
	public function products()
	{
		$result = array('success' => false, "message" => "Something went wrong", "products" => array());
		$params		= $this->input->post();
		$keyword	= empty($params["keyword"])?"":$params["keyword"];
		$start		= empty($params["start"])?"":$params["start"];
		$limit		= empty($params["limit"])?"":$params["limit"];

		if ($this->check_authentication()) {
			$records = $this->Api_model->products(array(),"",$keyword,$start,$limit);
			if(count($records)>0)
			{
				$result["success"] = true;
				$result["message"] = count($records)." records found";
				$result["products"] = $records;
			}else{
				$result["success"] = false;
				$result["message"] = "products not found!";
			}
		} else {
			$result["message"] = "Authentication failed!";
		}
		$this->json_return($result);
	}
	public function category_products()
	{
		$result = array('success' => false, "message" => "Something went wrong", "products" => array());
		$params		= $this->input->post();
		$keyword	= empty($params["keyword"])?"":$params["keyword"];
		$start		= empty($params["start"])?"":$params["start"];
		$limit		= empty($params["limit"])?"":$params["limit"];
		$category	= empty($params["category"])?0:$params["category"];

		if ($this->check_authentication()) {
			if($category>0){
				$records = $this->Api_model->products(array(),array("category"=>$category),$keyword,$start,$limit);
			}else{
				$records = array();
			}
			if(count($records)>0)
			{
				$result["success"] = true;
				$result["message"] = count($records)." records found";
				$result["products"] = $records;
			}else{
				$result["success"] = false;
				$result["message"] = "products not found!";
			}
		} else {
			$result["message"] = "Authentication failed!";
		}
		$this->json_return($result);
	}
	public function subcategory_products()
	{
		$result = array('success' => false, "message" => "Something went wrong", "products" => array());
		$params		= $this->input->post();
		$keyword	= empty($params["keyword"])?"":$params["keyword"];
		$start		= empty($params["start"])?"":$params["start"];
		$limit		= empty($params["limit"])?"":$params["limit"];
		$subcategory	= empty($params["subcategory"])?0:$params["subcategory"];

		if ($this->check_authentication()) {
			if($subcategory>0){
				$records = $this->Api_model->products(array(),$keyword,array("sub_category"=>$subcategory),$start,$limit);
			}else{
				$records = array();
			}
			if(count($records)>0)
			{
				$result["success"] = true;
				$result["message"] = count($records)." records found";
				$result["products"] = $records;
			}else{
				$result["success"] = false;
				$result["message"] = "products not found!";
			}
		} else {
			$result["message"] = "Authentication failed!";
		}
		$this->json_return($result);
	}
	public function vendor_products()
	{
		$result = array('success' => false, "message" => "Something went wrong", "products" => array());
		$params		= $this->input->post();
		$keyword	= empty($params["keyword"])?"":$params["keyword"];
		$start		= empty($params["start"])?0:$params["start"];
		$limit		= empty($params["limit"])?0:$params["limit"];
		$vendor		= empty($params["vendor_id"])?0:$params["vendor_id"];

		if ($this->check_authentication()) {
			if($vendor>0){
				$default_limit = 10;
				$limit=$start+$default_limit;
				$counter = 0;
				$records = $this->db->get("product")->result_array();
				$vendor_products = array();
				foreach ($records as $record)
				{
					$added_by = json_decode($record["added_by"]);
					$counter++;
					if($counter>=$start && $counter<=$limit)
					{
						if($added_by->type=="vendor" && $added_by->id==$vendor)
						{
							$vendor_products[]=$this->single_product_for_list($record);
						}
					}
					if(($start+$counter)==($start+$limit))
					{
						break;
					}
				}
			}else{
				$vendor_products = array();
			}
			if(count($vendor_products)>0)
			{
				$result["success"] = true;
				$result["message"] = count($vendor_products)." records found";
				$result["products"] = $vendor_products;
			}else{
				$result["success"] = false;
				$result["message"] = "products not found!";
			}
		} else {
			$result["message"] = "Authentication failed!";
		}
		$this->json_return($result);
	}
	public function category()
	{
		$result = array('success' => false, "message" => "Something went wrong", "sub_categories" => array());
		$params		= $this->input->post();
		$keyword	= empty($params["keyword"])?"":$params["keyword"];
		$start		= empty($params["start"])?"":$params["start"];
		$limit		= empty($params["limit"])?"":$params["limit"];
		$category	= empty($params["category"])?0:$params["category"];

		if ($this->check_authentication()) {
			if($category>0){
				$records = $this->Api_model->subcategories(array(),array("category"=>$category),$keyword,$start,$limit);
			}else{
				$records = array();
			}
			if(count($records)>0)
			{
				$result["success"] = true;
				$result["message"] = count($records)." records found";
				$result["sub_categories"] = $records;
			}else{
				$result["success"] = false;
				$result["message"] = "products not found!";
			}
		} else {
			$result["message"] = "Authentication failed!";
		}
		$this->json_return($result);
	}
	public function featureProducts()
	{
		$result = array('success' => false, "message" => "Something went wrong", "featured_products" => array());
		$params		= $this->input->post();
		$keyword	= empty($params["keyword"])?"":$params["keyword"];
		$start		= empty($params["start"])?"":$params["start"];
		$limit		= empty($params["limit"])?"":$params["limit"];

		if ($this->check_authentication()) {
			$records = $this->Api_model->products(array(),$keyword,array("featured"=>"ok"),$start,$limit);
			if(count($records)>0)
			{
				$result["success"] = true;
				$result["message"] = count($records)." records found";
				$result["featured_products"] = $records;
			}else{
				$result["success"] = false;
				$result["message"] = "products not found!";
			}
		} else {
			$result["message"] = "Authentication failed!";
		}
		$this->json_return($result);
	}
	public function get_cities()
	{
		$result = array('success' => false, "message" => "", "cities" => array());
		if ($this->check_authentication()) {
			$records = $this->db->get_where("ws_city",array("country_code"=>"PK"))->result_array();
			if(count($records)>0)
			{
				$result["success"] = true;
				$result["message"] = count($records)." records found";
				$cities = array_map(function ($sr){ return array("id"=>$sr["id"],"name"=>$sr["city_name"]);},$records);
				$result["cities"] = $cities;
			}else{
				$result["success"] = false;
				$result["message"] = "records not found!";
			}
		} else {
			$result["message"] = "Authentication failed!";
		}
		$this->json_return($result);
	}
	public function load_filters()
	{
		$result = array('success' => false, "message" => "", "cities" => array(),"categories"=>array());
		if ($this->check_authentication()) {
			$records = $this->db->get_where("ws_city",array("country_code"=>"PK"))->result_array();
			$records2 = $this->db->get_where("category",array("digital"=>null))->result_array();
			if(count($records)>0 || count($records2)>0)
			{
				$result["success"] = true;
				$result["message"] = count($records)." cities and ".count($records2)." categories found";
				$cities = array_map(function ($sr){ return array("id"=>$sr["id"],"name"=>$sr["city_name"]);},$records);
				$categories = array_map(function ($sr){ return array("id"=>$sr["category_id"],"name"=>$sr["category_name"]);},$records2);
				$result["cities"] = $cities;
				$result["categories"] = $categories;
			}else{
				$result["success"] = false;
				$result["message"] = "records not found!";
			}
		} else {
			$result["message"] = "Authentication failed!";
		}
		$this->json_return($result);
	}
	public function get_filter_products()
	{

	}
	public function get_city_products()
	{
		$result = array('success' => false, "message" => "Something went wrong", "city_products" => array());
		$params		= $this->input->post();
		$keyword	= empty($params["keyword"])?"":$params["keyword"];
		$start		= empty($params["start"])?"":$params["start"];
		$limit		= empty($params["limit"])?"":$params["limit"];

		if ($this->check_authentication())
		{
			$city_vendors = $this->get_city_vendors($params["city_id"]);
			if(count($city_vendors)>0)
			{
				$condition = array();
				if(count($city_vendors)>0)
				{

					foreach ($city_vendors as $city_vendor) {
						$added_by =json_encode(array("type"=>"vendor","id"=>$city_vendor)); //{"type":"vendor","id":"3"}
						$condition[]=array("added_by"=>$added_by);
					}
				}
				$counter = 0;
				$condition_string = "";
				foreach ($condition as $c)
				{
					if($counter==0)
					{
						$condition_string .="added_by=".$c["added_by"];
					}else{
						$condition_string .=" OR added_by=".$c["added_by"];
					}
					$counter++;
				}
				$records = $this->Api_model->products(array(),$keyword,array($condition_string),$start,$limit);
				if(count($records)>0)
				{
					$result["success"] = true;
					$result["message"] = count($records)." records found";
					$result["city_products"] = $records;
				}else{
					$result["success"] = false;
					$result["message"] = "products not found!";
				}
			}else{
				$result["message"] = "products not found!";
			}
		} else {
			$result["message"] = "Authentication failed!";
		}
		$this->json_return($result);
	}
	public function get_city_products1()
	{
		$result = array('success' => false, "message" => "Something went wrong", "city_products" => array());
		$params		= $this->input->post();
		$keyword	= empty($params["keyword"])?"":$params["keyword"];
		$start		= empty($params["start"])?"":$params["start"];
		$limit		= empty($params["limit"])?"":$params["limit"];

		if ($this->check_authentication())
		{
			$city_vendors = $this->get_city_vendors($params["city_id"]);
			if(count($city_vendors)>0)
			{
				$condition = array();
				if(count($city_vendors)>0)
				{

					foreach ($city_vendors as $city_vendor) {
						$added_by =json_encode(array("type"=>"vendor","id"=>$city_vendor)); //{"type":"vendor","id":"3"}
						$condition[]=array("added_by"=>$added_by);
					}
				}
				$counter = 0;
				$condition_string = "";
				foreach ($condition as $c)
				{
					if($counter==0)
					{
						$condition_string .=" added_by=".json_encode($c["added_by"]);
					}else{
						$condition_string .=" OR added_by=".json_encode($c["added_by"]);
					}
					$counter++;
				}
				$records = $this->Api_model->products(array(),$keyword,array($condition_string),$start,$limit);
				if(count($records)>0)
				{
					$result["success"] = true;
					$result["message"] = count($records)." records found";
					$result["city_products"] = $records;
				}else{
					$result["success"] = false;
					$result["message"] = "products not found!";
				}
			}else{
				$result["message"] = "products not found!";
			}
		} else {
			$result["message"] = "Authentication failed!";
		}
		$this->json_return($result);
	}
	/*user*/
	public function signup()
	{
		$result = array("success"=>false,"message"=>"");
		if($this->check_authentication())
		{
			$param = $this->input->post();
			$validation = $this->validate_user_signup($param);
			if($validation["success"])
			{
				$vendor_signup = $this->Api_model->add($param);
				if($vendor_signup)
				{
					$result["success"]=true;
					$result["message"]="User Registration success";
				}else{
					$result["message"]="Something went wrong.";
				}
			}else{
				$result["message"]=$validation["message"];
			}
		}
		$this->json_return($result);
	}
	public function verify_email()
	{
		$result = array("success"=>false,"message"=>"");
		if($this->check_authentication())
		{
			$param = $this->input->post();
			if(!empty($param["email"]) && filter_var($param["email"], FILTER_VALIDATE_EMAIL))
			{
				$dbresult = $this->db->get_where("user",array("email"=>$param["email"]));
				if($dbresult->num_rows()>0)
				{
					$result["message"]="Email Already Exist!";
				}else{
					$result["success"]=true;
					$result["message"]="Valid Email Address!";
				}
			}else{
				$result["message"]="Email Required!";
			}
		}
		$this->json_return($result);
	}
	private function validate_user_signup($user=array())
	{
		$result = array("success"=>false,"message"=>"");
		$required_columns = array("name","email","phone","password"/*,"address","country","city","state","zip_code"*/);
		if(!empty($user["email"]) && filter_var($user["email"], FILTER_VALIDATE_EMAIL))
		{
			$dbresult = $this->db->get_where("user",array("email"=>$user["email"]));
			if($dbresult->num_rows()>0)
			{
				$result["message"]="Email Already Exist!";
			}else{
				foreach ($required_columns as $v)
				{
					if(empty($user[$v]) || (is_numeric($user[$v]) && $user[$v]==0))
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
	public function login()
	{
		$result = array("success"=>false,"message"=>"");
		if($this->check_authentication())
		{
			$param = $this->input->post();
			$validation = $this->validate_user_login($param);
			if($validation["success"])
			{
				$user = $this->Api_model->login($param);
				if(count($user)>1)
				{
					$result["success"]=true;
					$result["message"]="User Login success";
				}else{
					$result["message"]="Invalid Credentials.";
				}
			}else{
				$result["message"]=$validation["message"];
			}
		}else{
			$result["message"]="token authentication failed!";
		}
		$this->json_return($result);
	}
	private function validate_user_login($user=array())
	{
		$result = array("success"=>false,"message"=>"");
		$required_columns = array("email","password");
		if(!empty($user["email"]) && filter_var($user["email"], FILTER_VALIDATE_EMAIL))
		{
			foreach ($required_columns as $v)
			{
				if(empty($user[$v]) || (is_numeric($user[$v]) && $user[$v]==0))
				{
					$result["message"]=$v." is required";
					return $result;
				}
			}
			$result["success"]=true;
		}else{
			$result["message"]="email address not valid.";
		}
		return $result;
	}
	public function check_login_status()
	{
		$result = array("success"=>false,"message"=>"");
		return $result;
	}
	public function logout()
	{
		$result = array("success"=>false,"message"=>"");
		if($this->check_authentication())
		{
			$param = $this->input->post();
			$validation = $this->validate_user_login($param);
			if($validation["success"])
			{
				$this->db->where("access_token",$param["access_token"]);
				$this->db->update("user_session",array("expired"=>1));
				if($this->db->affected_rows()>0)
				{
					$result["success"]=true;
					$result["message"]="Logged out";
				}
			}else{
				$result["message"]=$validation["message"];
			}
		}
		$this->json_return($result);
	}
	public function get_shipping_address()
	{
		$result = array(
			"success"=>false,
			"message"=>"",
			"address"=>"",
			"apartment"=>"",
			"street"=>"",
			"area"=>"",
			"nearest_landmark"=>"",
			"city"=>"",
			"state"=>"",
			"country"=>"",
			"zip_code"=>""
			);
		if($this->check_authentication())
		{
			$param = $this->input->post();
			$user = $this->db->get_where("user_session",array("access_token"=>$param["access_token"],"expired"=>0))->row();
			if(!empty($user))
			{
				$this->db->where("user_id",$user->user_id);
				$dbresult = $this->db->get("user");
				if($dbresult->num_rows()>0)
				{
					$user = $dbresult->row_array();
					$result["success"]=true;
					$result["message"]="";
					$result["address"]="".$user["address1"];
					$result["apartment"]="".$user["apartment"];
					$result["street"]="".$user["street"];
					$result["area"]="".$user["area"];
					$result["nearest_landmark"]="".$user["nearest_landmark"];
					$result["city"]="".$user["city"];
					$result["state"]="".$user["state"];
					$result["country"]="".$user["country"];
					$result["zip_code"]="".$user["zip"];
				}
			}else{
				$result["message"]="Please Login To Continue..";
			}
		}else{
			$result["message"]="authentication failed";
		}
		$this->json_return($result);
	}
	public function get_user_profile()
	{
		$result = array(
			"success"=>false,
			"message"=>"",
			"id"=>"",
			"name"=>"",
			"email"=>"",
			"phone"=>""
			);
		if($this->check_authentication())
		{
			$param = $this->input->post();
			$user = $this->db->get_where("user_session",array("access_token"=>$param["access_token"],"expired"=>0))->row();
			if(!empty($user))
			{
				$this->db->where("user_id",$user->user_id);
				$dbresult = $this->db->get("user");
				if($dbresult->num_rows()>0)
				{
					$user = $dbresult->row_array();
					$result["success"]=true;
					$result["message"]="";
					$result["id"]=$user["user_id"];
					$result["name"]=$user["username"];
					$result["email"]=$user["email"];
					$result["phone"]=$user["phone"];
				}
			}else{
				$result["message"]="Please Login To Continue..";
			}
		}else{
			$result["message"]="authentication failed";
		}
		$this->json_return($result);
	}
	public function update_shipping_address()
	{
		$result = array("success"=>false,"message"=>"");
		if($this->check_authentication())
		{
			$param = $this->input->post();
			if(true)
			{
				$user = $this->db->get_where("user_session",array("access_token"=>$param["access_token"],"expired"=>0))->row();
				if(!empty($user))
				{
					$this->db->where("user_id",$user->user_id);
					$shipping_address = array(
						"address1"=>$param["address"],
						"apartment"=>$param["apartment"],
						"street"=>$param["street"],
						"area"=>$param["area"],
						"nearest_landmark"=>$param["nearest_landmark"],
						"city"=>$param["city"],
						"state"=>$param["state"],
						"country"=>$param["country"],
						"zip"=>$param["zip_code"]
					);
					$this->db->update("user",$shipping_address);
					if($this->db->affected_rows()>0)
					{
						$result["success"]=true;
						$result["message"]="Address Updated!";
					}
				}else{
					$result["message"]="Please Login To Continue..";
				}
			}else{
				$result["message"]="";
			}
		}else{
			$result["message"]="Authentication failed!";
		}
		$this->json_return($result);
	}
	public function update_profile()
	{
		$result = array("success"=>false,"message"=>"");
		if($this->check_authentication())
		{
			$param = $this->input->post();
			$validation = $this->validate_profile_update($param);
			if($validation["success"])
			{
				$vendor_signup = $this->Api_model->update_profile($param);
				if($vendor_signup)
				{
					$result["success"]=true;
					$result["message"]="User Profile updated!";
				}else{
					$result["message"]="Something went wrong.";
				}
			}else{
				$result["message"]=$validation["message"];
			}
		}else{
			$result["message"]="Authentication failed!";
		}
		$this->json_return($result);
	}
	private function validate_profile_update($user=array())
	{
		$result = array("success"=>false,"message"=>"");
		$required_columns = array("user_id","name","phone");
		foreach ($required_columns as $v)
		{
			if(empty($user[$v]) || (is_numeric($user[$v]) && $user[$v]==0))
			{
				$result["message"]=$v." is required";
				return $result;
			}
		}
		$result["success"]=true;
		return $result;
	}
	/*single item data*/
	public function productDetail()
	{
		$result = array('success' => false, "message" => "Something went wrong");
		$params		= $this->input->post();
		$id			= empty($params["id"])?"":$params["id"];
		if ($this->check_authentication()) {
			$record = $this->Api_model->product($id);
			$result["success"] = true;
			$result["message"] = "";
//			$result["product"] = $record;
			$result = array_merge($result,$record);
		} else {
			$result["message"] = "Authentication failed!";
		}
		$this->json_return($result);
	}
	/*Cart*/
	public function add_to_cart1()
	{
		$result = array('success' => false, "message" => "Something went wrong");
		$params		= $this->input->post();
		if ($this->check_authentication()) {
			$product_validation = $this->validate_cart_product($params);
			if($product_validation["success"]){
				$this->db->where("access_token",$params["access_token"]);
				$this->db->like(array("product"=>"\"id\":\"".$params["product_id"]."\""));
				$old_product = $this->db->get("user_cart");
				if($old_product->num_rows()>0)
				{
					$this->update_product_quantity($params);
					return;
				}else{
					if(empty($params["quantity"]) || $params["quantity"]==0)
					{
						$params["quantity"] = 1;
					}
					$product	= $this->Api_model->get_product_for_cart($params);
					if(count($product)>0)
					{
						$this->db->insert("user_cart",array("access_token"=>$params["access_token"],"product"=>json_encode($product)));
						if($this->db->insert_id()>0)
						{
							$result["success"]=true;
							$result["message"]="Product added to cart";
						}
					}else{
						$result["message"] = "Product not found";
					}
				}
			}else{
				$result["message"] = $product_validation["message"];
			}
		} else {
			$result["message"] = "Authentication failed!";
		}
		$this->json_return($result);
	}
	private function validate_cart_product($product=array())
	{
		$result = array("success"=>false,"message"=>"");
		$required_columns = array("product_id"/*,"quantity","color","size"*/);
		foreach ($required_columns as $v)
		{
			if(empty($product[$v]) || (is_numeric($product[$v]) && $product[$v]==0))
			{
				$result["message"]=$v." is required";
				return $result;
			}
		}
		/*check is product have color option*/
		$product_color = $this->get_type_name_by_id("product",$product["product_id"],"color");
		$product_size = $this->get_type_name_by_id("product",$product["product_id"],"size");
		if(!empty($product_color))
		{
			$result["message"]="Product Color is required!";
		}
		if(!empty($product_size))
		{
			$result["message"]="Product Size is required!";
		}
		$result["success"]=true;
		return $result;
	}
	private function update_product_quantity()
	{
		$result = array('success' => false, "message" => "Something went wrong");
		$params		= $this->input->post();
		if ($this->check_authentication()) {
			$product_validation = $this->validate_cart_product($params);
			if($product_validation["success"]){
				$this->db->like(array("product"=>"\"id\":\"".$params["product_id"]."\""));
				$old_product = $this->db->get("user_cart");
				if($old_product->num_rows()>0)
				{
					$old_product_dbresult = $old_product->row_array();
					$old_product = json_decode($old_product_dbresult["product"]);
					foreach ($old_product as $k=>$op)
					{
						$newProduct = (array)$op;
						if($params["quantity"]==0)
						{
							$this->db->where("id",$old_product_dbresult["id"]);
							$this->db->delete("user_cart");
							if($this->db->affected_rows()>0)
							{
								$result["success"]=true;
								$result["message"]="Product removed success";
							}
						}else{
							if(!empty($params["quantity"]))
							{
								$newProduct["qty"]=$params["quantity"];
								$product = array(
									"product_id"=>$newProduct["id"],
									"quantity"=>$params["quantity"],
									"color"=>json_decode($newProduct["option"])->color->value,
									"size"=>json_decode($newProduct["option"])->size->value,
								);
								$updatedProduct = $this->Api_model->get_product_for_cart($product);
							}
							$this->db->where("id",$old_product_dbresult["id"]);
							$this->db->update("user_cart",array("product"=>json_encode($updatedProduct)));
							if($this->db->affected_rows()>0)
							{
								$result["success"]=true;
								$result["message"]="Product quantity updated";
							}
						}
					}
				}
			}else{
				$result["message"] = $product_validation["message"];
			}
		} else {
			$result["message"] = "Authentication failed!";
		}
		$this->json_return($result);
	}
	public function update_quantity()
	{
		$result = array(
			'success' => false,
			"message" => "Something went wrong",
			"currency"=>"PKR",
			"total_products"=>"",
			"shipping"=>"0",
			"tax"=>"0",
			"discount"=>"0",
			"total"=>"0",
			"grand_total"=>"0"
		);
		$params		= $this->input->post();
		if ($this->check_authentication()) {
			$product_validation = $this->validate_cart_product($params);
			if($product_validation["success"]){
				$access_token = $params["access_token"];
				$user_id = $this->get_user_id_by_token($access_token);
				$product_id = $params["product_id"];
				$product_quantity = $params["quantity"];
				$product_color = !empty($params["color"])?$params["color"]:"";
				$product_size = !empty($params["size"])?$params["size"]:"";
				$already = $this->is_product_already_in_cart($product_id,$access_token,$user_id,$product_color,$product_size);
				if($already)
				{
					$is_update = $this->update_cart_product($product_id,$product_quantity,$product_color,$product_size,$access_token,$user_id);
					if($is_update)
					{
						$result["success"]=true;
						$result["message"]="Product quantity updated!";
					}else{
						$result["message"]="Product quantity updated!";
					}
				}else{
					$result["message"]="Product Not found in cart!";
				}
			}else{
				$result["message"] = $product_validation["message"];
			}
		} else {
			$result["message"] = "Authentication failed!";
		}
		/*calculate cart*/
		$access_token = $params["access_token"];
		if(!empty($access_token))
		{
			$user_id = $this->get_user_id_by_token($access_token);
			$cart_calculations = $this->calculate_cart($user_id);
			$result["total_products"]=$cart_calculations->products_count."";
			$result["tax"]=$cart_calculations->total_tax."";
			$result["shipping"]=$cart_calculations->total_shipping."";
			$result["total"]=$cart_calculations->total_price."";
			$result["grand_total"]=$cart_calculations->grand_total."";
		}
		$this->json_return($result);
	}
	/*product remove from cart...*/
	public function product_remove()
	{
		$result = array(
			'success' => false,
			"message" => "Something went wrong",
			"is_cart_empty"=>false,
			"currency"=>"PKR",
			"total_products"=>"",
			"shipping"=>"0",
			"tax"=>"0",
			"discount"=>"0",
			"total"=>"0",
			"grand_total"=>"0"
		);
		$params		= $this->input->post();
		if ($this->check_authentication()) {
			$product_validation = $this->validate_cart_product($params);
			if($product_validation["success"]){
				$access_token = $params["access_token"];
				$user_id = $this->get_user_id_by_token($access_token);
				$product_id = $params["product_id"];
//				$product_quantity = $params["quantity"];
				$product_color = !empty($params["color"])?$params["color"]:"";
				$product_size = !empty($params["size"])?$params["size"]:"";
				$already = $this->is_product_already_in_cart($product_id,$access_token,$user_id,$product_color,$product_size);
				if($already)
				{
					$is_update = $this->remove_cart_product($product_id,$product_color,$product_size,$access_token,$user_id);
					if($is_update)
					{
						$result["success"]=true;
						$result["message"]="Product Removed!";
						$userCart = $this->get_cart_products($access_token);
						if(count($userCart)==0)
						{
							$result["is_cart_empty"]=true;
						}
					}
				}else{
					$result["message"]="Product Not found in cart!";
				}
			}else{
				$result["message"] = $product_validation["message"];
			}
		} else {
			$result["message"] = "Authentication failed!";
		}
		/*calculate cart*/
		$access_token = $params["access_token"];
		if(!empty($access_token))
		{
			$user_id = $this->get_user_id_by_token($access_token);
			$cart_calculations = $this->calculate_cart($user_id);
			$result["total_products"]=$cart_calculations->products_count."";
			$result["tax"]=$cart_calculations->total_tax."";
			$result["shipping"]=$cart_calculations->total_shipping."";
			$result["total"]=$cart_calculations->total_price."";
			$result["grand_total"]=$cart_calculations->grand_total."";
		}
		$this->json_return($result);
	}
	public function load_order1(){
		$result = array(
			'success' => false,
			"message" => "Something went wrong",
			"name"=>"",
			"address"=>"",
			"prducts_cart"=>array(),
			"currency"=>"PKR",
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
			$userCart = $this->db->get_where("user_cart",array('access_token'=>$params["access_token"]));
			if($userCart->num_rows()>0)
			{
				$user = $this->db->get_where("user_session",array("access_token"=>$params["access_token"],"expired"=>0))->row();
				if(!empty($user->user_id))
				{
					$user_profile = $this->db->get_where("user",array("user_id"=>$user->user_id))->row();

					$cartProducts = $userCart->result_array();
					$products = array();
					$total = 0;
					$grand_total = 0;
					$tax = 0;
					$tax_type = "percent";
					$discount = 0;
					$discount_type = "percent";
					$shippingg = 0;
					foreach ($cartProducts as $cartProduct)
					{
						$product = (array) json_decode($cartProduct["product"]);
						foreach ($product as $p)
						{
							$color = !empty(json_decode($p->option)->color->value)?json_decode($p->option)->color->value:"";
							$size = !empty(json_decode($p->option)->size->value)?json_decode($p->option)->size->value:"";
							$price = number_format((float)$p->price,2,".",",");
							$subtotal = (float) $p->subtotal;
							$product_tax = number_format((float)$p->tax,2,".",",");
							$shipping=number_format((empty($p->shipping)?0:(int)$p->shipping),2,".",",");

							$total=$price;
							$grand_total += $subtotal;
							$discount+=$p->discount;
							$discount_type = $p->discount_type;
							$tax_type = $p->tax_type;

							$tax+=$product_tax;
							$pr = array(
								"id"=>$p->id,
								"name"=>$p->name,
								"image"=>$p->image,
								"rating"=>"0",
								"color"=>$color,
								"size"=>$size,
								"quantity"=>$p->qty."",
								"currency"=>"PKR",
								"price"=>$p->price."",
								"shipping"=>$p->shipping."",
								"tax"=>($p->tax_type=="percent"?$p->tax."%":"PKR ".$p->tax),
								"discount"=>($p->discount_type="percent"?$p->discount."%":"PKR ".$p->discount),
								"subtotal"=>number_format((float)$p->subtotal,2,".",","),
								"save"=>(!empty($p->discount)?($p->discount>0?$p->discount:0):0).""
							);
							array_push($products,$pr);
						}
					}
					/*for image*/
					$image = $products[0]["image"];

					$address = $user_profile->address1;
					$result["success"]=true;
					$result["message"]="";
					$result["name"]=$user_profile->username;
					$result["address"]=$address;
					$result["prducts_cart"]=$products;
					$result["currency"]="PKR";
					$result["total_products"]="".count($products);
					$result["shipping"]=$shippingg."";
					$result["tax"]=($tax_type="percent"?$tax."%":"PKR ".$tax);
					$result["discount"]=($discount_type="percent"?$discount."%":"PKR ".$discount);
					$result["total"]=$total."";
					$result["grand_total"]=$grand_total."";
				}else{
					$result["message"]="please login to continue";
				}
			}else{
				$result["message"] = "Cart is empty";
			}
		} else {
			$result["message"] = "Authentication failed!";
		}
		$this->json_return($result);
	}
	public function load_order(){
		$result = array(
			'success' => false,
			"message" => "Something went wrong",
			"name"=>"",
			"address"=>"",
			"prducts_cart"=>array(),
			"currency"=>"PKR",
			"total_products"=>"",
			"shipping"=>"0",
			"tax"=>"0",
			"discount"=>"0",
			"total"=>"0",
			"grand_total"=>"0"
		);
		$params		= $this->input->post();
		if ($this->check_authentication()){
			/*get cart products*/
			$userCart = $this->get_cart_products($params["access_token"]);
			if(count($userCart)>0)
			{
				$user = $this->db->get_where("user_session",array("access_token"=>$params["access_token"],"expired"=>0))->row();
				if(!empty($user->user_id))
				{
					$user_profile = $this->db->get_where("user",array("user_id"=>$user->user_id))->row();
					$cartProducts = $userCart;
					$products = array();
					$total = 0;
					$grand_total = 0;
					$tax = 0;
					$tax_type = $this->currency();
					$discount = 0;
					$discount_type = $this->currency();
					$shippingg = 0;

					/*fetch cart products*/
					foreach ($cartProducts as $cart_product)
					{
						$product = $this->db->get_where("product",array("product_id"=>$cart_product['product_id']))->row();
						if(!empty($product->product_id))
						{
							$image = dirname(base_url())."/uploads/product_image/product_".$product->product_id."_1".".jpg";
							$price = $this->get_product_price($product->product_id);
							$quantity = $cart_product['quantity'];
							$product_shipping = $this->get_shipping_cost($product->product_id);
							$product_tax = $this->get_product_tax($product->product_id);
							$product_discount = $this->get_product_discount($product->product_id);
							$subtotal = ($price*$quantity)+($quantity*$product_tax)+($quantity*$product_shipping);
							$pr = array(
								"id"=>$product->product_id,
								"name"=>$product->title,
								"image"=>$image,
								"rating"=>"0",
								"color"=>$cart_product['color']."",
								"size"=>$cart_product['size']."",
								"quantity"=>$cart_product['quantity']."",
								"currency"=>$this->currency(),
								"price"=>$this->get_product_price($product->product_id),
								"shipping"=>$this->get_shipping_cost($product->product_id),
								"tax"=>$this->get_product_tax($product->product_id)."",
								"discount"=>$this->get_product_discount($product->product_id),
								"subtotal"=>number_format($subtotal,2,".",","),
								"save"=>$this->get_product_discount($product->product_id)
							);
							/*vendor details*/
							$added_by = json_decode($product->added_by);
							$vendor = array("id"=>"","display_name"=>"","contact"=>"");
							if($added_by->type="vendor")
							{
								/*get vendor details*/
								$vendor["id"] = $added_by->id;
								$vendor["display_name"] = $this->get_type_name_by_id("vendor",$added_by->id,"display_name");
								$vendor["contact"] = $this->get_type_name_by_id("vendor",$added_by->id,"phone");
							}else{
								$vendor["id"] = "";
								$vendor["display_name"] = "";
								$vendor["contact"] = "";
							}
							$pr["vendor_id"]=$vendor["id"]."";
							$pr["vendor_name"]=$vendor["display_name"]."";
							$pr["vendor_contact"]=$vendor["contact"]."";
							/*vendor details end...*/
							array_push($products,$pr);
							/*calculate grand values*/
							$total+=$price*$quantity;
							$grand_total+=$subtotal;
							$tax+=$product_tax*$quantity;
							$discount+=$product_discount;
							$shippingg+=$product_shipping*$quantity;
						}
					}

					$address = $user_profile->address1;
					$result["success"]=true;
					$result["message"]="";
					$result["name"]=$user_profile->username;
					$result["address"]=$address;
					$result["prducts_cart"]=$products;
					$result["currency"]=$this->currency();
					$result["total_products"]="".count($products);
					$result["shipping"]=$shippingg."";
					$result["tax"]=number_format($tax,2,".",",")."";
					$result["discount"]=number_format($discount,2,".",",")."";
					$result["total"]=number_format($total,2,".",",")."";
					$result["grand_total"]=number_format($grand_total,2,".",",")."";
				}else{
					$result["message"]="please login to continue";
				}
			}else{
				$result["message"] = "Cart is empty";
			}
		} else {
			$result["message"] = "Authentication failed!";
		}
		$this->json_return($result);
	}
	public function checkout1()
	{
		$result = array('success' => false, "message" => "");
		$params		= $this->input->post();
		if ($this->check_authentication()) {
			/*get cart products*/
			$userCart = $this->db->get_where("user_cart",array('access_token'=>$params["access_token"]));
			if($userCart->num_rows()>0)
			{
				$user = $this->db->get_where("user_session",array("access_token"=>$params["access_token"],"expired"=>0))->row();
				$delivery_status = array (
					array (
						'vendor' => '3',
						'status' => 'pending',
						'comment' => '',
						'delivery_time' => '',
					),
					array (
						'admin' => '',
						'status' => 'pending',
						'comment' => '',
						'delivery_time' => '',
					),
				);
				if(!empty($user->user_id))
				{
					$cartProducts = $userCart->result_array();
					$products = array();
					$subtotal = 0;
					$shipping=0;
					$tax = 0;
					foreach ($cartProducts as $cartProduct)
					{
						$product = $cartProduct["product"];
//						foreach ($product as $p)
//						{
//						 $subtotal+=$p["subtotal"];
//						}
						array_push($products,$product);
					}
					$cart = array(
						"sale_code"=>rand(0,null),
						"buyer"=>$user->user_id,
						"product_details"=>json_encode($products),
						"shipping_address"=>$params["shipping_address"],
						"vat"=>$tax,
						"vat_percent"=>"",
						"shipping"=>$shipping,
						"payment_type"=>$params["payment_method"],
//						"payment_status"=>$params["payment_status"],
//						"payment_details"=>$params["payment_details"],
						"payment_timestamp"=>"",
						"grand_total"=>$subtotal,
						"sale_datetime"=>time(),
						"delivery_status"=>json_encode($delivery_status)
					);
					$this->db->insert("sale",$cart);
					if($this->db->insert_id()>0)
					{
						$this->db->where("access_token",$params["access_token"]);
						$this->db->delete("user_cart");
						if($this->db->affected_rows()>0)
						{
							$result["success"]=true;
							$result["message"]="Thank You For Your Order!";
						}
					}
				}else{
					$result["message"]="please login to continue";
				}
			}else{
				$result["message"] = "Cart is empty";
			}
		} else {
			$result["message"] = "Authentication failed!";
		}
		$this->json_return($result);
	}
	public function add_to_cart()
	{
		$result = array('success' => false, "message" => "Something went wrong");
		$params		= $this->input->post();
		if ($this->check_authentication()) {
			$product_validation = $this->validate_cart_product($params);
			if($product_validation["success"]){
				$access_token = $params["access_token"];
				$user_id = $this->get_user_id_by_token($access_token);
				$product_id = $params["product_id"];
				$product_quantity = $params["quantity"];
				$product_color = !empty($params["color"])?$params["color"]:"";
				$product_size = !empty($params["size"])?$params["size"]:"";
				$already = $this->is_product_already_in_cart($product_id,$access_token,$user_id,$product_color,$product_size);
				if($already)
				{
					$is_update = $this->update_cart_product($product_id,$product_quantity,$product_color,$product_size,$access_token,$user_id);
					if($is_update)
					{
						$result["success"]=true;
						$result["message"]="Product quantity updated!";
					}else{
						$product_quantity++;
						$this->update_cart_product($product_id,$product_quantity,$product_color,$product_size,$access_token,$user_id);
						$result["success"]=true;
						$result["message"]="Product quantity updated!";
					}
				}else{
					$is_added = $this->product_add_to_cart($product_id,$product_quantity,$product_color,$product_size,$access_token,$user_id);
					if($is_added)
					{
						$result["success"]=true;
						$result["message"]="Product added to cart!";
					}
				}
			}else{
				$result["message"] = $product_validation["message"];
			}
		} else {
			$result["message"] = "Authentication failed!";
		}
		$this->json_return($result);
	}
	public function checkout()
	{
		$result = array('success' => false, "message" => "");
		$params		= $this->input->post();
		if ($this->check_authentication()) {
//			$cart_products = array(array("id"=>"151","quantity"=>"1","color"=>"","size"=>""),array("id"=>"174","quantity"=>"1","color"=>"","size"=>""));
			$cart_products = $this->get_cart_products($params["access_token"]);
			$product_details = array();
			$total_products_shipping = 0; // total of all products shipping
			$total_products_tax=0; //total of all products tax
			$total_products_ammount = 0; // total of all products price
			$row_id = 1;
			foreach ($cart_products as $cp)
			{
				$random_row_id = bin2hex(random_bytes(10)).$row_id;
				$options = array(
					"color"=>array("title"=>"Color","value"=>$cp["color"]),
					"size"=>array("title"=>"size","value"=>$cp["size"])
				);
				$name = $this->get_type_name_by_id("product",$cp["product_id"],"title");
				$image_url = dirname(base_url())."/uploads/product_image/product_".$cp["product_id"]."_1".".jpg";;
				$quantity = $cp["quantity"];
				$price = $this->get_product_price($cp["product_id"]);
				$shipping = $this->get_shipping_cost($cp["product_id"])*$quantity;
				$tax = $this->get_product_tax($cp["product_id"])*$quantity;
				$subtotal = ($price*$quantity)+$shipping+$tax;
				$p=array(
					"id"=>$cp["product_id"],
					"qty"=>$quantity,
					"option"=>json_encode($options),
					"price"=>$price,
					"name"=>$name,
					"shipping"=>$shipping,
					"tax"=>$tax,
					"image"=>$image_url,
					"coupon"=>"",
					"rowid"=>$random_row_id,
					"subtotal"=>$subtotal,
				);
//				array_push($product_details,array($row_id=>$p));
				$product_details[$random_row_id]=$p;
				$row_id++;
				/*calculate grand values*/
				$total_products_shipping+=$shipping;
				$total_products_tax+=$tax;
				$total_products_ammount+=($price*$quantity);
			}
			$order_shipping = 0;
			$order_tax = $total_products_tax;
			$order_grand_total = $total_products_ammount+$order_tax+$order_shipping;
			/*calculate order shipping*/
			if ($this->get_type_name_by_id('business_settings', '3', 'value') == 'product_wise') {
				$order_shipping = $total_products_shipping;
			} else {
				$order_shipping = $this->get_type_name_by_id('business_settings', '2', 'value');
			}

			/*buyer info start....*/
			$buyer_id = $this->get_byer_id($params);
			$buyer_name = $this->get_type_name_by_id("user",$buyer_id,"username");
			$buyer_phone = $this->get_type_name_by_id("user",$buyer_id,"phone");
			$buyer_address = $this->get_type_name_by_id("user",$buyer_id,"address1");
			if(!empty($params["shipping_address"]))
			{
				$buyer_address = (array) json_decode($params["shipping_address"],true);
				if(!empty($buyer_address["name"]))
				{
					$buyer_name=$buyer_address["name"];
				}
				if(!empty($buyer_address["address"]))
				{
					$buyer_address=$buyer_address["address"];
				}
			}
			$shipping_address=json_encode(array("firstname"=>$buyer_name,"phone"=>$buyer_phone,"address1"=>$buyer_address));
			/*buyer info end.*/
			$order = array(
				"sale_code"=>"",
				"buyer"=>$buyer_id."",
				"product_details"=>json_encode($product_details),
				"shipping_address"=>$shipping_address,
				"vat"=>$order_tax,
				"vat_percent"=>'',
				"shipping"=>$order_shipping,
				"payment_type"=>$params["payment_method"],
				"payment_status"=>"",
				"payment_details"=>"",
				"payment_timestamp"=>"",
				"grand_total"=>$order_grand_total,
				"sale_datetime"=>time(),
				"delivary_datetime"=>"",
				"delivery_status"=>"",
				"viewed"=>"",
			);
			$this->db->insert("sale",$order);
			$sale_id = $this->db->insert_id();
			$sale_code = date('Ym', $order['sale_datetime']) . $sale_id;
			/*delivery and payment status .....*/
			$delivery_status = array();
			$payment_status = array();
			$vendors = $this->vendors_in_sale($product_details);
			foreach ($vendors as $p) {
				$delivery_status[] = array('vendor' => $p, 'status' => 'pending', 'comment' => '', 'delivery_time' => '');
				$payment_status[] = array('vendor' => $p, 'status' => 'due');
			}
			if ($this->is_admin_in_sale($product_details)) {
				$delivery_status[] = array('admin' => '', 'status' => 'pending', 'comment' => '', 'delivery_time' => '');
				$payment_status[] = array('admin' => '', 'status' => 'due');
			}
			/*update order*/
			$order["sale_code"]=$sale_code;
			$order["delivery_status"]=json_encode($delivery_status);
			$order["payment_status"]=json_encode($payment_status);
			$this->db->where("sale_id",$sale_id);
			$this->db->update("sale",$order);
			if($this->db->affected_rows()>0)
			{
				$this->empty_cart($params["access_token"]);
				$result["success"]=true;
				$result["message"]="Thank You for your order!";
			}
			/*send push notification to vendors for new order*/
			/*getting vendor fcm*/
			$vendor_tokens = array();
			foreach ($vendors as $vendor_id)
			{
				$this->db->where("vendor_id",$vendor_id);
				$vendor = $this->db->get("vendor")->row();
				if(!empty($vendor->fcm_token))
				{
					$vendor_tokens[]=$vendor->fcm_token;
				}
			}
			/*sending notifications*/
			if(count($vendor_tokens)>0)
			{
				$title = "New Order";
				$message = "A new order placed on your store!";
				$image = "";
				$fcm = $vendor_tokens;
				foreach ($fcm as $f)
				{
					$this->firebase->sendPush($title,$message,$sale_id,$f);
				}
			}

		} else {
			$result["message"] = "Authentication failed!";
		}
		$this->json_return($result);
	}
	/*my orders*/
	public function myorders()
	{
		$result = array('success' => false, "message" => "Something went wrong","orders"=>array());
		$params		= $this->input->post();
		if ($this->check_authentication()) {
			/*get cart products*/
			$user = $this->db->get_where("user_session",array("access_token"=>$params["access_token"],"expired"=>0))->row();
			if(!empty($user->user_id))
			{
				$this->db->order_by("sale_id","desc");
				$dbresult = $this->db->get_where("sale",array("buyer"=>$user->user_id));
				if($dbresult->num_rows()>0)
				{
					$result["success"]=true;
					$result["message"]=$dbresult->num_rows()." Orders Found!";
					$myorders=$dbresult->result_array();
					foreach ($myorders as $myorder)
					{
						$product = (array) json_decode($myorder["product_details"]);
						$image = "not found!";
						foreach ($product as $p)
						{
							$image = !empty($p->image)?$p->image:"";
							break;
						}
						$status = $this->get_delivery_status($myorder["sale_id"]);
						$order =array(
							"id"=>$myorder["sale_id"],
							"image" => $image,
							"order_status"=>$status,
							"grand_total"=>$myorder["grand_total"],
							"order_time"=>date("Y-m-d",$myorder{"sale_datetime"}),
							"currency"=>"PKR"
						);
						array_push($result["orders"],$order);
					}
				}else{
					$result["message"]="Orders not found!";
				}
			}else{
				$result["message"]="please login to continue";
			}
		} else {
			$result["message"] = "Authentication failed!";
		}
		$this->json_return($result);
	}
	public function order_detail()
	{
		$result = array(
			'success' => false,
			"message" => "Something went wrong",
			"name"=>"",
			"address"=>"",
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
			$user = $this->db->get_where("user_session",array("access_token"=>$params["access_token"],"expired"=>0))->row();
			if(!empty($user->user_id) && !empty($params["order_id"]))
			{
				$user_profile = $this->db->get_where("user",array("user_id"=>$user->user_id))->row();
				$dbresult = $this->db->get_where("sale",array("sale_id"=>$params["order_id"]));
				if($dbresult->num_rows()>0)
				{
					$myorder = $dbresult->row_array();
					$status = $this->get_delivery_status($params["order_id"]);

					$address = json_decode($myorder["shipping_address"]);
					$products = (array)json_decode($myorder["product_details"]);
					$orderProducts = array();
					$total=0;
					$grand_total=0;
					$tax=0;
					foreach ($products as $p)
					{
						$color = !empty(json_decode($p->option)->color->value)?json_decode($p->option)->color->value:"";
						$size = !empty(json_decode($p->option)->size->value)?json_decode($p->option)->size->value:"";
						$price = $p->price;//number_format($p->price,2,".",",");
						$quantity = $p->qty;
						$subtotal = $p->subtotal;//number_format($p->subtotal,2,".",",");
						$product_tax = $p->tax;//number_format($p->tax,2,".",",");
						$product_discount = $this->get_product_discount($p->id);

						/*vendor_details*/
						$vendorDetails = $this->get_product_vendor($p->id);
						$vendorId = $vendorDetails->vendor_id;
						$vendorName = $vendorDetails->display_name;
						$vendorPhone = $vendorDetails->phone;

						$rating=$this->get_type_name_by_id("product",$p->id,"rating_total");
						if(empty($rating)){
							$rating=0;
						}

						$total+=($price*$quantity);
						$grand_total+=$subtotal;

						$tax+=$product_tax;
						$pr = array(
							"id"=>$p->id,
							"name"=>$p->name,
							"image"=>$p->image,
							"vendor_id"=>$vendorId."",
							"vendor_name"=>$vendorName."",
							"vendor_phone"=>$vendorPhone."",
							"rating"=>$rating."",
							"color"=>$color,
							"size"=>$size,
							"quantity"=>$p->qty,
							"currency"=>"PKR",
							"price"=>number_format($this->get_product_price($p->id),2,".",","),
							"shipping"=>number_format($this->get_shipping_cost($p->id),2,".",","),
							"tax"=>number_format($product_tax,2,".",","),
							"subtotal"=>number_format($subtotal,2,".",","),
							"save"=>$price-$product_discount.""
						);
						array_push($orderProducts,$pr);
					}
					$result = array(
						'success' => true,
						"message" => "",
						"name"=>$user_profile->username,
						"address"=>$user_profile->address1,
						"order_status"=>$status,
						"order_time"=>date("Y-m-d",$myorder{"sale_datetime"}),
						"my_order_product"=>$orderProducts,
						"total_products"=>count($orderProducts),
						"currency"=>"PKR",
						"shipping"=>$this->currency(number_format($myorder["shipping"],2,".",",").""),
						"tax"=>$this->currency(number_format($myorder["vat"],2,".",",").""),
						"discount"=>"0",
						"total"=>$this->currency(number_format($myorder["grand_total"],2,".",",")),
						"grand_total"=>$this->currency(number_format($myorder["grand_total"]+$myorder["shipping"],2,".",",")),
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
	/*order calculation*/
	private function get_product_price($product_id)
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
		}else{
			$number=$price;
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
		$result = 0;
		$price = $this->get_type_name_by_id('product', $product_id, 'sale_price');
		$tax = $this->get_type_name_by_id('product', $product_id, 'tax');
		$tax_type = $this->get_type_name_by_id('product', $product_id, 'tax_type');
		if(!empty($tax) && $tax>0 && !empty($price) && $price>0)
		{
			if ($tax_type == 'amount') {
				$result = $tax;
			}
			if ($tax_type == 'percent') {
				$result = $tax * $price / 100;
			}
		}
		return $result;
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
	private function get_delivery_status($order_id)
	{
		$status = "";
		$delivery_status = json_decode($this->get_type_name_by_id('sale', $order_id, 'delivery_status'),true);
		$success_count = 0;
		$pending_count = 0;
		foreach ($delivery_status as $dev) {
			if($dev['status'] == 'delivered')
			{
				$success_count++;
			}else{
				$pending_count++;
			}
		}
		if($success_count>0){
			$status .=$success_count." delivered";
		}
		if($success_count>0 && $pending_count>0)
		{
			$status.=" and ".$pending_count." pending";
		}else{
			$status="pending";
		}
		return $status;
	}
	private function get_byer_id($params=array())
	{
		$result = 0;
		if(!empty($params["access_token"]))
		{
			$this->db->order_by("id","DESC");
			$user = $this->db->get_where("user_session",array("access_token"=>$params["access_token"],"expired"=>0))->row();
			$result=!empty($user->user_id)?$user->user_id:0;
		}
		return $result;
	}
	private function is_added_by($type, $id, $user_id, $user_type = 'vendor')
	{
		$added_by = json_decode($this->db->get_where($type, array($type . '_id' => $id))->row()->added_by, true);
		if ($user_type == 'admin') {
			$user_id = $added_by['id'];
		}
		if ($added_by['type'] == $user_type && $added_by['id'] == $user_id) {
			return true;
		} else {
			return false;
		}
	}
	private function vendors_in_sale($product_details)
	{
		$vendors = $this->db->get('vendor')->result_array();
		$return = array();
		$product_ids = array();
		foreach ($product_details as $p)
		{
			$product_ids[] = $p["id"];
		}
		foreach ($vendors as $row)
		{
			foreach ($product_ids as $pid)
			{
				if($this->is_added_by("product",$pid,$row["vendor_id"],"vendor"))
				{
					$return[]=$row["vendor_id"];
				}
			}
		}
		return $return;
	}
	private function is_admin_in_sale($product_details)
	{
		$return = array();
		$product_ids = array();
		foreach ($product_details as $p)
		{
			$product_ids[] = $p["id"];
		}
		foreach ($product_ids as $pid)
		{
			if($this->is_added_by("product",$pid,0,"admin"))
			{
				$return[]=$pid;
			}
		}
		if (empty($return)) {
			return false;
		} else {
			return $return;
		}
	}
	private function empty_cart($access_token=0)
	{
		if(!empty($access_token))
		{
			$this->db->where("access_token",$access_token);
			$this->db->delete("user_cart");
		}
	}
	private function product_add_to_cart($product_id,$quantity,$color,$size,$token,$user_id)
	{
		$result = false;
		$user_id = $user_id;
		$access_token = $token;
		$cart = array(
			"user_id"=>$user_id,
			"access_token"=>$access_token,
			"product_id"=>$product_id,
			"quantity"=>$quantity,
			"color"=>$color,
			"size"=>$size,
		);
		$this->db->insert("user_cart",$cart);
		if($this->db->insert_id()>0)
		{
			$result=true;
		}
		return $result;
	}
	private function is_product_already_in_cart($product_id,$token,$user_id,$color,$size)
	{
		$result = false;
		if(!empty($product_id) && !empty($user_id))
		{
			$this->db->where("access_token",$token);
			$this->db->where("product_id",$product_id);
			$this->db->where("color",$color);
			$this->db->where("size",$size);
			$dbresult = $this->db->get("user_cart");
			if($dbresult->num_rows()>0)
			{
				$result = true;
			}
		}
		return $result;
	}
	private function update_cart_product($product_id,$quantity,$color,$size,$token,$user_id)
	{
		$result = false;
		$user_id = $user_id;
		$access_token = $token;
		$cart = array(
			"user_id"=>$user_id,
			"access_token"=>$access_token,
			"product_id"=>$product_id,
			"quantity"=>$quantity,
			"color"=>$color,
			"size"=>$size,
		);
		$this->db->where("access_token",$access_token);
		$this->db->where("product_id",$product_id);
		$this->db->update("user_cart",array("quantity"=>$quantity));
		if($this->db->affected_rows()>0)
		{
			$result=true;
		}
		return $result;
	}
	private function remove_cart_product($product_id,$color,$size,$token,$user_id)
	{
		$result = false;
		$user_id = $user_id;
		$access_token = $token;
		$this->db->where("access_token",$access_token);
		$this->db->where("product_id",$product_id);
		$this->db->where("color",$color);
		$this->db->where("size",$size);
		$this->db->delete("user_cart");
		if($this->db->affected_rows()>0)
		{
			$result=true;
		}
		return $result;
	}
	private function get_cart_products($token)
	{
		$result = array();
		if(!empty($token))
		{
			$dbresult = $this->db->get_where("user_cart",array("access_token"=>$token))->result_array();
			foreach ($dbresult as $item) {
				$result[]=$item;
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
	private function get_user_id_by_token($token="")
	{
		$result = 0;
		if(!empty($token))
		{
			$user_session = $this->db->get_where("user_session",array("access_token"=>$token,"expired"=>0))->row();
			$result = !empty($user_session->user_id)?$user_session->user_id:0;
		}
		return $result;
	}
	private function get_city_vendors($city_id = 0)
	{
		$result = array();
		if($city_id>0)
		{
			$vendors = $this->db->get("vendor")->result_array();
			foreach ($vendors as $v)
			{
				$vendor_cities = $v["delivery_cities"];
				if(!empty($vendor_cities))
				{
					$v_cities = (array)json_decode($vendor_cities,true);
					if(in_array($city_id,$v_cities))
					{
						$result[]=$v["vendor_id"];
					}
				}
			}
		}
		return $result;
	}
	/*single product array for list*/
	private function single_product_for_list($product=array())
	{
		$result = array();
		if(count($product)>0)
		{
			$added_by = json_decode($product["added_by"]);
			$vendor = array("id"=>"","display_name"=>"","contact"=>"");
			$image = dirname(base_url())."/uploads/product_image/product_".$product["product_id"]."_1".".jpg";
			if($added_by->type="vendor")
			{
				/*get vendor details*/
				$vendor["id"] = $added_by->id;
				$vendor["display_name"] = $this->get_type_name_by_id("vendor",$added_by->id,"display_name");
				$vendor["contact"] = $this->get_type_name_by_id("vendor",$added_by->id,"phone");
			}
			$product = array(
				"id"				=>$product["product_id"],
				"name"				=>$product["title"],
				"image"				=>$image,
				"vendor_id"			=>$vendor["id"],
				"vendor_name"		=>$vendor["display_name"],
				"vendor_contact"	=>$vendor["contact"],
				"featured"			=>($product["featured"]=="ok"?true:false),
				"newprice"			=>$product["sale_price"],
				"discount"			=>$this->get_product_discount($product["product_id"]),
				"save"				=>$this->get_product_discount($product["product_id"]),
				"currency"			=>"PKR",
				"rating"			=>$product["rating_total"]
			);
			$result = $product;
		}
		return $result;
	}
	public function filter_products()
	{
		$result = array('success' => false, "message" => "Something went wrong", "products" => array());
		$params		= $this->input->post();
		$keyword	= empty($params["keyword"])?"":$params["keyword"];
		$start		= empty($params["start"])?"":$params["start"];
		$limit		= empty($params["limit"])?"":$params["limit"];
		$category	= empty($params["category"])?0:$params["category"];
		$subcategory	= empty($params["subcategory"])?0:$params["subcategory"];
		$keyword		= empty($params["keyword"])?0:$params["keyword"];
		$min_ammount	= empty($params["min_ammount"])?0:$params["min_ammount"];
		$max_ammount	= empty($params["max_ammount"])?0:$params["max_ammount"];

		/*create condition*/
		$condition =array();
		if($category>0)
		{
			$condition["category"]=$category;
		}
		if($subcategory>0)
		{
			$condition["sub_category"]=$subcategory;
		}
		if($min_ammount>0)
		{
			$condition["sale_price>="]=$min_ammount;
		}
		if($max_ammount>0)
		{
			$condition["sale_price<="]=$max_ammount;
		}
		/*create condition */
		if ($this->check_authentication()) {
			$records = $this->Api_model->products(array(),$keyword,$condition,$start,$limit);
			if(count($records)>0)
			{
				$result["success"] = true;
				$result["message"] = count($records)." records found";
				$result["products"] = $records;
			}else{
				$result["success"] = false;
				$result["message"] = "products not found!";
			}
		} else {
			$result["message"] = "Authentication failed!";
		}
		$this->json_return($result);
	}
	public function get_product_vendor($product_id)
	{
		$result = "";
		if($product_id>0)
		{
			$product = $this->db->get_where("product",array("product_id"=>$product_id))->row();
			if(!empty($product->product_id))
			{
				$added_by = json_decode($product->added_by);
				$vendor = $this->db->get_where("vendor",array("vendor_id"=>$added_by->id))->row();
				if(!empty($vendor->vendor_id))
				{
					$result = $vendor;
				}
			}
		}
		return $result;
	}
	private function calculate_cart($user_id=0)
	{
		$result = (object) array("products_count"=>0,"total_tax"=>0,"total_shipping"=>0,"total_price"=>0,"grand_total"=>0);
		if($user_id>0)
		{
			$cart = $this->db->get_where("user_cart",array("user_id"=>$user_id))->result_array();
			if(count($cart)>0)
			{
				foreach ($cart as $product)
				{
					$product_id = $product["product_id"];
					$product_quantity = $product["quantity"];
					$product_shipping = $this->get_shipping_cost($product_id);
					$product_tax	= $this->get_product_tax($product_id);
					$product_price = $this->get_product_price($product_id);

					/*calculation*/
					$result->products_count ++;
					$result->total_tax+=$product_tax*$product_quantity;
					$result->total_shipping+=$product_shipping*$product_quantity;
					$result->total_price+=$product_price*$product_quantity;
					$result->grand_total+= ($product_tax*$product_quantity)+($product_shipping*$product_quantity)+($product_price*$product_quantity);
				}
			}
		}
		return $result;
	}
	private function html_remove($content="")
	{
		$result = "";
		if(!empty($content))
		{
			$result = html_escape($content);
		}
		return $result;
	}

	/*testing...*/
	public function send_notification()
	{
		$title = "Notification Testing";
		$message = "This notification is sent from server for testing...";
		$sale_id = "1";
		$fcm = $this->input->post("fcm");
		$this->firebase->sendPush($title,$message,$sale_id,$fcm);
	}
}
