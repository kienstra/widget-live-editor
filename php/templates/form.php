<?php
/**
 * Widget form for Widget Live Editor.
 *
 * @package WidgetLiveEditor
 */

namespace WidgetLiveEditor;

?>
<p>
	<label for="<?php echo esc_attr( $image_name ); ?>"><?php echo esc_html( $image_label ); ?></label>
	<input class="ar-featured-image" type="hidden" value="<?php echo esc_attr( $image_src ); ?>" id="<?php echo esc_attr( $image_id ); ?>" class="widefat" name="<?php echo esc_attr( $image_name ); ?>">
	<img id="featured-image-preview" src="<?php echo ! empty( $image_src ) ? esc_url( $image_src ) : ''; ?>">
</p>
<button type="button" class="ar-select-image button not-selected">
	<?php empty( $image_src ) ? esc_html_e( 'Select Image', 'widget-live-editor' ) : esc_html_e( 'Replace Image', 'widget-live-editor' ); ?>
</button>
<p>
	<label for="<?php echo esc_attr( $heading_name ); ?>"><?php esc_html_e( 'Heading:', 'widget-live-editor' ); ?></label>
	<input type="text" value="<?php echo esc_attr( $heading ); ?>" id="<?php echo esc_attr( $heading_id ); ?>" class="widefat" name="<?php echo esc_attr( $heading_name ); ?>" placeholder="<?php echo esc_attr( $heading_placeholder ); ?>">
</p>
<p>
	<label for="<?php echo esc_attr( $copy_name ); ?>"><?php esc_html_e( 'Copy:' ); ?></label>
	<textarea class="widefat code" rows="4" cols="20" id="<?php echo esc_attr( $copy_id ); ?>" name="<?php echo esc_attr( $copy_name ); ?>"><?php echo esc_textarea( $copy ); ?></textarea>
</p>
