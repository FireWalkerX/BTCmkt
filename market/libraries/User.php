<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User {

	private $id;
	private $username;
	private $email;
	private $last_address_change;
	private $reg_time;
	private $last_active;
	private $money;
	private $btc_address;

	public function __construct()
	{
		$CI =& get_instance();
		$CI->load->driver('session');

		if ($this->is_logged_in())
		{
			$CI->db->where('id', $CI->session->userdata('user_id'));
			$query = $CI->db->get('users');

			foreach ($query->result() as $user);

			$this->id = (int) $user->id;
			$this->username = $user->username;
			$this->email = $user->email;
			$this->last_address_change = $user->lastAdrChange;
			$this->reg_time = (int) $user->reg_time;
			$this->last_active = (int) $user->last_active;
			$this->money = unserialize($user->money);
			$this->money['BTC'] = $CI->bitcoin->getbalance($this->id);
			$this->btc_address = $CI->bitcoin->getaccountaddress($this->id);
		}
	}

	public function is_logged_in()
	{
		$CI =& get_instance();
		return (bool) $CI->session->userdata('logged_in');
	}

	public function get_address()
	{
		return $this->btc_address;
	}
}


/* End of file User.php */
/* Location: ./market/libraries/User.php */