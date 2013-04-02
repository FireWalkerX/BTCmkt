<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends CI_Controller {

	public function index()
	{
		redirect('errors/page_not_found');
	}

	public function page_not_found()
	{
		$this->output->enable_profiler(FALSE);
		$this->lang->load('public');

		header($this->input->server('SERVER_PROTOCOL')." 404 Not Found", TRUE, 404);
		$this->load->view('errors/error_404');
	}
}


/* End of file errors.php */
/* Location: ./market/controllers/errors.php */