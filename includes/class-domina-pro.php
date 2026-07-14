<?php
/**
 * Core plugin class.
 *
 * @package Domina_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Domina_Pro {

	/** @var Domina_Pro_Loader */
	protected $loader;

	/** @var string */
	protected $plugin_name;

	/** @var string */
	protected $version;

	public function __construct() {
		$this->version     = defined( 'DOMINA_PRO_VERSION' ) ? DOMINA_PRO_VERSION : '1.2.1';
		$this->plugin_name = 'domina-pro';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_public_hooks();

		// Keep the vendor licensing/admin integration intact.
		\b81452de6026a16694ac3e5e588f153a::f7262b4015b7ac58abf55d040a( $this );
		\b81452de6026a16694ac3e5e588f153a::d6d1b0d07fad86357365c8a73b7eabae( $this );
	}

	private function load_dependencies() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-domina-pro-loader.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-domina-pro-i18n.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/domina-pro-security.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/classes/setup.class.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/config/admin-options.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-domina-pro-public.php';

		$this->loader = new Domina_Pro_Loader();
	}

	private function set_locale() {
		$plugin_i18n = new Domina_Pro_i18n();
		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}

	private function define_public_hooks() {
		$plugin_public = new Domina_Pro_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles', 20 );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts', 20 );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'remove_theme_assets', 999 );
	}

	public function run() {
		$this->loader->run();
	}

	public function get_plugin_name() {
		return $this->plugin_name;
	}

	public function get_loader() {
		return $this->loader;
	}

	public function get_version() {
		return $this->version;
	}

	/**
	 * Replace the public response with the selected Domina template.
	 */
	public function domina() {
		if ( ! domina_pro_should_render() ) {
			return;
		}

		domina_pro_send_response_headers();

		$template = sanitize_key( (string) domina_pro_get_option( 'dom_template', 'template-1' ) );
		$allowed  = array( 'template-1', 'template-2', 'template-3' );
		$template = in_array( $template, $allowed, true ) ? $template : 'template-1';
		$file     = DOM_DIR_PATH . 'public/templates/' . $template . '.php';

		if ( is_readable( $file ) ) {
			include $file;
			exit;
		}
	}

	/**
	 * Render the contact form with CSRF, honeypot and accessible labels.
	 */
	public function domina_html_form_code() {
		$options = domina_pro_get_options();
		$get     = static function ( $key, $default = '' ) use ( $options ) {
			return array_key_exists( $key, $options ) ? $options[ $key ] : $default;
		};

		$name_label        = sanitize_text_field( $get( 'dom_namelabel', __( 'نام', 'domina-pro' ) ) );
		$email_label       = sanitize_text_field( $get( 'dom_emaillabel', __( 'ایمیل', 'domina-pro' ) ) );
		$subject_label     = sanitize_text_field( $get( 'dom_subjectlabel', __( 'موضوع', 'domina-pro' ) ) );
		$proposal_label    = sanitize_text_field( $get( 'dom_proposallabel', __( 'پیام', 'domina-pro' ) ) );
		$name_placeholder  = sanitize_text_field( $get( 'dom_nameplaceholder', __( 'نام شما', 'domina-pro' ) ) );
		$email_placeholder = sanitize_text_field( $get( 'dom_emailplaceholder', __( 'آدرس ایمیل شما', 'domina-pro' ) ) );
		$sub_placeholder   = sanitize_text_field( $get( 'dom_subjectplaceholder', __( 'موضوع پیام', 'domina-pro' ) ) );
		$msg_placeholder   = sanitize_text_field( $get( 'dom_proposalplaceholder', __( 'پیام خود را بنویسید', 'domina-pro' ) ) );
		$button_label      = sanitize_text_field( $get( 'dom_buttonlabel', __( 'ارسال پیام', 'domina-pro' ) ) );

		ob_start();
		?>
		<form action="" method="post" id="contact-form" class="domina-contact-form">
			<?php wp_nonce_field( 'domina_contact_submit', 'domina_contact_nonce' ); ?>
			<div class="domina-honeypot" aria-hidden="true">
				<label for="dom_website"><?php esc_html_e( 'وب‌سایت', 'domina-pro' ); ?></label>
				<input id="dom_website" type="text" name="dom_website" value="" tabindex="-1" autocomplete="off">
			</div>

			<div class="mb13 domina-field">
				<label class="form-label<?php echo empty( $name_label ) ? ' screen-reader-text' : ''; ?>" for="dom_name"><span><?php echo esc_html( $name_label ?: __( 'نام', 'domina-pro' ) ); ?></span></label>
				<input id="dom_name" class="contact-name" required maxlength="100" placeholder="<?php echo esc_attr( $name_placeholder ); ?>" type="text" name="dom_name" autocomplete="name">
			</div>

			<div class="mb13 domina-field">
				<label class="form-label<?php echo empty( $email_label ) ? ' screen-reader-text' : ''; ?>" for="dom_email"><span><?php echo esc_html( $email_label ?: __( 'ایمیل', 'domina-pro' ) ); ?></span></label>
				<input id="dom_email" class="contact-name" required maxlength="190" placeholder="<?php echo esc_attr( $email_placeholder ); ?>" type="email" name="dom_email" autocomplete="email" inputmode="email">
			</div>

			<div class="mb13 domina-field">
				<label class="form-label<?php echo empty( $subject_label ) ? ' screen-reader-text' : ''; ?>" for="dom_subject"><span><?php echo esc_html( $subject_label ?: __( 'موضوع', 'domina-pro' ) ); ?></span></label>
				<input id="dom_subject" class="contact-name" required maxlength="150" placeholder="<?php echo esc_attr( $sub_placeholder ); ?>" type="text" name="dom_subject">
			</div>

			<div class="mb13 domina-field">
				<label class="form-label<?php echo empty( $proposal_label ) ? ' screen-reader-text' : ''; ?>" for="dom_proposal"><span><?php echo esc_html( $proposal_label ?: __( 'پیام', 'domina-pro' ) ); ?></span></label>
				<textarea id="dom_proposal" name="dom_proposal" rows="4" maxlength="3000" class="contact-name field-message" placeholder="<?php echo esc_attr( $msg_placeholder ); ?>" required></textarea>
			</div>

			<input class="btn btn-default btn-filled" type="submit" name="dom_submitted" value="<?php echo esc_attr( $button_label ); ?>">
		</form>
		<?php
		return ob_get_clean();
	}

	/**
	 * Validate and deliver contact form mail.
	 */
	public function domina_deliver_mail() {
		$data = array(
			'type'        => '',
			'title'       => '',
			'description' => '',
			'okay'        => '',
		);

		$request_method = isset( $_SERVER['REQUEST_METHOD'] ) ? strtoupper( sanitize_text_field( wp_unslash( $_SERVER['REQUEST_METHOD'] ) ) ) : '';
		if ( 'POST' !== $request_method || ! isset( $_POST['dom_submitted'] ) ) {
			wp_localize_script( 'domina-custom', 'confirmation', $data );
			return;
		}

		$options = domina_pro_get_options();
		$get     = static function ( $key, $default = '' ) use ( $options ) {
			return array_key_exists( $key, $options ) ? $options[ $key ] : $default;
		};

		$error_title = sanitize_text_field( $get( 'dom_error-title', __( 'ارسال پیام انجام نشد', 'domina-pro' ) ) );
		$error_okay  = sanitize_text_field( $get( 'dom_error-okay', __( 'متوجه شدم', 'domina-pro' ) ) );

		$nonce = isset( $_POST['domina_contact_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['domina_contact_nonce'] ) ) : '';
		if ( ! $nonce || ! wp_verify_nonce( $nonce, 'domina_contact_submit' ) ) {
			$data = array(
				'type'        => 'error',
				'title'       => $error_title,
				'description' => __( 'درخواست معتبر نیست. صفحه را تازه‌سازی و دوباره تلاش کنید.', 'domina-pro' ),
				'okay'        => $error_okay,
			);
			wp_localize_script( 'domina-custom', 'confirmation', $data );
			return;
		}

		$honeypot = isset( $_POST['dom_website'] ) ? trim( sanitize_text_field( wp_unslash( $_POST['dom_website'] ) ) ) : '';
		if ( '' !== $honeypot ) {
			// Silently accept bot submissions without sending mail.
			$data = array(
				'type'        => 'success',
				'title'       => sanitize_text_field( $get( 'dom_success-title', __( 'پیام دریافت شد', 'domina-pro' ) ) ),
				'description' => sanitize_text_field( $get( 'dom_success-description', __( 'از پیام شما سپاسگزاریم.', 'domina-pro' ) ) ),
				'okay'        => '',
			);
			wp_localize_script( 'domina-custom', 'confirmation', $data );
			return;
		}

		$name    = isset( $_POST['dom_name'] ) ? sanitize_text_field( wp_unslash( $_POST['dom_name'] ) ) : '';
		$email   = isset( $_POST['dom_email'] ) ? sanitize_email( wp_unslash( $_POST['dom_email'] ) ) : '';
		$subject = isset( $_POST['dom_subject'] ) ? sanitize_text_field( wp_unslash( $_POST['dom_subject'] ) ) : '';
		$message = isset( $_POST['dom_proposal'] ) ? sanitize_textarea_field( wp_unslash( $_POST['dom_proposal'] ) ) : '';

		$name    = function_exists( 'mb_substr' ) ? mb_substr( $name, 0, 100 ) : substr( $name, 0, 100 );
		$subject = function_exists( 'mb_substr' ) ? mb_substr( $subject, 0, 150 ) : substr( $subject, 0, 150 );
		$message = function_exists( 'mb_substr' ) ? mb_substr( $message, 0, 3000 ) : substr( $message, 0, 3000 );

		if ( '' === $name || ! is_email( $email ) || '' === $subject || '' === $message ) {
			$data = array(
				'type'        => 'error',
				'title'       => $error_title,
				'description' => __( 'لطفاً همه فیلدها را با اطلاعات معتبر تکمیل کنید.', 'domina-pro' ),
				'okay'        => $error_okay,
			);
			wp_localize_script( 'domina-custom', 'confirmation', $data );
			return;
		}

		$ip         = domina_pro_get_client_ip();
		$rate_limit = absint( $get( 'dom_form_rate_limit', 60 ) );
		$rate_limit = min( max( $rate_limit, 10 ), HOUR_IN_SECONDS );
		$rate_key   = 'domina_form_' . hash_hmac( 'sha256', $ip ?: 'unknown', wp_salt( 'nonce' ) );

		if ( get_transient( $rate_key ) ) {
			$data = array(
				'type'        => 'error',
				'title'       => $error_title,
				'description' => __( 'پیام قبلی ثبت شده است. لطفاً کمی بعد دوباره تلاش کنید.', 'domina-pro' ),
				'okay'        => $error_okay,
			);
			wp_localize_script( 'domina-custom', 'confirmation', $data );
			return;
		}

		set_transient( $rate_key, 1, $rate_limit );

		$site_url = home_url( '/' );
		$date     = wp_date( 'Y-m-d H:i:s T' );
		$template = (string) $get(
			'dom_emaitemplate',
			"مدیر محترم،\nشما یک پیام از {from} ({email}) دارید.\n\nموضوع: {subject}\n\n{message}\n\nتاریخ: {date}\nIP: {ip}\nسایت: {siteURL}"
		);

		$variables = array( '{from}', '{subject}', '{email}', '{message}', '{siteURL}', '{date}', '{ip}', '{تاریخ}' );
		$values    = array( $name, $subject, $email, $message, $site_url, $date, $ip, $date );
		$text      = trim( str_replace( $variables, $values, wp_strip_all_tags( $template ) ) );

		$raw_targets = explode( ',', (string) $get( 'dom_targetemail', get_option( 'admin_email' ) ) );
		$targets     = array_values( array_filter( array_map( 'sanitize_email', $raw_targets ), 'is_email' ) );
		if ( empty( $targets ) ) {
			$targets = array( sanitize_email( get_option( 'admin_email' ) ) );
		}

		$host       = (string) wp_parse_url( home_url( '/' ), PHP_URL_HOST );
		$host       = preg_replace( '/^www\./i', '', $host );
		$from_email = sanitize_email( 'wordpress@' . $host );
		if ( ! is_email( $from_email ) ) {
			$from_email = sanitize_email( get_option( 'admin_email' ) );
		}

		$site_name = sanitize_text_field( wp_specialchars_decode( get_bloginfo( 'name' ), ENT_QUOTES ) );
		$headers   = array(
			'From: ' . $site_name . ' <' . $from_email . '>',
			'Reply-To: ' . $name . ' <' . $email . '>',
			'Content-Type: text/plain; charset=UTF-8',
		);

		if ( wp_mail( $targets, $subject, $text, $headers ) ) {
			$data = array(
				'type'        => 'success',
				'title'       => sanitize_text_field( $get( 'dom_success-title', __( 'پیام دریافت شد', 'domina-pro' ) ) ),
				'description' => sanitize_text_field( $get( 'dom_success-description', __( 'به‌زودی با شما تماس می‌گیریم.', 'domina-pro' ) ) ),
				'okay'        => '',
			);
		} else {
			delete_transient( $rate_key );
			$data = array(
				'type'        => 'error',
				'title'       => $error_title,
				'description' => sanitize_text_field( $get( 'dom_error-description', __( 'خطایی در سرویس ایمیل رخ داد. لطفاً دوباره تلاش کنید.', 'domina-pro' ) ) ),
				'okay'        => $error_okay,
			);
		}

		wp_localize_script( 'domina-custom', 'confirmation', $data );
	}

	public function dom_shortcode() {
		$this->domina_deliver_mail();
		return $this->domina_html_form_code();
	}
}
