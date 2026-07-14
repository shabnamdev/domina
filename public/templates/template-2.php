<?php
/**
 * Two-column particle template.
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
$contacts    = $get( 'dom_contact_info', array() );
$socials     = $get( 'dom_social_media', array() );
$features    = $get( 'dom_features', array() );
$logo        = $get( 'dom_logo', array() );
$logo_url    = is_array( $logo ) && ! empty( $logo['url'] ) ? $logo['url'] : '';
$logo_alt    = is_array( $logo ) && ! empty( $logo['alt'] ) ? $logo['alt'] : get_bloginfo( 'name' );
$site_title  = sanitize_text_field( $get( 'dom_sitetitle', get_bloginfo( 'name' ) ) );
$description = sanitize_text_field( $get( 'dom_sitedescription', get_bloginfo( 'description' ) ) );
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo esc_html( $site_title ); ?></title>
	<?php if ( $description ) : ?><meta name="description" content="<?php echo esc_attr( $description ); ?>"><?php endif; ?>
	<?php if ( domina_pro_is_truthy( $get( 'dom_noindex', true ), true ) ) : ?><meta name="robots" content="noindex,nofollow,noarchive"><?php endif; ?>
	<?php if ( $get( 'dom_favicon' ) ) : ?><link rel="icon" href="<?php echo esc_url( $get( 'dom_favicon' ) ); ?>"><?php endif; ?>
	<?php wp_head(); ?>
</head>
<body>
<?php wp_body_open(); ?>
<?php if ( domina_pro_is_truthy( $get( 'dom_loader', true ), true ) ) : ?><div class="loader-wrapper" aria-hidden="true"><div class="loader"></div></div><?php endif; ?>

<section class="hero-area position-relative" dir="<?php echo is_rtl() ? 'rtl' : 'ltr'; ?>">
	<div class="left-bg-area bg-area"></div>
	<div id="particles" class="right-bg-area bg-area" aria-hidden="true"></div>
	<div class="container">
		<div class="row position-absolute m-20px-t"><div class="col-sm-12"><?php if ( $logo_url ) : ?><img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( $logo_alt ); ?>"><?php endif; ?></div></div>
		<div class="row full-height align-items-center">
			<div class="col-md-6 p-100px-t p-50px-b light-text">
				<?php if ( $get( 'dom_domainname' ) || $get( 'dom_saletitle' ) ) : ?><h2 class="m-25px-b"><span class="domain-name"><?php echo esc_html( $get( 'dom_domainname' ) ); ?></span><br><span class="domain-offer"><?php echo esc_html( $get( 'dom_saletitle' ) ); ?></span></h2><?php endif; ?>
				<?php if ( $get( 'dom_content' ) ) : ?><div class="m-25px-b"><?php echo wp_kses_post( $get( 'dom_content' ) ); ?></div><?php endif; ?>
				<?php if ( $get( 'make_an_offer' ) ) : ?><p><strong><?php echo esc_html( $get( 'make_an_offer' ) ); ?></strong></p><?php endif; ?>
				<?php if ( $get( 'dom_pricetag' ) ) : ?><div class="domain-offering domain-offering-fill"><?php echo wp_kses_post( $get( 'dom_pricetag' ) ); ?></div><?php endif; ?>
				<?php if ( is_array( $contacts ) && $contacts ) : ?><div class="contact-info"><?php foreach ( $contacts as $contact ) : if ( empty( $contact['info_name'] ) ) { continue; } ?><p><i aria-hidden="true" class="<?php echo esc_attr( isset( $contact['info_icon'] ) ? $contact['info_icon'] : '' ); ?>"></i>&nbsp;<?php echo esc_html( $contact['info_name'] ); ?></p><?php endforeach; ?></div><?php endif; ?>
				<?php if ( is_array( $socials ) && $socials ) : ?><ul class="social-links" aria-label="<?php esc_attr_e( 'شبکه‌های اجتماعی', 'domina-pro' ); ?>"><?php foreach ( $socials as $social ) : $url = isset( $social['social_link'] ) ? esc_url( $social['social_link'] ) : ''; if ( ! $url ) { continue; } $host = wp_parse_url( $url, PHP_URL_HOST ); ?><li><a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( $host ?: __( 'شبکه اجتماعی', 'domina-pro' ) ); ?>"><i aria-hidden="true" class="<?php echo esc_attr( isset( $social['social_icon'] ) ? $social['social_icon'] : '' ); ?>"></i></a></li><?php endforeach; ?></ul><?php endif; ?>
			</div>
			<div class="col-md-6 p-100px-t p-50px-b md-p-0px-t hero-right">
				<div class="hero-area text-center m-50px-b sm-m-25px-b">
					<h1 class="m-15px-b md-color-light"><?php echo esc_html( $get( 'dom_formtitle', __( 'با ما در ارتباط باشید', 'domina-pro' ) ) ); ?></h1>
					<?php if ( is_array( $features ) && $features ) : ?><ul class="domain-feature md-color-light"><?php foreach ( $features as $feature ) : if ( ! empty( $feature['dom_feature'] ) ) : ?><li><?php echo esc_html( $feature['dom_feature'] ); ?></li><?php endif; endforeach; ?></ul><?php endif; ?>
				</div>
				<div class="row"><div class="col-sm-12"><div class="offer-form-wrap"><?php echo do_shortcode( '[dom_contact_form]' ); ?></div></div></div>
			</div>
		</div>
	</div>
</section>
<?php wp_footer(); ?>
</body>
</html>
