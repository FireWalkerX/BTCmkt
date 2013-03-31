<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="<?php echo $this->lang->lang(); ?>">
	<head>
		<title><?php echo config_item('app_title'); ?></title>
		<link rel="icon" href="<?php echo site_url('img/favicon.ico'); ?>">
		<meta charset="UTF-8">
		<meta name="generator" content="<?php echo config_item('script_name').'-'.config_item('script_version'); ?>">
		<meta name="author" content="Razican, adri93">
		<meta name="application-name" content="<?php echo config_item('script_name'); ?>">
		<link rel="stylesheet" href="<?php echo site_url('css/public.css'); ?>" type="text/css">
		<script charset="UTF-8" type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script type="text/javascript">
		<!--
			if(typeof jQuery === 'undefined'){
				document.write(unescape('<scri'+'pt src="<?php echo site_url('js/jquery.js'); ?>" type="text/javascript"></scri'+'pt>'));
			}
		//-->
		</script>
		<script charset="UTF-8" type="text/javascript" src="<?php echo site_url('js/overal.js'); ?>"></script>
	</head>
	<body>
	<section class="page">