<?php
session_start();
class Common extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('myfun');
		$this->load->helper('cookie');
		date_default_timezone_set("PRC");

	}

}


?>