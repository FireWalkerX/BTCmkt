<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
		if($this->uri->segment(2))
		{
			redirect('/');
		}

		if ($this->user->is_logged_in())
		{
			//TODO
		}
		else
		{
			$this->load->view('public/header');
			$this->load->view('public/main');
			$this->load->view('public/footer');
		}
	}
}


/* End of file main.php */
/* Location: ./market/controllers/main.php */