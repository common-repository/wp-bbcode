<?php
function wp_bbcode_register_settings() {
	add_option('wp_bbcode_open', 'open_both');
	register_setting('wp_bbcode_options', 'wp_bbcode_open'); 
} 
add_action('admin_init', 'wp_bbcode_register_settings');
 
function wp_bbcode_register_options_page() {
	add_options_page(__('WP BBCode Options Page', WP_BBCODE_TEXT_DOMAIN), __('WP BBCode', WP_BBCODE_TEXT_DOMAIN), 'manage_options', WP_BBCODE_TEXT_DOMAIN.'-options', 'wp_bbcode_options_page');
}
add_action('admin_menu', 'wp_bbcode_register_options_page');

function wp_bbcode_get_select_option($select_option_name, $select_option_value, $select_option_id){
	?>
	<select name="<?php echo $select_option_name; ?>" id="<?php echo $select_option_name; ?>">
		<?php
		for($num = 0; $num < count($select_option_id); $num++){
			$select_option_value_each = $select_option_value[$num];
			$select_option_id_each = $select_option_id[$num];
			?>
			<option value="<?php echo $select_option_id_each; ?>"<?php if (get_option($select_option_name) == $select_option_id_each){?> selected="selected"<?php } ?>>
				<?php echo $select_option_value_each; ?>
			</option>
		<?php } ?>
	</select>
	<?php
}

function wp_bbcode_options_page() {
?>
<div class="wrap">
	<h2><?php _e("WP BBCode Options Page", WP_BBCODE_TEXT_DOMAIN); ?></h2>
	<form method="post" action="options.php">
		<?php settings_fields('wp_bbcode_options'); ?>
		<h3><?php _e("General Options", WP_BBCODE_TEXT_DOMAIN); ?></h3>
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><label for="wp_bbcode_open"><?php _e("Place you want to open shortcode: ", WP_BBCODE_TEXT_DOMAIN); ?></label></th>
					<td>
						<?php wp_bbcode_get_select_option("wp_bbcode_open", array(__('Both Posts and Comments', WP_BBCODE_TEXT_DOMAIN), __('Comments only', WP_BBCODE_TEXT_DOMAIN)), array('open_both', 'open_comments')); ?>
					</td>
				</tr>
			</table>
		<?php submit_button(); ?>
	</form>
</div>
<?php
}
?>