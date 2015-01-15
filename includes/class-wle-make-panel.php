<?php

// Create the Widget Live Editor markup
// Echoed in the widget() function of class WP_Widget_WLE

class WLE_Make_Panel {
	protected static $instance;
	protected $panel_name;
	protected $container;
	protected $opening_div;
	protected $options;

	public function __construct( $panel_name ) {
		$this->panel_name = $panel_name;
		$this->options = get_option( 'wle_options' );
		$this->make_full_section();
	}

	public static function init_and_get( $panel_name ) {
		self::$instance = new self( $panel_name );
		return self::$instance->container;
	}

	public function make_full_section() {
		$this->add_opening_div_to_container();
		$this->add_image_section_to_container();
		$this->add_heading_section_to_container();
		$this->add_copy_and_link_section_to_container();
		$this->add_closing_div_to_container();
	}

	public function add_image_section_to_container() {
		$selector = 'image_' . $this->panel_name;
		$src = isset( $this->options[ $selector ] ) ? $this->options[ $selector ] : "";
		$display = $src ? 'block' : 'none';
		$alt = ( $src != "" ) ? $selector : "";
		$is_svg = preg_match( '/.+(\.svg$)/' , $src );
		// if is_svg, control the height of the containing div, set the img height to 100%
		$height = $is_svg ? '300px' : '';
		$max_height = $this->get_max_height();
		$this->container .=
			'<div class="wle-img-container" style="display: ' . esc_attr( $display ) . '">'
			.	'<img class="img-customize ' . esc_attr( $selector ) . ' img-responsive" src="' . esc_url( $src ) . '" style="max-height:' . esc_attr( $max_height ) . '; height:'. esc_attr( $height ) . '" alt="' . esc_attr( $alt ) . '">'
			. '</div>';
	}

	protected function get_max_height() {
		$max_height_pixels = apply_filters( 'wle_image_max_height_in_pixels' , 300 );
		$max_height_setting = $this->get_user_height_setting();
		$max_height = floor( $max_height_pixels * $max_height_setting / 100 );
		return $max_height . 'px';
	}

	protected function get_user_height_setting() {
		$setting = isset ( $this->options[ 'image_slider_' . $this->panel_name ] ) ?
					$this->options[ 'image_slider_' . $this->panel_name ] : 1;
		return $setting;
	}

	public function add_heading_section_to_container() {
		$selector = 'heading_' . $this->panel_name;
		$heading_html = isset( $this->options[ $selector ] ) ?
				       $this->options[ $selector ] : "";
		$this->container .=
			  '<h2 class="' . esc_attr( $selector ) . ' wle-heading">'
			.	esc_html( $heading_html )
			. '</h2>';
	}

	protected function add_copy_and_link_section_to_container() {
		$this->container .= '<div class="wle-copy-and-link">';
		$this->add_copy_section_to_container();
		$this->add_link_to_container();
		$this->container .= '</div>';
	}

	public function add_copy_section_to_container() {
		$selector = 'copy_' . $this->panel_name;
		$copy_html = isset( $this->options[ $selector ] ) ? $this->options[ $selector ] : "";
		$this->container .=
			  '<span class="' . esc_attr( $selector ) . ' wle-copy">'
			.	 nl2br( strip_tags( $copy_html ) )
			. '</span>';
	}

	public function add_link_to_container() {
		$selector = 'link_href_' . $this->panel_name;
		$link_href = isset( $this->options[ $selector ] ) ? $this->options[ $selector ] : "";
		$display = $link_href ? 'inline-block' : 'none';
		$options = get_option( 'wle_plugin_options' );
		$anchor_class = isset( $options[ 'anchor_class' ] ) ? $options[ 'anchor_class' ] : "";
		$anchor_text = isset( $options[ 'anchor_text' ] ) ? $options[ 'anchor_text' ] : "";

		$this->container .=
			  '<p>'
			.	'<a id="' . esc_attr( $selector ) . '" href="' . esc_url( $link_href ) . '" class="' . esc_url( $anchor_class ) . ' wle-link" style="display: ' . esc_attr( $display ) . '">'
			.		esc_html( $anchor_text )
			.	'</a>'
			. '<p>';
	}

	protected function add_opening_div_to_container() {
		$url_to_customizer_of_this_page = wle_get_url_to_customizer_of_this_page();
		$this->container .=
			'<div class="customized-col" id="' . esc_attr( $this->panel_name ) . '">';
	}

	protected function add_closing_div_to_container() {
		$this->container .= '</div>';
	}
}	/* end WLE_Make_Panel */