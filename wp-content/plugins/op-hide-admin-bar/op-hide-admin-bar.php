<?php
 /*
   Plugin Name: OP Hide Admin Bar
   Plugin URI: https://optimizepress.com
   Description: Hides admin bar for any logged in user
   Version: 100.3
   Author: Kevin
   Author URI: https://optimizepress.com
   */
   
// disable the admin bar for security reasons
add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}
