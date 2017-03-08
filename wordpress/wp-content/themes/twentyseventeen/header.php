<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>

	
				
</head>
<body <?php body_class(); ?>>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php _e('Skip to content', 'twentyseventeen'); ?></a>
	<div><table class="reg"><tbody><tr><td class="signin11"><a href="http://localhost/kipaspasir/wordpress/login/">Sign in</a></td><td></td><td>|</td><td></td><td class="register11"><a href="http://localhost/kipaspasir/wordpress/register-business-account/">Register</a></td><td></td><td>|</td><td></td><td class="deal11"><a href="">Deals</a></td><td></td><td>|</td><td></td><td class="help11"><a href="">Help</a></td></tr></tbody></table></div>
    <header id="masthead" class="site-header" role="banner">
        <?php get_template_part('template-parts/header/header', 'image'); ?>
        <?php if (has_nav_menu('top')) : ?>
		
        <div class="navigation-top">
			
            <div class="wrap">
                <?php get_template_part('template-parts/navigation/navigation', 'top'); ?>
				
                <!--Custom cart start-->
				
                <?php global $woocommerce; ?> 
				
				<a class="your-class-name" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" 
                   title="<?php _e('Cart View', 'woothemes'); ?>">
				   
                    <?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'),
                    $woocommerce->cart->cart_contents_count);?>  -
                    <?php echo $woocommerce->cart->get_cart_total(); ?>
                </a>
                <!--Custom cart end-->
            </div>
            <!-- .wrap -->
        </div><!-- .navigation-top -->
        <?php endif; ?>
    </header>
    <!-- #masthead -->
    <?php
    // If a regular post or page, and not the front page, show the featured image.
    if (has_post_thumbnail() && (is_single() || (is_page() && !twentyseventeen_is_frontpage()))) :
        echo '<div class="single-featured-image-header">';
        the_post_thumbnail('twentyseventeen-featured-image');
        echo '</div><!-- .single-featured-image-header -->';
    endif;
    ?>
	
	
    <div class="site-content-contain">
        <div id="content" class="site-content">