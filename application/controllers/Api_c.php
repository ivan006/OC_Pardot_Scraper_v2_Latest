<?php
class Api_c extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		require_once APPPATH.'libraries/'.'HTTP/Request2.php';
		require_once APPPATH.'libraries/'.'Net/URL2.php';
		require_once APPPATH.'libraries/'.'HTTP/Request2/Adapter.php';
		require_once APPPATH.'libraries/'.'HTTP/Request2/SocketWrapper.php';
		require_once APPPATH.'libraries/'.'HTTP/Request2/Response.php';
	}

	public function session_key()
	{
		header('Content-Type: application/json');


		$request = new HTTP_Request2();
		$request->setUrl('https://pi.pardot.com/api/login?format=json');
		$request->setMethod(HTTP_Request2::METHOD_POST);
		$request->setConfig(array(
			'follow_redirects' => TRUE
		));
		$request->addPostParameter(array(
			'email' => 'lisa@onecustom.co.za',
			'password' => '1On3Custom!',
			'user_key' => '97bec7bcd47cb353c3b56c5c30d3fe3d'
		));
		try {
			$response = $request->send();
			if ($response->getStatus() == 200) {
				// echo $response->getBody();

				
				echo json_encode("Success", JSON_PRETTY_PRINT);

				$result = json_decode($response->getBody(), true);
				$result = $result["api_key"];
				// echo json_encode($result, JSON_PRETTY_PRINT);
				file_put_contents(APPPATH.'flat_file_db/1_session_key.txt', $result);

			}
			else {
				echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
				$response->getReasonPhrase();
			}
		}
		catch(HTTP_Request2_Exception $e) {
			echo 'Error: ' . $e->getMessage();
		}



	}

	public function visits_query()
	{
		$session_key = file_get_contents(APPPATH.'flat_file_db/1_session_key.txt');
		// echo $this->config->item("pardot_user_key");
		// exit;
		header('Content-Type: application/json');

		if (1==1) {
			// code...
			$request = new HTTP_Request2();
			$request->setUrl('https://pi.pardot.com/api/visit/version/4/do/query?format=json&prospect_ids=36802159,36801871');
			$request->setMethod(HTTP_Request2::METHOD_GET);
			$request->setConfig(array(
				'follow_redirects' => TRUE
			));
			$request->setHeader(array(
				'Authorization' => 'Pardot api_key='.$session_key.', user_key='.$this->config->item("pardot_user_key")
				// 'Authorization' => 'Pardot api_key=97bec7bcd47cb353c3b56c5c30d3fe3d, user_key='.$session_key
			));
			try {
				$response = $request->send();
				if ($response->getStatus() == 200) {
					echo $response->getBody();
				}
				else {
					echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
					$response->getReasonPhrase();
				}
			}
			catch(HTTP_Request2_Exception $e) {
				echo 'Error: ' . $e->getMessage();
			}
		}


	}

}
