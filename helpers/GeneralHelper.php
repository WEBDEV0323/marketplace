<?php

use Twilio\Rest\Client;

if (!function_exists('getToken')) {
	function getToken($request) {
		if (preg_match('/Bearer\s(\S+)/', $request->header('Authorization'), $matches)) {
			return $matches[1];
		}
		return false;
	}
}
if (!function_exists('generate_token')) {
	function generate_token($user) {
		$token_params = [
			time(),
			$user->email,
			"access_token",
		];
		return base64_encode(md5(\implode("_", $token_params)));
	}
}
if (!function_exists('api_validation_error')) {
	function api_validation_error($message, $data) {
		$data = array('status' => false, 'error' => array('message' => $message, 'detail' => $data));
		return response()->json($data, 422);
	}
}
if (!function_exists('api_success')) {
	function api_success($message, $data) {
		$data = array('status' => true, 'response' => array('message' => $message, 'detail' => $data));
		return response()->json($data, 200);
	}
}
if (!function_exists('api_success1')) {
	function api_success1($message) {
		$data = array('status' => true, 'response' => array('message' => $message));
		return response()->json($data, 200);
	}
}
if (!function_exists('api_error')) {
	function api_error($message, $error_code = 500) {
		$data = array('status' => false, 'error' => array('message' => $message));
		return response()->json($data, $error_code);
	}
}
if (!function_exists('addFileOrignal')) {
	function addFileOrignal($file, $destinationPath) {

		$name = rand(9999, 99999) . '.' . $file->extension();

        \Image::make($file)->save($destinationPath . '/' . $name);

		return $name;
	}
}
if (!function_exists('addFile')) {
	function addFile($file, $path, $width = '1200', $height = '1200', $resize = true) {
		$destinationPath = $path;

		$file = $file;
		$name = rand(9999, 99999) . '.' . $file->extension();

		$background = \Image::canvas($width, $height);

		// if ($resize) {

		// 	$img = \Image::make($file)->resize($width, $height, function ($c) {
		// 		$c->aspectRatio();
		// 		$c->upsize();

		// 	});
		// } else {
		// 	$img = \Image::make($file)->fit($width, $height);
		// }

		$img = \Image::make($file)->fit($width, $height);

		$background->insert($img, 'center');
		$background->save($destinationPath . '/' . $name);

		$filePath = url('/') . '/' . $destinationPath . $name;
		return $name;
	}
}
if (!function_exists('ProductaddFile')) {
	function ProductaddFile($file, $path, $width = '1200', $height = '1200', $resize = true) {
		$destinationPath = $path;

		$file = $file;
		// $name = rand(9999, 99999) . '.' . $file->extension();
		// $background = \Image::canvas($width, $height);
		// $img = \Image::make($file)->fit($width, $height);
		// $background->insert($img, 'center');
		// $background->save($destinationPath . '/' . $name);
		// $filePath = url('/') . '/' . $destinationPath . $name;
		// return $name;
		$name = rand(9999, 99999) . '.' . $file->extension();
        \Image::make($file)->save($destinationPath . '/' . $name);
		return $name;
	}
}
if (!function_exists('get_place')) {
	function get_place($place_id) {
		$url = 'https://maps.googleapis.com/maps/api/place/details/json?place_id=' . $place_id . '&fields=geometry&key=AIzaSyA89-etKIfiHgLKrSEuwCBTGKimI6a-_aQ';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		$response = array();
		$response['http_code'] = $httpcode;
		$response['response'] = $result;
		return $response;
	}
}

function send_message($mobile_number, $message) {
	$accountSid = config('app.twilio')['TWILIO_ACCOUNT_SID'];
	$authToken = config('app.twilio')['TWILIO_AUTH_TOKEN'];
	$client = new Client($accountSid, $authToken);
	// dd($client);
	// Use the client to do fun stuff like send text messages!
	$client->messages->create(
		// the number you'd like to send the message to
		$mobile_number,
		array(
			// A Twilio phone number you purchased at twilio.com/console
			'from' => config('app.twilio')['TWILIO_PHONE'],
			// the body of the text message you'd like to send
			'body' => $message,
		)
	);
	return $client;

}

if (!function_exists('api_get_radius')) {
	function api_get_radius() {
		\Artisan::call('config:cache');
		\Artisan::call('cache:clear');
		return config('app.default_radius');
	}
}

if (!function_exists('get_image')) {
    function get_image($url, $default_img_name)
    {
        return @getimagesize($url) ? $url : url("/storage/default/$default_img_name");
    }
}