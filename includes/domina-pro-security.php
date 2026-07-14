<?php
/**
 * Shared security and request helpers for Domina Pro.
 *
 * @package Domina_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'domina_pro_get_options' ) ) {
	function domina_pro_get_options() {
		$options = get_option( 'dom_opt', array() );
		return is_array( $options ) ? $options : array();
	}
}

if ( ! function_exists( 'domina_pro_get_option' ) ) {
	function domina_pro_get_option( $key, $default = '' ) {
		$options = domina_pro_get_options();
		return array_key_exists( $key, $options ) ? $options[ $key ] : $default;
	}
}

if ( ! function_exists( 'domina_pro_is_truthy' ) ) {
	function domina_pro_is_truthy( $value, $default = false ) {
		if ( null === $value || '' === $value ) {
			return (bool) $default;
		}

		if ( is_bool( $value ) ) {
			return $value;
		}

		return in_array( strtolower( (string) $value ), array( '1', 'true', 'yes', 'on', 'enabled' ), true );
	}
}

if ( ! function_exists( 'domina_pro_is_excluded_request' ) ) {
	function domina_pro_is_excluded_request() {
		if ( is_admin() ) {
			return true;
		}

		if ( function_exists( 'wp_doing_ajax' ) && wp_doing_ajax() ) {
			return true;
		}

		if ( function_exists( 'wp_doing_cron' ) && wp_doing_cron() ) {
			return true;
		}

		if ( defined( 'REST_REQUEST' ) && REST_REQUEST ) {
			return true;
		}

		if ( defined( 'XMLRPC_REQUEST' ) && XMLRPC_REQUEST ) {
			return true;
		}

		if ( defined( 'WP_CLI' ) && WP_CLI ) {
			return true;
		}

		global $pagenow;
		if ( isset( $pagenow ) && 'wp-login.php' === $pagenow ) {
			return true;
		}

		$request_uri = isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '';
		$path        = wp_parse_url( $request_uri, PHP_URL_PATH );
		$path        = is_string( $path ) ? $path : '';

		foreach ( array( '/wp-login.php', '/wp-admin/', '/wp-cron.php' ) as $excluded_path ) {
			if ( false !== strpos( $path, $excluded_path ) ) {
				return true;
			}
		}

		return false;
	}
}

if ( ! function_exists( 'domina_pro_should_render' ) ) {
	function domina_pro_should_render() {
		if ( ! domina_pro_is_truthy( domina_pro_get_option( 'dom_enable', false ) ) ) {
			return false;
		}

		if ( domina_pro_is_excluded_request() ) {
			return false;
		}

		$bypass_admins = domina_pro_is_truthy( domina_pro_get_option( 'dom_bypass_admins', true ), true );
		if ( $bypass_admins && is_user_logged_in() && current_user_can( 'manage_options' ) ) {
			return false;
		}

		/**
		 * Filters whether Domina should replace the public response.
		 *
		 * @param bool $should_render Current decision.
		 */
		return (bool) apply_filters( 'domina_pro_should_render', true );
	}
}

if ( ! function_exists( 'domina_pro_send_response_headers' ) ) {
	function domina_pro_send_response_headers() {
		if ( headers_sent() ) {
			return;
		}

		$status = absint( domina_pro_get_option( 'dom_http_status', 503 ) );
		$status = in_array( $status, array( 200, 503 ), true ) ? $status : 503;

		status_header( $status );
		nocache_headers();

		if ( 503 === $status ) {
			$retry_after = absint( domina_pro_get_option( 'dom_retry_after', 3600 ) );
			$retry_after = min( max( $retry_after, 60 ), WEEK_IN_SECONDS );
			header( 'Retry-After: ' . $retry_after, true );
		}

		if ( domina_pro_is_truthy( domina_pro_get_option( 'dom_noindex', true ), true ) ) {
			header( 'X-Robots-Tag: noindex, nofollow, noarchive', true );
		}

		header( 'X-Content-Type-Options: nosniff', true );
		header( 'X-Frame-Options: SAMEORIGIN', true );
		header( 'Referrer-Policy: strict-origin-when-cross-origin', true );
		header( 'Permissions-Policy: camera=(), microphone=(), geolocation=()', true );
	}
}

if ( ! function_exists( 'domina_pro_get_client_ip' ) ) {
	function domina_pro_get_client_ip() {
		$ip = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
		return filter_var( $ip, FILTER_VALIDATE_IP ) ? $ip : '';
	}
}
