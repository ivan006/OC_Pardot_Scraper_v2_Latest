<?php
class Report_c extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();


	}

	public function index()
	{
		$this->load->view('partial/Header', array("title"=>"Hmmm"));
		$this->load->view('Report', array("data"=>"data"));
		$this->load->view('partial/Footer');

		// $homepage = file_get_contents('http://www.example.com/');
		// echo $homepage;
	}



}
