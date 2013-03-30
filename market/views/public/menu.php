<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<nav class="top-menu">
	<ul>
		<section class="account">
			<li><?php echo anchor('register', lang('register')); ?></li>
			<li><a href="#"><?php echo lang('login'); ?></a></li>
		</section>
		<section class="overal">
			<li><?php echo anchor('contact', lang('contact')); ?></li>
		</section>
	</ul>
</nav>