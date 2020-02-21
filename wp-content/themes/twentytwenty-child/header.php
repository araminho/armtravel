<?php
/**
 * Header file for the Twenty Twenty WordPress default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

?><!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

<head>

    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<article>

<?php
wp_body_open();
?>

<header id="site-header" class="header-footer-group" role="banner">

    <div class="header-inner section-inner">

        <div class="header-titles-wrapper">


            <div class="logo">

				<?php
				// Site title or logo.
				twentytwenty_site_logo();

				wp_list_pages( [
					'match_menu_classes'  => true,
					'show_sub_menu_icons' => true,
					'title_li'            => false,
				] );
				?>


            </div>

           <!-- <button class="toggle nav-toggle mobile-nav-toggle" data-toggle-target=".menu-modal"
                    data-toggle-body-class="showing-menu-modal" aria-expanded="false"
                    data-set-focus=".close-nav-toggle">
						<span class="toggle-inner">
							<span class="toggle-icon">
								<?php /*twentytwenty_the_theme_svg( 'ellipsis' ); */?>
							</span>
							<span class="toggle-text"><?php /*_e( 'Menu', 'twentytwenty' ); */?></span>
						</span>
            </button>-->


            <!-- .nav-toggle -->

        </div><!-- .header-titles-wrapper -->

        <div class="desctop-manu">

			<?php if ( has_nav_menu( 'primary' ) || ! has_nav_menu( 'expanded' ) ) { ?>



                    <ul class="primary-menu reset-list-style">

						<?php
						if ( has_nav_menu( 'primary' ) ) {

							wp_nav_menu( [
								'container'      => '',
								'items_wrap'     => '%3$s',
								'theme_location' => 'primary',
							] );

						} elseif ( ! has_nav_menu( 'expanded' ) ) {

							wp_list_pages( [
								'match_menu_classes'  => true,
								'show_sub_menu_icons' => true,
								'title_li'            => false,
								'walker'              => new TwentyTwenty_Walker_Page(),
							] );

						}
						?>

                    </ul>


            <?php } ?>

        </div><!-- .header-navigation-wrapper -->

    </div><!-- .header-inner -->


</header><!-- #site-header -->

<?php
// Output the menu modal.
get_template_part( 'template-parts/modal-menu' );
