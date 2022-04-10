<?php
add_action( 'admin_init', 'hide_editor' );
function hide_editor() {
    $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
    if( !isset( $post_id ) ) return;
    if($post_id == 8){
        remove_post_type_support('page', 'editor');
    }
}
function rs_enqueue_page_style($page, $src, $version, $name) {
    if (is_string($page)) {
        if (is_page($page)) {
            wp_enqueue_style($name, $src, array(), $version);
        }
    } else if (is_array($page)) {
        $should_enqueue = true;
        foreach ($page as $p) {
            if (!is_page($p)) {
                $should_enqueue = false;
                break;
            }
        }
        if ($should_enqueue) wp_enqueue_style($name, $src, array(), $version);
    }
}

function rs_enqueue_page_script($page, $src,  $version, $in_footer, $name) {
    if (is_string($page)) {
        if (is_page($page)) {
            wp_enqueue_script($name, $src, array(), '1.0.0', $in_footer);
        }
    } else if (is_array($page)) {
        $should_enqueue = true;
        foreach ($page as $p) {
            if (!is_page($p)) {
                $should_enqueue = false;
                break;
            }
        }
        if ($should_enqueue) wp_enqueue_script($name, $src, array(), $version, $in_footer);
    }
}

if ( !function_exists( 'rs_setup' ) ) {
    function rs_setup() {
        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'responsive-embeds' );
        add_theme_support( 'custom-logo' );
        //remove_theme_support( 'block-templates' );
        add_theme_support( 'wp-block-styles' );

    }

    add_action( 'after_setup_theme', 'rs_setup' );
}

function rs_scripts() {
    rs_enqueue_page_script("home",get_template_directory_uri() . '/js/home.js', '1.0', true, 'home-script' );
    rs_enqueue_page_style("home", get_template_directory_uri() . '/css/main.css', '1.0', "home-main" );
    rs_enqueue_page_style("home", get_template_directory_uri() . '/css/home.css', '1.0', "home-css" );

}

add_action( 'wp_enqueue_scripts', 'rs_scripts' );
