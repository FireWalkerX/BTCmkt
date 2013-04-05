<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Profiler hook
 *
 * @subpackage	Hooks
 * @author		Razican
 * @category	Hooks
 * @link		http://www.razican.com/
 */

function profiler()
{
	log_message('debug', 'Profiler hook initialised.');
	$CI			=& get_instance();

	$CI->output->enable_profiler(ENVIRONMENT === 'development' && ! $CI->input->is_ajax_request());
}


/* End of file Profiler.php */
/* Location: ./market/hooks/Profiler.php */