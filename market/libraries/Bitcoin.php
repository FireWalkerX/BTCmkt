<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bitcoin {

	private $url;

	/**
	 * Creates a Bitcoin connection.
	 * @param (array) params - array containing all the parameters:
	 *		'server'	=> (string) the server to which connect
	 *		'port'		=> (int) the port to connect to
	 *		'is_ssl'	=> (bool) if it will use SSL connection
	 **/
	public function __construct()
	{
		$this->url = (config_item('server_is_ssl') ? 'https://' : 'http://').
						config_item('server_user').':'.config_item('server_pass').'@'.
						config_item('server_name').':'.config_item('server_port').'/';

		log_message('debug', 'Bitcoin connection set, with URL '.$this->url);
	}

	/**
	 * Safely copies wallet.dat to destination, which can be a directory or a path with filename.
	 *
	 * @param (string) destination - The destination for the backup.
	 **/
	public function backupwallet($destination)
	{
		return $this->connect('backupwallet', array(realpath($destination)));
	}

	//TODO createrawtransaction
	//TODO decoderawtransaction

	/**
	 * Returns the account associated with the given address.
	 *
	 * @param (string) bitcoinaddress -The addres to check
	 **/
	public function getaccount($bitcoinaddress)
	{
		return $this->connect('getaccount', array($bitcoinaddress));
	}

	/**
	 * Returns the current bitcoin address for receiving payments to this account.
	 *
	 * @param (string) account - The account to check
	 **/
	public function getaccountaddress($account)
	{
		return $this->connect('getaccountaddress', array($account));
	}

	/**
	 * Returns the balance in the account.
	 *
	 * @param (string) account - The account to check
	 * @param (int) minconf - The minimum confirmations needed to consider as confirmed
	 **/
	public function getbalance($account, $minconf = 6)
	{
		return $this->connect('getaccountaddress', array($account, (int) $minconf));
	}

	/**
	 * Returns the number of connections to other nodes.
	 **/
	public function getconnectioncount()
	{
		return $this->connect('getaccountaddress');
	}

	/**
	 * Returns an object containing various state info.
	 **/
	public function getinfo()
	{
		return $this->connect('getinfo');
	}

	/**
	 * Returns a new bitcoin address for receiving payments.
	 * It is added to the address book so payments received with the address will be credited to the account.
	 *
	 * @param (string) account - The account for the new address
	 **/
	public function getnewaddress($account)
	{
		return $this->connect('getnewaddress', array($account));
	}

	/**
	 * Returns the total amount received by the account in transactions with a minimum confirmations.
	 *
	 * @param (string) account - The account to check
	 * @param (int) minconf - The minimum confirmations needed to consider as confirmed
	 **/
	public function getreceivedbyaccount($account, $minconf = 6)
	{
		return $this->connect('getaccountaddress', array($account, (int) $minconf));
	}

	/**
	 * Returns the integer value of the 64 bit double precision number in the JSON-RPC request.
	 *
	 * @param (double) value - The BTC value to be converted
	 * @return (int) the integer for use with Bitcoin
	 * @link https://en.bitcoin.it/wiki/Proper_Money_Handling_(JSON-RPC)
	 **/
	public function JSONtoAmount($value)
	{
		return round($value * 1E+8);
	}

	/**
	 * Creates the connection.
	 * Uses code from JSON-RPC PHP client.
	 *
	 * @param (string) method - the method to use in the JSON-RPC connection
	 * @param (array) params - the params to pass in the JSON-RPC connection
	 * @link http://jsonrpcphp.org/
	 **/
	private function connect($method, $params = array())
	{
		$id = mt_rand(1, 1000000);

		// prepares the request
		$request	= array(
						'method' => $method,
						'params' => $params,
						'id' => $id
						);
		$request	= json_encode($request);

		// performs the HTTP POST
		$opts		= array((config_item('server_is_ssl') ? 'https' : 'http') => array(
						'method'  => 'POST',
						'header'  => 'Content-type: application/json',
						'content' => $request
						));
		$context  = stream_context_create($opts);

		if ($fp = fopen($this->url, 'r', FALSE, $context))
		{
			$response = '';
			while ($row = fgets($fp))
			{
				$response.= trim($row)."\n";
			}

			$response = json_decode($response, TRUE);
		}
		else
		{
			throw new Exception('Unable to connect to '.$this->url);
		}

		// final checks and return
		if ($response['id'] != $id)
		{
				throw new Exception('Incorrect response id (request id: '.$id.', response id: '.$response['id'].')');
		}

		if ( ! is_null($response['error']))
		{
			throw new Exception('Request error: '.$response['error']);
		}

		return $response['result'];
	}
}


/* End of file Bitcoin.php */
/* Location: ./application/libraries/Bitcoin.php */