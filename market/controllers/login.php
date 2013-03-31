<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		if($this->uri->segment(3) OR $this->input->server('REQUEST_METHOD') !== 'POST' OR
			empty($this->input->post('user')) OR empty($this->input->post('pass')))
		{
			redirect('/');
		}

		if ($this->user->log_in($this->input->post('user'), $this->input->post('pass')))
		{
			redirect ('/');
		}
		else
		{
			echo json_encode(array('result' => FALSE));
		}
	}
}


/* End of file login.php */
/* Location: ./market/controllers/login.php */