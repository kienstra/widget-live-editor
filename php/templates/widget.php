<?php
/**
 * Widget template for Widget Live Editor.
 *
 * @package WidgetLiveEditor
 */

namespace WidgetLiveEditor;

?>
<div class="wle-container">
	<?php if ( ! empty( $image_src ) ) : ?>
		<div class="wle-img-container">
			<img class="img-customize img-responsive" src="<?php echo esc_attr( $image_src ); ?>" style="max-height:300px; height:  ">
		</div>
	<?php endif; ?>
	<h2 class="wle-heading"><?php echo isset( $heading ) ? esc_html( $heading ) : ''; ?></h2>
	<div class="wle-copy-and-link">
		<span class="copy_wle-5 wle-copy">
			<?php echo isset( $copy ) ? esc_html( $copy ) : ''; ?>
		</span>
		<p>
			<?php echo isset( $link ) ? wp_kses_post( $link ) : ''; ?>
		</p>
	</div>
</div>
