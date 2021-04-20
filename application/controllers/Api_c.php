<?php
class Api_c extends CI_Controller
{
	private $CI;

	public function __construct()
	{
		parent::__construct();

		require_once APPPATH.'libraries/'.'HTTP/Request2.php';
		require_once APPPATH.'libraries/'.'Net/URL2.php';
		require_once APPPATH.'libraries/'.'HTTP/Request2/Adapter.php';
		require_once APPPATH.'libraries/'.'HTTP/Request2/SocketWrapper.php';
		require_once APPPATH.'libraries/'.'HTTP/Request2/Response.php';

		$this->CI =& get_instance();
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

		$limit = 200;
		$offset = ($_GET["page"]*$limit)-$limit;

		if (1==1) {
			// code...
			$request = new HTTP_Request2();
			// 36802159,36801871
			$request->setUrl('https://pi.pardot.com/api/visit/version/4/do/query?format=json&prospect_ids='.$_GET["crawl_needles"].'&offset='.$offset);
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
					// echo $response->getBody();


					// echo json_encode("Success", JSON_PRETTY_PRINT);

					$response = json_decode($response->getBody(), true);
					// $data = json_decode($response->getBody(), true);
					// header('Content-Type: application/json');
					// echo json_encode($data, JSON_PRETTY_PRINT);
					// exit;
					$data = $response["result"]["visit"];


					// header('Content-Type: application/json');
					// echo json_encode($data, JSON_PRETTY_PRINT);
					// exit;
					//

					$visitor_page_views = array();
					foreach ($data as $key => $value) {

						if (isset($value["visitor_page_views"]["visitor_page_view"][0])) {
							// code...
							foreach ($value["visitor_page_views"]["visitor_page_view"] as $visit_key => $visit_value) {
								// code...
								$visitor_page_view_entry = $visit_value;
								$visitor_page_view_entry["visit_id"] = $value["id"];
								$visitor_page_view_entry["visitor_id"] = $value["visitor_id"];

								$visitor_page_views[] = $visitor_page_view_entry;
							}
						} else {
							// code...
							$visitor_page_view_entry = $value["visitor_page_views"]["visitor_page_view"];
							$visitor_page_view_entry["visit_id"] = $value["id"];
							$visitor_page_view_entry["visitor_id"] = $value["visitor_id"];

							$visitor_page_views[] = $visitor_page_view_entry;
						}

						unset($data[$key]["visitor_page_views"]);

					}

					$result = $this->insert_batch("visit", $data);


					// header('Content-Type: application/json');
					// echo json_encode($visitor_page_views, JSON_PRETTY_PRINT);
					// exit;
					$result = $this->insert_batch("visitor_page_view", $visitor_page_views);
					// echo json_encode($response, JSON_PRETTY_PRINT);


					header('Content-Type: application/json');
					echo json_encode($response);
					// exit;

					if (1==1) {
						// code...
					}
					// $result = $result["api_key"];
					// file_put_contents(APPPATH.'flat_file_db/1_session_key.txt', $result);
				}
				else {
					echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
					$response->getReasonPhrase();
				}
			}
			catch(HTTP_Request2_Exception $e) {
				echo 'Error: ' . $e->getMessage();
			}
		} else {
			require_once 'HTTP/Request2.php';
			$request = new HTTP_Request2();
			$request->setUrl('https://pi.pardot.com/api/visit/version/4/do/query?format=json&prospect_ids=36802159,36801871&offset=50');
			$request->setMethod(HTTP_Request2::METHOD_GET);
			$request->setConfig(array(
				'follow_redirects' => TRUE
			));
			$request->setHeader(array(
				'Authorization' => 'Pardot api_key=2b60d2be2e81659e3a99533a5e094da6, user_key=97bec7bcd47cb353c3b56c5c30d3fe3d'
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

	public function insert_batch($table, $data)
	{


		// $thing = json_encode($ajax_data, JSON_PRETTY_PRINT);
		// echo $thing;
		// exit;


		$this->CI->load->database();


		if (1==2) {
			$post = $this->CI->input->post();

			// unset($post["variables"][0]);
			$ajax_data = array();
			foreach ($post["variables"] as $key => $value) {

				$ajax_data["`".urldecode($key)."`"] = "\"".$value."\"";
			}

			$this->CI->db->_protect_identifiers=false;

			$query_result = $this->CI->db->insert("`".$table."`", $ajax_data);
			$this->CI->db->_protect_identifiers=true;

		} else {



			// $this->CI->db->_protect_identifiers=false;

			// $query_result = $this->CI->db->insert($table, $data);
			$query_result = $this->CI->db->insert_batch($table, $data);
			// $this->CI->db->_protect_identifiers=true;



			// Produces: INSERT INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date'), ('Another title', 'Another name', 'Another date')
		}

		if ($query_result) {

			$data = array('responce' => 'success', 'message' => 'Record added Successfully');
		} else {
			$data = array('responce' => 'error', 'message' => 'Failed to add record');
		}

		return $data;

	}



}
