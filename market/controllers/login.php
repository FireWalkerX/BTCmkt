<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		if($this->uri->total_segments() > 1 OR $this->input->server('REQUEST_METHOD') !== 'POST' OR
			is_null($this->input->post('user')) OR is_null($this->input->post('pass')))
		{
			redirect('/');
		}

		$this->config->set_item('compress_output', FALSE);

		echo json_encode($this->user->log_in($this->input->post('user'), $this->input->post('pass')));
	}

	public function register()
	{
		if($this->uri->total_segments() > 2 OR $this->input->server('REQUEST_METHOD') !== 'POST' OR
			is_null($this->input->post('user')) OR is_null($this->input->post('email')) OR
			is_null($this->input->post('pass')))
		{
			redirect('/');
		}

		$this->config->set_item('compress_output', FALSE);

		echo json_encode($this->user->register($this->input->post('user'),
						$this->input->post('email'), $this->input->post('pass')));
	}
}


/* End of file login.php */
/* Location: ./market/controllers/login.php */