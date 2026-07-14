<?php
/**
 * Public asset handling.
 *
 * @package Domina_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Domina_Pro_Public {

	private $plugin_name;
	private $version;

	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	private function selected_template() {
		$template = sanitize_key( (string) domina_pro_get_option( 'dom_template', 'template-1' ) );
		return in_array( $template, array( 'template-1', 'template-2', 'template-3' ), true ) ? $template : 'template-1';
	}

	public function enqueue_styles() {
		if ( ! domina_pro_should_render() ) {
			return;
		}

		$template = $this->selected_template();
		$base_url = plugin_dir_url( __FILE__ );

		wp_enqueue_style( 'domina-common', $base_url . 'css/domina-common.css', array(), $this->version );

		if ( 'template-3' === $template ) {
			wp_enqueue_style( 'domina-font-awesome', $base_url . 'css/fontawesome.min.css', array(), '5.15.4' );
			wp_enqueue_style( 'domina-editorial-luxury', $base_url . 'css/editorial-luxury.css', array(), $this->version );
			return;
		}

		wp_enqueue_style( 'domina-font-awesome', $base_url . 'css/fontawesome.min.css', array(), '5.15.4' );
		wp_enqueue_style( 'domina-bootstrap', $base_url . 'css/bootstrap.min.css', array(), '4.6.2' );

		if ( 'template-1' === $template ) {
			wp_enqueue_style( 'domina-page-transitions', $base_url . 'css/page-transitions.css', array(), $this->version );
		}

		wp_enqueue_style( 'domina-main', $base_url . 'css/domina-main.css', array(), $this->version );
		wp_enqueue_style( 'domina-responsive', $base_url . 'css/responsive.css', array( 'domina-main' ), $this->version );

		$allowed_schemes = array( 'orange', 'amethyst', 'ash', 'petrichor', 'purple', 'strain' );
		$scheme          = sanitize_key( (string) domina_pro_get_option( 'dom_scheme', 'orange' ) );
		$scheme          = in_array( $scheme, $allowed_schemes, true ) ? $scheme : 'orange';
		wp_enqueue_style( 'domina-scheme', $base_url . 'css/colors/' . $scheme . '.css', array( 'domina-main' ), $this->version );
	}

	public function enqueue_scripts() {
		if ( ! domina_pro_should_render() ) {
			return;
		}

		$template = $this->selected_template();
		$base_url = plugin_dir_url( __FILE__ );

		if ( 'template-1' === $template ) {
			wp_enqueue_script( 'domina-anime', $base_url . 'js/anime.min.js', array(), $this->version, true );
			wp_enqueue_script( 'domina-page-transitions', $base_url . 'js/page-transitions.js', array( 'domina-anime' ), $this->version, true );
		}

		if ( 'template-2' === $template ) {
			wp_enqueue_script( 'domina-particleground', $base_url . 'js/jquery.particleground.min.js', array( 'jquery' ), $this->version, true );
		}

		wp_enqueue_script( 'domina-custom', $base_url . 'js/custom.js', array(), $this->version, true );
	}

	/**
	 * Remove active-theme assets only for the replacement page.
	 */
	public function remove_theme_assets() {
		if ( ! domina_pro_should_render() ) {
			return;
		}

		$wp_scripts = wp_scripts();
		$wp_styles  = wp_styles();
		$themes_uri = get_theme_root_uri();

		foreach ( $wp_scripts->registered as $handle => $script ) {
			$src = isset( $script->src ) ? (string) $script->src : '';
			if ( $src && false !== strpos( $src, $themes_uri ) ) {
				wp_dequeue_script( $handle );
				wp_deregister_script( $handle );
			}
		}

		foreach ( $wp_styles->registered as $handle => $style ) {
			$src = isset( $style->src ) ? (string) $style->src : '';
			if ( $src && false !== strpos( $src, $themes_uri ) ) {
				wp_dequeue_style( $handle );
				wp_deregister_style( $handle );
			}
		}
	}
}
