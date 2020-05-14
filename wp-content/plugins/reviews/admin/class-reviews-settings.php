<?php

class Settings {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

  /**
	 * Admin settings page
	 *
	 * @since    1.0.0
	 */
	 public function aucor_add_options_page() {
		 add_menu_page( __( 'Aucor reviews settings' ), __( 'Aucor reviews settings' ), 'manage_options', 'aucor-reviews-settings', array( $this, 'aucor_display_options_page' ));
	 }

	 /**
	  * Admin settings page HTML
	  *
	  * @since    1.0.0
	  */
	 public function aucor_display_options_page() {
		 include_once 'partials/reviews-admin-display.php';
	 }

  /**
  * Register all related settings of this plugin
  *
  * @since  1.0.0
  */
 public function aucor_register_settings() {

   add_settings_section(
     'aucor_reviews_settings_section',
     __( 'Reviews Settings', 'aucor' ),
     '', // Callback
     'aucor-reviews-settings' // Settings page
   );

   add_settings_field(
     'aucor_display_score_field', // Slug for this
     __( 'Display score', 'aucor' ),
     array( $this, 'aucor_display_score_callback' ), // Callback
     'aucor-reviews-settings', // Settings page
     'aucor_reviews_settings_section', // Section belongs to
   );

   register_setting( 'aucor_reviews_settings', 'aucor_display_score', array( $this, 'aucor_sanitize_score' ) );

 }


 /**
 * Get the settings option array and print one of its values
 */
public function aucor_display_score_callback()
{
  $options = get_option( 'aucor_display_score' );

//var_dump($options);
  echo '<input id="aucor-display-score" name="aucor_display_score[aucor_display_score_field]" type="checkbox" value="1"'.
    ( isset( $options['aucor_display_score_field'] )  ? checked( $options['aucor_display_score_field'], 1, false ) : '' )
  .' />';
}

/**
* Sanitize
*/
public function aucor_sanitize_score( $input )
{
  $new_input = array();

  if ( isset( $input['aucor_display_score_field'] ) ) {
    $new_input['aucor_display_score_field'] = intval( $input['aucor_display_score_field'] );
  }

  return $input;
}



}
