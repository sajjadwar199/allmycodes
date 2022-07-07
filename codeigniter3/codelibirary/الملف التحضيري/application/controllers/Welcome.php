<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	 

	public function index()
	{
		$title = "العيادة الالكترونية";
		$data = [
			"title" => $title
		];
		
	 

		 $this->load->view('includes\website_header.php',$data);
		$this->load->view('welcome');
		$this->load->view("includes\website_footer.php");
    //    $this->migration->current()   ;
	}
}
