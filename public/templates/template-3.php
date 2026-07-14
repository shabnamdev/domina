<?php
/**
 * Editorial Luxury template.
 *
 * @package Domina_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$options = domina_pro_get_options();
$get     = static function ( $key, $default = '' ) use ( $options ) {
	return array_key_exists( $key, $options ) ? $options[ $key ] : $default;
};

$site_title       = sanitize_text_field( $get( 'dom_sitetitle', get_bloginfo( 'name' ) ) );
$site_description = sanitize_text_field( $get( 'dom_sitedescription', get_bloginfo( 'description' ) ) );
$eyebrow          = sanitize_text_field( $get( 'dom_luxury_eyebrow', __( 'به‌روزرسانی برنامه‌ریزی‌شده', 'domina-pro' ) ) );
$luxury_title     = sanitize_text_field( $get( 'dom_luxury_title', __( 'در حال ساخت تجربه‌ای دقیق‌تر و ماندگارتر هستیم.', 'domina-pro' ) ) );
$luxury_subtitle  = sanitize_textarea_field( $get( 'dom_luxury_subtitle', __( 'وب‌سایت برای انجام به‌روزرسانی‌های فنی و بهبود تجربه کاربری، موقتاً در دسترس نیست. به‌زودی با کیفیتی بهتر بازمی‌گردیم.', 'domina-pro' ) ) );
$luxury_note      = sanitize_text_field( $get( 'dom_luxury_note', __( 'از شکیبایی و همراهی شما سپاسگزاریم.', 'domina-pro' ) ) );
$domain_name      = sanitize_text_field( $get( 'dom_domainname', wp_parse_url( home_url( '/' ), PHP_URL_HOST ) ) );
$form_title       = sanitize_text_field( $get( 'dom_formtitle', __( 'با ما در ارتباط باشید', 'domina-pro' ) ) );
$show_form        = domina_pro_is_truthy( $get( 'dom_luxury_show_form', true ), true );
$noindex          = domina_pro_is_truthy( $get( 'dom_noindex', true ), true );

$accent     = sanitize_hex_color( $get( 'dom_luxury_accent', '#b79862' ) );
$background = sanitize_hex_color( $get( 'dom_luxury_background', '#171713' ) );
$surface    = sanitize_hex_color( $get( 'dom_luxury_surface', '#f1ede4' ) );
$accent     = $accent ?: '#b79862';
$background = $background ?: '#171713';
$surface    = $surface ?: '#f1ede4';

$logo         = $get( 'dom_logo', array() );
$logo_url     = is_array( $logo ) && ! empty( $logo['url'] ) ? esc_url( $logo['url'] ) : '';
$logo_alt     = is_array( $logo ) && ! empty( $logo['alt'] ) ? sanitize_text_field( $logo['alt'] ) : $site_title;
$luxury_image = $get( 'dom_luxury_image', array() );
$image_url    = is_array( $luxury_image ) && ! empty( $luxury_image['url'] ) ? esc_url( $luxury_image['url'] ) : '';
$image_alt    = is_array( $luxury_image ) && ! empty( $luxury_image['alt'] ) ? sanitize_text_field( $luxury_image['alt'] ) : '';
$socials      = $get( 'dom_social_media', array() );
$contacts     = $get( 'dom_contact_info', array() );
$favicon      = esc_url( $get( 'dom_favicon', '' ) );
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo esc_html( $site_title ?: get_bloginfo( 'name' ) ); ?></title>
	<?php if ( $site_description ) : ?>
		<meta name="description" content="<?php echo esc_attr( $site_description ); ?>">
	<?php endif; ?>
	<?php if ( $noindex ) : ?>
		<meta name="robots" content="noindex,nofollow,noarchive">
	<?php endif; ?>
	<?php if ( $favicon ) : ?>
		<link rel="icon" href="<?php echo esc_url( $favicon ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>
<body class="domina-editorial-luxury" style="--del-accent: <?php echo esc_attr( $accent ); ?>; --del-bg: <?php echo esc_attr( $background ); ?>; --del-surface: <?php echo esc_attr( $surface ); ?>;">
<?php wp_body_open(); ?>

<?php if ( domina_pro_is_truthy( $get( 'dom_loader', true ), true ) ) : ?>
	<div class="loader-wrapper del-loader" aria-hidden="true">
		<div class="del-loader__mark"><span></span><span></span></div>
	</div>
<?php endif; ?>

<div class="del-shell">
	<div class="del-noise" aria-hidden="true"></div>
	<div class="del-orbit del-orbit--one" aria-hidden="true"></div>
	<div class="del-orbit del-orbit--two" aria-hidden="true"></div>

	<header class="del-header">
		<div class="del-brand" aria-label="<?php echo esc_attr( $site_title ); ?>">
			<?php if ( $logo_url ) : ?>
				<img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( $logo_alt ); ?>">
			<?php else : ?>
				<span class="del-brand__monogram" aria-hidden="true"><?php echo esc_html( function_exists( 'mb_substr' ) ? mb_substr( $site_title, 0, 1 ) : substr( $site_title, 0, 1 ) ); ?></span>
				<span class="del-brand__name"><?php echo esc_html( $site_title ); ?></span>
			<?php endif; ?>
		</div>

		<div class="del-status">
			<span class="del-status__dot" aria-hidden="true"></span>
			<span><?php echo esc_html( $eyebrow ); ?></span>
		</div>
	</header>

	<main class="del-main">
		<section class="del-story" aria-labelledby="del-title">
			<div class="del-kicker">
				<span class="del-kicker__line" aria-hidden="true"></span>
				<span><?php echo esc_html( $domain_name ); ?></span>
			</div>

			<h1 id="del-title"><?php echo esc_html( $luxury_title ); ?></h1>
			<p class="del-lead"><?php echo nl2br( esc_html( $luxury_subtitle ) ); ?></p>

			<div class="del-signature">
				<span class="del-signature__mark" aria-hidden="true">D</span>
				<div>
					<strong><?php echo esc_html( $site_title ); ?></strong>
					<span><?php echo esc_html( $luxury_note ); ?></span>
				</div>
			</div>

			<?php if ( is_array( $socials ) && ! empty( $socials ) ) : ?>
				<nav class="del-social" aria-label="<?php esc_attr_e( 'شبکه‌های اجتماعی', 'domina-pro' ); ?>">
					<?php foreach ( $socials as $social ) :
						$url  = isset( $social['social_link'] ) ? esc_url( $social['social_link'] ) : '';
						$icon = isset( $social['social_icon'] ) ? sanitize_html_class( str_replace( ' ', '-', $social['social_icon'] ) ) : '';
						if ( ! $url ) {
							continue;
						}
						$host = wp_parse_url( $url, PHP_URL_HOST );
						$label = $host ? $host : __( 'شبکه اجتماعی', 'domina-pro' );
						?>
						<a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( $label ); ?>">
							<span aria-hidden="true">↗</span>
							<?php echo esc_html( preg_replace( '/^www\./i', '', (string) $label ) ); ?>
						</a>
					<?php endforeach; ?>
				</nav>
			<?php endif; ?>
		</section>

		<aside class="del-card" aria-label="<?php echo esc_attr( $form_title ); ?>">
			<div class="del-card__media<?php echo $image_url ? ' has-image' : ''; ?>">
				<?php if ( $image_url ) : ?>
					<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
				<?php else : ?>
					<div class="del-card__abstract" aria-hidden="true">
						<span></span><span></span><span></span>
					</div>
				<?php endif; ?>
				<span class="del-card__index" aria-hidden="true">01</span>
			</div>

			<div class="del-card__body">
				<div class="del-card__heading">
					<span><?php esc_html_e( 'ارتباط مستقیم', 'domina-pro' ); ?></span>
					<h2><?php echo esc_html( $form_title ); ?></h2>
				</div>

				<?php if ( $show_form ) : ?>
					<?php echo do_shortcode( '[dom_contact_form]' ); ?>
				<?php elseif ( is_array( $contacts ) && ! empty( $contacts ) ) : ?>
					<ul class="del-contact-list">
						<?php foreach ( $contacts as $contact ) :
							$value = isset( $contact['info_name'] ) ? sanitize_text_field( $contact['info_name'] ) : '';
							if ( ! $value ) {
								continue;
							}
							?>
							<li><span aria-hidden="true">—</span><?php echo esc_html( $value ); ?></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		</aside>
	</main>

	<footer class="del-footer">
		<span><?php echo esc_html( wp_date( 'Y' ) ); ?> © <?php echo esc_html( $site_title ); ?></span>
		<span class="del-footer__rule" aria-hidden="true"></span>
		<span><?php esc_html_e( 'با دقت، آرامش و احترام به زمان شما', 'domina-pro' ); ?></span>
	</footer>
</div>

<?php wp_footer(); ?>
</body>
</html>
