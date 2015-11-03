<?php 
/*
Plugin Name: heatmap for WordPress
Plugin URI: http://wordpress.org/plugins/heatmap-for-wp/
Description: Real-time analytics and event tracking for your WordPress site (see https://heatmap.me)
Version: 0.3.1
Author: HeatMap, Inc
Author URI: https://heatmap.me
License: GPL2
*/
/*
Copyright 2014 - HeatMap, Inc - https://heatmap.me/

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
/*
We thank our beta testers: womenology.fr, lesconfettis.com, cool-tabs.com, lepetitjournal.com
*/
/*
 * Singleton class
 */
class heatmapWP {
	/**
	 * Singleton
	 */
	private static $instance = null;
	private static $PLUGIN_DIR;
	private static $PLUGIN_SLUG;
	private static $ACTION_PREFIX;
	private static $OPTION_NAME = 'heatmapWP_options';
	private static $JS_TRIGGER = 'var s=document.createElement("script");s.type="text/javascript";s.src="//u.heatmap.it/bookmark.js";(top.document.body || top.document.getElementsByTagName("head")[0]).appendChild(s);';
	/**
	 * Main function of the singleton class
	 */
	private function __construct() {
		if (is_admin()) {
			if (!$this->get_option('active')) {
				$this->check_account_active(3600); // while not active, check every hour
			}
			add_action('admin_menu', array($this, 'admin_menu'));
			if ($this->get_page_type() == 'admin' && false !== stristr($_GET['page'], self::$PLUGIN_SLUG)) {
				add_action('admin_enqueue_scripts', array($this, 'admin_assets'));
			} else {
				add_action('admin_notices', array($this, 'admin_notices'));
			}
			if ($this->get_option('active')) {
				add_action('admin_post_'.self::$ACTION_PREFIX.'save', array($this, 'admin_post_save'));
			} else {
				add_action('admin_post_'.self::$ACTION_PREFIX.'check', array($this, 'admin_post_check'));
			}
			// TODO: load_plugin_textdomain($PLUGIN_SLUG, false, self::$PLUGIN_DIR.'languages' );
		} else {
			if ($this->get_option('active')) {
				add_action('wp_head', array($this, 'front_write_script'));
				add_action('admin_bar_menu', array($this, 'admin_bar_menu'), 1000);
			}
		}
		// make sure we have the cron
		if (is_admin() && !wp_next_scheduled(self::$ACTION_PREFIX.'cron_check_account')) {
			wp_schedule_event(time(), 'daily', self::$ACTION_PREFIX.'cron_check_account');
		}
		add_action(self::$ACTION_PREFIX.'cron_check_account', array($this, 'cron_check_account'));
		
		register_activation_hook(self::$PLUGIN_DIR.basename(__FILE__), array($this, 'activate_plugin'));
		register_deactivation_hook(self::$PLUGIN_DIR.basename(__FILE__), array($this, 'deactivate_plugin'));
	}
	public static function init() {
		if (!self::$instance) {
			self::$PLUGIN_SLUG = basename(__FILE__, '.php');
			self::$PLUGIN_DIR = self::$PLUGIN_SLUG.DIRECTORY_SEPARATOR;
			self::$ACTION_PREFIX = preg_replace('/[^a-z]+/', '_', strtolower(self::$PLUGIN_SLUG)).'_';
			self::$instance = new self();
		}
	}
	public function activate_plugin() {
		if (!$this->check_account_active()) {
			if ($check_err = $this->get_option('active_last_check_err')) {
				die('Error while activating the plugin: please contact support (error: '.$check_err.')');
			}
		}
	}
	public function deactivate_plugin() {
		wp_clear_scheduled_hook(self::$ACTION_PREFIX.'cron_check_account');
	}
	public function cron_check_account() {
		$this->check_account_active();
	}
	/**
	 * Adding the settings menu
	 */
	public function admin_menu() {
		add_menu_page('heatmap', 'heatmap', 'manage_options', self::$PLUGIN_SLUG, array($this, 'admin_options_page'), $this->get_asset('icon-16.png'));
	}
	public function admin_notices() {
		$this->show_notice(
			$this->get_page_type() == 'plugins' && !$this->get_option('active'),
			'error', 'heatmap',
			__('You are almost done!', self::$PLUGIN_SLUG).' '.
				sprintf('<a href="%s">%s</a>', admin_url('admin.php?'.http_build_query(array('page' => self::$PLUGIN_SLUG))), __('Click here to setup the plugin', self::$PLUGIN_SLUG))
		);
	}
	/**
	 */
	public function admin_assets() {
		wp_enqueue_style(self::$PLUGIN_SLUG.'-admin-style', $this->get_asset('admin.css'));
		wp_enqueue_style(self::$PLUGIN_SLUG.'-admin-codemirror-style', $this->get_asset('codemirror.css'));
		wp_enqueue_script('jquery');
		wp_enqueue_script(self::$PLUGIN_SLUG.'-admin-codemirror-script', $this->get_asset('codemirror-compressed.js'));
	}
	public function admin_options_page() {
		$this->show_options_page();
	}
	public function admin_bar_menu() {
		if (!is_admin_bar_showing()) return;
		global $wp_admin_bar;
		$wp_admin_bar->add_menu( array(
			'id' => self::$PLUGIN_SLUG.'-bar',
			'meta' => array('onclick' => self::$JS_TRIGGER.';return false;'),
			'title' => $this->get_admin_bar_toggle_button(),
			'href' => '#',
		) );
	}
	public function admin_post_check() {
		check_admin_referer(self::$ACTION_PREFIX.'check');
		$this->check_account_active();
		wp_safe_redirect(wp_get_referer());
	}
	public function admin_post_save() {
		check_admin_referer(self::$ACTION_PREFIX.'save');
		$new_values = array(
			'ext_use' => true && $this->array_get($_POST, 'ext_use'),
			'ext_code' => $this->array_get($_POST, 'ext_code'),
		);
		$this->set_options($new_values, true);
		wp_safe_redirect(add_query_arg('saved', '1', wp_get_referer()));
	}
	/**
	 * Writing the script on the front-end pages
	 */
	public function front_write_script() {
		?>
<script type="text/javascript">
<?php if ($this->get_option('ext_use')) echo $this->get_option('ext_code'); ?>
<?php if (is_admin_bar_showing()): ?>
window.heatmap_ext=window.heatmap_ext||{};window.heatmap_ext.recordDisabled=true;
<?php endif; ?>
(function() {
var hm = document.createElement('script'); hm.type ='text/javascript'; hm.async = true;
hm.src = ('++u-heatmap-it+log-js').replace(/[+]/g,'/').replace(/-/g,'.');
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(hm, s);
})();
</script>
		<?php
	}
	
	private $options = array();
	private function array_get($array, $key, $default = '') {
		return array_key_exists($key, $array) ? $array[$key] : $default;
	}
	/**
	 * Check if the current site has an active account with HeatMap, Inc
	 * @return boolean
	 */
	private function check_account_active($frequency = 0) {
		if ($this->get_option('active_last_check', 0) < time() - $frequency) {
			$params = array(
				'u' => get_bloginfo('url'),
				'callback' => 'wp'
			);
			if (defined('WP_HEATMAP_AFFILIATEID')) {
				$params['aff'] = WP_HEATMAP_AFFILIATEID;
			}
			$check_url = '//heatmap.it/api/check/account?'.http_build_query($params);
			$check_response = wp_remote_get('https:'.$check_url, array('timeout' => 10, 'sslverify' => false));
			$check_result = false;
			$check_err = '';
			if (is_wp_error($check_response)) {
				// fallback to http
				$check_response = wp_remote_get('http:'.$check_url, array('timeout' => 10));
			}
			if (is_wp_error($check_response)) {
				$check_err = $check_response->get_error_message();
			} else {
				$json_result = trim(preg_replace(array('/[\n\r]/', '/^wp/'), array('', ''), $check_response['body']), '();');
				$check_result = json_decode($json_result, true);
				if (!is_array($check_result) || !array_key_exists('active', $check_result)) {
					$check_err = 'cannot parse jsonp response '.print_r($json_result,true);
				}
			}
			$options_new_values = array(
				'active_last_check' => time(),
				'active_last_check_err' => $check_err,
			);
			if ('' === $check_err) {
				$options_new_values['active'] = $this->array_get($check_result, 'active', false);
			} elseif ($this->get_option('active_last_check_err')) {
				// on second successive error, we disable the plugin 
				$options_new_values['active'] = false;
			}
			$this->set_options($options_new_values);
		}
		return $this->get_option('active');
	}
	
	private function get_asset($filename) {
		return plugins_url(self::$PLUGIN_DIR.'assets'.DIRECTORY_SEPARATOR.$filename);
	}
	private function get_page_type() {
		global $pagenow;
		return str_replace('.php', '', $pagenow);
	}
	private function load_options($force_reload = false) {
		if (!$force_reload && count($this->options) > 0) return;
		$default_options = array(
			'active' => false,
			'active_last_check' => 0,
			'active_last_check_err' => '',
			'ext_use' => false,
			'ext_code' =>  <<< EXT_DEFAULT
var heatmap_ext = {
	cleanupURL: function(url) {
		return url;
	},
	getCurrentURL: function() {
		return heatmap_ext.cleanupURL(document.location.href);
	}
};
EXT_DEFAULT
		);
		$option_db_value = get_option(self::$OPTION_NAME);
		if (empty($option_db_value)) {
			$this->set_options($default_options); // make sure to save the options in DB so WP won't try to load them separately each time
		} else {
			$this->set_options(wp_parse_args($option_db_value, $default_options), false); 
		}
	}
	private function get_option($option_key, $default = false) {
		$this->load_options();
		return $this->array_get($this->options, $option_key, $default);
	}
	private function set_options($new_values, $save_in_db = true) {
		$this->options = array_merge($this->options, $new_values);
		if ($save_in_db) {
			update_option(self::$OPTION_NAME, $this->options);
		}
	}
	private function show_notice($condition, $type, $title, $message) {
		if (!$condition) return;
		echo '<div id="message" class="', $type, '">',
			'<p>',
				'<strong>', $title, '</strong>: ',
				$message,
			'</p>',
		'</div>';
	}
	private function show_options_page() {
		?>
<div class="wrap">
	<div class="hm-content">
		<h2>heatmap settings</h2>
		<?php
		$this->show_notice($this->array_get($_GET, 'saved'), 'updated', 'Notice', __('Your changes have been saved', self::$PLUGIN_SLUG));
		$this->show_notice(!$this->get_option('active'), 'error', 'Error', 
			__('The plugin cannot find your heatmap account', self::$PLUGIN_SLUG).'<br>'.
			('' !== $this->get_option('active_last_check_err') ? sprintf('<small>[ error: %s ]</small>', $this->get_option('active_last_check_err')) : '')
		);
		?>
		<form action="admin-post.php" method="POST">
			<p class="hm-status">
				<?php _e('Plugin status:', self::$PLUGIN_SLUG) ?>
				<?php if ($this->get_option('active')): ?>
					<span class="hm-active"><?php _e('Active', self::$PLUGIN_SLUG) ?></span>
				<?php else: ?>
					<span class="hm-inactive"><?php _e('Inactive', self::$PLUGIN_SLUG) ?></span>
				<?php endif; ?>
			</p>
			<?php if (!$this->get_option('active')): ?>
				<?php $action = self::$ACTION_PREFIX.'check'; ?>
				<?php 
				$since_last_check = (time() - $this->get_option('active_last_check')) / 60;
				if ($since_last_check < 1) {
					$check_text = __('few seconds', self::$PLUGIN_SLUG);
				} elseif ($since_last_check < 60) {
					$check_text = __('few minutes', self::$PLUGIN_SLUG);
				} else {
					$check_text = __('some hours', self::$PLUGIN_SLUG);
				}
				?>
				<hr>
				<h3>Getting heatmap for your site</h3>
				<ol>
					<li>
						<?php printf(__('Create your account on %s.', self::$PLUGIN_SLUG), '<a href="https://heatmap.me/" target="_blank">https://heatmap.me</a>'); ?>
						<em><strong><?php _e('Free plan available', self::$PLUGIN_SLUG) ?></strong></em>
						<br>
						<?php _e('Easily sign up in less than 2 minutes by using your Facebook or Google account!', self::$PLUGIN_SLUG) ?>
					</li>
					<li>
						<?php printf(__('Come back here and click the "%s" button below', self::$PLUGIN_SLUG), __('Check now', self::$PLUGIN_SLUG)) ?>
						<br>
					</li>
				</ol>
				<p style="text-align:center;">
					<input type="submit" class="button button-primary" value="<?php esc_attr_e('Check now', self::$PLUGIN_SLUG) ?>" /><br>
					<small><?php printf(__('Last check: %s ago', self::$PLUGIN_SLUG), $check_text); ?></small>
				</p>
			<?php else: ?>
				<?php $action = self::$ACTION_PREFIX.'save'; ?>
				<p>
					<?php printf(__('While browsing your site, simply use the "%s" button from your admin bar to toggle heatmap\'s sidebar on or off.', self::$PLUGIN_SLUG), $this->get_admin_bar_toggle_button()); ?>
				</p>
				<p style="margin:0 30px;">
					<small>
						<?php _e('If you disabled the admin bar from your site, you can either hit Alt+Shift+H on your keyboard<br> or use our bookmarklet', self::$PLUGIN_SLUG) ?>
						<span style="display:inline-block;">
							<a ondragstart="try{event.dataTransfer.setDragImage(this,$(this).width()/2,$(this).height()/2);}catch(e){}"
								href="javascript:(function(){<?php echo esc_attr(self::$JS_TRIGGER); ?>})();"
								style="display:inline-block; padding:0 8px;border-radius:4px;background:#ccc;text-decoration:none;color:#000;cursor:move;">
								heatmap
							</a>
							&larr; <?php _e('drag this to your bookmarks bar', self::$PLUGIN_SLUG) ?>
						</span>
					</small>
				</p>
				<hr>
				<h3 class="title"><?php _e('Options', self::$PLUGIN_SLUG) ?></h3>
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><?php _e('Advanced customization', self::$PLUGIN_SLUG) ?></th>
						<td>
							<label for="heatmap_ext_checkbox">
								<input id="heatmap_ext_checkbox" type="checkbox" name="ext_use" value="1" <?php if ($this->get_option('ext_use')) echo 'checked'; ?>>
								<?php _e('Use Javascript advanced customization', self::$PLUGIN_SLUG) ?> <small>(<a href="https://heatmap.me/docs/tech/heatmap_ext" target="_blank"><?php _e('documentation', self::$PLUGIN_SLUG) ?></a>)</small>
							</label>
						</td>
					</tr>
					<tr id="heatmap_ext_editor_row" style="display:none;">
						<td colspan="2" style="padding-top: 0;">
							<textarea name="ext_code" id="heatmap_ext_editor" rows="10" cols="50" style="width:100%"><?php echo htmlspecialchars($this->get_option('ext_code')) ?></textarea>
							<br>
							<small><?php _e('Note: if your custom code has errors, no events will be logged', self::$PLUGIN_SLUG) ?></small>
						</td>
					</tr>
				</table>
				<script type="text/javascript">
				jQuery(function($) {
					var $f = function(s) { return $(s)[0]; }, 
						cm = CodeMirror.fromTextArea($f('#heatmap_ext_editor'), { mode: 'javascript', indentUnit:4, indentWithTabs:true, electricChars:false }),
						toggle = function() { $('#heatmap_ext_editor_row').toggle($f('#heatmap_ext_checkbox').checked); cm.refresh(); };
					$('#heatmap_ext_checkbox').click(toggle);
					toggle();
				});
				</script>
				<p class="submit">
					<input type="submit" class="button button-primary" value="<?php esc_attr_e('Save options', self::$PLUGIN_SLUG) ?>" />
				</p>
			<?php endif; ?>
			<input type="hidden" name="action" value="<?php echo $action; ?>">
			<?php wp_nonce_field($action); ?>
		</form>	
		<?php if($this->get_option('active')): ?>
		<hr>
		<div>
			<h3><?php _e('Like this plugin?', self::$PLUGIN_SLUG); ?></h3>
			<ul class="ul-square">
				<li><a target="_blank" href="http://wordpress.org/support/view/plugin-reviews/heatmap-for-wp?rate=5#postform"><?php _e('Leave a review on WordPress.org', self::$PLUGIN_SLUG); ?></a></li>
				<li><?php _e('Recommend the plugin to your friends:', self::$PLUGIN_SLUG); ?><iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwordpress.org%2Fplugins%2Fheatmap-for-wp&amp;width&amp;layout=standard&amp;action=recommend&amp;show_faces=false&amp;share=true&amp;height=35&amp;appId=259460820829840" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:20px; margin:0 0 -3px 8px;" allowTransparency="true"></iframe></li>
				<li><a target="_blank" href="http://wordpress.org/plugins/heatmap-for-wp/"><?php _e('Vote "works" on the plugin page', self::$PLUGIN_SLUG); ?></a></li>
				<li><?php _e('You can also promote heatmap on Facebook:', self::$PLUGIN_SLUG); ?><iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fheatmap.me&amp;width&amp;layout=standard&amp;action=recommend&amp;show_faces=false&amp;share=true&amp;height=35&amp;appId=259460820829840" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:20px; margin:0 0 -3px 8px;" allowTransparency="true"></iframe></li>
			</ul>
		</div>
		<?php endif; ?>
	</div>
	<div class="hm-sidebar">
		<h4><?php _e('Get the latest news: join us on Facebook', self::$PLUGIN_SLUG) ?></h4>
		<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fheatmap.me&amp;height=558&amp;colorscheme=light&amp;show_faces=true&amp;header=false&amp;stream=true&amp;show_border=false&amp;appId=259460820829840" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100%; height:558px;" allowTransparency="true"></iframe>
	</div>
</div>
	<?php
	}
	
	private function get_admin_bar_toggle_button() {
		return '<span style="display:inline-block;width:16px;background:transparent url('.$this->get_asset('icon-16.png').') 50% 50% no-repeat; }">&nbsp;</span>'.
			' heatmap';
	}
}

heatmapWP::init();

