<!DOCTYPE html>
<html lang="fa-IR">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header id="masthead" class="site-header" role="banner">
        <div class="site-branding">
            <!-- Placeholder for logo, to be managed by Elementor or Customizer -->
            <div class="site-logo">
                <!-- Elementor will typically insert a logo widget here -->
            </div>
        </div>
        <nav id="site-navigation" class="main-navigation" role="navigation">
            <!-- Placeholder for navigation menu, to be managed by Elementor or WordPress Menus -->
            <?php
            if ( function_exists( 'elementor_theme_do_location' ) && elementor_theme_do_location( 'header' ) ) {
                // Elementor Pro header location
            } elseif ( has_nav_menu( 'primary' ) ) {
                wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) );
            } else {
                // Fallback or placeholder if no Elementor Pro header and no 'primary' menu is set
                echo '<ul id="primary-menu" class="menu nav-menu"><li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'maasir-theme' ) . '</a></li></ul>';
            }
            ?>
        </nav><!-- #site-navigation -->
        <div class="header-search">
            <!-- Placeholder for search icon/form, to be managed by Elementor -->
        </div>
    </header><!-- #masthead -->
</body>
</html>
