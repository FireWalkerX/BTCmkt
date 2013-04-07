<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php echo $menu; ?>

<section class="marquee <?php echo $this->user->is_logged_in() ? $this->user->get_setting('marquee-speed') : 'fast'; ?>">
	<span class="bid title"><?php echo lang('marquee.bid'); ?></span>: <span class="bid">113.45013</span> €
	<span class="ask title"><?php echo lang('marquee.ask'); ?></span>: <span class="ask">113.49000</span> €
</section>

<section class="market">
	<section class="bids"></section>
	<section class="asks"></section>
</section>