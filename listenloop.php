<?php
/*
Plugin Name: ListenLoop
Plugin URI: http://wordpress.org/extend/plugins/listenloop/
Description: Integrate the <a href="http://get.listenloop.com">ListenLoop</a> B2B Retarging and micro survey solution into your WordPress website.
Version: 1.1
Author: Sandeep Arneja
Author URI: http://sandeep45.github.io
*/

if (!defined('WP_CONTENT_URL'))
      define('WP_CONTENT_URL', get_option('siteurl').'/wp-content');
if (!defined('WP_CONTENT_DIR'))
      define('WP_CONTENT_DIR', ABSPATH.'wp-content');
if (!defined('WP_PLUGIN_URL'))
      define('WP_PLUGIN_URL', WP_CONTENT_URL.'/plugins');
if (!defined('WP_PLUGIN_DIR'))
      define('WP_PLUGIN_DIR', WP_CONTENT_DIR.'/plugins');

function activate_listenloop() {
  add_option('listenloop_public_key', '0');
}

function deactive_listenloop() {
  delete_option('listenloop_public_key');
}

function admin_init_listenloop() {
  register_setting('listenloop', 'listenloop_public_key');
}

function admin_menu_listenloop() {
  add_options_page('ListenLoop', 'ListenLoop', 'manage_options', 'listenloop', 'options_page_listenloop');
}

function options_page_listenloop() {
  include(WP_PLUGIN_DIR.'/listenloop/options.php');
}

function listenloop() {
  $listenloop_public_key = get_option('listenloop_public_key');
?>
<script type="text/javascript">
 (function() {
    var fks = document.createElement('script');
    fks.type = 'text/javascript';
    fks.async = true;
    fks.setAttribute("fk-public-key",'<?php echo $listenloop_public_key ?>');
    fks.setAttribute("fk-server","app.listenloop.com");
    fks.src = ('https:' == document.location.protocol ? 'https://':'http://') +
      'cdn.listenloop.com/assets/featurekicker.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(fks, s);
  })();
</script>
<?php
}

register_activation_hook(__FILE__, 'activate_listenloop');
register_deactivation_hook(__FILE__, 'deactive_listenloop');

if (is_admin()) {
  add_action('admin_init', 'admin_init_listenloop');
  add_action('admin_menu', 'admin_menu_listenloop');
}

if (!is_admin()) {
  add_action('wp_footer', 'listenloop', 1000);
}

?>
