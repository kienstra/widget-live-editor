<?php

class WLE_Customizer_Section {
	public $wp_customize;
	public static $section_counter = 0;
	private static $instance;

	public function __construct( $wp_customize ) {
		$this->wp_customize = $wp_customize;
	}

	public function make_full_section( $section_name , $title ) {
		$this->initialize_section( $section_name, $title );
		$this->image_with_slider( $section_name );
		$this->heading_and_copy( $section_name , $title );
		self::$section_counter++;
	}

	public function initialize_section( $name , $title ) {
		$this->wp_customize->add_section( $name , array(
			'title'	=> $title ,
			'priority' => self::$section_counter ,
			'panel' => 'wle_panel' ,
	 ) );
	}

	public function image_with_slider( $name ) {

		$this->wp_customize->add_setting( "wle_options[image_{$name}]" , array(
			'default'		=>	'',
			'type'			 => 'option' ,
			'capability' => 'manage_options',
			'transport'	=> 'postMessage',
		) );

		$this->wp_customize->add_control( new RK_Customize_Image_Control(
			$this->wp_customize, "image_$name",
			array( 'label' => __( 'Image' , 'widget-live-editor' ) ,
			       'section' => $name ,
			       'settings' =>	"wle_options[image_{$name}]" ,
			) ) );

		$this->wp_customize->add_setting( "wle_options[image_slider_$name]", array(
	 		'default' => '100',
			'type' => 'option' ,
			'capability' => 'manage_options' ,
			'transport' => 'postMessage',
		) );

		$this->wp_customize->add_control( new RK_Customize_Image_Slider(
			 $this->wp_customize, "image_slider_$name", array( 'label' => '' ,
		 	 		      			    	   'section' => $name,
		 							   'settings' => "wle_options[image_slider_$name]" ,
		) ) );
	}

	public function heading_and_copy( $name , $title ) {
		$this->wp_customize->add_setting( "wle_options[heading_$name]", array(
			'default'		=>	$title . __( ' Heading' , 'widget-live-editor' ) ,
			'type'	=> 'option' ,
			'capability' => 'manage_options' ,
			'transport'	=> 'postMessage' ,
		) );

		$this->wp_customize->add_control( "heading_$name", array(
			'label'			=> __( 'Heading' , 'widget-live-editor' ) ,
			'section'		=> $name,
			'settings'		=> "wle_options[heading_$name]" ,
			'capability' => 'manage_options',
		) );

		$this->wp_customize->add_setting( "wle_options[copy_$name]" , array(
			'default'		=> $title .	__( ' Copy ' , 'widget-live-editor' ) ,
			'type'	=> 'option' ,
			'capability' => 'manage_options',
			'transport'	=> 'postMessage',
			'class_name' => 'copy-panel',
		) );

		$this->wp_customize->add_control( new PTD_Textarea_Control( $this->wp_customize, "copy_$name",
			array( 'label'		=> __( 'Copy' , 'widget-live-editor' ) ,
			 'section'		=>	$name ,
			 'settings'	 => "wle_options[copy_$name]" ,
			 'capability' => 'manage_options' ,
		) ) );

		$this->wp_customize->add_setting( "wle_options[link_href_{$name}]" , array(
						  		'default' => '' ,
								'type' => 'option' ,
								'capability' => 'manage_options',
								'transport'	=> 'postMessage',
		) );

		$this->wp_customize->add_control( new RK_Customize_Link_Control(
						      $this->wp_customize, "link_href_$name",
	 					      array( 'label' => __( 'Link To' , 'widget-live-editor' ) ,
						      	     'section' => $name ,
							     'settings' =>	"wle_options[link_href_{$name}]" ,
		) ) );

	}	/* end function heading_and_copy */

}	/* end class RK_Customizer_Section */