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
			$this->config->set_item('compress_output', FALSE);
			echo 'Logged in<br>';

			echo 'Testing:<br>';
			var_dump($this->bitcoin->listtransactions(1));

			echo '<br><br>';
			//move(), sendfrom(), signmessage, settxfee(), validateaddress(), listunspent()
		}
		else
		{
			$this->lang->load('public');
			$this->load->helper('form');

			$data['menu'] = $this->load->view('public/menu', array(), TRUE);

			$this->load->view('public/header');
			$this->load->view('public/main', $data);
			$this->load->view('public/footer');
		}
	}
}


/* End of file main.php */
/* Location: ./market/controllers/main.php */