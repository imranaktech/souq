<?php
class REST_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
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
			$device_token = $this->Api_model->generate_device_token($device_id);
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
			$model_result = $this->Api_model->token_authentication($headers['access_token']);
			if($model_result){
				$result = true;
			}
		}
		return $result;
	}
	protected function json_return($data=array())
	{
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200) // Return status
			->set_output(json_encode($data));
	}
	protected function validate_signup($data=array())
	{
		$result = "";
		$signup_fields = array();
		foreach ($signup_fields as $f)
		{
			if(empty($data[$f]) || $data[$f]==0)
			{

			}
		}
		return $result;
	}

	public function currency($price="")
	{
		$result = "";
		$currency = "PKR ";
		if(empty($price))
		{
			$result=$currency;
		}else{
			$result=$currency.$price;
		}
		return $result;
	}
}
