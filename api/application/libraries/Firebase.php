<?php
/**
 * Created by   : Saqib Waheed.
 * User         : saqib_waheed
 * email        : saqib.a.waheed@gmail.com
 * Date         : 5/16/2020
 * Time         : 10:26 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Firebase
{
	public function __construct()
	{
		define('FIREBASE_API_KEY', 'AAAAvqx3NVQ:APA91bEidQposqlJrmsuQAiN4lQL-Ms3lQxNUxse-FLEvX6lldRNvq48f-9W_oY9S-EEVc56ArzrlmE9vOQMl5ye_0PwU0N-giVb8akHZF6H_Ayh3aV6jTlkB_VTJBteNld-ucNtCQuX');
	}
	public function send($registration_ids, $android,$ios) {
		$fields = array(
			'to'            => $registration_ids,
			'data'          => $android,
			'notification'  => $ios,
		);
		return $this->sendPushNotification($fields);
	}
	/*
	 * for singl notification single fcm token
	 * to send multiple devices array of tokens will be used like array(token1,token2,token3)
	 * */
	public function sendPush($title,$message,$order_id,$fcm_token)
	{
		$result = false;
		$android = array(
			'order_id'  =>  $order_id,
			'title'     =>  $title,
			'body'      =>  $message,
		);
		$ios = array(
			'title'     		=>  $title,
			'body'      		=>  $message,
			'content-available' =>  1,
			'badge'             =>  1,
		);
		$is_sent = $this->send($fcm_token,$android,$ios);
		if($is_sent!=FALSE)
		{
			$result=true;
		}
		return $result;
	}
	private function sendPushNotification($fields) {

		//importing the constant files
//		require_once 'Config.php';

		//firebase server url to send the curl request
		$url = 'https://fcm.googleapis.com/fcm/send';

		//building headers for the request
		$headers = array(
			'Authorization: key=' . FIREBASE_API_KEY,
			'Content-Type: application/json'
		);

		//Initializing curl to open a connection
		$ch = curl_init();

		//Setting the curl url
		curl_setopt($ch, CURLOPT_URL, $url);

		//setting the method as post
		curl_setopt($ch, CURLOPT_POST, true);

		//adding headers
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		//disabling ssl support
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		//adding the fields in json format
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

		//finally executing the curl request
		$result = curl_exec($ch);
		if ($result === FALSE) {
			die('Curl failed: ' . curl_error($ch));
		}

		//Now close the connection
		curl_close($ch);

		//and return the result
		return $result;
	}
}
