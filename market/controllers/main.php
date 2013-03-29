<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
		if($this->uri->segment(2))
		{
			redirect('/');
		}
		//TODO
	//	$this->load->view('welcome_message');

		echo "<pre>\n";
		print_r($this->bitcoin->getinfo());
		echo "</pre>";
	}
}


/* End of file main.php */
/* Location: ./application/controllers/main.php */