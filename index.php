<?php get_header(); ?>

<main id="primary" class="site-main">
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php if ( is_singular() ) :
                        the_title( '<h1 class="entry-title">', '</h1>' );
                    else :
                        the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                    endif; ?>
                </header>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>

                <footer class="entry-footer">
                    <?php edit_post_link( esc_html__( 'Edit', 'itworld-jersey' ), '<span class="edit-link">', '</span>' ); ?>
                </footer>
            </article>
        <?php endwhile; ?>

        <?php the_posts_navigation(); ?>

    <?php else : ?>
        <section class="no-results not-found">
            <header class="page-header">
                <h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'itworld-jersey' ); ?></h1>
            </header>

            <div class="page-content">
                <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
                    <p><?php printf( wp_kses_post( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'itworld-jersey' ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
                <?php else : ?>
                    <p><?php esc_html_e( 'It seems we can’t find what you’re looking for. Try a search.', 'itworld-jersey' ); ?></p>
                    <?php get_search_form(); ?>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>
</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
