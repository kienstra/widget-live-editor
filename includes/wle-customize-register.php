<?php

add_action( 'customize_register' , 'wle_register_classes', 10 );
function wle_register_classes( $wp_customize ) {
	if ( class_exists( 'WP_Customize_Control' ) ) {
		class RK_Customize_Image_Control extends WP_Customize_Control {

			public function render_content() {
				?>
				<label>
					<span class="customize-control-title">
						<?php echo esc_html( $this->label ); ?>
					</span>
					<?php $images_query = new WP_Query( array( 'post_type' => 'attachment' , 'post_status' => 'inherit', 'post_mime_type' => 'image' , 'posts_per_page' => 100 ) );
					if ( $images_query->have_posts() ) :
				?>
						<select <?php echo $this->get_link(); ?> class="image-selector" >
							<option value="">--No image--</option>
								<?php
								while ( $images_query->have_posts() ) :
									$images_query->the_post();
								?>
									<option value="<?php echo wp_get_attachment_url(); ?>" <?php selected( $this->value(), get_permalink(), false ); ?>>
									<?php the_title(); ?>
							</option>
							<?php
							endwhile;
						?>
						</select>
					</label>
					<?php wp_reset_postdata();
					else:
						echo __( 'Please' , 'widget-live-editor' ) . "<a href='media-new.php'>" . __( ' upload images' , 'widget-live-editor' ) . "</a>";
					endif;
			}
		} /* end class RK_Customize_Image_Control */

		class RK_Customize_Link_Control extends WP_Customize_Control {
			public function render_content() {
				?>
				<label>
					<span class="customize-control-title">
						<?php echo esc_html( $this->label ); ?>
					</span>
					<?php $page_uri_query = new WP_Query( array( 'post_type' => 'page' , 'posts_per_page' => 100 ) );
					if ( $page_uri_query->have_posts() ) :
					?>
						<select <?php echo $this->get_link(); ?> class="image-selector" >
							<option value="">--No Link--</option>
								<?php
								while ( $page_uri_query->have_posts() ) :
									$page_uri_query->the_post();
								?>
									<option value="<?php the_permalink(); ?>" <?php selected( $this->value(), get_permalink(), false ); ?>>
										Page: <?php the_title(); ?>
									</option>
								<?php
								endwhile;
					endif;
					wp_reset_postdata();
					$post_uri_query = new WP_Query( array( 'post_type' => 'post' , 'posts_per_page' => 100 ) );
					if ( $post_uri_query->have_posts() ) :
						while ( $post_uri_query->have_posts() ) :
							$post_uri_query->the_post();
							?>
							<option value="<?php the_permalink(); ?>" <?php selected( $this->value(), get_permalink(), false ); ?>>
							Post: <?php the_title(); ?>
							</option>
							<?php
						endwhile;
					endif;
					?>
					</select>
				</label>
			<?php
			}
		}

		class PTD_Textarea_Control extends WP_Customize_Control {
			public function render_content() {
				?>
				<label>
					<span class="customize-control-title">
						<?php echo esc_html( $this->label ); ?>
					</span>
				</label>
				<textarea class="<?php echo $this->label; ?> large-text" cols="20" rows="10" <?php $this->link(); ?>>
					<?php echo get_option( "wle_options[ 'copy_' . $this->label ]" ); ?>
	 			</textarea>
	 			<span>
	 			</span
			<?php
			}
		}

		class RK_Customize_Image_Slider extends WP_Customize_Control {
			public function render_content() {
				?>
				<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
				</span>
	 			<input type="range" <?php echo $this->link(); ?> value="<?php get_option( "wle_options[ 'image_slider_' . $this->label ]" ); ?>" />
			<?php
			}
		}
	}
} /* end function wle_register_classes */


// Find all the Live Editor widgets in active sidebars, and create customizer sections for them
add_action( 'customize_register' , 'wle_create_widget_customizer_section' );
function wle_create_widget_customizer_section( $wp_customize ) {
	$sidebars_mapped_to_their_widgets = get_option( 'sidebars_widgets' );

	foreach( $GLOBALS[ 'wp_registered_sidebars' ] as $active_sidebar ) {
		if ( isset( $sidebars_mapped_to_their_widgets[ $active_sidebar[ 'id' ] ] ) ) {
			wle_add_new_panel( $wp_customize );
			$widgets_of_any_kind = $sidebars_mapped_to_their_widgets[ $active_sidebar[ 'id' ] ];
			wle_register_customizer_sections( $widgets_of_any_kind , $wp_customize );
		}
	}
}

function wle_register_customizer_sections( $widgets_of_any_kind , $wp_customize ) {
	foreach( $widgets_of_any_kind as $widget ) {
		if ( preg_match( '/(wle-)([0-9]{1,5})/' , $widget , $matches ) ) {
		// this is a Live Editor Widget
		wle_register_single_customizer_section( $widget , $wp_customize );
		}
	}
}

function wle_register_single_customizer_section( $widget , $wp_customize ) {
	$customizer = new WLE_Customizer_Section( $wp_customize );
	$customizer->make_full_section( $widget , __( 'Widget Live Editor' , 'widget-live-editor' ) );
}

function wle_add_new_panel( $wp_customize ) {
	$wp_customize->add_panel( 'wle_panel' , array(
		'priority' => 10,
		'capability' => 'manage_options',
		'theme_supports' => '' ,
		'title'	=> __( 'Live Editor Widgets' , 'widget-live-editor' ) ,
		'description' => __( 'Edit the content' , 'widget-live-editor' ) ,
	) );
}

// Allow svgs
add_filter( 'upload_mimes', 'wle_add_svg_support' );
function wle_add_svg_support( $mimes ){
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}