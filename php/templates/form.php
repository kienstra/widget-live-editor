<?php
/**
 * Widget form for Widget Live Editor.
 *
 * @package WidgetLiveEditor
 */

namespace WidgetLiveEditor;

if ( isset( $image_name, $image_label, $image_id ) ) : ?>
	<p>
		<label for="<?php echo esc_attr( $image_name ); ?>"><?php echo esc_html( $image_label ); ?></label>
		<input class="ar-featured-image" type="hidden" value="<?php echo ! empty( $image_src ) ? esc_attr( $image_src ) : ''; ?>" id="<?php echo esc_attr( $image_id ); ?>" class="widefat" name="<?php echo esc_attr( $image_name ); ?>">
		<img id="<?php echo defined( Widget_Live_Editor::IMAGE_PREVIEW_ID ) ? esc_attr( Widget_Live_Editor::IMAGE_PREVIEW_ID ) : ''; ?>" src="<?php echo ! empty( $image_src ) ? esc_url( $image_src ) : ''; ?>">
	</p>
<?php endif; ?>
<button type="button" class="ar-select-image button not-selected">
	<?php empty( $image_src ) ? esc_html_e( 'Select Image', 'widget-live-editor' ) : esc_html_e( 'Replace Image', 'widget-live-editor' ); ?>
</button>
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
