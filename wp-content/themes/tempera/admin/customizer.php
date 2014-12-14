<?php
/**
 * Contains methods for customizing the theme customization screen.
 * @since Tempera 1.2.4
 */

function tempera_customizer_setup($wp_customize) {
	class Tempera_Extended_Settings extends WP_Customize_Control {
		public $type = 'tempera_extended_link';
		public function render_content() {
			_e(
				sprintf('To configure the remaining 200+ theme options, access the dedicated %s page.',
						'<b><a href="themes.php?page=tempera-page">'.
							__('Tempera Settings','tempera').
						'</a></b>'),
						'tempera'
			);
		}
	}  // class
} // tempera_customizer_setup()

function tempera_generic_customizer_sanitize(){
	// dummy function that does nothing, since the sanitizer add_section function 
	// does not add any user-editable field
}
 
class Tempera_Customize {

   public static function register ( $wp_customize ) {
   
      $wp_customize->add_section( 'tempera_settings', 
         array(
            'title' => __( 'Tempera Advanced Settings', 'tempera' ), //Visible title of section
            'priority' => 999, //Determines what order this appears in
            'capability' => 'edit_theme_options', //Capability needed to tweak
            'description' => __('', 'tempera'), //Descriptive tooltip
         ) 
      );
        
      $wp_customize->add_setting( 'tempera_extended_link', 
         array(
            'default' => '#', //Default setting/value to save
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			'sanitize_callback' => 'tempera_generic_customizer_sanitize', //Sanitizer function callback
         ) 
      ); 	  

	  $wp_customize->add_control( new Tempera_Extended_Settings( 
		$wp_customize, 
		'tempera_extended_link', 
		array(
			'label'   => '',
			'section' => 'tempera_settings',
			'settings'   => 'tempera_extended_link',
		)
	  ) );
   
   }
 
}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register', 'tempera_customizer_setup' );
add_action( 'customize_register' , array( 'Tempera_Customize' , 'register' ) );

?>