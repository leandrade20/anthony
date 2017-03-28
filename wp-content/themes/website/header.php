<!DOCTYPE html>
<html lang="en-ie">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?php wp_title(); ?></title>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo get_template_directory_uri ();?>/style.css" rel="stylesheet">
<?php wp_head(); ?>

</head>
    
    	
    <body <?php body_class(); ?>>
	<header id="masthead" class="site-header">
            <div class="site-branding">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Home Page" rel="home"><img src="<?php echo get_theme_mod('logo'); ?>" alt="<?php echo get_bloginfo('name' );?> Logo"></a>
            </div>
           
            <button title="Main Menu" id="menu-toggle" class="menu-toggle">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="sr-only">Toggle navigation</span>
            </button>

            <div id="site-header-menu" class="site-header-menu">
                <nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'website' ); ?>">
                    <?php
                        wp_nav_menu( array(
                                'theme_location' => 'primary',
                                'menu_class'     => 'primary-menu',
                         ) );
                    ?>
                </nav>
            </div>
        </header>
