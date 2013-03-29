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
	 * @param (int) minconf - The minimum confirmations needed for a transaction to be considered as confirmed
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
	 * @param (int) minconf - The minimum confirmations needed for a transaction to be considered as confirmed
	 **/
	public function getreceivedbyaccount($account, $minconf = 6)
	{
		return $this->connect('getaccountaddress', array($account, (int) $minconf));
	}

	/**
	 * Returns an object about the given transaction containing:
	 *		amount - total amount of the transaction
	 *		confirmations - number of confirmations of the transaction
	 *		txid - the transaction ID
	 *		time - time the transaction occurred
	 *		details - An array of objects containing:
	 *			account, address, category, amount, fee
	 *
	 * @param (string) txid - The account to check
	 **/
	public function gettransaction($txid)
	{
		return $this->connect('gettransaction', array($txid));
	}

	/**
	 * Returns Object that has account names as keys, account balances as values.
	 *
	 * @param (int) minconf - The minimum confirmations needed for a transaction to be considered as confirmed
	 **/
	public function listaccounts($minconf = 6)
	{
		return $this->connect('listaccounts', array((int) $minconf));
	}

	/**
	 * Returns an array of objects containing:
	 *		account - the account of the receiving addresses
	 *		amount - total amount received by addresses with this account
	 *		confirmations - number of confirmations of the most recent transaction included
	 *
	 * @param (int) minconf - The minimum confirmations needed for a transaction to be considered as confirmed
	 * @param (bool) includeempty - Wether to include account with no transactions
	 **/
	public function listreceivedbyaccount($minconf = 6, $includeempty = TRUE)
	{
		return $this->connect('listreceivedbyaccount', array((int) $minconf, (bool) $includeempty));
	}

	/**
	 * Returns an array of objects containing:
	 *		address - receiving address
	 *		account - the account of the receiving addresses
	 *		amount - total amount received by addresses with this account
	 *		confirmations - number of confirmations of the most recent transaction included
	 *
	 * @param (int) minconf - The minimum confirmations needed for a transaction to be considered as confirmed
	 * @param (bool) includeempty - Wether to include account with no transactions
	 **/
	public function listreceivedbyaddress($minconf = 6, $includeempty = TRUE)
	{
		return $this->connect('listreceivedbyaddress', array((int) $minconf, (bool) $includeempty));
	}

	/**
	 * Returns the most recent transactions skipping the first given transactions for the given account.
	 *
	 * @param (string account - The account to check
	 * @param (int) count - The number of transactions to return
	 * @param (int) from - The number of transactions to skip
	 **/
	public function listtransactions($account, $count = 10, $from = 0)
	{
		return $this->connect('listtransactions', array($account, (int) $count, (int) $from));
	}

	/**
	 * Returns array of unspent transaction inputs in the wallet.
	 *
	 * @param (int) minconf - The minimum confirmations needed for a transaction to be considered as confirmed
	 * @param (int) maxconf - The maximum confirmations for a transaction to be showed
	 **/
	public function listunspent($minconf = 6, $maxconf = 999999)
	{
		return $this->connect('listunspent', array((int) $minconf, (int) $maxconf));
	}

	/**
	 * Move from one account in your wallet to another. It won't use Bitcoin network, and thus,
	 * whon't cost any fee.
	 *
	 * @param (string) fromaccount - The account from which to transfer funds
	 * @param (string) toaccount - The account to which send funds
	 * @param (double) amount - The amount to send (rounded to 8 decimal places)
	 * @param (int) minconf - The minimum confirmations needed for a transaction to be considered as confirmed
	 * @param (string) comment - The comment for the move
	 **/
	public function move($fromaccount, $toaccount, $amount, $minconf = 6, $comment = '')
	{
		return $this->connect('move', array($fromaccount, $toaccount, (double) $amount, (int) $minconf, $comment));
	}

	/**
	 * Will send the given amount to the given address, ensuring the account has a valid balance
	 * using given confirmations.
	 *
	 * @param (string) fromaccount - The account from which to transfer funds
	 * @param (string) tobitcoinaddress - The Bitcoin address for receiving the funds
	 * @param (double) amount - The amount to send (rounded to 8 decimal places)
	 * @param (int) minconf - The minimum confirmations needed for a transaction to be considered as confirmed
	 * @param (string) comment - The comment for the sending transaction
	 * @param (string) comment-to - The comment for the arriving transaction
	 * @return (string) the transaction ID, if successful (not a JSON object)
	 **/
	public function sendfrom($fromaccount, $tobitcoinaddress, $amount, $minconf = 6, $comment = '', $comment_to = '')
	{
		return $this->connect('sendfrom', array($fromaccount, $tobitcoinaddress, (double) $amount, (int) $minconf, $comment, $comment_to));
	}

	/**
	 * Sends multiple transactions at one time. It will use a send array to
	 * send different ammounts to each address.
	 *
	 * @param (string) fromaccount - The account from which to transfer funds
	 * @param (array) send_array - The array with the ammounts to send,
	 *		in (string) key|address => (double) amount (rounded to 8 decimal places) format
	 * @param (int) minconf - The minimum confirmations needed for a transaction to be considered as confirmed
	 * @param (string) comment - The comment for the sending transaction
	 **/
	public function sendmany($fromaccount, $send_array, $minconf = 6, $comment = '')
	{
		return $this->connect('sendmany', array($fromaccount, json_encode($send_array), (int) $minconf, $comment));
	}

	/**
	 * Sends money to a given address using the default account.
	 *
	 * @param (string) bitcoinaddress - The address to which to send funds
	 * @param (double) amount (rounded to 8 decimal places)
	 * @param (string) comment - The comment for the sending transaction
	 * @param (string) comment-to - The comment for the arriving transaction
	 **/
	public function sendtoaddress($bitcoinaddress, $amount, $comment = '', $comment_to = '')
	{
		return $this->connect('sendtoaddress', array($bitcoinaddress, (double) $amount, $comment, $comment_to));
	}

	/**
	 * Sign a message with the private key of an address.
	 *
	 * @param (string) bitcoinaddress - The address to use for signing
	 * @param (string) message - The message to sign
	 * @return (string) The signed message
	 **/
	public function signmessage($bitcoinaddress, $message)
	{
		return $this->connect('signmessage', array($bitcoinaddress, $message));
	}

	/**
	 * Sets the new fee for transactions.
	 *
	 * @param (double) amount -The new amount for the fee (rounded to 8 decimal places)
	 **/
	public function settxfee($amount)
	{
		return $this->connect('settxfee', array((double) $amount));
	}

	/**
	 * Return information about a given address.
	 *
	 * @param $bitcoinaddress - The address to check
	 **/
	public function validateaddress($bitcoinaddress)
	{
		return $this->connect('settxfee', array($bitcoinaddress));
	}

	/**
	 * Sign a message with the private key of an address.
	 *
	 * @param (string) bitcoinaddress - The address used for signing
	 * @param (string) signature - The signature resulted from signing
	 * @param (string) message - The message
	 * @return (bool) Wether the signature has been verified or not
	 **/
	public function verifymessage($bitcoinaddress, $signature, $message)
	{
		return $this->connect('verifymessage', array($bitcoinaddress, $signature, $message));
	}

	/**
	 * Removes the wallet encryption key from memory, locking the wallet.
	 * After calling this method, you will need to call walletpassphrase again
	 * before being able to call any methods which require the wallet to be unlocked.
	 **/
	public function walletlock()
	{
		return $this->connect('walletlock');
	}

	/**
	 * Stores the wallet decryption key in memory for a given amount of seconds.
	 *
	 * @param (string) passphrase - The passphrase of the wallet
	 * @param (int) timeout - The number of seconds to store the decryption key in memory
	 **/
	public function walletpassphrase($passphrase, $timeout)
	{
		return $this->connect('walletpassphrase', array($passphrase, (int) $timeout));
	}

	/**
	 * Changes the wallet passphrase.
	 *
	 * @param oldpassphrase - The old passphrase
	 * @param newpassphrase - The new passphrase to set
	 **/
	public function walletpassphrasechange($oldpassphrase, $newpassphrase)
	{
		return $this->connect('walletpassphrasechange', array($oldpassphrase, $newpassphrase));
	}

	/**
	 * Returns the integer value of the 64 bit double precision number in the JSON-RPC request.
	 *
	 * @param (double) value - The BTC value to be converted
	 * @return (int) the integer for use with Bitcoin
	 * @link https://en.bitcoin.it/wiki/Proper_Money_Handling_(JSON-RPC)
	 **/
	public function JSON_to_amount($value)
	{
		return round($value * 1E+8);
	}

	/**
	 * Returns the 64 bit double precision number for the JSON-RPC request of the integer.
	 *
	 * @param (int) value - The BTC value to be converted
	 * @return (double) the double to use with the JSON-RPC API
	 * @link https://en.bitcoin.it/wiki/Proper_Money_Handling_(JSON-RPC)
	 **/
	public function amount_to_JSON($value)
	{
		return (double) round($value * 1E-8, 8);
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