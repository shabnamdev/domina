<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: background
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'DOM_Field_background' ) ) {
  class DOM_Field_background extends DOM_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $args                             = wp_parse_args( $this->field, array(
        'background_color'              => true,
        'background_image'              => true,
        'background_position'           => true,
        'background_repeat'             => true,
        'background_attachment'         => true,
        'background_size'               => true,
        'background_origin'             => false,
        'background_clip'               => false,
        'background_blend_mode'         => false,
        'background_gradient'           => false,
        'background_gradient_color'     => true,
        'background_gradient_direction' => true,
        'background_image_preview'      => true,
        'background_auto_attributes'    => false,
        'compact'                       => false,
        'background_image_library'      => 'image',
        'background_image_placeholder'  => esc_html__( 'Not selected', 'domina-pro' ),
      ) );

      if ( $args['compact'] ) {
        $args['background_color']           = false;
        $args['background_auto_attributes'] = true;
      }

      $default_value                    = array(
        'background-color'              => '',
        'background-image'              => '',
        'background-position'           => '',
        'background-repeat'             => '',
        'background-attachment'         => '',
        'background-size'               => '',
        'background-origin'             => '',
        'background-clip'               => '',
        'background-blend-mode'         => '',
        'background-gradient-color'     => '',
        'background-gradient-direction' => '',
      );

      $default_value = ( ! empty( $this->field['default'] ) ) ? wp_parse_args( $this->field['default'], $default_value ) : $default_value;

      $this->value = wp_parse_args( $this->value, $default_value );

      echo $this->field_before();

      echo '<div class="dom--background-colors">';

      //
      // Background Color
      if ( ! empty( $args['background_color'] ) ) {

        echo '<div class="dom--color">';

        echo ( ! empty( $args['background_gradient'] ) ) ? '<div class="dom--title">'. esc_html__( 'From', 'domina-pro' ) .'</div>' : '';

        DOM::field( array(
          'id'      => 'background-color',
          'type'    => 'color',
          'default' => $default_value['background-color'],
        ), $this->value['background-color'], $this->field_name(), 'field/background' );

        echo '</div>';

      }

      //
      // Background Gradient Color
      if ( ! empty( $args['background_gradient_color'] ) && ! empty( $args['background_gradient'] ) ) {

        echo '<div class="dom--color">';

        echo ( ! empty( $args['background_gradient'] ) ) ? '<div class="dom--title">'. esc_html__( 'To', 'domina-pro' ) .'</div>' : '';

        DOM::field( array(
          'id'      => 'background-gradient-color',
          'type'    => 'color',
          'default' => $default_value['background-gradient-color'],
        ), $this->value['background-gradient-color'], $this->field_name(), 'field/background' );

        echo '</div>';

      }

      //
      // Background Gradient Direction
      if ( ! empty( $args['background_gradient_direction'] ) && ! empty( $args['background_gradient'] ) ) {

        echo '<div class="dom--color">';

        echo ( ! empty( $args['background_gradient'] ) ) ? '<div class="dom---title">'. esc_html__( 'Direction', 'domina-pro' ) .'</div>' : '';

        DOM::field( array(
          'id'          => 'background-gradient-direction',
          'type'        => 'select',
          'options'     => array(
            ''          => esc_html__( 'Gradient Direction', 'domina-pro' ),
            'to bottom' => esc_html__( '&#8659; top to bottom', 'domina-pro' ),
            'to right'  => esc_html__( '&#8658; left to right', 'domina-pro' ),
            '135deg'    => esc_html__( '&#8664; corner top to right', 'domina-pro' ),
            '-135deg'   => esc_html__( '&#8665; corner top to left', 'domina-pro' ),
          ),
        ), $this->value['background-gradient-direction'], $this->field_name(), 'field/background' );

        echo '</div>';

      }

      echo '</div>';

      //
      // Background Image
      if ( ! empty( $args['background_image'] ) ) {

        echo '<div class="dom--background-image">';

        DOM::field( array(
          'id'          => 'background-image',
          'type'        => 'media',
          'class'       => 'dom-assign-field-background',
          'library'     => $args['background_image_library'],
          'preview'     => $args['background_image_preview'],
          'placeholder' => $args['background_image_placeholder'],
          'attributes'  => array( 'data-depend-id' => $this->field['id'] ),
        ), $this->value['background-image'], $this->field_name(), 'field/background' );

        echo '</div>';

      }

      $auto_class   = ( ! empty( $args['background_auto_attributes'] ) ) ? ' dom--auto-attributes' : '';
      $hidden_class = ( ! empty( $args['background_auto_attributes'] ) && empty( $this->value['background-image']['url'] ) ) ? ' dom--attributes-hidden' : '';

      echo '<div class="dom--background-attributes'. esc_attr( $auto_class . $hidden_class ) .'">';

      //
      // Background Position
      if ( ! empty( $args['background_position'] ) ) {

        DOM::field( array(
          'id'              => 'background-position',
          'type'            => 'select',
          'options'         => array(
            ''              => esc_html__( 'Background Position', 'domina-pro' ),
            'left top'      => esc_html__( 'Left Top', 'domina-pro' ),
            'left center'   => esc_html__( 'Left Center', 'domina-pro' ),
            'left bottom'   => esc_html__( 'Left Bottom', 'domina-pro' ),
            'center top'    => esc_html__( 'Center Top', 'domina-pro' ),
            'center center' => esc_html__( 'Center Center', 'domina-pro' ),
            'center bottom' => esc_html__( 'Center Bottom', 'domina-pro' ),
            'right top'     => esc_html__( 'Right Top', 'domina-pro' ),
            'right center'  => esc_html__( 'Right Center', 'domina-pro' ),
            'right bottom'  => esc_html__( 'Right Bottom', 'domina-pro' ),
          ),
        ), $this->value['background-position'], $this->field_name(), 'field/background' );

      }

      //
      // Background Repeat
      if ( ! empty( $args['background_repeat'] ) ) {

        DOM::field( array(
          'id'          => 'background-repeat',
          'type'        => 'select',
          'options'     => array(
            ''          => esc_html__( 'Background Repeat', 'domina-pro' ),
            'repeat'    => esc_html__( 'Repeat', 'domina-pro' ),
            'no-repeat' => esc_html__( 'No Repeat', 'domina-pro' ),
            'repeat-x'  => esc_html__( 'Repeat Horizontally', 'domina-pro' ),
            'repeat-y'  => esc_html__( 'Repeat Vertically', 'domina-pro' ),
          ),
        ), $this->value['background-repeat'], $this->field_name(), 'field/background' );

      }

      //
      // Background Attachment
      if ( ! empty( $args['background_attachment'] ) ) {

        DOM::field( array(
          'id'       => 'background-attachment',
          'type'     => 'select',
          'options'  => array(
            ''       => esc_html__( 'Background Attachment', 'domina-pro' ),
            'scroll' => esc_html__( 'Scroll', 'domina-pro' ),
            'fixed'  => esc_html__( 'Fixed', 'domina-pro' ),
          ),
        ), $this->value['background-attachment'], $this->field_name(), 'field/background' );

      }

      //
      // Background Size
      if ( ! empty( $args['background_size'] ) ) {

        DOM::field( array(
          'id'        => 'background-size',
          'type'      => 'select',
          'options'   => array(
            ''        => esc_html__( 'Background Size', 'domina-pro' ),
            'cover'   => esc_html__( 'Cover', 'domina-pro' ),
            'contain' => esc_html__( 'Contain', 'domina-pro' ),
            'auto'    => esc_html__( 'Auto', 'domina-pro' ),
          ),
        ), $this->value['background-size'], $this->field_name(), 'field/background' );

      }

      //
      // Background Origin
      if ( ! empty( $args['background_origin'] ) ) {

        DOM::field( array(
          'id'            => 'background-origin',
          'type'          => 'select',
          'options'       => array(
            ''            => esc_html__( 'Background Origin', 'domina-pro' ),
            'padding-box' => esc_html__( 'Padding Box', 'domina-pro' ),
            'border-box'  => esc_html__( 'Border Box', 'domina-pro' ),
            'content-box' => esc_html__( 'Content Box', 'domina-pro' ),
          ),
        ), $this->value['background-origin'], $this->field_name(), 'field/background' );

      }

      //
      // Background Clip
      if ( ! empty( $args['background_clip'] ) ) {

        DOM::field( array(
          'id'            => 'background-clip',
          'type'          => 'select',
          'options'       => array(
            ''            => esc_html__( 'Background Clip', 'domina-pro' ),
            'border-box'  => esc_html__( 'Border Box', 'domina-pro' ),
            'padding-box' => esc_html__( 'Padding Box', 'domina-pro' ),
            'content-box' => esc_html__( 'Content Box', 'domina-pro' ),
          ),
        ), $this->value['background-clip'], $this->field_name(), 'field/background' );

      }

      //
      // Background Blend Mode
      if ( ! empty( $args['background_blend_mode'] ) ) {

        DOM::field( array(
          'id'            => 'background-blend-mode',
          'type'          => 'select',
          'options'       => array(
            ''            => esc_html__( 'Background Blend Mode', 'domina-pro' ),
            'normal'      => esc_html__( 'Normal', 'domina-pro' ),
            'multiply'    => esc_html__( 'Multiply', 'domina-pro' ),
            'screen'      => esc_html__( 'Screen', 'domina-pro' ),
            'overlay'     => esc_html__( 'Overlay', 'domina-pro' ),
            'darken'      => esc_html__( 'Darken', 'domina-pro' ),
            'lighten'     => esc_html__( 'Lighten', 'domina-pro' ),
            'color-dodge' => esc_html__( 'Color Dodge', 'domina-pro' ),
            'saturation'  => esc_html__( 'Saturation', 'domina-pro' ),
            'color'       => esc_html__( 'Color', 'domina-pro' ),
            'luminosity'  => esc_html__( 'Luminosity', 'domina-pro' ),
          ),
        ), $this->value['background-blend-mode'], $this->field_name(), 'field/background' );

      }

      echo '</div>';

      echo $this->field_after();

    }

    public function output() {

      $output    = '';
      $bg_image  = array();
      $important = ( ! empty( $this->field['output_important'] ) ) ? '!important' : '';
      $element   = ( is_array( $this->field['output'] ) ) ? join( ',', $this->field['output'] ) : $this->field['output'];

      // Background image and gradient
      $background_color        = ( ! empty( $this->value['background-color']              ) ) ? $this->value['background-color']              : '';
      $background_gd_color     = ( ! empty( $this->value['background-gradient-color']     ) ) ? $this->value['background-gradient-color']     : '';
      $background_gd_direction = ( ! empty( $this->value['background-gradient-direction'] ) ) ? $this->value['background-gradient-direction'] : '';
      $background_image        = ( ! empty( $this->value['background-image']['url']       ) ) ? $this->value['background-image']['url']       : '';


      if ( $background_color && $background_gd_color ) {
        $gd_direction   = ( $background_gd_direction ) ? $background_gd_direction .',' : '';
        $bg_image[] = 'linear-gradient('. $gd_direction . $background_color .','. $background_gd_color .')';
        unset( $this->value['background-color'] );
      }

      if ( $background_image ) {
        $bg_image[] = 'url('. $background_image .')';
      }

      if ( ! empty( $bg_image ) ) {
        $output .= 'background-image:'. implode( ',', $bg_image ) . $important .';';
      }

      // Common background properties
      $properties = array( 'color', 'position', 'repeat', 'attachment', 'size', 'origin', 'clip', 'blend-mode' );

      foreach ( $properties as $property ) {
        $property = 'background-'. $property;
        if ( ! empty( $this->value[$property] ) ) {
          $output .= $property .':'. $this->value[$property] . $important .';';
        }
      }

      if ( $output ) {
        $output = $element .'{'. $output .'}';
      }

      $this->parent->output_css .= $output;

      return $output;

    }

  }
}
