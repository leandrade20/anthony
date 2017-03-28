<?php get_header(); ?>
<div class="main-content-wrap">
    <div class="container main-content">
        <h1 class="main-heading">Error Page Not Found</h1>
        <div class="text-center">
            <img src="<?php echo get_template_directory_uri ();?>/404.png" class="img-responsive" alt="404 Error Image">
            <p class="errorpage">Oops Something went wrong, we couldn't find the page you were looking for. <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Juvo Home Page" rel="home">Click here</a> to go back to the home page.</p>
        </div>
    </div>
    
</div>
<?php get_footer();

