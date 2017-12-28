<?php
/**
 * Widget form for Widget Live Editor.
 *
 * @package WidgetLiveEditor
 */

namespace WidgetLiveEditor;

if ( isset( $image_name, $image_label, $image_id ) && defined( __NAMESPACE__ . '\Widget_Live_Editor::IMAGE_INPUT' ) && defined( __NAMESPACE__ . '\Widget_Live_Editor::IMAGE_PREVIEW' ) ) : ?>
	<p>
		<label for="<?php echo esc_attr( $image_name ); ?>"><?php echo esc_html( $image_label ); ?></label>
		<input class="<?php echo esc_attr( Widget_Live_Editor::IMAGE_INPUT ); ?>" type="hidden" value="<?php echo esc_attr( $image_src ); ?>" id="<?php echo esc_attr( $image_id ); ?>" class="widefat" name="<?php echo esc_attr( $image_name ); ?>">
		<p>
			<img class="<?php echo esc_attr( Widget_Live_Editor::IMAGE_PREVIEW ); ?><?php echo empty( $image_src ) ? esc_attr( ' hidden' ) : ''; ?>" src="<?php echo ! empty( $image_src ) ? esc_url( $image_src ) : ''; ?>">
		</p>
		<?php if ( empty( $image_src ) && defined( __NAMESPACE__ . '\Widget_Live_Editor::NO_IMAGE' ) ) : ?>
			<div class="<?php echo esc_attr( Widget_Live_Editor::NO_IMAGE ); ?>">
				<div class="placeholder"><?php esc_html_e( 'No image selected', 'widget-live-editor' ); ?></div>
			</div>
		<?php endif; ?>
	</p>
<?php endif; ?>
<button type="button" class="<?php echo esc_attr( Widget_Live_Editor::IMAGE_BUTTON ); ?> button not-selected">
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
<?php if ( isset( $link_name, $link_id ) ) : ?>
<p>
	<label for="<?php echo esc_attr( $link_name ); ?>"><?php esc_html_e( 'Link:', 'widget-live-editor' ); ?></label>
	<input class="wle-link" type="text" value="<?php echo ! empty( $link ) ? esc_url( $link ) : ''; ?>" id="<?php echo esc_attr( $link_id ); ?>" name="<?php echo esc_attr( $link_name ); ?>">
</p>
<button type="button" class="wle-select-link button not-selected">
	<?php empty( $link ) ? esc_html_e( 'Add Link', 'widget-live-editor' ) : esc_html_e( 'Replace Link', 'widget-live-editor' ); ?>
</button>
<?php endif; ?>
