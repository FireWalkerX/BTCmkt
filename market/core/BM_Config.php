<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * BM_Config Class
 *
 * @subpackage	Libraries
 * @author		Jérôme Jaglale
 * @author		Razican
 * @category	Libraries
 * @link		http://maestric.com/en/doc/php/codeigniter_i18n
 * @link		http://www.razican.com/
 */

class BM_Config extends CI_Config {

	function __construct()
	{
		parent::__construct();
	}

	function site_url($uri = '')
	{
		if (is_array($uri))
		{
			$uri = implode('/', $uri);
		}

		if (class_exists('CI_Controller'))
		{
			$uri = get_instance()->lang->localized($uri);
		}

		return parent::site_url($uri);
	}
}


/* End of file BM_Config.php */
/* Location: ./application/core/BM_Config.php */