<?php
/**
 * Classic split template.
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

$feature_list = $get( 'dom_feature_list', array() );
$socials      = $get( 'dom_social_media', array() );
$features     = $get( 'dom_features', array() );
$logo         = $get( 'dom_logo', array() );
$right_image  = $get( 'dom_right_image', array() );
$logo_url     = is_array( $logo ) && ! empty( $logo['url'] ) ? $logo['url'] : '';
$logo_alt     = is_array( $logo ) && ! empty( $logo['alt'] ) ? $logo['alt'] : get_bloginfo( 'name' );
$image_url    = is_array( $right_image ) && ! empty( $right_image['url'] ) ? $right_image['url'] : '';
$image_alt    = is_array( $right_image ) && ! empty( $right_image['alt'] ) ? $right_image['alt'] : '';
$site_title   = sanitize_text_field( $get( 'dom_sitetitle', get_bloginfo( 'name' ) ) );
$description  = sanitize_text_field( $get( 'dom_sitedescription', get_bloginfo( 'description' ) ) );
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
<body class="demo-1 loading">
<?php wp_body_open(); ?>

<?php if ( domina_pro_is_truthy( $get( 'dom_loader', true ), true ) ) : ?>
	<div class="loader-wrapper" aria-hidden="true"><div class="loader"></div></div>
<?php endif; ?>

<main>
	<div class="content content--intro">
		<div class="content__inner">
			<section class="hero-area">
				<header class="position-relative header-area p-25px-t">
					<div class="container"><div class="row"><div class="col-lg-12">
						<?php if ( $logo_url ) : ?><img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( $logo_alt ); ?>"><?php endif; ?>
					</div></div></div>
				</header>
				<div class="left-shape primary-bg"></div>
				<div class="container">
					<div class="row full-height align-items-center">
						<div class="col-lg-6 p-50px-t p-50px-b md-p-10px-b">
							<?php if ( $get( 'dom_domainname' ) || $get( 'dom_saletitle' ) ) : ?>
								<h2 class="m-25px-b"><span class="domain-name"><?php echo esc_html( $get( 'dom_domainname' ) ); ?></span><br><span class="domain-offer"><?php echo esc_html( $get( 'dom_saletitle' ) ); ?></span></h2>
							<?php endif; ?>
							<?php if ( $get( 'dom_content' ) ) : ?><div class="m-25px-b"><?php echo wp_kses_post( $get( 'dom_content' ) ); ?></div><?php endif; ?>
							<?php if ( is_array( $feature_list ) && $feature_list ) : ?>
								<ul class="feature-list">
									<?php foreach ( $feature_list as $feature ) : if ( empty( $feature['feature_text'] ) ) { continue; } ?>
										<li><?php echo esc_html( $feature['feature_text'] ); ?></li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
							<?php if ( $get( 'dom_pricetag' ) ) : ?>
								<div class="hero-btn-wrapper"><span class="domain-offering"><?php echo wp_kses_post( $get( 'dom_pricetag' ) ); ?></span><a class="btn btn-default enter" href="#domina-offer"><?php echo esc_html( $get( 'dom_offer_btn', __( 'پیشنهاد بدهید', 'domina-pro' ) ) ); ?></a></div>
							<?php endif; ?>
							<?php if ( is_array( $socials ) && $socials ) : ?>
								<ul class="social-links" aria-label="<?php esc_attr_e( 'شبکه‌های اجتماعی', 'domina-pro' ); ?>">
									<?php foreach ( $socials as $social ) :
										$url = isset( $social['social_link'] ) ? esc_url( $social['social_link'] ) : '';
										if ( ! $url ) { continue; }
										$host = wp_parse_url( $url, PHP_URL_HOST );
										?>
										<li><a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( $host ?: __( 'شبکه اجتماعی', 'domina-pro' ) ); ?>"><i aria-hidden="true" class="<?php echo esc_attr( isset( $social['social_icon'] ) ? $social['social_icon'] : '' ); ?>"></i></a></li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
						</div>
						<?php if ( $image_url ) : ?>
							<div class="col-lg-6 p-50px-t p-50px-b md-p-10px-t text-lg-right text-center"><img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>"></div>
						<?php endif; ?>
					</div>
				</div>
				<svg height="0" width="0" aria-hidden="true"><clipPath id="svgPath"><path d="M215,100.3c97.8-32.6,90.5-71.9,336-77.6c92.4-2.1,98.1,81.6,121.8,116.4c101.7,149.9,53.5,155.9,14.7,178c-96.4,54.9,5.4,269-257,115.1c-57-33.5-203,46.3-263.7,20.1c-33.5-14.5-132.5-45.5-95-111.1C125.9,246.6,98.6,139.1,215,100.3z"></path></clipPath></svg>
			</section>
		</div>
		<div class="shape-wrap" aria-hidden="true"><svg class="shape" width="100%" height="100vh" preserveAspectRatio="none" viewBox="0 0 1440 800"><path d="M -44,-50 C -52.71,28.52 15.86,8.186 184,14.69 383.3,22.39 462.5,12.58 638,14 835.5,15.6 987,6.4 1194,13.86 1661,30.68 1652,-36.74 1582,-140.1 1512,-243.5 15.88,-589.5 -44,-50 Z" pathdata:id="M -44,-50 C -137.1,117.4 67.86,445.5 236,452 435.3,459.7 500.5,242.6 676,244 873.5,245.6 957,522.4 1154,594 1593,753.7 1793,226.3 1582,-126 1371,-478.3 219.8,-524.2 -44,-50 Z"></path></svg></div>
	</div>

	<div id="domina-offer" class="content content--fixed">
		<div class="content__inner">
			<div class="left-shape primary-bg"></div>
			<div class="container"><div class="row full-height align-items-center position-relative">
				<?php if ( $get( 'dom_domainname' ) ) : ?><h1 class="text-bg"><?php echo esc_html( $get( 'dom_domainname' ) ); ?></h1><?php endif; ?>
				<div class="col-md-12 p-50px-t p-50px-b md-p-10px-b">
					<?php if ( $get( 'dom_formtitle' ) ) : ?><div class="hero-area text-center"><h1 class="m-50px-b lg-m-25px-b"><span class="domain-offer"><?php echo esc_html( $get( 'dom_formtitle' ) ); ?></span></h1></div><?php endif; ?>
					<div class="row"><div class="offset-sm-1 col-sm-10">
						<div class="offer-form-wrap shadow-1 p-50px sm-p-15px m-15px-b"><?php echo do_shortcode( '[dom_contact_form]' ); ?></div>
						<?php if ( is_array( $features ) && $features ) : ?><ul class="domain-feature"><?php foreach ( $features as $feature ) : if ( ! empty( $feature['dom_feature'] ) ) : ?><li><?php echo esc_html( $feature['dom_feature'] ); ?></li><?php endif; endforeach; ?></ul><?php endif; ?>
					</div></div>
				</div>
			</div></div>
			<a class="next-demo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( $get( 'dom_back_home', __( 'بازگشت', 'domina-pro' ) ) ); ?> <i aria-hidden="true" class="fas fa-arrow-right"></i></a>
		</div>
	</div>
</main>
<?php wp_footer(); ?>
</body>
</html>
