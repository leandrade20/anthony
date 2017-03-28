<?php /* Template Name: Blog Page */ ?>
<?php get_header(); ?>

<section>
    <div id='hero-full' class='hero'>
        <img src='http://anthonyjoyce.juvoclients.com/wp-content/uploads/Insights.jpg' class='img-responsive' alt='Anthony Joyce Solicitors Insights Image'>
        <div class='inner-hero wpb_animate_when_almost_visible wpb_left-to-right'>
            <h1>Insights</h1>
        </div>
    </div>
    <div id='hero-mobile' class='hero'>
        <img src='http://anthonyjoyce.juvoclients.com/wp-content/uploads/insights-mobile.jpg' class='img-responsive' alt='Anthony Joyce Solicitors Insights Image'>
        <div class='inner-hero wpb_animate_when_almost_visible wpb_left-to-right'>
            <h1>Insights</h1>
        </div>
    </div>
</section>

<div class="blog-main-container clearfix">
    <div class="entry-content col-md-9">
        <?php while ( have_posts() ) : the_post(); 
            $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
            $args = ['post_type' => 'post', 'posts_per_page' => 4,'paged' => $paged];
            $query = new WP_Query($args);
            if($query->have_posts()) : while($query->have_posts()): $query->the_post();
                $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="post-wrapper">
                        <div class="post-wrap">
                            <h2><?php the_title(); ?></h2>
                            <div class="post-date">
                                <span class="date"><?php echo get_the_date('M'); ?></span>
                                <span class="month"><?php echo get_the_date('d'); ?></span>
                            </div>
                            <div class="author"><i><?php the_author(); ?></i></div>
                            <a href="<?php the_permalink(); ?>"><div class="image"><?php the_post_thumbnail('full'); ?></div></a>
                            <div class="p-content"><?php echo get_the_excerpt(); ?></div>
                            <div class="read-more"><a href="<?php the_permalink(); ?>" class="btn btn-main green">Read More</a></div>
                        </div>
                    </div>
                </article>
            <?php
            endwhile;
            endif;
            wp_reset_postdata();?>
            <div class="link-wrapper">
                <?php 
                $big = 999999999; // need an unlikely integer

                echo paginate_links( array(
                    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                    'format' => '?paged=%#%',
                    'current' => max( 1, get_query_var('paged') ),
                    'total' => $query->max_num_pages,
                    'prev_text'          => __('<'),
                    'next_text'          => __('>'),
                ) ); ?>
            </div>
        <?php endwhile; ?>
    </div>
    <?php get_sidebar(); ?>    
</div>

<?php
get_footer();
