<?php
/* ********************************************************************* */
/* ***************************CONTAINER************************************ */

function container_func( $atts, $content = null ) {
    $output = "
        <div class='container'>
            <div class='row'>
                ".do_shortcode($content)."
            </div>
        </div>
    ";

    return $output;
}
add_shortcode( 'container', 'container_func' );

function container_integrateWithVC() {
    vc_map( [
        'name' => __( 'Container'),
        'base' => 'container',
        "as_parent" => array('except' => 'nothing'),
        'description' => __( 'Add Container' ),
        'category' => __('Custom Elements'),
        'content_element' => true,
        'show_settings_on_create' => false,
        'js_view' => 'VcColumnView', 
    ] );
}
add_action( 'vc_before_init', 'container_integrateWithVC' );

if(class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_Container extends WPBakeryShortCodesContainer { }
}


/* ********************************************************************* */
/* ***************************SLIDER************************************ */
/*
// Shortcode Parent
function slider_container_func( $atts, $content = null ) {
    $output = "
        <section>
            <div class='swiper-container swiper-top'>
                <div class='swiper-wrapper'>
                    ".do_shortcode($content)."
                </div>
                <div class='swiper-pagination'></div>            
            </div>
        </section>
    ";

    return $output;
}
add_shortcode( 'slider_container', 'slider_container_func' );

// Shortcode Child
function slide_func( $atts, $content = null ) {
    extract(shortcode_atts(['image' => 'image', 'heading' => 'heading', 'text' => ''], $atts));

    $slide = wp_get_attachment_image_src($image, 'full');
    if ($text === '') {
        $output = "
            <div class='swiper-slide' style='background: url({$slide[0]}); background-repeat: no-repeat; background-size: cover; background-position-x: 50%;'>
                <div class='inner-slide'>
                    <h1>{$heading}</h1>
                </div>
            </div>
        ";
    } else {
        $output = "
            <div class='swiper-slide' style='background: url({$slide[0]}); background-repeat: no-repeat; background-size: cover; background-position-x: 50%;'>
                <div class='inner-slide'>
                    <h1>{$heading}</h1>
                    <p>{$text}</p>
                </div>
            </div>
        ";
    }

    return $output;
}
add_shortcode( 'slide', 'slide_func' );

// Parent Element
function slider_container_integrateWithVC() {
    vc_map( [
        'name' => __( 'Slider Container'),
        'base' => 'slider_container',
        'description' => __( 'Add Slider Container' ),
        'category' => __('Custom Elements'),
        'as_parent' => ['only' => 'slide'],
        'content_element' => true,
        'show_settings_on_create' => false,
        'js_view' => 'VcColumnView', 
    ] );
}
add_action( 'vc_before_init', 'slider_container_integrateWithVC' );

// Child Element
function slide_integrateWithVC() {
    vc_map( [
        'name' => __('Slide'),
        'base' => 'slide',
        'description' => __( 'Add a slide to slider.' ),
        'category' => __('Custom Elements'),
        'content_element' => true,
        'as_child' => ['only' => 'slider_container'],
        'params' => [
            [
                "type" => "attach_image",
                "heading" => __("Slide Image"),
                "param_name" => "image",
                'holder' => 'div' 
            ],
            [
                "type" => "textfield",
                "heading" => __("Heading"),
                "param_name" => "heading",
                'holder' => 'div' 
            ],
            [
                "type" => "textfield",
                "heading" => __("Text"),
                "param_name" => "text",
                'holder' => 'div' 
            ],
        ]
    ] );
}
add_action( 'vc_before_init', 'slide_integrateWithVC' );

if(class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_Slider_Container extends WPBakeryShortCodesContainer { }
}
if(class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Slide extends WPBakeryShortCode { }
}


/* ************************************************************************ */
/* *************************HERO IMAGE BLOCK************************************* */

add_shortcode('hero', 'hero_func');
function hero_func( $atts, $content = null ) {
    extract(shortcode_atts(['image' => 'image', 'image_mobile' => 'image', 'alt' => '', 'heading' => 'heading', 'button_text' => '', 'link' => '', 'animation' => 'no'], $atts));

    $img = wp_get_attachment_image_src($image, 'full');
    $img_mobile = wp_get_attachment_image_src($image_mobile, 'full');
    if ($animation === 'no') {
        $animationcss = '';
    }
	if ($animation === 'top-to-bottom') {
        $animationcss = 'wpb_animate_when_almost_visible wpb_top-to-bottom';
    }
	if ($animation === 'bottom-to-top') {
        $animationcss = 'wpb_animate_when_almost_visible wpb_bottom-to-top';
    }
        if ($animation === 'left-to-right') {
        $animationcss = 'wpb_animate_when_almost_visible wpb_left-to-right';
    }
	if ($animation === 'right-to-left') {
        $animationcss = 'wpb_animate_when_almost_visible wpb_right-to-left';
    }
	if ($animation === 'appear') {
        $animationcss = 'wpb_animate_when_almost_visible wpb_appear';
    }
    if ($button_text === '') {	
        return "
            <section>
                <div id='hero-full' class='hero'>
                    <img src='{$img[0]}' class='img-responsive' alt='{$alt}'>
                    <div class='inner-hero {$animationcss}'>
                        <h1>{$heading}</h1>
                    </div>
                </div>
                <div id='hero-mobile' class='hero'>
                    <img src='{$img_mobile[0]}' class='img-responsive' alt='{$alt}'>
                    <div class='inner-hero {$animationcss}'>
                        <h1>{$heading}</h1>
                    </div>
                </div>
            </section>
        ";
    } else {                    
        return "
            <section>
                <div id='hero-full' class='hero'>
                    <img src='{$img[0]}' class='img-responsive' alt='{$alt}'>
                    <div class='inner-hero {$animationcss}'>
                        <h1>{$heading}</h1>
                        <br>
                        <a href='{$link}' class='btn btn-main' role='button'>{$button_text}</a>
                    </div>
                </div>
                <div id='hero-mobile' class='hero'>
                    <img src='{$img_mobile[0]}' class='img-responsive' alt='{$alt}'>
                    <div class='inner-hero {$animationcss}'>
                        <h1>{$heading}</h1>
                        <br>
                        <a href='{$link}' class='btn btn-main' role='button'>{$button_text}</a>
                    </div>
                </div>
            </section>
        ";
    }
    
}
add_action( 'vc_before_init', 'hero_integrateWithVC' );
function hero_integrateWithVC() {
    vc_map( [
        "name" => __( "Hero Image"),
        "base" => "hero",
        "category" => __("Custom Elements"),
        'params' => [
            [
                "type" => "attach_image",
                "heading" => __("Large Image"),
                "param_name" => "image",
                'holder' => 'div' 
            ],
            [
                "type" => "attach_image",
                "heading" => __("Mobile Image"),
                "param_name" => "image_mobile",
                'holder' => 'div' 
            ],
            [
                "type" => "textfield",
                "heading" => __("Image alt text"),
                "param_name" => "alt",
                'holder' => 'div' 
            ],
            [
                "type" => "textfield",
                "heading" => __("Heading"),
                "param_name" => "heading",
                'holder' => 'div' 
            ],
            [
                "type" => "textfield",
                "heading" => __("Button Text"),
                "param_name" => "button_text",
                "description" => __("Leave blank if you don't want a button"),
                'holder' => 'div' 
            ],
            [
                "type" => "textfield",
                "heading" => __("Button Link"),
                "param_name" => "link",
                "description" => __("Leave blank if you don't want a button"),
                'holder' => 'div' 
            ],
            [
                "type" => "dropdown",
                "heading" => __("CSS Animation"),
                "param_name" => "animation",
                "value" => [
                    'No' => 'no',
                    'Top to bottom' => 'top-to-bottom',	
                    'Bottom to top' => 'bottom-to-top',						
                    'Left to right' => 'left-to-right',	
                    'Right to left' => 'right-to-left',	
                    'Appear from center' => 'appear',
                ],
            ],
        ]
    ] );

}

/* ********************************************************************* */
/* *************************HEADER BLOCK******************************** */

add_shortcode('header', 'header_func');
function header_func( $atts, $content = null ) { extract(shortcode_atts(['animation' => 'no'], $atts));
    $content = wpb_js_remove_wpautop($content, true);
    if ($animation === 'no') {
        $animationcss = '';
    }
	if ($animation === 'top-to-bottom') {
        $animationcss = 'wpb_animate_when_almost_visible wpb_top-to-bottom';
    }
	if ($animation === 'bottom-to-top') {
        $animationcss = 'wpb_animate_when_almost_visible wpb_bottom-to-top';
    }
    if ($animation === 'left-to-right') {
        $animationcss = 'wpb_animate_when_almost_visible wpb_left-to-right';
    }
	if ($animation === 'right-to-left') {
        $animationcss = 'wpb_animate_when_almost_visible wpb_right-to-left';
    }
	if ($animation === 'appear') {
        $animationcss = 'wpb_animate_when_almost_visible wpb_appear';
    }
    
    return "
        <div class='container'>
            <div class='row'>
                <div class='header-block {$animationcss}'>
                    {$content}
                </div>
            </div>
        </div>
    ";
}
add_action( 'vc_before_init', 'header_integrateWithVC' );
function header_integrateWithVC() {
    vc_map( [
        "name" => __( "Header Block"),
        "base" => "header",
        "category" => __("Custom Elements"),
        "params" => [
            [
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __( "Content" ),
                "param_name" => "content"
            ],
            [
                "type" => "dropdown",
                "heading" => __("CSS Animation"),
                "param_name" => "animation",
                "value" => [
                    'No' => 'no',
                    'Top to bottom' => 'top-to-bottom',	
                    'Bottom to top' => 'bottom-to-top',						
                    'Left to right' => 'left-to-right',	
                    'Right to left' => 'right-to-left',	
                    'Appear from center' => 'appear',
                ],
            ],
        ]
    ] );
}


/* ********************************************************************* */
/* *************************SERVICES BLOCK****************************** */

add_shortcode('messages', 'messages_func');

function messages_func($atts) {
    extract(shortcode_atts([
        'heading1' => '',
        'link1' => '#',
        'img1' => '',
        'img1hover' => '',
        'text1' => '',
        'animation1' => 'no',
        'heading2' => '',
        'link2' => '#',
        'img2' => '',
        'img2hover' => '',
        'text2' => '',
        'animation2' => 'no',
        'heading3' => '',
        'link3' => '#',
        'img3' => '',
        'img3hover' => '',
        'text3' => '',
        'animation3' => 'no',
        'heading4' => '',
        'link4' => '#',
        'img4' => '',
        'img4hover' => '',
        'text4' => '',
        'animation4' => 'no'
    ], $atts));

    $image1 = wp_get_attachment_image_src($img1, 'full');
    $image2 = wp_get_attachment_image_src($img2, 'full');
    $image3 = wp_get_attachment_image_src($img3, 'full');
    $image4 = wp_get_attachment_image_src($img4, 'full');
    $image1hover = wp_get_attachment_image_src($img1hover, 'full');
    $image2hover = wp_get_attachment_image_src($img2hover, 'full');
    $image3hover = wp_get_attachment_image_src($img3hover, 'full');
    $image4hover = wp_get_attachment_image_src($img4hover, 'full');
	
    if ($animation1 === 'no') {
        $animationcss1 = '';
    }
    if ($animation1 === 'top-to-bottom') {
        $animationcss1 = 'wpb_animate_when_almost_visible wpb_top-to-bottom';
    }
    if ($animation1 === 'bottom-to-top') {
        $animationcss1 = 'wpb_animate_when_almost_visible wpb_bottom-to-top';
    }
    if ($animation1 === 'left-to-right') {
        $animationcss1 = 'wpb_animate_when_almost_visible wpb_left-to-right';
    }
    if ($animation1 === 'right-to-left') {
        $animationcss1 = 'wpb_animate_when_almost_visible wpb_right-to-left';
    }
    if ($animation1 === 'appear') {
        $animationcss1 = 'wpb_animate_when_almost_visible wpb_appear';
    }
    if ($animation2 === 'no') {
        $animationcss2 = '';
    }
    if ($animation2 === 'top-to-bottom') {
        $animationcss2 = 'wpb_animate_when_almost_visible wpb_top-to-bottom';
    }
    if ($animation2 === 'bottom-to-top') {
        $animationcss2 = 'wpb_animate_when_almost_visible wpb_bottom-to-top';
    }
    if ($animation2 === 'left-to-right') {
        $animationcss2 = 'wpb_animate_when_almost_visible wpb_left-to-right';
    }
    if ($animation2 === 'right-to-left') {
        $animationcss2 = 'wpb_animate_when_almost_visible wpb_right-to-left';
    }
    if ($animation2 === 'appear') {
        $animationcss2 = 'wpb_animate_when_almost_visible wpb_appear';
    }
    if ($animation3 === 'no') {
        $animationcss3 = '';
    }
    if ($animation3 === 'top-to-bottom') {
        $animationcss3 = 'wpb_animate_when_almost_visible wpb_top-to-bottom';
    }
    if ($animation3 === 'bottom-to-top') {
        $animationcss3 = 'wpb_animate_when_almost_visible wpb_bottom-to-top';
    }
    if ($animation3 === 'left-to-right') {
        $animationcss3 = 'wpb_animate_when_almost_visible wpb_left-to-right';
    }
    if ($animation3 === 'right-to-left') {
        $animationcss3 = 'wpb_animate_when_almost_visible wpb_right-to-left';
    }
    if ($animation3 === 'appear') {
        $animationcss3 = 'wpb_animate_when_almost_visible wpb_appear';
    }
    if ($animation4 === 'no') {
        $animationcss4 = '';
    }
    if ($animation4 === 'top-to-bottom') {
        $animationcss4 = 'wpb_animate_when_almost_visible wpb_top-to-bottom';
    }
    if ($animation4 === 'bottom-to-top') {
        $animationcss4 = 'wpb_animate_when_almost_visible wpb_bottom-to-top';
    }
    if ($animation4 === 'left-to-right') {
        $animationcss4 = 'wpb_animate_when_almost_visible wpb_left-to-right';
    }
    if ($animation4 === 'right-to-left') {
        $animationcss4 = 'wpb_animate_when_almost_visible wpb_right-to-left';
    }
    if ($animation4 === 'appear') {
        $animationcss4 = 'wpb_animate_when_almost_visible wpb_appear';
    }
      
    return "
        <section>
            <div class='container' style='margin-bottom:80px;'>
                <div class='row'>
                    <div class='messages'>
                        <a href='{$link1}' title='{$heading1}'>
                            <div class='col-sm-6 {$animationcss1}'>
                                <div class='hover-container'>
                                    <div class='hover1'>
                                        <div class='messagecont' style='background:url({$image1[0]}); background-repeat: no-repeat; background-size: cover;'>
                                            <div class='message'><h2>{$heading1}</h2></div>
                                        </div>
                                    </div>
                                    <div class='hover2'>
                                        <div class='messagecont hidden-xs hidden-sm hidden-md' style='background:url({$image1hover[0]}); background-repeat: no-repeat; background-size: cover;'>
                                            <div class='message'>
                                                <p>{$text1}</p>
                                            </div>
                                            <div class='button-cont'>
                                                <span class='btn btn-main' role='button'>Read More</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href='{$link2}' title='{$heading2}'>
                            <div class='col-sm-6 {$animationcss2}'>
                                <div class='hover-container'>
                                    <div class='hover1'>
                                        <div class='messagecont' style='background:url({$image2[0]}); background-repeat: no-repeat; background-size: cover;'>
                                            <div class='message'><h2>{$heading2}</h2></div>
                                        </div>
                                    </div>
                                    <div class='hover2'>
                                        <div class='messagecont hidden-xs hidden-sm hidden-md' style='background:url({$image2hover[0]}); background-repeat: no-repeat; background-size: cover;'>
                                            <div class='message'>
                                                <p>{$text2}</p>
                                            </div>
                                            <div class='button-cont'>
                                                <span class='btn btn-main' role='button'>Read More</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href='{$link3}' title='{$heading3}'>
                            <div class='col-sm-6 {$animationcss3}'>
                                <div class='hover-container'>
                                    <div class='hover1'>
                                        <div class='messagecont' style='background:url({$image3[0]}); background-repeat: no-repeat; background-size: cover;'>
                                            <div class='message'><h2>{$heading3}</h2></div>
                                        </div>
                                    </div>
                                    <div class='hover2'>
                                        <div class='messagecont hidden-xs hidden-sm hidden-md' style='background:url({$image3hover[0]}); background-repeat: no-repeat; background-size: cover;'>
                                            <div class='message'>
                                                <p>{$text3}</p>
                                            </div>
                                            <div class='button-cont'>
                                                <span class='btn btn-main' role='button'>Read More</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href='{$link4}' title='{$heading4}'>
                            <div class='col-sm-6  {$animationcss4}'>
                                <div class='hover-container'>
                                    <div class='hover1'>
                                        <div class='messagecont' style='background:url({$image4[0]}); background-repeat: no-repeat; background-size: cover;'>
                                            <div class='message'><h2>{$heading4}</h2></div>
                                        </div>
                                    </div>
                                    <div class='hover2'>
                                        <div class='messagecont hidden-xs hidden-sm hidden-md' style='background:url({$image4hover[0]}); background-repeat: no-repeat; background-size: cover;'>
                                            <div class='message'>
                                                <p>{$text4}</p>
                                            </div>
                                            <div class='button-cont'>
                                                <span class='btn btn-main' role='button'>Read More</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    ";
}

add_action('vc_before_init', 'messages_integrateWithVC');

function messages_integrateWithVC() {
    vc_map( [
        "name" => __("Services"),
        "base" => "messages",
        "category" => __("Custom Elements"),
        "params" => [
            [
                "type" => "attach_image",
                "heading" => __("Background Image 1"),
                "param_name" => "img1"
            ],
            [
                "type" => "attach_image",
                "heading" => __("Hover background Image 1"),
                "param_name" => "img1hover"
            ],
            [
                "type" => "textfield",
                "heading" => __("Heading 1"),
                "param_name" => "heading1",
                "value" => __("Enter your heading")
            ],
            [
                "type" => "textfield",
                "heading" => __("Link 1"),
                "param_name" => "link1",
                "value" => __("Enter page to link to")
            ],
            [
                "type" => "textarea",
                "heading" => __("Text 1"),
                "param_name" => "text1",
                "value" => __("Enter your text")
            ],
            [
                "type" => "dropdown",
                "heading" => __("CSS Animation 1"),
                "param_name" => "animation1",
                "value" => [
                    'No' => 'no',
                    'Top to bottom' => 'top-to-bottom',	
                    'Bottom to top' => 'bottom-to-top',						
                    'Left to right' => 'left-to-right',	
                    'Right to left' => 'right-to-left',	
                    'Appear from center' => 'appear',
                ],
            ],
            [
                "type" => "attach_image",
                "heading" => __("Background Image 2"),
                "param_name" => "img2"
            ],
            [
                "type" => "attach_image",
                "heading" => __("Hover background Image 2"),
                "param_name" => "img2hover"
            ],
            [
                "type" => "textfield",
                "heading" => __("Heading 2"),
                "param_name" => "heading2",
                "value" => __("Enter your heading")
            ],
            [
                "type" => "textfield",
                "heading" => __("Link 2"),
                "param_name" => "link2",
                "value" => __("Enter page to link to")
            ],
            [
                "type" => "textarea",
                "heading" => __("Text 2"),
                "param_name" => "text2",
                "value" => __("Enter your text")
            ],
            [
                "type" => "dropdown",
                "heading" => __("CSS Animation 2"),
                "param_name" => "animation2",
                "value" => [
                    'No' => 'no',
                    'Top to bottom' => 'top-to-bottom',	
                    'Bottom to top' => 'bottom-to-top',						
                    'Left to right' => 'left-to-right',	
                    'Right to left' => 'right-to-left',	
                    'Appear from center' => 'appear',
                ],
            ],
            [
                "type" => "attach_image",
                "heading" => __("Background Image 3"),
                "param_name" => "img3"
            ],
            [
                "type" => "attach_image",
                "heading" => __("Hover background Image 3"),
                "param_name" => "img3hover"
            ],
            [
                "type" => "textfield",
                "heading" => __("Heading 3"),
                "param_name" => "heading3",
                "value" => __("Enter your heading")
            ],
            [
                "type" => "textfield",
                "heading" => __("Link 3"),
                "param_name" => "link3",
                "value" => __("Enter page to link to")
            ],
            [
                "type" => "textarea",
                "heading" => __("Text 3"),
                "param_name" => "text3",
                "value" => __("Enter your text")
            ],
            [
                "type" => "dropdown",
                "heading" => __("CSS Animation 3"),
                "param_name" => "animation3",
                "value" => [
                    'No' => 'no',
                    'Top to bottom' => 'top-to-bottom',	
                    'Bottom to top' => 'bottom-to-top',						
                    'Left to right' => 'left-to-right',	
                    'Right to left' => 'right-to-left',	
                    'Appear from center' => 'appear',
                ],
            ],
            [
                "type" => "attach_image",
                "heading" => __("Background Image 4"),
                "param_name" => "img4"
            ],
            [
                "type" => "attach_image",
                "heading" => __("Hover background Image 4"),
                "param_name" => "img4hover"
            ],
            [
                "type" => "textfield",
                "heading" => __("Heading 4"),
                "param_name" => "heading4",
                "value" => __("Enter your heading")
            ],
            [
                "type" => "textfield",
                "heading" => __("Link 4"),
                "param_name" => "link4",
                "value" => __("Enter page to link to")
            ],
            [
                "type" => "textarea",
                "heading" => __("Text 4"),
                "param_name" => "text4",
                "value" => __("Enter your text")
            ],
            [
                "type" => "dropdown",
                "heading" => __("CSS Animation 4"),
                "param_name" => "animation4",
                "value" => [
                    'No' => 'no',
                    'Top to bottom' => 'top-to-bottom',	
                    'Bottom to top' => 'bottom-to-top',						
                    'Left to right' => 'left-to-right',	
                    'Right to left' => 'right-to-left',	
                    'Appear from center' => 'appear',
                ],
            ],
        ]
    ]);
}

/* ********************************************************************* */
/* ***************************SERVICES NEW******************************* */

// Shortcode Parent
function services_container_func( $atts, $content = null ) {
    $output = "
        <section>
            <div class='container' style='margin-bottom:80px;'>
                <div class='row'>
                    <div class='messages'>
                        ".do_shortcode($content)."
                    </div>
                </div>
            </div>
        </section>
    ";

    return $output;
}
add_shortcode( 'services_container', 'services_container_func' );

// Shortcode Child

function services_func($atts) {  
    extract(shortcode_atts(['heading' => '', 'link' => '', 'img' => '', 'imghover' => '', 'text' => '', 'animation' => 'no'], $atts));
    
    $image = wp_get_attachment_image_src($img, 'full');
    $imagehover = wp_get_attachment_image_src($imghover, 'full');
    	
    if ($animation === 'no') {
        $animationcss = '';
    }
    if ($animation === 'top-to-bottom') {
        $animationcss = 'wpb_animate_when_almost_visible wpb_top-to-bottom';
    }
    if ($animation === 'bottom-to-top') {
        $animationcss = 'wpb_animate_when_almost_visible wpb_bottom-to-top';
    }
    if ($animation === 'left-to-right') {
        $animationcss = 'wpb_animate_when_almost_visible wpb_left-to-right';
    }
    if ($animation === 'right-to-left') {
        $animationcss = 'wpb_animate_when_almost_visible wpb_right-to-left';
    }
    if ($animation === 'appear') {
        $animationcss = 'wpb_animate_when_almost_visible wpb_appear';
    }
    $href = vc_build_link( $link );
    
        
    return "
        <a href='{$href[url]}' title='{$heading}'>
            <div class='col-sm-6 {$animationcss}'>
                <div class='hover-container'>
                    <div class='hover1'>
                        <div class='messagecont' style='background:url({$image[0]}); background-repeat: no-repeat; background-size: cover;'>
                            <div class='message'><h2>{$heading}</h2></div>
                        </div>
                    </div>
                    <div class='hover2'>
                        <div class='messagecont hidden-xs hidden-sm hidden-md' style='background:url({$imagehover[0]}); background-repeat: no-repeat; background-size: cover;'>
                            <div class='message'>
                                <p>{$text}</p>
                            </div>
                            <div class='button-cont'>
                                <span class='btn btn-main' role='button'>Read More</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    ";
}
add_shortcode('services', 'services_func');

// Parent Element
function services_container_integrateWithVC() {
    vc_map( [
        'name' => __( 'Services Container'),
        'base' => 'services_container',
        'description' => __( 'Add Services Container' ),
        'category' => __('Custom Elements'),
        'as_parent' => ['only' => 'services'],
        'content_element' => true,
        'show_settings_on_create' => false,
        'js_view' => 'VcColumnView', 
    ] );
}
add_action( 'vc_before_init', 'services_container_integrateWithVC' );

// Child Element
function services_integrateWithVC() {
    vc_map( [
        'name' => __('Services'),
        'base' => 'services',
        'description' => __( 'Add a service.' ),
        'category' => __('Custom Elements'),
        'content_element' => true,
        'as_child' => ['only' => 'service_container'],
        "params" => [
            [
                "type" => "attach_image",
                "heading" => __("Background Image"),
                "param_name" => "img"
            ],
            [
                "type" => "attach_image",
                "heading" => __("Hover background Image"),
                "param_name" => "imghover"
            ],
            [
                "type" => "textfield",
                "heading" => __("Heading"),
                "param_name" => "heading",
                "value" => __("Enter your heading")
            ],
            [
                "type" => "vc_link",
                "heading" => __("Link"),
                "param_name" => "link",
                "value" => __("Enter page to link to")
            ],
            [
                "type" => "textarea",
                "heading" => __("Text"),
                "param_name" => "text",
                "value" => __("Enter your text")
            ],
            [
                "type" => "dropdown",
                "heading" => __("CSS Animation"),
                "param_name" => "animation",
                "value" => [
                    'No' => 'no',
                    'Top to bottom' => 'top-to-bottom',	
                    'Bottom to top' => 'bottom-to-top',						
                    'Left to right' => 'left-to-right',	
                    'Right to left' => 'right-to-left',	
                    'Appear from center' => 'appear',
                ],
            ],
        ]
    ] );
}
add_action( 'vc_before_init', 'services_integrateWithVC' );

if(class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_Services_Container extends WPBakeryShortCodesContainer { }
}
if(class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Services extends WPBakeryShortCode { }
}

/* ********************************************************************* */
/* ***************************TESTIMONIAL******************************* */

// Shortcode Parent
function test_container_func( $atts, $content = null ) {
    $output = "
        <section>
            <div class='test-container'>
                <div class='test-inner'>
                    <h3>Testimonials</h3>
                    ".do_shortcode($content)."
                </div>
            </div>
        </section>
    ";

    return $output;
}
add_shortcode( 'test_container', 'test_container_func' );

// Shortcode Child
function test_func( $atts, $content = null) { 
    extract(shortcode_atts(['author' => '', 'animation' => 'no'], $atts));
    $uploads = wp_upload_dir();
    $dir = $uploads['baseurl'];
    if ($animation === 'no') {
        $animationcss = '';
    }
    if ($animation === 'top-to-bottom') {
        $animationcss = 'wpb_animate_when_almost_visible wpb_top-to-bottom';
    }
    if ($animation === 'bottom-to-top') {
        $animationcss = 'wpb_animate_when_almost_visible wpb_bottom-to-top';
    }
    if ($animation === 'left-to-right') {
        $animationcss = 'wpb_animate_when_almost_visible wpb_left-to-right';
    }
    if ($animation === 'right-to-left') {
        $animationcss = 'wpb_animate_when_almost_visible wpb_right-to-left';
    }
    if ($animation === 'appear') {
        $animationcss = 'wpb_animate_when_almost_visible wpb_appear';
    }
    return "
        <div class='test {$animationcss}'>
            {$content}
        </div>
        <div class='t-author {$animationcss}'>
            <span class='test-icon'>
                <img src='{$dir}/speach-icon.png' alt='Speach Icon'>
            </span>
            {$author}
        </div>
    ";
}
add_shortcode('test', 'test_func');

// Parent Element
function test_container_integrateWithVC() {
    vc_map( [
        'name' => __( 'Testimonials Container'),
        'base' => 'test_container',
        'description' => __( 'Add Testimonials Container' ),
        'category' => __('Custom Elements'),
        'as_parent' => ['only' => 'test'],
        'content_element' => true,
        'show_settings_on_create' => false,
        'js_view' => 'VcColumnView', 
    ] );
}
add_action( 'vc_before_init', 'test_container_integrateWithVC' );

// Child Element
function test_integrateWithVC() {
    vc_map( [
        'name' => __('Testimonial'),
        'base' => 'test',
        'description' => __( 'Add a testimonial.' ),
        'category' => __('Custom Elements'),
        'content_element' => true,
        'as_child' => ['only' => 'test_container'],
        "params" => [
            [
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __( "Testimonial" ),
                "param_name" => "content"
            ],
            [
                "type" => "textfield",
                "heading" => __("Author"),
                "param_name" => "author",
                "value" => __("Enter Testimonial Author")
            ],
            [
                "type" => "dropdown",
                "heading" => __("CSS Animation"),
                "param_name" => "animation",
                "value" => [
                    'No' => 'no',
                    'Top to bottom' => 'top-to-bottom',	
                    'Bottom to top' => 'bottom-to-top',						
                    'Left to right' => 'left-to-right',	
                    'Right to left' => 'right-to-left',	
                    'Appear from center' => 'appear',
                ],
            ],
        ]
    ] );
}
add_action( 'vc_before_init', 'test_integrateWithVC' );

if(class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_Test_Container extends WPBakeryShortCodesContainer { }
}
if(class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Test extends WPBakeryShortCode { }
}


/* ********************************************************************* */
/* ***************************TEXT BlOCK******************************** */
/*
// Shortcode Parent
function text_container_func( $atts, $content = null ) {
    extract(shortcode_atts(['header' => 'Header'], $atts));
    $output = "
        <section>
            <h2 class='text-block-header'>{$header}</h2>
            <div class='text-block clearfix'>
                ".do_shortcode($content)."
            </div>
        </section>
    ";

    return $output;
}
add_shortcode( 'text_container', 'text_container_func' );

// Shortcode Child
function text_func( $atts, $content = null ) {
    $content = wpb_js_remove_wpautop($content, true);
    
    $output = "
        <div class='col-xs-12 col-sm-4 col-md-15 nopadding'>
            <div class='text-inner'>
                {$content}
            </div>
        </div>
    ";

    return $output;
}
add_shortcode( 'text', 'text_func' );

// Parent Element
function text_container_integrateWithVC() {
    vc_map( [
        'name' => __( 'Grey Text Block Container'),
        'base' => 'text_container',
        'description' => __( 'Add Text Container' ),
        'category' => __('Custom Elements'),
        'as_parent' => ['only' => 'text'],
        'params' => [
             [
                "type" => "textfield",
                "heading" => __("Section Header"),
                "param_name" => "header",
                "value" => __("Section Header")
            ],
        ],
        'content_element' => true,
        'show_settings_on_create' => true,
        'js_view' => 'VcColumnView', 
        
    ] );
}
add_action( 'vc_before_init', 'text_container_integrateWithVC' );

// Child Element
function text_integrateWithVC() {
    vc_map( [
        'name' => __('Text Block'),
        'base' => 'text',
        'description' => __( 'Add a text block.' ),
        'category' => __('Custom Elements'),
        'content_element' => true,
        'as_child' => ['only' => 'text_container'],
        'params' => [
            [
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __( "Content" ),
                "param_name" => "content"
            ],
        ]
    ] );
}
add_action( 'vc_before_init', 'text_integrateWithVC' );

if(class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_Text_Container extends WPBakeryShortCodesContainer { }
}
if(class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Text extends WPBakeryShortCode { }
}

/* ********************************************************************* */
/* ***************************CERT BlOCK******************************** */
/*
// Shortcode Parent
function cert_container_func( $atts, $content = null ) {
    extract(shortcode_atts(['header' => 'Header'], $atts));
    $output = "
        <section>
            <h2 class='text-block-header'>{$header}</h2>
            <div class='container'>
                <div class='row'>
                    <table class='certs'>
                        <tbody>
                            ".do_shortcode($content)."
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    ";

    return $output;
}
add_shortcode( 'cert_container', 'cert_container_func' );

// Shortcode Child
function cert_func( $atts ) {
    extract(shortcode_atts(['type' => '', 'cert' => '', 'school' => '', 'year' => '' ], $atts));   
    $output = "
        <tr><td>{$type}</td><td>{$cert}</td><td>{$school}</td><td>{$year}</td></tr>
    ";

    return $output;
}
add_shortcode( 'cert', 'cert_func' );

// Parent Element
function cert_container_integrateWithVC() {
    vc_map( [
        'name' => __( 'Certificate Table Container'),
        'base' => 'cert_container',
        'description' => __( 'Add Certificate Table' ),
        'category' => __('Custom Elements'),
        'as_parent' => ['only' => 'cert'],
        'params' => [
            [
                "type" => "textfield",
                "heading" => __("Section Header"),
                "param_name" => "header",
                "value" => __("Section Header")
            ],
        ],
        'content_element' => true,
        'show_settings_on_create' => true,
        'js_view' => 'VcColumnView', 
        
    ] );
}
add_action( 'vc_before_init', 'cert_container_integrateWithVC' );

// Child Element
function cert_integrateWithVC() {
    vc_map( [
        'name' => __('Certificate Table Row'),
        'base' => 'cert',
        'description' => __( 'Add Row to Certificate Table.' ),
        'category' => __('Custom Elements'),
        'content_element' => true,
        'as_child' => ['only' => 'cert_container'],
        'params' => [
            [
                "type" => "textfield",
                "heading" => __("Certificate Type"),
                "param_name" => "type",
            ],
            [
                "type" => "textfield",
                "heading" => __("Certificate"),
                "param_name" => "cert",
            ],
            [
                "type" => "textfield",
                "heading" => __("School"),
                "param_name" => "school",
            ],
            [
                "type" => "textfield",
                "heading" => __("Year"),
                "param_name" => "year",
            ],
        ]
    ] );
}
add_action( 'vc_before_init', 'cert_integrateWithVC' );

if(class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_Cert_Container extends WPBakeryShortCodesContainer { }
}
if(class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Cert extends WPBakeryShortCode { }
}

/* ********************************************************************* */
/* ***************************MEMBERSHIP BLOCK************************** */
/*
// Shortcode Parent
function member_container_func( $atts, $content = null ) {
    extract(shortcode_atts(['header' => 'Header'], $atts));
    $output = "
        <section>
            <h2 class='text-block-header'>{$header}</h2>
            <div class='container'>
                <div class='row'>
                    <div class='text-block clearfix member-block'>
                        ".do_shortcode($content)."
                    </div>
                </div>
            </div>               
        </section>
    ";

    return $output;
}
add_shortcode( 'member_container', 'member_container_func' );

// Shortcode Child
function member_func( $atts, $content = null ) {
    $content = wpb_js_remove_wpautop($content, true);
    
    $output = "
        <div class='member col-sm-6 nopadding'>
            <div class='text-inner'>
                {$content}
            </div>
        </div>
    ";

    return $output;
}
add_shortcode( 'member', 'member_func' );

// Parent Element
function member_container_integrateWithVC() {
    vc_map( [
        'name' => __( 'Membership Container'),
        'base' => 'member_container',
        'description' => __( 'Add Membership Container' ),
        'category' => __('Custom Elements'),
        'as_parent' => ['only' => 'member'],
        'params' => [
             [
                "type" => "textfield",
                "heading" => __("Section Header"),
                "param_name" => "header",
                "value" => __("Section Header")
            ],
        ],
        'content_element' => true,
        'show_settings_on_create' => true,
        'js_view' => 'VcColumnView', 
        
    ] );
}
add_action( 'vc_before_init', 'member_container_integrateWithVC' );

// Child Element
function member_integrateWithVC() {
    vc_map( [
        'name' => __('Membership Text Block'),
        'base' => 'member',
        'description' => __( 'Add a text block.' ),
        'category' => __('Custom Elements'),
        'content_element' => true,
        'as_child' => ['only' => 'member_container'],
        'params' => [
            [
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __( "Content" ),
                "param_name" => "content"
            ],
        ]
    ] );
}
add_action( 'vc_before_init', 'member_integrateWithVC' );

if(class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_Member_Container extends WPBakeryShortCodesContainer { }
}
if(class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Member extends WPBakeryShortCode { }
}

/* ********************************************************************* */
/* ***************************CLIENTS BLOCK***************************** */
/*
// Shortcode Parent
function clients_container_func( $atts, $content = null ) {
    $output = "
        <section class='clients-section clearfix'>
            ".do_shortcode($content)."
        </section>
    ";

    return $output;
}
add_shortcode( 'clients_container', 'clients_container_func' );

// Shortcode Child
function clients_func( $atts, $content = null ) {
    extract(shortcode_atts(['image' => 'image'], $atts));
    
    $content = wpb_js_remove_wpautop($content, true);
    $img = wp_get_attachment_image_src($image, 'full');
    
    $output = "
        <div class='col-sm-6 col-md-4 client'>
            <div class='hover1'>
                <div class='client' style='background:url({$img[0]}); background-repeat: no-repeat; background-position: 50% 50%; background-size:contain;'>

                </div>
            </div>
            <div class='hover2'>
                <div class='client hidden-xs' style='background:#79a448;'>
                    <div class='message'>
                        {$content}
                    </div>
                </div>
            </div>
        </div>
    ";

    return $output;
}
add_shortcode( 'clients', 'clients_func' );

// Parent Element
function clients_container_integrateWithVC() {
    vc_map( [
        'name' => __( 'Clients Container'),
        'base' => 'clients_container',
        'description' => __( 'Add Clients Container' ),
        'category' => __('Custom Elements'),
        'as_parent' => ['only' => 'clients'],
        'content_element' => true,
        'show_settings_on_create' => false,
        'js_view' => 'VcColumnView', 
        
    ] );
}
add_action( 'vc_before_init', 'clients_container_integrateWithVC' );

// Child Element
function clients_integrateWithVC() {
    vc_map( [
        'name' => __('Client Logo'),
        'base' => 'clients',
        'category' => __('Custom Elements'),
        'content_element' => true,
        'as_child' => ['only' => 'clients_container'],
        'params' => [
            [
                "type" => "attach_image",
                "heading" => __("Client Logo"),
                "param_name" => "image"
            ],
            [
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __( "Content" ),
                "param_name" => "content"
            ],
        ]
    ] );
}
add_action( 'vc_before_init', 'clients_integrateWithVC' );

if(class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_Clients_Container extends WPBakeryShortCodesContainer { }
}
if(class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Clients extends WPBakeryShortCode { }
}

/* ********************************************************************* */
/* ***************************SERVICES BOTTOM*************************** */
add_shortcode('services_bottom', 'services_bottom_func');

function services_bottom_func($atts) {
    extract(shortcode_atts([
        'heading1' => '',
        'link1' => '',
        'img1' => '',
        'img1hover' => '',
        'text1' => '',
        'animation1' => 'no',
        'heading2' => '',
        'link2' => '',
        'img2' => '',
        'img2hover' => '',
        'text2' => '',
        'animation2' => 'no'
    ], $atts));

    $image1 = wp_get_attachment_image_src($img1, 'full');
    $image2 = wp_get_attachment_image_src($img2, 'full');
    $image1hover = wp_get_attachment_image_src($img1hover, 'full');
    $image2hover = wp_get_attachment_image_src($img2hover, 'full');
    
    if ($animation1 === 'no') {
        $animationcss1 = '';
    }
    if ($animation1 === 'top-to-bottom') {
        $animationcss1 = 'wpb_animate_when_almost_visible wpb_top-to-bottom';
    }
    if ($animation1 === 'bottom-to-top') {
        $animationcss1 = 'wpb_animate_when_almost_visible wpb_bottom-to-top';
    }
    if ($animation1 === 'left-to-right') {
        $animationcss1 = 'wpb_animate_when_almost_visible wpb_left-to-right';
    }
    if ($animation1 === 'right-to-left') {
        $animationcss1 = 'wpb_animate_when_almost_visible wpb_right-to-left';
    }
    if ($animation1 === 'appear') {
        $animationcss1 = 'wpb_animate_when_almost_visible wpb_appear';
    }
    if ($animation2 === 'no') {
        $animationcss2 = '';
    }
    if ($animation2 === 'top-to-bottom') {
        $animationcss2 = 'wpb_animate_when_almost_visible wpb_top-to-bottom';
    }
    if ($animation2 === 'bottom-to-top') {
        $animationcss2 = 'wpb_animate_when_almost_visible wpb_bottom-to-top';
    }
    if ($animation2 === 'left-to-right') {
        $animationcss2 = 'wpb_animate_when_almost_visible wpb_left-to-right';
    }
    if ($animation2 === 'right-to-left') {
        $animationcss2 = 'wpb_animate_when_almost_visible wpb_right-to-left';
    }
    if ($animation2 === 'appear') {
        $animationcss2 = 'wpb_animate_when_almost_visible wpb_appear';
    }
    
    return "
        <div class='container'>
            <div class='services-container clearfix'>
                <a href='{$link1}' title='{$heading1}'>
                    <div class='col-sm-6 {$animationcss1}'>
                        <div class='hover-container'>
                            <div class='hover1'>
                                <div class='messagecont' style='background:url({$image1[0]}); background-repeat: no-repeat; background-size: cover; background-position: center;'>
                                    <div class='service'><h3>{$heading1}</h3></div>
                                </div>
                            </div>
                            <div class='hover2'>
                                <div class='messagecont hidden-xs hidden-sm hidden-md' style='background:url({$image1hover[0]}); background-repeat: no-repeat; background-size: cover; background-position: center;'>
                                    <div class='message'>
                                        <p>{$text1}</p>
                                    </div>
                                    <div class='button-cont'>
                                        <span class='btn btn-main' role='button'>Read More</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                
                <a href='{$link2}' title='{$heading2}'>
                    <div class='col-sm-6 {$animationcss2}'>
                        <div class='hover-container'>
                            <div class='hover1'>
                                <div class='messagecont' style='background:url({$image2[0]}); background-repeat: no-repeat; background-size: cover; background-position: center;'>
                                    <div class='service'><h3>{$heading2}</h3></div>
                                </div>
                            </div>
                            <div class='hover2'>
                                <div class='messagecont hidden-xs hidden-sm hidden-md' style='background:url({$image2hover[0]}); background-repeat: no-repeat; background-size: cover; background-position: center;'>
                                    <div class='message'>
                                        <p>{$text2}</p>
                                    </div>
                                    <div class='button-cont'>
                                        <span class='btn btn-main' role='button'>Read More</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    ";
}

add_action('vc_before_init', 'services_bottom_integrateWithVC');

function services_bottom_integrateWithVC() {
    vc_map( [
        "name" => __("Services Bottom"),
        "base" => "services_bottom",
        "category" => __("Custom Elements"),
        "params" => [
            [
                "type" => "textfield",
                "heading" => __("Heading 1"),
                "param_name" => "heading1",
                "value" => __("Enter your heading")
            ],
            [
                "type" => "textfield",
                "heading" => __("Link 1"),
                "param_name" => "link1",
                "value" => __("Enter page to link to")
            ],
            [
                "type" => "attach_image",
                "heading" => __("Background Image 1"),
                "param_name" => "img1"
            ],
            [
                "type" => "attach_image",
                "heading" => __("Background Image 1 Hover"),
                "param_name" => "img1hover"
            ],
            [
                "type" => "textarea",
                "heading" => __("Text 1"),
                "param_name" => "text1"
            ],
            [
                "type" => "dropdown",
                "heading" => __("CSS Animation 1"),
                "param_name" => "animation1",
                "value" => [
                    'No' => 'no',
                    'Top to bottom' => 'top-to-bottom',	
                    'Bottom to top' => 'bottom-to-top',						
                    'Left to right' => 'left-to-right',	
                    'Right to left' => 'right-to-left',	
                    'Appear from center' => 'appear',
                ],
            ],
            [
                "type" => "textfield",
                "heading" => __("Heading 2"),
                "param_name" => "heading2",
                "value" => __("Enter your heading")
            ],
            [
                "type" => "textfield",
                "heading" => __("Link 2"),
                "param_name" => "link2",
                "value" => __("Enter page to link to")
            ],
            [
                "type" => "attach_image",
                "heading" => __("Background Image 2"),
                "param_name" => "img2"
            ],
            [
                "type" => "attach_image",
                "heading" => __("Background Image 2 Hover"),
                "param_name" => "img2hover"
            ],
            [
                "type" => "textarea",
                "heading" => __("Text 2"),
                "param_name" => "text2"
            ],
            [
                "type" => "dropdown",
                "heading" => __("CSS Animation 2"),
                "param_name" => "animation2",
                "value" => [
                    'No' => 'no',
                    'Top to bottom' => 'top-to-bottom',	
                    'Bottom to top' => 'bottom-to-top',						
                    'Left to right' => 'left-to-right',	
                    'Right to left' => 'right-to-left',	
                    'Appear from center' => 'appear',
                ],
            ],
        ]
    ]);
}

/* ********************************************************************************************* */
/* ********************************************************************************************* */
/* ********************************************************************************************* */
/* ********************************************************************************************* */
/* Team Row Shortcode */
function flex_row_func( $atts, $content = null ) {
    $output = "
        <div class='flex-container'>
            ".do_shortcode($content)."
        </div>
    ";

    return $output;
}
add_shortcode( 'flex_row', 'flex_row_func' );


/* Team Block */
function team_block_func( $atts, $content = null ) {
    extract(shortcode_atts(['image' => 'image'], $atts));
    
    $image = wp_get_attachment_image_src($image, 'full');
    $content = wpb_js_remove_wpautop($content, true);
    return "
        <div class='col-sm-6 team' >
            <div class='team-image wpb_animate_when_almost_visible wpb_appear'>
                <img src='{$image[0]}' alt='Staff Member'>
            </div>
            <div class='team-content flex-item wpb_animate_when_almost_visible wpb_appear'>
                {$content}
            </div>
        </div>
    ";
}
add_shortcode('team_block', 'team_block_func');

/* Team Row Element */
function flex_row_integrateWithVC() {
    vc_map( [
        'name' => __( 'Team Row.'),
        'base' => 'flex_row',
        "category" => __("Custom Elements"),
        "description" => __("Add 2 members per row."),
        'as_parent' => ['only' => 'team_block'],
        'content_element' => true,
        'show_settings_on_create' => false,
        'js_view' => 'VcColumnView', 
    ] );
}
add_action( 'vc_before_init', 'flex_row_integrateWithVC' );

/* Team Block Element */
function team_block_integrateWithVC() {
    vc_map( [
        "name" => __( "Team Block"),
        "base" => "team_block",
        "category" => __("Custom Elements"),
        "as_child" => ['only' => 'flex_row'],
        "params" => [
            [
                "type" => "attach_image",
                "heading" => __("Background Image"),
                "param_name" => "image",
            ],
            [
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __( "Content" ),
                "param_name" => "content",
            ],
        ]
    ] );
}
add_action( 'vc_before_init', 'team_block_integrateWithVC' );

if(class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_Flex_Row extends WPBakeryShortCodesContainer { }
}
if(class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Team_Block extends WPBakeryShortCode { }
}