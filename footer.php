<footer id="colophon" class="site-footer" role="contentinfo">
    <?php
    if ( function_exists( 'elementor_theme_do_location' ) && elementor_theme_do_location( 'footer' ) ) {
        // Elementor Pro footer location takes precedence
        // This function will render the Elementor Pro footer.
    } else {
        // Fallback to a standard footer structure if Elementor Pro footer is not used
        ?>
        <div class="footer-widgets-area">
            <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                <div class="footer-widget-column">
                    <?php dynamic_sidebar( 'footer-1' ); ?>
                </div>
            <?php endif; ?>
            <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                <div class="footer-widget-column">
                    <?php dynamic_sidebar( 'footer-2' ); ?>
                </div>
            <?php endif; ?>
            <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                <div class="footer-widget-column">
                    <?php dynamic_sidebar( 'footer-3' ); ?>
                </div>
            <?php endif; ?>
            <?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
                <div class="footer-widget-column">
                    <?php dynamic_sidebar( 'footer-4' ); ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="site-info">
            <!-- Placeholder for copyright information -->
            <?php printf( esc_html__( '&copy; %1$s %2$s. All rights reserved.', 'maasir-theme' ), esc_html( date_i18n( 'Y' ) ), esc_html( get_bloginfo( 'name' ) ) ); ?>
        </div><!-- .site-info -->

        <div class="social-links">
            <!-- Placeholder for social media links -->
            <!-- User would add Elementor social icons widget here or use a WordPress menu -->
            <?php esc_html_e( 'Follow us:', 'maasir-theme' ); echo ' <span class="social-icons-placeholder-text">[' . esc_html__( 'Social Icons Placeholder', 'maasir-theme' ) . ']</span>'; ?>
            <?php
            if ( has_nav_menu( 'social' ) ) {
                wp_nav_menu(
                    array(
                        'theme_location' => 'social',
                        'menu_class'     => 'social-menu',
                        'link_before'    => '<span class="screen-reader-text">',
                        'link_after'     => '</span>',
                        'depth'          => 1,
                    )
                );
            }
            ?>
        </div><!-- .social-links -->
        <?php
    }
    ?>
</footer><!-- #colophon -->
<?php wp_footer(); ?>
</body>
</html>
