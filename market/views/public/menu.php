<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<nav class="top-menu">
	<ul>
		<section class="account">
			<li><?php echo anchor('register', lang('register')); ?></li>
			<li><a id="login" href="#"><?php echo lang('login'); ?></a></li>
		</section>

		<section class="overal">
			<li><?php echo anchor('charts', lang('charts')); ?></li>
			<li><?php echo anchor('contact', lang('contact')); ?></li>
		</section>

		<section class="language">
			<li<?php echo $this->lang->lang() === 'es' ? ' class="selected"' : ''; ?>><?php echo anchor($this->lang->switch_uri('es'), img(array(
									'src' => 'img/lang/es.png',
									'alt' => 'Español',
									'title' => 'Español',
									'width' => '24px',
									'height' => '24px'))) ?></li>
			<li<?php echo $this->lang->lang() === 'en' ? ' class="selected"' : ''; ?>><?php echo anchor($this->lang->switch_uri('en'), img(array(
									'src' => 'img/lang/en.png',
									'alt' => 'English',
									'title' => 'English',
									'width' => '24px',
									'height' => '24px'))) ?></li>
		</section>
	</ul>
</nav>

<section class="login-form"><?php echo form_open('#'); ?>
	<input type="text" id="user" name="user" placeholder="<?php echo lang('login.username'); ?>">
	<input type="password" id="pass" name="pass" placeholder="<?php echo lang('login.password'); ?>">
	<?php echo anchor('login/reset_password', lang('login.reset_pass')); ?>
	<input type="submit" value="<?php echo lang('login.submit'); ?>">
</form></section>