<?php
/**
 * Widget template for Widget Live Editor.
 *
 * @package WidgetLiveEditor
 */

namespace WidgetLiveEditor;

?>
<div class="c-wle <?php echo ! empty( $align ) ? esc_attr( $align ) : ''; ?>">
	<div>
		<img class="c-wle__img img-responsive" src="<?php echo ! empty( $image_src ) ? esc_attr( $image_src ) : ''; ?>" <?php echo ! empty( $width ) ? 'style="max-width:' . esc_attr( $width ) . '%"' : ''; ?>>
	</div>
	<h2 class="c-wle__heading"><?php echo isset( $heading ) ? esc_html( $heading ) : ''; ?></h2>
	<div class="l-footer__cta">
		<span class="c-wle__copy">
			<?php echo isset( $copy ) ? esc_html( $copy ) : ''; ?>
		</span>
		<p>
			<?php echo isset( $link ) ? wp_kses_post( $link ) : ''; ?>
		</p>
	</div>
</div>
