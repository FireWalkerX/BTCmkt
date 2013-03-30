<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<nav class="top-menu">
	<ul>
		<section class="account">
			<li><?php echo anchor('register', lang('register')); ?></li>
			<li><a href="#"><?php echo lang('login'); ?></a></li>
		</section>

		<section class="overal">
			<li><?php echo anchor('charts', lang('charts')); ?></li>
			<li><?php echo anchor('contact', lang('contact')); ?></li>
		</section>

		<section class="language">
			<?php if ($this->lang->lang() !== 'es'): ?>
			<li><?php echo anchor($this->lang->switch_uri('es'), img(array(
									'src' => 'img/lang/es.png',
									'alt' => 'Español',
									'title' => 'Español',
									'width' => '24px',
									'height' => '24px'))) ?></li>
			<?php endif; ?>
			<?php if ($this->lang->lang() !== 'en'): ?>
			<li><?php echo anchor($this->lang->switch_uri('en'), img(array(
									'src' => 'img/lang/en.png',
									'alt' => 'English',
									'title' => 'English',
									'width' => '24px',
									'height' => '24px'))) ?></li>
			<?php endif; ?>
		</section>
	</ul>
</nav>