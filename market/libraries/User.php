<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User {

	private $id;
	private $username;
	private $email;
	private $last_address_change;
	private $reg_time;
	private $last_active;
	private $language;
	private $money;
	private $btc_address;

	/**
	 * Loads the current user
	 **/
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
			$this->language = $user->language;
			$this->money = unserialize($user->money);
			$this->settings = unserialize($user->settings);
			$this->money['BTC'] = $CI->bitcoin->getbalance($this->id);
			$this->btc_address = $CI->bitcoin->getaccountaddress($this->id);
		}
	}

	/**
	 * Tels if the user is logged in or not
	 *
	 * @return (bool) If the user is logged in
	 **/
	public function is_logged_in()
	{
		$CI =& get_instance();
		return (bool) $CI->session->userdata('logged_in');
	}

	/**
	 * Returns the language of the user. If the user is not logged in,
	 * returns null.
	 *
	 * @return (string) The language key of the user
	 **/
	public function get_language()
	{
		return $this->get_setting('language');
	}

	/**
	 * Returns the Bitcoin address of the user.
	 *
	 * @return (string) The address of the user
	 **/
	public function get_address()
	{
		return $this->btc_address;
	}

	/**
	 * Logs in the user
	 *
	 * @return (bool) If it has logged in
	 **/
	public function log_in($username, $password)
	{
		$CI =& get_instance();
		$db_password = sha1($password);

		$CI->db->where('username', $username);
		$CI->db->where('password', $db_password);
		$CI->db->select('id');
		$query = $CI->db->get('users');

		if ($query->num_rows() === 1)
		{
			foreach ($query->result() as $user);
			$CI->session->set_userdata('user_id', (int) $user->id);
			$CI->session->set_userdata('logged_in', TRUE);
		}

		return $query->num_rows() > 0;
	}

	/**
	 * Gets a user setting
	 *
	 * @param (string) The setting to check
	 * @return (mixed) The value of the setting, NULL if not set
	 **/
	public function get_setting($setting)
	{
		if (isset($this->settings[$setting]))
		{
			return $this->settings[$setting];
		}

		return NULL;
	}
}


/* End of file User.php */
/* Location: ./market/libraries/User.php */