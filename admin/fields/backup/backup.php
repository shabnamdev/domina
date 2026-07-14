<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: backup
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'DOM_Field_backup' ) ) {
  class DOM_Field_backup extends DOM_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $unique = $this->unique;
      $nonce  = wp_create_nonce( 'dom_backup_nonce' );
      $export = add_query_arg( array( 'action' => 'dom-export', 'unique' => $unique, 'nonce' => $nonce ), admin_url( 'admin-ajax.php' ) );

      echo $this->field_before();

      echo '<textarea name="dom_import_data" class="dom-import-data"></textarea>';
      echo '<button type="submit" class="button button-primary dom-confirm dom-import" data-unique="'. esc_attr( $unique ) .'" data-nonce="'. esc_attr( $nonce ) .'">'. esc_html__( 'Import', 'domina-pro' ) .'</button>';
      echo '<hr />';
      echo '<textarea readonly="readonly" class="dom-export-data">'. esc_attr( json_encode( get_option( $unique ) ) ) .'</textarea>';
      echo '<a href="'. esc_url( $export ) .'" class="button button-primary dom-export" target="_blank">'. esc_html__( 'Export & Download', 'domina-pro' ) .'</a>';
      echo '<hr />';
      echo '<button type="submit" name="dom_transient[reset]" value="reset" class="button dom-warning-primary dom-confirm dom-reset" data-unique="'. esc_attr( $unique ) .'" data-nonce="'. esc_attr( $nonce ) .'">'. esc_html__( 'Reset', 'domina-pro' ) .'</button>';

      echo $this->field_after();

    }

  }
}
