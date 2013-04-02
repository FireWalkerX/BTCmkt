<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="<?php echo $this->lang->lang(); ?>">
	<head>
		<title><?php echo lang('404_title'); ?></title>
		<meta charset="UTF-8">
		<link rel="icon" href="<?php echo site_url('img/favicon.ico'); ?>">
		<meta name="generator" content="<?php echo config_item('script_name').'-'.config_item('script_version'); ?>">
		<meta name="author" content="Razican, adri93">
		<meta name="application-name" content="<?php echo config_item('script_name'); ?>">
		<link rel="stylesheet" href="<?php echo site_url('css/404.css'); ?>" type="text/css">
		<script charset="UTF-8" type="text/javascript" src="<?php echo site_url('js/modernizr.js'); ?>"></script>
	</head>
	<body>
		<!--[if lt IE 7]>
			<p class="chromeframe"><?php echo lang('outdated_br'); ?></p>
		<![endif]-->
		<div class="container">
			<h1><?php echo lang('404_heading'); ?> <span>:(</span></h1>
			<p><?php echo lang('404_description'); ?></p>
			<p><?php echo lang('404_options'); ?></p>
			<ul>
				<li><?php echo lang('404_opt_mistype'); ?></li>
				<li><?php echo lang('404_opt_outdated'); ?></li>
			</ul>
			<script type="text/javascript">
				var GOOG_FIXURL_LANG = (navigator.language || '').slice(0,2),GOOG_FIXURL_SITE = location.host
			</script>
			<script charset="UTF-8" type="text/javascript" src="http://linkhelp.clients.google.com/tbproxy/lh/wm/fixurl.js"></script>
		</div>
	</body>
</html>