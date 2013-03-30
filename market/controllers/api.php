<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function index()
	{
		if($this->uri->segment(1))
		{
			redirect('api');
		}
		//TODO
	}
}


/* End of file api.php */
/* Location: ./market/controllers/api.php */