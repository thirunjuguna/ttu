<?php

namespace ttu\Http\Controllers;

use Illuminate\Http\Request;

use Exception;

class AfrisoftAfricaSMSGateway
{
	protected $_account;
	protected $_apiKey;

	protected $_requestBody;
	protected $_requestUrl;

	protected $_responseBody;
	protected $_responseInfo;

	const SMS_URL          = 'http://afrisoftmobile.co.ke/afrisoft/sms';


	//Turn this on if you run into problems. It will print the raw HTTP response from our server
	const Debug            = false;

	const HTTP_CODE_OK      = 200;
	const HTTP_CODE_CREATED = 201;

	public function __construct($account_number_, $apiKey_)
	{
		$this->_account    = $account_number_;
		$this->_apiKey      = $apiKey_;

		$this->_requestBody = null;
		$this->_requestUrl  = null;

		$this->_responseBody = null;
		$this->_responseInfo = null;
	}


	//Messaging methods
	public function sendMessage($to_, $message_, $from_ = null, $bulkSMSMode_ = 1, Array $options_ = array())
	{
		if ( strlen($to_) == 0 || strlen($message_) == 0 ) {
			throw new Exception('Please supply both Recipient and message parameters');
		}

		$params = array(
				'account_number' => $this->_account,
				'to'       => $to_,
				'message'  => $message_,
				'apikey'  => $this->_apiKey,
				'from'  => $from_,
		);

		if ( $from_ !== null ) {
			$params['from']        = $from_;
			$params['bulkSMSMode'] = $bulkSMSMode_;
		}

		//This contains a list of parameters that can be passed in $options_ parameter
		if ( count($options_) > 0 ) {
			$allowedKeys = array (
					'enqueue',
					'keyword',
					'linkId',
					'retryDurationInHours'
			);

			//Check whether data has been passed in options_ parameter
			foreach ( $options_ as $key => $value ) {
				if ( in_array($key, $allowedKeys) && strlen($value) > 0 ) {
					$params[$key] = $value;
				} else {
					throw new Exception("Invalid key in options array: [$key]");
				}
			}
		}

		$this->_requestUrl  = self::SMS_URL;
		$this->_requestBody = http_build_query($params, '', '&');

		$this->executePOST();

		$obj=json_decode($this->_responseBody);
		if($obj != null){
			if ($obj->http_code == 200) {
				# code...
				//return $obj;
				return $this->_responseBody;
	
			}elseif ($obj->http_code == 201) {
				# code...
				//return $obj;
				return $this->_responseBody;
			}

		}
		throw new Exception($this->_responseBody);

	}



	private function executeGet ()
	{
		$ch = curl_init();
		$this->doExecute($ch);
	}

	private function executePost ()
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POSTFIELDS, $this->_requestBody);
		curl_setopt($ch, CURLOPT_POST, 1);
		$this->doExecute($ch);
	}

	private function doExecute (&$curlHandle_)
	{
		try {
			$this->setCurlOpts($curlHandle_);
			$responseBody = curl_exec($curlHandle_);
			if ($responseBody) {
				# code...
				if ( self::Debug ) {
					//echo "Full response: ". print_r($responseBody, true)."\n";
				}

				$this->_responseInfo = curl_getinfo($curlHandle_);

				$this->_responseBody = $responseBody;

				curl_close($curlHandle_);

			}else{
				$responseBody = null;
				$this->_responseBody = $responseBody;
			}

		}
		catch(Exeption $e) {
			curl_close($curlHandle_);
			throw $e;
		}
	}

	private function setCurlOpts (&$curlHandle_)
	{
		curl_setopt($curlHandle_, CURLOPT_TIMEOUT, 60);
		curl_setopt($curlHandle_, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curlHandle_, CURLOPT_URL, $this->_requestUrl);
		curl_setopt($curlHandle_, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curlHandle_, CURLOPT_HTTPHEADER, array ('Accept: application/json',
				'apikey: ' . $this->_apiKey));
	}
}


class SmsController extends Controller
{
    //
    
	
	
	public function SendSms($mobile,$message){
		
		
		// Be sure to include the file you've just downloaded
		
		
		// Specify your login credentials
		//$account_number   = 100262;
                $account_number=100132;
		//$apikey="gfqJdTQcMuJTu0XyQgHqjGZQ3oUm3RK9Y1J1Lp3nKC86sWta32rcyhSrwEEo";// "nofDQoCJLB0tDCQWnrb88PeLcBUH6bKjqQM85eHGFy190HUd0XcYChzFJkdF";
		$apikey='YIneaNszPC4iaTplnWjc5p7GBPzK87KWGZ1HCj6iM1rMKIYYt81pnZWPElqC';
		// Specify the numbers that you want to send to in a comma-separated list
		// Please ensure you include the country code (254 for Kenya in this case)
		$recipients =$mobile;
		
		// And of course we want our recipients to know what we really do
		$message    = $message;
		//$senderId = '';
			// Create a new instance of our awesome gateway class
		$gateway = new AfrisoftAfricaSMSGateway($account_number, $apikey);
		
		try
		{
			// Thats it, hit send and we'll take care of the rest.
			$results = $gateway->sendMessage($recipients, $message);
			if ( $results == null ) {
				# code...
				echo "Error occured while sending: Unable to send the request";
			}else{
				//echo $results;
			}
		
		}
		catch ( Exception $e )
		{
			echo "Encountered an error while sending: ".$e->getMessage();
		}
	}
}

