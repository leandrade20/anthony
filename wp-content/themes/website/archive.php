<?php /* Template Name: Archives */ ?>
<?php get_header(); 
$uploads = wp_upload_dir();
?>

<section>
    <div id='hero-full' class='hero'>
        <img src="<?php echo $uploads['baseurl'];?>/Insights.jpg" class="img-responsive" alt="Anthony Joyce Solicitors Insights Image">
        <div class="inner-hero wpb_animate_when_almost_visible wpb_left-to-right">
            <h1>Insights</h1>
        </div>
    </div>
    <div id="hero-mobile" class="hero">
        <img src="<?php echo $uploads['baseurl'];?>/insights-mobile.jpg" class="img-responsive" alt="Anthony Joyce Solicitors Insights Image">
        <div class="inner-hero wpb_animate_when_almost_visible wpb_left-to-right">
            <h1>Insights</h1>
        </div>
    </div>
</section>

<div class="blog-main-container clearfix">
    <div class="entry-content col-md-9">
        <?php while ( have_posts() ) : the_post(); ?>
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
        <?php endwhile;
        the_posts_navigation();?>
    </div>
    <?php get_sidebar(); ?>    
</div>

<?php
get_footer();
