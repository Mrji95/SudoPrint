<?php
get_header();
?>

<main id="main" class="site-main" role="main">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) :
            the_post();
            the_content(); // Elementor will hook into this to display its content
        endwhile;
    else :
        // Optional: Content to display if no posts are found or if it's a static page without content yet.
        // For Elementor, this part is less critical as Elementor will provide the content.
        if ( is_user_logged_in() && current_user_can( 'edit_posts' ) ) {
            // Prompt to add content or edit with Elementor if the page is empty
            echo '<div class="container_wrap"><p>' .
                 sprintf(
                     wp_kses(
                         /* translators: 1: link to WP admin new page. 2: link to Elementor editor. */
                         __( 'This is your front page. <a href="%1$s">Add some content</a> or <a href="%2$s">edit with Elementor</a>.', 'maasir-theme' ),
                         array(
                             'a' => array(
                                 'href' => array(),
                             ),
                         )
                     ),
                     esc_url( admin_url( 'post-new.php?post_type=page' ) ),
                     esc_url( add_query_arg( 'action', 'elementor', get_permalink() ) )
                 ) .
                 '</p></div>';
        }
    endif;
    ?>
</main><!-- #main -->

<?php
get_footer();
?>
