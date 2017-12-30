<?php
/**
 * Widget form for Widget Live Editor.
 *
 * @package WidgetLiveEditor
 */

namespace WidgetLiveEditor;

if ( isset( $image_name, $image_label, $image_id ) && defined( __NAMESPACE__ . '\Field::IMAGE_INPUT' ) && defined( __NAMESPACE__ . '\Field::IMAGE_PREVIEW' ) ) : ?>
	<p>
		<label for="<?php echo esc_attr( $image_name ); ?>"><?php echo esc_html( $image_label ); ?></label>
		<input class="<?php echo esc_attr( Field::IMAGE_INPUT ); ?>" type="hidden" value="<?php echo esc_attr( $image_src ); ?>" id="<?php echo esc_attr( $image_id ); ?>" class="widefat" name="<?php echo esc_attr( $image_name ); ?>">
		<p>
			<img class="<?php echo esc_attr( Field::IMAGE_PREVIEW ); ?><?php echo empty( $image_src ) ? esc_attr( ' hidden' ) : ''; ?>" src="<?php echo ! empty( $image_src ) ? esc_url( $image_src ) : ''; ?>">
		</p>
		<?php if ( empty( $image_src ) && defined( __NAMESPACE__ . '\Field::NO_IMAGE' ) ) : ?>
			<div class="<?php echo esc_attr( Field::NO_IMAGE ); ?>">
				<div class="placeholder"><?php esc_html_e( 'No image selected', 'widget-live-editor' ); ?></div>
			</div>
		<?php endif; ?>
	</p>
	<button type="button" class="<?php echo defined( __NAMESPACE__ . '\Field::IMAGE_BUTTON' ) ? esc_attr( Field::IMAGE_BUTTON ) : ''; ?> button not-selected">
		<?php empty( $image_src ) ? esc_html_e( 'Select Image', 'widget-live-editor' ) : esc_html_e( 'Replace Image', 'widget-live-editor' ); ?>
	</button>
<?php endif; ?>
<?php if ( isset( $width, $width_name, $width_id ) ) : ?>
	<p>
		<label for="<?php echo esc_attr( $width_name ); ?>"><?php esc_html_e( 'Image Width:', 'widget-live-editor' ); ?></label>
		<input type="range" name="<?php echo esc_attr( $width_name ); ?>" id="<?php echo esc_attr( $width_id ); ?>" value="<?php echo esc_attr( $width ); ?>" style="display:block">
	</p>
<?php endif; ?>
<?php if ( isset( $heading_name, $heading_placeholder, $heading_id ) ) : ?>
	<p>
		<label for="<?php echo esc_attr( $heading_name ); ?>"><?php esc_html_e( 'Heading:', 'widget-live-editor' ); ?></label>
		<input type="text" value="<?php echo ! empty( $heading ) ? esc_attr( $heading ) : ''; ?>" id="<?php echo esc_attr( $heading_id ); ?>" class="widefat" name="<?php echo esc_attr( $heading_name ); ?>" placeholder="<?php echo esc_attr( $heading_placeholder ); ?>">
	</p>
<?php endif; ?>
<?php if ( isset( $copy_name, $copy_id ) ) : ?>
	<p>
		<label for="<?php echo esc_attr( $copy_name ); ?>"><?php esc_html_e( 'Copy:', 'widget-live-editor' ); ?></label>
		<textarea class="widefat code" rows="4" cols="20" id="<?php echo esc_attr( $copy_id ); ?>" name="<?php echo esc_attr( $copy_name ); ?>"><?php echo ! empty( $copy ) ? esc_textarea( $copy ) : ''; ?></textarea>
	</p>
<?php endif; ?>
<?php if ( isset( $link_name, $link_id ) ) : ?>
	<p>
		<label for="<?php echo esc_attr( $link_name ); ?>"><?php esc_html_e( 'Link:', 'widget-live-editor' ); ?></label>
		<input name="<?php echo esc_attr( $link_name ); ?>" class="<?php echo defined( __NAMESPACE__ . '\Field::URL_INPUT' ) ? esc_attr( Field::URL_INPUT ) : ''; ?>" type="text" value="<?php echo ! empty( $link ) ? esc_attr( $link ) : ''; ?>" id="<?php echo esc_attr( $link_id ); ?>">
	</p>
	<p>
		<button type="button" class="<?php echo defined( __NAMESPACE__ . '\Field::URL_BUTTON' ) ? esc_attr( Field::URL_BUTTON ) : ''; ?> button not-selected">
			<?php empty( $link ) ? esc_html_e( 'Add Link', 'widget-live-editor' ) : esc_html_e( 'Replace Link', 'widget-live-editor' ); ?>
		</button>
	</p>
<?php endif; ?>
<?php if ( isset( $align, $align_name, $align_id ) && defined( __NAMESPACE__ . '\Field::ALIGN_LEFT' ) && defined( __NAMESPACE__ . '\Field::ALIGN_CENTER' ) ) : ?>
	<p>
		<label for="<?php echo esc_attr( $align_name ); ?>"><?php esc_html_e( 'Alignment:', 'widget-live-editor' ); ?></label>
		<label for="<?php echo esc_attr( $align_id ); ?>"><?php esc_html_e( 'Left', 'widget-live-editor' ); ?></label>
		<input name="<?php echo esc_attr( $align_name ); ?>" id="<?php echo esc_attr( $align_id ); ?>" type="radio" value="<?php echo esc_attr( Field::ALIGN_LEFT ); ?>" <?php checked( ( empty( $align ) || Field::ALIGN_LEFT === $align ) ); ?>>
		<label for="<?php echo esc_attr( $align_id ); ?>"><?php esc_html_e( 'Center', 'widget-live-editor' ); ?></label>
		<input name="<?php echo esc_attr( $align_name ); ?>" id="<?php echo esc_attr( $align_id ); ?>" type="radio" value="<?php echo esc_attr( Field::ALIGN_CENTER ); ?>" <?php checked( $align, Field::ALIGN_CENTER ); ?>>
	</p>
<?php
endif;
