<?php
class Database_c extends CI_Controller
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

	public function index()
	{


		$request = new HTTP_Request2();
		$request->setUrl('https://jsonplaceholder.typicode.com/posts');
		$request->setMethod(HTTP_Request2::METHOD_POST);
		$request->setConfig(array(
			'follow_redirects' => TRUE
		));
		$request->setHeader(array(
			'Content-type'=> 'application/json; charset=UTF-8',
		));
		$request->addPostParameter(array(
			'title' => 'foo',
			'body' => 'bar',
			'userId' => 1
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






		$this->load->view('partial/Header', array("title"=>"Title"));
    $this->load->view('Database', array("data"=>"data"));
    $this->load->view('partial/Footer');

	}

	public function database_api()
	{


	}

}
