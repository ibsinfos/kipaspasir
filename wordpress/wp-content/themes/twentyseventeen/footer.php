<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>

		</div><!-- #content -->

		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="wrap">
				<?php
				get_template_part( 'template-parts/footer/footer', 'widgets' );

				if ( has_nav_menu( 'social' ) ) : ?>
					<nav class="social-navigation" role="navigation" aria-label="<?php _e( 'Footer Social Links Menu', 'twentyseventeen' ); ?>">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'social',
								'menu_class'     => 'social-links-menu',
								'depth'          => 1,
								'link_before'    => '<span class="screen-reader-text">',
								'link_after'     => '</span>' . twentyseventeen_get_svg( array( 'icon' => 'chain' ) ),
							) );
						?>
					</nav><!-- .social-navigation -->
				<?php endif;

				get_template_part( 'template-parts/footer/site', 'info' );
				?>
				<!---hahahahaha-->
				<div id="footer-widgets">

<div id="sidebar-1">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 1') ) : ?>
<?php endif; ?>
</div>

<div id="sidebar-2">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 2') ) : ?>
<?php endif; ?>
</div>

<div id="sidebar-3">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 3') ) : ?>
<?php endif; ?>
</div>

<div id="sidebar-4">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 4') ) : ?>
<?php endif; ?>
</div>
</div>
<div style="clear-both"></div>
			</div><!-- .wrap -->
			<div class=bottombar1>Copyright © 2017 Alladein. DinarPal Group. All Rights Reserved. </div>
		</footer><!-- #colophon -->
	</div><!-- .site-content-contain -->
	
	
</div><!-- #page -->

<?php wp_footer(); ?>


</body>
</html>
