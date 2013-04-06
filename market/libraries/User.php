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

	/**
	 * Logs the user in
	 *
	 * @return (array) With this format:
	 *			user -> (bool) if exists
	 *			pass -> (bool) if it's correct
	 **/
	public function log_in($username, $password)
	{
		$CI =& get_instance();
		$db_password = sha1($password);

		$CI->db->where('username', $username);
		$CI->db->where('password', $db_password);
		$CI->db->select('id');
		$query = $CI->db->get('users');

		$result = array();

		if ($query->num_rows() === 1)
		{
			foreach ($query->result() as $user);
			$CI->session->set_userdata('user_id', (int) $user->id);
			$CI->session->set_userdata('logged_in', TRUE);

			$result['user'] = TRUE;
			$result['pass'] = TRUE;
		}
		else
		{
			$CI->db->where('username', $username);
			$result['user'] = $CI->db->count_all_results() === 1;
			$result['pass'] = FALSE;
		}

		return $result;
	}

	/**
	 * Registers a new user
	 *
	 * @return (array) With this format:
	 *			user -> (bool) if the user is valid (it will
	 *					be valid if it is not in the database)
	 *			email -> (int) if the email is valid (int(0) if
	 *					the email is correct, int(1) if it's in use
	 *					and int(2) if the mx_check fails)
	 **/
	public function register($username, $email, $password)
	{
		$CI =& get_instance();
		$db_password = sha1($password);
		$now = now();
		$result = array();

		$domain = explode('@', $email);
		$valid_email = (bool) getmxrr($domain[1], $mxhost);

		$CI->db->where('username', $username);
		$CI->db->from('users');
		$result['user'] = $CI->db->count_all_results() === 0;

		$CI->db->where('email', $email);
		$CI->db->from('users');
		$result['email'] = $CI->db->count_all_results();

		if ($valid_email && $result['user'] && $result['email'] === 0)
		{
			$data = array(
				'username'		=> $username,
				'password'		=> $db_password,
				'email'			=> $email,
				'lastAdrChange'	=> $now,
				'reg_time'		=> $now,
				'last_active'	=> $now,
				'money'			=> 'a:0:{}',
				'settings'		=> serialize(array('language' => $CI->config->item('language')))
				);
			$query = $CI->db->insert('users', $data);

			$CI->db->select('id');
			$query = $CI->db->get('users');
			foreach ($query->result() as $user);
			$CI->bitcoin->getnewaddress($user->id);

			$CI->session->set_userdata('user_id', (int) $user->id);
			$CI->session->set_userdata('logged_in', TRUE);

			//TODO confirmation email
		}
		else
		{
			$result['email'] = ! $valid_email ? 2 : $result['email'];
		}

		return $result;
	}
}


/* End of file User.php */
/* Location: ./market/libraries/User.php */