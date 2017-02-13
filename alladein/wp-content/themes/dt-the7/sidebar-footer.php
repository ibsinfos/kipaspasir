<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package presscore
 * @since presscore 1.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $post;
$footer_sidebar = false;

if ( !( is_page() || is_single() ) ) {
	$footer_sidebar = false;
} else if ( !empty( $post ) ) {
	$footer_sidebar = get_post_meta( $post->ID, '_dt_footer_widgetarea_id', true ); 
}

if ( !$footer_sidebar) {
	$footer_sidebar = apply_filters( 'presscore_default_footer_sidebar', 'sidebar_2' );
}
?>
<?php if ( is_active_sidebar( $footer_sidebar ) ) : ?>
	<!-- !Footer -->	
	<div id="desk-area"><img src="http://v2.ncn.com.my/wp-content/uploads/2015/06/bottom-icn.jpg" width="100%" height="auto" style="margin-bottom:-5px"></div>
	<footer id="footer" class="footer">

		<div class="wf-wrap">
			<div class="wf-container">
				<?php do_action( 'presscore_before_footer_widgets' ); ?>
				<?php dynamic_sidebar( $footer_sidebar ); ?>
			</div><!-- .wf-container -->
		</div><!-- .wf-wrap -->
	</footer><!-- #footer -->
<?php endif; ?>