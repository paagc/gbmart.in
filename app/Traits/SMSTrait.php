<?php
namespace App\Traits;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

trait SMSTrait 
{
	//Your authentication key
	protected static $authKey = "138130AwGxCrvxBaS58836a9c";

	//Sender ID,While using route4 sender id should be 6 characters long.
	protected static $senderId = "GBMART";

	//Define route 
	protected static $route = "4";

	//API URL
	protected static $url="https://control.msg91.com/api/sendhttp.php";

	public static function send($mobile_number, $message) {

		// For testing, comment this in production
		// $mobile_number = "7506867017";

		$postData = array(
		    'authkey' => self::$authKey,
		    'mobiles' => "91" . $mobile_number,
		    'message' => urlencode($message),
		    'sender' => self::$senderId,
		    'route' => self::$route
		);

		$client = new \GuzzleHttp\Client();
		$response = $client->post(self::$url, $postData);
		return;
	}
}