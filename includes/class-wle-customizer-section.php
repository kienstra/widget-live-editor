<?php

/*
 * Register Widget Live Editor widgets as customizer controls
 * WLE widgets won't actually appear in the customizer as widgets.
 * They'll be in their own section, as customizer controls.
 */
class WLE_Customizer_Section {
	protected static $section_counter = 0;
	protected $title;
	protected $wp_customize;

	public function __construct( $title , $wp_customize ) {
		$this->title = $title;	
		$this->wp_customize = $wp_customize;
	}

	public function make_full_section_for( $section_name ) {
		$this->section_setup( $section_name );
		$this->increment_section_counter();
	}

	protected function section_setup( $section_name ) {
		$this->initialize_section( $section_name );
		$this->register_image_with_slider( $section_name );
		$this->register_heading_and_copy( $section_name );
	}

	protected function increment_section_counter() {
		self::$section_counter++;
	}

	protected function initialize_section( $name ) {
		$this->wp_customize->add_section( $name , array(
			'title'	   => $this->title ,
			'priority' => self::$section_counter ,
			'panel'    => 'wle_panel' ,
		) );
	}

	protected function register_image_with_slider( $name ) {
		$this->wp_customize->add_setting( "wle_options[image_{$name}]" , array(
			'default'    =>	'',
			'type'	     => 'option' ,
			'capability' => 'manage_options',
			'transport'  => 'postMessage',
		) );

		$this->wp_customize->add_control( new WLE_Customize_Image_Control(
			$this->wp_customize,
			"image_$name",
			array( 'label'    => __( 'Image' , 'widget-live-editor' ) ,
			       'section'  => $name ,
			       'settings' => "wle_options[image_{$name}]" ,
			) ) );

		$this->wp_customize->add_setting( "wle_options[image_slider_$name]", array(
	 		'default'    => '100',
			'type' 	     => 'option' ,
			'capability' => 'manage_options' ,
			'transport'  => 'postMessage',
		) );

		$this->wp_customize->add_control( new WLE_Customize_Image_Slider(
			$this->wp_customize ,
			"image_slider_$name" ,
			array( 'label'     => '' ,
     			       'section'   => $name,
			       'settings' => "wle_options[image_slider_$name]" ,
			 )
		) );
	} /* end function register_image_with_slider */

	protected function register_heading_and_copy( $name ) {
		$this->wp_customize->add_setting( "wle_options[heading_$name]", array(
			'default'    => $this->title . __( ' Heading' , 'widget-live-editor' ) ,
			'type'	     => 'option' ,
			'capability' => 'manage_options' ,
			'transport'  => 'postMessage' ,
		) );

		$this->wp_customize->add_control( "heading_$name", array(
			'label'		=> __( 'Heading' , 'widget-live-editor' ) ,
			'section'	=> $name ,
			'settings'	=> "wle_options[heading_$name]" ,
			'capability' 	=> 'manage_options' ,
		) );

		$this->wp_customize->add_setting( "wle_options[copy_$name]" , array(
			'default'    => $this->title . __( ' Copy ' , 'widget-live-editor' ) ,
			'type'	     => 'option' ,
			'capability' => 'manage_options' ,
			'transport'  => 'postMessage' ,
			'class_name' => 'copy-panel' ,
		) );

		$this->wp_customize->add_control( new WLE_Textarea_Control(
			$this->wp_customize,
			"copy_$name",
			array( 'label'      => __( 'Copy' , 'widget-live-editor' ) ,
			       'section'    =>	$name ,
			       'settings'   => "wle_options[copy_$name]" ,
			       'capability' => 'manage_options' ,
		) ) );

		$this->wp_customize->add_setting( "wle_options[link_href_{$name}]" , array(
			'default'    => '' ,
			'type' 	     => 'option' ,
			'capability' => 'manage_options',
			'transport'  => 'postMessage',
		) );

		$this->wp_customize->add_control( new WLE_Customize_Link_Control(
			$this->wp_customize,
			"link_href_$name",
			array(
				'label'    => __( 'Link To' , 'widget-live-editor' ) ,
				'section'  => $name ,
				'settings' => "wle_options[link_href_{$name}]" ,
			)
		) );

	}	/* end function register_heading_and_copy */

}  	/* end class WLE_Customizer_Section */