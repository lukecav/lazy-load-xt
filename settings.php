<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class LazyLoadXTSettings {

	public function __construct() {
		add_action( 'admin_menu', array($this,'lazyloadxt_add_admin_menu') );
		add_action( 'admin_init', array($this,'lazyloadxt_settings_init') );
	}

	function lazyloadxt_add_admin_menu(  ) { 
		add_options_page( 'Lazy Load XT', 'Lazy Load XT', 'manage_options', 'lazyloadxt', array($this,'settings_page') );
	}


	function lazyloadxt_settings_init(  ) { 

		register_setting( 'addOns', 'lazyloadxt_settings' );

		add_settings_section(
			'lazyloadxt_general_section', 
			__( 'General Settings', 'lazy-load-xt' ), 
			array($this,'lazyloadxt_general_section_callback'), 
			'generalSettings'
		);

		add_settings_section(
			'lazyloadxt_effects_section', 
			__( 'Effects Settings', 'lazy-load-xt' ), 
			array($this,'lazyloadxt_effects_section_callback'), 
			'effects'
		);

		add_settings_section(
			'lazyloadxt_addons_section', 
			__( 'Add Ons Settings', 'lazy-load-xt' ), 
			array($this,'lazyloadxt_addons_section_callback'), 
			'addOns'
		);

		add_settings_field( 
			'lazyloadxt_minimize_scripts', 
			__( 'Load minimized scripts', 'lazy-load-xt' ), 
			array($this,'lazyloadxt_minimize_scripts_render'), 
			'generalSettings', 
			'lazyloadxt_general_section' 
		);

		add_settings_field( 
			'lazyloadxt_load_extras', 
			__( 'Load "extras" version', 'lazy-load-xt' ), 
			array($this,'lazyloadxt_load_extras_render'), 
			'generalSettings', 
			'lazyloadxt_general_section' 
		);

		add_settings_field( 
			'lazyloadxt_fade_in', 
			__( 'Fade objects in on load', 'lazy-load-xt' ), 
			array($this,'lazyloadxt_fade_in_render'), 
			'effects', 
			'lazyloadxt_effects_section' 
		);

		add_settings_field( 
			'Show spinner as objects are loading', 
			__( 'Settings field description', 'lazy-load-xt' ), 
			array($this,'lazyloadxt_spinner_render'), 
			'effects', 
			'lazyloadxt_effects_section' 
		);

		add_settings_field( 
			'lazyloadxt_script_based_tagging', 
			__( 'Script-based tagging', 'lazy-load-xt' ), 
			array($this,'lazyloadxt_script_based_tagging_render'), 
			'addOns', 
			'lazyloadxt_addons_section' 
		);

		add_settings_field( 
			'lazyloadxt_responsive_images', 
			__( 'Responsive images', 'lazy-load-xt' ), 
			array($this,'lazyloadxt_responsive_images_render'), 
			'addOns', 
			'lazyloadxt_addons_section' 
		);

		add_settings_field( 
			'lazyloadxt_print', 
			__( 'Print', 'lazy-load-xt' ), 
			array($this,'lazyloadxt_print_render'), 
			'addOns', 
			'lazyloadxt_addons_section' 
		);

		add_settings_field( 
			'lazyloadxt_background_image', 
			__( 'Lazy load background images', 'lazy-load-xt' ), 
			array($this,'lazyloadxt_background_image_render'), 
			'addOns', 
			'lazyloadxt_addons_section' 
		);

		add_settings_field( 
			'lazyloadxt_deferred_load', 
			__( 'Defer loading script', 'lazy-load-xt' ), 
			array($this,'lazyloadxt_deferred_load_render'), 
			'addOns', 
			'lazyloadxt_addons_section' 
		);


	}


	function lazyloadxt_minimize_scripts_render(  ) { 

		$options = get_option( 'lazyloadxt_general' );
		?>
		<input type='checkbox' name='lazyloadxt_general[lazyloadxt_minimize_scripts]' <?php checked( $options['lazyloadxt_minimize_scripts'], 1 ); ?> value='1'>
		<?php

	}


	function lazyloadxt_load_extras_render(  ) { 

		$options = get_option( 'lazyloadxt_general' );
		?>
		<input type='checkbox' name='lazyloadxt_general[lazyloadxt_load_extras]' <?php checked( $options['lazyloadxt_load_extras'], 1 ); ?> value='1'>
		<?php

	}


	function lazyloadxt_fade_in_render(  ) { 

		$options = get_option( 'lazyloadxt_effects' );
		?>
		<input type='checkbox' name='lazyloadxt_effects[lazyloadxt_fade_in]' <?php checked( $options['lazyloadxt_fade_in'], 1 ); ?> value='1'>
		<?php

	}


	function lazyloadxt_spinner_render(  ) { 

		$options = get_option( 'lazyloadxt_effects' );
		?>
		<input type='checkbox' name='lazyloadxt_effects[lazyloadxt_spinner]' <?php checked( $options['lazyloadxt_spinner'], 1 ); ?> value='1'>
		<?php

	}


	function lazyloadxt_script_based_tagging_render(  ) { 

		$options = get_option( 'lazyloadxt_addons' );
		?>
		<input type='checkbox' name='lazyloadxt_addons[lazyloadxt_script_based_tagging]' <?php checked( $options['lazyloadxt_script_based_tagging'], 1 ); ?> value='1'>
		<?php

	}


	function lazyloadxt_responsive_images_render(  ) { 

		$options = get_option( 'lazyloadxt_addons' );
		?>
		<input type='checkbox' name='lazyloadxt_addons[lazyloadxt_responsive_images]' <?php checked( $options['lazyloadxt_responsive_images'], 1 ); ?> value='1'>
		<?php

	}


	function lazyloadxt_print_render(  ) { 

		$options = get_option( 'lazyloadxt_addons' );
		?>
		<input type='checkbox' name='lazyloadxt_addons[lazyloadxt_print]' <?php checked( $options['lazyloadxt_print'], 1 ); ?> value='1'>
		<?php

	}


	function lazyloadxt_background_image_render(  ) { 

		$options = get_option( 'lazyloadxt_addons' );
		?>
		<input type='checkbox' name='lazyloadxt_addons[lazyloadxt_background_image]' <?php checked( $options['lazyloadxt_background_image'], 1 ); ?> value='1'>
		<?php

	}


	function lazyloadxt_deferred_load_render(  ) { 

		$options = get_option( 'lazyloadxt_addons' );
		?>
		<input type='checkbox' name='lazyloadxt_addons[lazyloadxt_deferred_load]' <?php checked( $options['lazyloadxt_deferred_load'], 1 ); ?> value='1'>
		<?php

	}


	function lazyloadxt_general_section_callback(  ) { 

		echo __( 'General section description', 'lazy-load-xt' );

	}

	function lazyloadxt_effects_section_callback(  ) { 

		echo __( 'Effects section description', 'lazy-load-xt' );

	}

	function lazyloadxt_addons_section_callback(  ) { 

		echo __( 'Plugin settings description', 'lazy-load-xt' );

	}


	function settings_page(  ) { 

		?>
		<form action='options.php' method='post'>
			
			<h2>Lazy Load XT</h2>
			
			<?php
			settings_fields( 'generalSettings' );
			do_settings_sections( 'generalSettings' );
			settings_fields( 'effects' );
			do_settings_sections( 'effects' );
			settings_fields( 'addOns' );
			do_settings_sections( 'addOns' );
			submit_button();
			?>
			
		</form>
		<?php

	}

}


