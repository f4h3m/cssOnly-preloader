<?php

class csspreloader_Settings_Page {
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'csspreloader_create_settings' ) );
		add_action( 'admin_init', array( $this, 'csspreloader_setup_sections' ) );
		add_action( 'admin_init', array( $this, 'csspreloader_setup_fields' ) );
	}


	public function csspreloader_create_settings() {
		$page_title = __( 'Css Preloader', 'cssonly-preloader' );
		$menu_title = __( 'Css Preloader', 'cssonly-preloader' );
		$capability = 'manage_options';
		$slug       = 'csspreloader';
		$callback   = array( $this, 'csspreloader_settings_content' );
		add_options_page( $page_title, $menu_title, $capability, $slug, $callback );
	}

	public function csspreloader_settings_content() { ?>
        <div class="wrap">
            <h1>Css Only Preloader</h1>
            <p>Paste your HTML and CSS codes of your preloader.</p>
            <form method="POST" action="options.php">
				<?php
				settings_fields( 'csspreloader' );
				do_settings_sections( 'csspreloader' );
				submit_button();
				?>
            </form>
        </div> <?php
	}

	public function csspreloader_setup_sections() {
		add_settings_section( 'csspreloader_section', '', array(), 'csspreloader' );
	}

	public function csspreloader_setup_fields() {
		$fields = array(
			array(
				'label'   => __( 'HTML Code', 'cssonly-preloader' ),
				'id'      => 'csspreloader_html',
				'type'    => 'textarea',
				'section' => 'csspreloader_section'
			),
            array(
                'label'   => __( 'CSS Style', 'cssonly-preloader'),
                'id'      => 'csspreloader_css',
                'type'    => 'textarea',
                'section' => 'csspreloader_section'
            )

		);
		foreach ( $fields as $field ) {
			add_settings_field( $field['id'], $field['label'], array(
				$this,
				'csspreloader_field_callback'
			), 'csspreloader', $field['section'], $field );
			register_setting( 'csspreloader', $field['id']);
		}
	}

	public function csspreloader_field_callback( $field ) {
		$value = get_option( $field['id'] );

		if($field['id']=='csspreloader_html'){
            printf( '<textarea name="%1$s" id="%1$s" placeholder="%2$s" rows="8" cols="100">%3$s</textarea>',
                $field['id'],
                isset( $field['placeholder'] ) ? $field['placeholder'] : '',
                $value
            );
        }

        if($field['id']=='csspreloader_css'){
            printf( '<textarea name="%1$s" id="%1$s" placeholder="%2$s" rows="8" cols="100">%3$s</textarea>',
                $field['id'],
                isset( $field['placeholder'] ) ? $field['placeholder'] : '',
                $value
            );
        }
	}
}

new csspreloader_Settings_Page();