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
	</head>
	<body>
	<section class="page">