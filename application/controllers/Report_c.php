<?php
class Report_c extends CI_Controller
{
	private $CI;

	public function __construct()
	{
		parent::__construct();

		$this->CI =& get_instance();

	}

	public function index()
	{


		$this->CI->load->database();
		$query = $this->CI->db;
		$query = $query->select('id');
		$query = $query->get('prospect');
		$query = $query->result();
		$query =  array_column($query, 'id');
		// $crawl_needles =  implode(",",$query);

		// $crawl_needles =  implode(",",$query);
		// $crawl_needles =  $query;
		$crawl_needles = array_chunk($query,200);

		// header('Content-Type: application/json');
		// echo json_encode($query, JSON_PRETTY_PRINT);
		// exit;

		$this->load->view('partial/Header', array("title"=>"Pardot Crawler"));

		$this->load->view('Report', array(
			"data"=> array(
				'crawl_needles' => $crawl_needles
			)
		));
		$this->load->view('partial/Footer');

		// $homepage = file_get_contents('http://www.example.com/');
		// echo $homepage;
	}



}
