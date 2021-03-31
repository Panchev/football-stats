<?php

class Football_Api {

	public $curl_options = [];
	public $api_key = '';
	public $api_host = '';

	public function __construct() {
		$this->api_key = 'b2a481ae62msh42eee36242dab3ap13bd7cjsn1556871f49bb';
		$this->api_host = 'api-football-v1.p.rapidapi.com';

		$this->curl_options = [
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_ENCODING => "",
			CURLOPT_SSL_VERIFYHOST => false,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"x-rapidapi-host: " . $this->api_host,
				"x-rapidapi-key: " . $this->api_key
			),
		];

	}

	public function request( $url ) {
		$curl = curl_init();

		$this->curl_options[CURLOPT_URL] = $url;
		curl_setopt_array( $curl, $this->curl_options );

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ( $err ) {
			return $err;
		} else {
			return json_decode( $response );
		}
	}
}