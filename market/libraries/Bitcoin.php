<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bitcoin {

	private $url;

	/**
	 * Creates a Bitcoin connection.
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
		return $this->connect('getaccount', array((string) $bitcoinaddress));
	}

	/**
	 * Returns the current bitcoin address for receiving payments to this account.
	 *
	 * @param (int) account - The account to check
	 **/
	public function getaccountaddress($account)
	{
		return $this->connect('getaccountaddress', array((string) (int) $account));
	}

	/**
	 * Returns the balance in the account.
	 *
	 * @param (int) account - The account to check
	 * @param (int) minconf - The minimum confirmations needed for a transaction to be considered as confirmed
	 **/
	public function getbalance($account, $minconf = 6)
	{
		return $this->connect('getbalance', array((string) (int) $account, (int) $minconf));
	}

	/**
	 * Returns the number of connections to other nodes.
	 *
	 * @return (int) The number of connections
	 **/
	public function getconnectioncount()
	{
		return $this->connect('getconnectioncount');
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
	 * @param (int) account - The account for the new address
	 **/
	public function getnewaddress($account)
	{
		return $this->connect('getnewaddress', array((string) (int) $account));
	}

	/**
	 * Returns the total amount received by the account in transactions with a minimum confirmations.
	 *
	 * @param (int) account - The account to check
	 * @param (int) minconf - The minimum confirmations needed for a transaction to be considered as confirmed
	 **/
	public function getreceivedbyaccount($account, $minconf = 6)
	{
		return $this->connect('getreceivedbyaccount', array((string) (int) $account, (int) $minconf));
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
		return $this->connect('gettransaction', array((string) $txid));
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
	 * @param (int) account - The account to check
	 * @param (int) count - The number of transactions to return
	 * @param (int) from - The number of transactions to skip
	 **/
	public function listtransactions($account, $count = 10, $from = 0)
	{
		return $this->connect('listtransactions', array((string) (int) $account, (int) $count, (int) $from));
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
	 * @param (int) fromaccount - The account from which to transfer funds
	 * @param (int) toaccount - The account to which send funds
	 * @param (double) amount - The amount to send (rounded to 8 decimal places)
	 * @param (int) minconf - The minimum confirmations needed for a transaction to be considered as confirmed
	 * @param (string) comment - The comment for the move
	 **/
	public function move($fromaccount, $toaccount, $amount, $minconf = 6, $comment = '')
	{
		return $this->connect('move', array((string) (int) $fromaccount, (string) (int) $toaccount,
											(double) $amount, (int) $minconf, (string) $comment));
	}

	/**
	 * Will send the given amount to the given address, ensuring the account has a valid balance
	 * using given confirmations.
	 *
	 * @param (int) fromaccount - The account from which to transfer funds
	 * @param (string) tobitcoinaddress - The Bitcoin address for receiving the funds
	 * @param (double) amount - The amount to send (rounded to 8 decimal places)
	 * @param (int) minconf - The minimum confirmations needed for a transaction to be considered as confirmed
	 * @param (string) comment - The comment for the sending transaction
	 * @param (string) comment-to - The comment for the arriving transaction
	 * @return (string) the transaction ID, if successful (not a JSON object)
	 **/
	public function sendfrom($fromaccount, $tobitcoinaddress, $amount, $minconf = 6, $comment = '', $comment_to = '')
	{
		return $this->connect('sendfrom', array((string) (int) $fromaccount, (string) $tobitcoinaddress, (double) $amount,
											(int) $minconf, (string) $comment, (string) $comment_to));
	}

	/**
	 * Sends multiple transactions at one time. It will use a send array to
	 * send different amounts to each address.
	 *
	 * @param (int) fromaccount - The account from which to transfer funds
	 * @param (array) send_array - The array with the amounts to send,
	 *		in (string) key|address => (double) amount (rounded to 8 decimal places) format
	 * @param (int) minconf - The minimum confirmations needed for a transaction to be considered as confirmed
	 * @param (string) comment - The comment for the sending transaction
	 **/
	public function sendmany($fromaccount, $send_array, $minconf = 6, $comment = '')
	{
		return $this->connect('sendmany', array((string) (int) $fromaccount, json_encode($send_array), (int) $minconf, (string) $comment));
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
		return $this->connect('sendtoaddress', array((string) $bitcoinaddress, (double) $amount, (string) $comment, (string) $comment_to));
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
		return $this->connect('signmessage', array((string) $bitcoinaddress, (string) $message));
	}

	//TODO ^

	/**
	 * Sets the new fee for transactions.
	 *
	 * @param int $amount The new amount for the fee
	 * @return bool|object If the modification was successful
	 *						or the error object
	 **/
	public function settxfee($amount)
	{
		if ( ! is_int($amount))
		{
			log_message('error', 'Bad data received for $amount at bitcoin->settxfee()');
		}

		$result = $this->connect('settxfee', array(amount_to_JSON($amount)));
		if ($this->_has_error($result))
		{
			return $this->_get_error($result);
		}
		else
		{
			return (bool) $result;
		}
	}

	/**
	 * Return information about a given address.
	 *
	 * @param string $bitcoinaddress The address to check
	 * @return object the data of the account, or the error object
	 **/
	public function validateaddress($bitcoinaddress)
	{
		$result = $this->connect('settxfee', array((string) $bitcoinaddress));
		if ($this->_has_error($result))
		{
			return $this->_get_error($result);
		}
		else
		{
			return json_decode($result);
		}
	}

	/**
	 * Sign a message with the private key of an address.
	 *
	 * @param string $bitcoinaddress The address used for signing
	 * @param string $signature The signature resulted from signing
	 * @param string $message The message
	 * @return bool|object Wether the signature has been verified or not
	 *						or the error of ocurred
	 **/
	public function verifymessage($bitcoinaddress, $signature, $message)
	{
		$result = $this->connect('verifymessage', array((string) $bitcoinaddress, (string) $signature, (string) $message));
		if ($this->_has_error($result))
		{
			return $this->_get_error($result);
		}
		else
		{
			return (bool) $result;
		}
	}

	/**
	 * Removes the wallet encryption key from memory, locking the wallet.
	 * After calling this method, you will need to call walletpassphrase again
	 * before being able to call any methods which require the wallet to be unlocked.
	 *
	 * @return null|object If there is an error, the error object
	 **/
	public function walletlock()
	{
		$result = $this->connect('walletlock');
		if ($this->_has_error($result))
		{
			return $this->_get_error($result);
		}
		else
		{
			return NULL;
		}
	}

	/**
	 * Stores the wallet decryption key in memory for a given amount of seconds.
	 *
	 * @param string $passphrase The passphrase of the wallet
	 * @param int $timeout The number of seconds to store the decryption key in memory
	 **/
	public function walletpassphrase($passphrase, $timeout = 30)
	{
		if ( ! is_int($timeout))
		{
			log_message('error', 'Bad data received for $timeout at bitcoin->walletpassphrase()');
		}

		$result = $this->connect('walletpassphrase', array((string) $passphrase, (int) $timeout));
		if ($this->_has_error($result))
		{
			return $this->_get_error($result);
		}
		else
		{
			return NULL;
		}
	}

	/**
	 * Changes the wallet passphrase.
	 *
	 * @param string $oldpassphrase The old passphrase
	 * @param string $newpassphrase The new passphrase to set
	 * @return null|object If there is an error, the error object
	 **/
	public function walletpassphrasechange($oldpassphrase, $newpassphrase)
	{
		$result = $this->connect('walletpassphrasechange', array((string) $oldpassphrase, (string) $newpassphrase));
		if ($this->_has_error($result))
		{
			return $this->_get_error($result);
		}
		else
		{
			return NULL;
		}
	}

	/**
	 * Returns the integer value of the 64 bit double precision number in the JSON-RPC request.
	 *
	 * @param double $value The BTC value to be converted
	 * @return int the integer for use with Bitcoin
	 * @link https://en.bitcoin.it/wiki/Proper_Money_Handling_(JSON-RPC)
	 **/
	public function JSON_to_amount($value)
	{
		if ( ! is_numeric($value))
		{
			log_message('error', 'Bad data received for $value at bitcoin->JSON_to_amount()');
		}

		return (int) round($value * 1E+8);
	}

	/**
	 * Returns the 64 bit double precision number for the JSON-RPC request of the integer.
	 *
	 * @param int $value The BTC value to be converted
	 * @return double the double to use with the JSON-RPC API
	 * @link https://en.bitcoin.it/wiki/Proper_Money_Handling_(JSON-RPC)
	 **/
	public function amount_to_JSON($value)
	{
		if ( ! is_int($value))
		{
			log_message('error', 'Bad data received for $value at bitcoin->amount_to_JSON()');
		}

		return (double) round($value * 1E-8, 8);
	}

	/**
	 * Returns if the given error code is a standard JSON-RPC error
	 *
	 * @param int $error_code The error code
	 * @return bool if the code is a JSON-RPC error
	 **/
	private function _is_rpc_error($error_code)
	{
		return ($error_code >= -32768 && $error_code <= -32000);
	}

	/**
	 * Returns if the given response contains an error
	 *
	 * @param string $response the server's response
	 * @return bool if the response contains an error
	 **/
	private function _has_error($response)
	{
		return ! empty($response) && strstr($response, 'error: ');
	}

	/**
	 * Gets the error from the request. It's supposed that the response has
	 * been checked, and an error has been found.
	 *
	 * @param string $error the server's response
	 * @return object the error
	 **/
	private function _get_error($error)
	{
		if (strstr($error, 'error'))
		{
			$result = json_decode(substr($error, 7));
			if ($this->_is_rpc_error($result->code))
			{
				log_message('error', 'RPC error: Code -> '.$result->code.' Message -> '.$result->message);
			}

			return $result;
		}
		else
		{
			log_message('error', 'There has been an error when decoding the bitcoin->walletpassphrasechange() return message');
		}
	}

	/**
	 * Creates the connection.
	 * Uses code from JSON-RPC PHP client.
	 *
	 * @param string $method the method to use in the JSON-RPC connection
	 * @param array $params the params to pass in the JSON-RPC connection
	 * @return mixed The result of the request
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
/* Location: ./market/libraries/Bitcoin.php */