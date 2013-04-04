<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
	<div class="navbar navbar-inverse navbar-fixed-top"><div class="navbar-inner">
		<a class="brand" href="<?php echo site_url(); ?>"><?php echo img(array(
								'src' => 'img/logo.png',
								'alt' => 'Bitcoin Market',
								'title' => 'Bitcoin Market',
								'width' => 135,
								'height' => 25)); ?></a>
		<ul class="nav">
			<li<?php if ( ! $this->uri->segment(2)) echo ' class="active"' ?>><?php echo anchor('/', lang('home')); ?></a></li>
			<li<?php if ($this->uri->segment(2) === 'charts') echo ' class="active"' ?>><?php echo anchor('charts', lang('charts')); ?></li>
			<li<?php if ($this->uri->segment(2) === 'contact') echo ' class="active"' ?>><?php echo anchor('contact', lang('contact')); ?></li>
			<!-- TODO charts, contact -->
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					<?php echo lang('register'); ?><b class="caret"></b>
				</a>
				<ul id="register" class="dropdown-menu form">
					<?php echo form_open('#'); ?>
						<input type="text" name="user" placeholder="<?php echo lang('login.username'); ?>">
						<input type="email" name="email" placeholder="<?php echo lang('reg.email'); ?>">
						<input type="password" name="pass" placeholder="<?php echo lang('login.password'); ?>">
						<input type="password" name="pass_conf" placeholder="<?php echo lang('reg.pass_conf'); ?>">
						<input class="btn btn-info" type="button" value="<?php echo lang('reg.submit'); ?>">
					</form>
				</ul>
			</li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					<?php echo lang('login'); ?><b class="caret"></b>
				</a>
				<ul id="login" class="dropdown-menu form">
					<?php echo form_open('#'); ?>
						<input type="text" name="user" placeholder="<?php echo lang('login.username'); ?>">
						<input type="password" name="pass" placeholder="<?php echo lang('login.password'); ?>">
						<?php echo anchor('login/reset_password', lang('login.reset_pass')); ?>
						<input class="btn btn-info" type="button" value="<?php echo lang('login.submit'); ?>">
					</form>
				</ul>
			</li>
		</ul>
		<ul class="nav pull-right">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<?php echo lang('language'); ?><b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li<?php echo $this->lang->lang() === 'es' ? ' class="selected"' : ''; ?>>
								<?php echo anchor($this->lang->switch_uri('es'), img(array(
								'src' => 'img/lang/es.png',
								'alt' => 'Español',
								'title' => 'Español',
								'width' => '24px',
								'height' => '24px')).' Español'); ?></li>
					<li<?php echo $this->lang->lang() === 'en' ? ' class="selected"' : ''; ?>>
								<?php echo anchor($this->lang->switch_uri('en'), img(array(
								'src' => 'img/lang/en.png',
								'alt' => 'English',
								'title' => 'English',
								'width' => '24px',
								'height' => '24px')).' English'); ?></li>
				</ul>
			</li>
		</ul>
	</div></div>
	<div class="container">