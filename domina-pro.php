<?php
/**
 * Plugin Name:       Domina Pro
 * Plugin URI:        https://zhaket.com/store/web/shabnam
 * Description:       افزونه‌ای حرفه‌ای برای نمایش صفحات تعمیرات، به‌روزرسانی، در دست ساخت و معرفی یا فروش دامنه در وردپرس
 * Version:           1.2.0
 * Author:            SHABNAM
 * Author URI:        https://zhaket.com/store/web/shabnam
 * License:           GPL-2.0+
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       domina-pro
 * Domain Path:       /languages
 *
 * @package Domina_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/activatezhk/validate-locked.php';

if ( \b81452de6026a16694ac3e5e588f153a::ad5561aad1c4910b76c4c6416616504b() ) {
	define( 'DOMINA_PRO_VERSION', '1.2.0' );

	if ( ! defined( 'DOM_DIR_PATH' ) ) {
		define( 'DOM_DIR_PATH', plugin_dir_path( __FILE__ ) );
	}

	if ( ! defined( 'DOM_DIR_URL' ) ) {
		define( 'DOM_DIR_URL', plugin_dir_url( __FILE__ ) );
	}

	function domina_pro_activate() {
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-domina-pro-activator.php';
		Domina_Pro_Activator::activate();
	}

	function domina_pro_deactivate() {
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-domina-pro-deactivator.php';
		Domina_Pro_Deactivator::deactivate();
	}

	register_activation_hook( __FILE__, 'domina_pro_activate' );
	register_deactivation_hook( __FILE__, 'domina_pro_deactivate' );

	require plugin_dir_path( __FILE__ ) . 'includes/class-domina-pro.php';

	function domina_pro_run() {
		$plugin = new Domina_Pro();
		$plugin->run();
	}

	domina_pro_run();
}
