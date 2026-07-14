<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: icon
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'DOM_Field_icon' ) ) {
  class DOM_Field_icon extends DOM_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $args = wp_parse_args( $this->field, array(
        'button_title' => esc_html__( 'Add Icon', 'domina-pro' ),
        'remove_title' => esc_html__( 'Remove Icon', 'domina-pro' ),
      ) );

      echo $this->field_before();

      $nonce  = wp_create_nonce( 'dom_icon_nonce' );
      $hidden = ( empty( $this->value ) ) ? ' hidden' : '';

      echo '<div class="dom-icon-select">';
      echo '<span class="dom-icon-preview'. esc_attr( $hidden ) .'"><i class="'. esc_attr( $this->value ) .'"></i></span>';
      echo '<a href="#" class="button button-primary dom-icon-add" data-nonce="'. esc_attr( $nonce ) .'">'. $args['button_title'] .'</a>';
      echo '<a href="#" class="button dom-warning-primary dom-icon-remove'. esc_attr( $hidden ) .'">'. $args['remove_title'] .'</a>';
      echo '<input type="hidden" name="'. esc_attr( $this->field_name() ) .'" value="'. esc_attr( $this->value ) .'" class="dom-icon-value"'. $this->field_attributes() .' />';
      echo '</div>';

      echo $this->field_after();

    }

    public function enqueue() {
      add_action( 'admin_footer', array( 'DOM_Field_icon', 'add_footer_modal_icon' ) );
      add_action( 'customize_controls_print_footer_scripts', array( 'DOM_Field_icon', 'add_footer_modal_icon' ) );
    }

    public static function add_footer_modal_icon() {
    ?>
      <div id="dom-modal-icon" class="dom-modal dom-modal-icon hidden">
        <div class="dom-modal-table">
          <div class="dom-modal-table-cell">
            <div class="dom-modal-overlay"></div>
            <div class="dom-modal-inner">
              <div class="dom-modal-title">
                <?php esc_html_e( 'Add Icon', 'domina-pro' ); ?>
                <div class="dom-modal-close dom-icon-close"></div>
              </div>
              <div class="dom-modal-header">
                <input type="text" placeholder="<?php esc_html_e( 'Search...', 'domina-pro' ); ?>" class="dom-icon-search" />
              </div>
              <div class="dom-modal-content">
                <div class="dom-modal-loading"><div class="dom-loading"></div></div>
                <div class="dom-modal-load"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php
    }

  }
}
