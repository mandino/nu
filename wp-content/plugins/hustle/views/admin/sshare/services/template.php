<div class="sui-box" <?php if ( 'services' !== $section ) echo ' style="display: none;"'; ?> data-tab="services">

	<div class="sui-box-header">

		<h2 class="sui-box-title"><?php esc_html_e( 'Services', 'wordpress-popup' ); ?></h2>

	</div>

	<div id="hustle-wizard-content" class="sui-box-body"></div>

	<div class="sui-box-footer">

		<div class="sui-actions-right">
			<button class="sui-button sui-button-icon-right wpmudev-button-navigation" data-direction="next">
				<span class="sui-loading-text">
					<?php esc_html_e( 'Display Options', 'wordpress-popup' ); ?> <i class="sui-icon-arrow-right" aria-hidden="true"></i>
				</span>
				<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
			</button>
		</div>

	</div>

</div>

<script id="hustle-wizard-content-tpl" type="text/template">

	<?php
	// SETTING: Counter
	self::static_render(
		'admin/sshare/services/tpl--counter',
		array()
	); ?>

	<?php
	// SETTING: Social Services
	self::static_render(
		'admin/sshare/services/tpl--social-services',
		array(
			'content_settings' => $content_settings,
		)
	); ?>

</script>
