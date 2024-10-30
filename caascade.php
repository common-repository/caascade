<?php
/**
 * Plugin Name: Caascade
 * Plugin URI: https://wp.tetragy.com
 * Description: Mathematical Computing for the Wordpress public
 * Version: 1.8.2
 * Author: pmagunia
 * Author URI: https://tetragy.com
 * License: GPLv2 or Later
 */

/*  Copyright 2014  Tetragy Limited

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

# settings menu link
add_action('admin_menu', 'caascade_admin_add_page');
function caascade_admin_add_page() {
  add_options_page('Settings', 'Caascade', 'manage_options', 'Caascade', 'caascade_plugin_settings_page');
}

# plugin page settings link
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'caascade_plugin_settings_link' );

function caascade_plugin_settings_link($links) { 
  $settings_link = '<a href="options-general.php?page=Caascade">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}

function caascade_plugin_settings_page() { 
  ?>
  <div class="wrap">
    <div class="wp-caascade-admin">
      <h2>Caascade Settings</h2>
      <?php 
        include_once(ABSPATH . 'wp-admin/includes/plugin.php');
        echo (!is_plugin_active('simple-mathjax/simple-mathjax.php') ? '<h3 style="color:red;">Required Wordpress Simple-MathJax plugin not found.</h3>' : '');
      ?>
      <p>Settings related to the Caascade plugin can be modified here and will have a global effect on all Caascade shortcode.</p>
      <div>
        <form action="options.php" method="post">
          <?php settings_fields('caascade_plugin_settings'); ?>
          <?php do_settings_sections('caascade'); ?>
          <br/>
          <div class-"wp-caascade-submit">
          <input name="Submit" type="submit" value="<?php esc_attr_e('Save'); ?>" />
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php }

add_action('admin_init', 'caascade_plugin_admin_init');

function caascade_plugin_admin_init() {
  register_setting( 'caascade_plugin_settings', 'caascade_router', 'caascade_settings_router_validate');
  add_settings_section('caascade_options', 'Caascade', 'caascade_section_text', 'caascade');
  add_settings_section('caascade_helper_options', 'Quickstart', 'caascade_helper_text', 'caascade');
  add_settings_field('caascade_router', 'Caascade Router', 'caascade_setting_router', 'caascade', 'caascade_options');
}

function caascade_section_text() {
  echo '<p>Visit https://github.com/pmagunia/tserver to send requests to your own Caascade/Quatriceps server.</p>';
}

function caascade_helper_text() {
  echo '<p>Once configured, use WordPress Shortcode syntax when editing a post to add Caascade widgets: <strong>[caascade com="prime"]</strong>.<p>Visit Tetragy\'s <a href="https://math.tetragy.com/caascade/doc">Caascade documentation</a> for a complete list of Maxima commands available.</p>';
}

function caascade_setting_router() {
  $router = get_option('caascade_router', 'https://route.tetragy.com');
  echo "<input id='caascade_router' name='caascade_router' size='30' type='text' value='$router' />";
}

function caascade_settings_router_validate($router) {
  if(strlen($router) > 255) {
    $router = 'https://route.tetragy.com';
  }
  return $router;
}

# Print form with Shortcode API
function caascade_func( $atts ) {
  extract( shortcode_atts( array(
    'com' => 'prime',
  ), $atts ) );

	$dialog = '<div class="caascade-dialog"><div class="caascade-waiting-container"><div class="caascade-waiting">Computing...</div></div><div class="caascade-output-container"><div class="caascade-output"></div></div></div>';

  # if users wants to override packaged file
  if(is_file(__DIR__ . '/html/override/' . $com . '.html')) {
    $markup = file_get_contents(__DIR__ . '/html/override/' . $com . '.html');
  } else {
     $markup = file_get_contents(__DIR__ . '/html/' . $com . '.html');
  }
  $markup = '<div class="caascade-cp">' . $markup . '</div>';
  return '<div class="caascade" id="caascade-' . $com .'">' . $markup . $dialog . $recap . '</div>';
}

add_shortcode( 'caascade', 'caascade_func' );

add_action( 'init', 'caascade_script_enqueuer' );

function caascade_script_enqueuer() {
  # check if admin wants to override default CSS and JS files
  $override_css = $override_js = '/html/override';
  $override_css_path = plugin_dir_path( __FILE__ ) . '/html/override/caascade.css';
  $override_js_path = plugin_dir_path( __FILE__ ) . '/html/override/caascade.js';
  if(!is_file($override_css_path)) {
    $override_css = '';
  }
  if(!is_file($override_js_path)) {
     $override_js = '';
  }
  wp_register_script("caascade_script", WP_PLUGIN_URL . '/caascade' . $override_js . '/caascade.js', array('jquery'), '1.8.2', true);
  wp_register_style("caascade_css", WP_PLUGIN_URL . '/caascade' . $override_css . '/caascade.css', array(), '1.8.2', 'all');
  wp_localize_script('caascade_script', 'caascadeAjax', array('ajaxurl' => admin_url('admin-ajax.php')));
  wp_enqueue_script('caascade_script');
  wp_enqueue_style('caascade_css');
}

add_action("wp_ajax_caascade_compute", "prefix_ajax_caascade_compute");
add_action("wp_ajax_nopriv_caascade_compute", "prefix_ajax_caascade_compute");

function prefix_ajax_caascade_compute() {

  $fields['cmd'] = $_REQUEST['cmd'];
  $fields['pdf'] = $_REQUEST['pdf'];
  $fields['approximate'] = $_REQUEST['approximate'];
  $fields['arg0'] = $_REQUEST['arg0'];
  $fields['arg1'] = $_REQUEST['arg1'];
  $fields['arg2'] = $_REQUEST['arg2'];
  $fields['arg3'] = $_REQUEST['arg3'];
  $fields['arg4'] = $_REQUEST['arg4'];
  $fields['input_base'] = $_REQUEST['input_base'];
  $fields['output_base'] = $_REQUEST['output_base'];
  $fields['expr_1'] = $_REQUEST['expr_1'];
  $fields['expr_2'] = $_REQUEST['expr_2'];
  $fields['x_wrt'] = $_REQUEST['x_wrt'];
  $fields['y_wrt'] = $_REQUEST['y_wrt'];
  $fields['z_wrt'] = $_REQUEST['z_wrt'];
  $fields['x_from'] = $_REQUEST['x_from'];
  $fields['y_from'] = $_REQUEST['y_from'];
  $fields['z_from'] = $_REQUEST['z_from'];
  $fields['x_to'] = $_REQUEST['x_to'];
  $fields['y_to'] = $_REQUEST['y_to'];
  $fields['z_to'] = $_REQUEST['z_to'];
  $fields['azimuth'] = $_REQUEST['azimith'];
  $fields['elevation'] = $_REQUEST['elevation'];
  $fields['ntics'] = $_REQUEST['ntics'];
  $fields['grid'] = $_REQUEST['grid'];
  $fields['logx'] = $_REQUEST['logx'];
  $fields['logy'] = $_REQUEST['logy'];
  $fields['contours'] = $_REQUEST['contours'];
  $fields['box'] = $_REQUEST['box'];
  $fields['axes'] = $_REQUEST['axes'];
  $fields['legend'] = $_REQUEST['legend'];
  $fields['xlabel'] = $_REQUEST['xlabel'];
  $fields['ylabel'] = $_REQUEST['ylabel'];
  $fields['zlabel'] = $_REQUEST['zlabel'];
  $fields['width'] = $_REQUEST['width'];
  $fields['height'] = $_REQUEST['height'];
  $fields['format'] = $_REQUEST['format'];
  $fields_string = '';
  foreach($fields as $key => $value) {
    $fields_string .= $key . '=' . urlencode($value) . '&';
  }
  $fields_string = rtrim($fields_string, '&');
  echo $_REQUEST['callback'] . '(' . file_get_contents(get_option('caascade_router', 'https://route.tetragy.com') . '/index.php?' . $fields_string) . ')';
  die();
}

