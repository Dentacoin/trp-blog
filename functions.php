<?php
//Setup
function blog_setup() {
	load_theme_textdomain( 'blogtrp' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );

	add_filter( 'use_default_gallery_style', '__return_false' );

    register_nav_menus( array(
        'primary' => 'Primary Menu',
        'footer' => 'Footer Menu',
    ));
}
add_action( 'after_setup_theme', 'blog_setup' );


function wpdocs_custom_excerpt_length( $length ) {
    return 37;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );


function get_cat_slug($cat_id) {
	$cat_id = (int) $cat_id;
	$category = &get_category($cat_id);
	return $category->slug;
}
/**
 * Register our sidebars and widgetized areas.
 *
 */
function blog_widgets_init() {

	register_sidebar( array(
		'name'          => 'Post social share',
		'id'            => 'post_social_share',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
	) );

}
add_action( 'widgets_init', 'blog_widgets_init' );

function post_types() {

    register_post_type( 'dentist',
        array(
            'hierarchical' => true,
            'labels' => array(
                'name' => 'Dentists',
                'singular_name' => 'Dentist'
            ),
            'public' => true,
            'has_archive' => false,
            'taxonomies' => array('post_tag'),
            'supports' => array('title', 'editor', 'thumbnail')
        )
    );
    add_post_type_support( 'dentist', 'page-attributes' );

    register_post_type( 'assets',
        array(
            'hierarchical' => true,
            'labels' => array(
                'name' => 'Assets',
                'singular_name' => 'Asset'
            ),
            'public' => true,
            'has_archive' => true,
            'taxonomies' => array('post_tag'),
            'supports' => array('title', 'editor', 'thumbnail')
        )
    );
    add_post_type_support( 'assets', 'page-attributes' );

}
add_action( 'init', 'post_types' );

add_action( 'wp_ajax_demo-pagination-load-posts', 'cvf_demo_pagination_load_posts' );

add_action( 'wp_ajax_nopriv_demo-pagination-load-posts', 'cvf_demo_pagination_load_posts' ); 

function cvf_demo_pagination_load_posts() {

    global $wpdb;
    // Set default variables
    $msg = '';

    if(isset($_POST['page'])){
        // Sanitize the received page   
        $page = sanitize_text_field($_POST['page']);
        $cur_page = $page;
        $page -= 1;
        // Set the number of results to display
        $per_page = 9;
        $previous_btn = true;
        $next_btn = true;
        $first_btn = true;
        $last_btn = true;
        $start = $page * $per_page;

        // Set the table where we will be querying data
        $table_name = $wpdb->prefix . "posts";

        // Query the necessary posts
        $all_blog_posts = $wpdb->get_results($wpdb->prepare("
            SELECT * FROM " . $table_name . " WHERE post_type = 'post' AND post_status = 'publish' ORDER BY post_date DESC LIMIT %d, %d", $start, $per_page ) );

        // At the same time, count the number of queried posts
        $count = $wpdb->get_var($wpdb->prepare("
            SELECT COUNT(ID) FROM " . $table_name . " WHERE post_type = 'post' AND post_status = 'publish'", array() ) );

        // /**
        //  * Use WP_Query:
        //  *
        // $all_blog_posts = new WP_Query(
        //     array(
        //         'post_type'         => 'post',
        //         'post_status '      => 'publish',
        //         'orderby'           => 'post_date',
        //         'order'             => 'DESC',
        //         'posts_per_page'    => $per_page,
        //         'offset'            => $start
        //     )
        // );

        // $count = new WP_Query(
        //     array(
        //         'post_type'         => 'post',
        //         'post_status '      => 'publish',
        //         'posts_per_page'    => -1
        //     )
        // );
        // */

        // Loop into all the posts
        foreach($all_blog_posts as $key => $post): 
            $src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium', false );

            $c_c_id = '';
            $p_cat = '';
            foreach (wp_get_post_categories( $post->ID ) as $k => $cat_id) {
                if($k == 0) {
                    $p_cat = '• '.get_category($cat_id)->name;
                    $c_c_id = $cat_id;
                }
            }

            $image_position = !empty(get_field('featured_image_position',$post->ID)) || get_field('featured_image_position', $post->ID) === '0' ? get_field('featured_image_position', $post->ID).'%' : '50%';

            // Set the desired output into a variable
            $msg .= '
            <div class="news">
                <a href="' . get_permalink($post->ID) . '" class="news-image cover" style="background-image: url('.$src[0].'); background-position: 50% '.$image_position.'">            
                    <div class="cat">'.$p_cat.'</div>
                </a>
                <a href="'.get_permalink($post->ID).'">
                   <h4>'.get_the_title($post->ID).'</h4>
                </a>
                <a class="new-category" href="'.get_category_link($c_c_id).'">
                    '.$p_cat.'
                </a>
                <p>
                    '.apply_filters('the_excerpt', get_post_field('post_excerpt', $post->ID)).'
                </p>
                <a href="'.get_permalink($post->ID).'" class="read-more">
                    Read more
                    <img src="'.get_stylesheet_directory_uri().'/img/read-arrow.png">
                </a>
            </div>';

        endforeach;

        // Optional, wrap the output into a container
        $msg = "<div class='cvf-universal-content flex wrap'>" . $msg . "</div><br class = 'clear' />";

        // This is where the magic happens
        $no_of_paginations = ceil($count / $per_page);

        if ($cur_page >= 7) {
            $start_loop = $cur_page - 3;
            if ($no_of_paginations > $cur_page + 3)
                $end_loop = $cur_page + 3;
            else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
                $start_loop = $no_of_paginations - 6;
                $end_loop = $no_of_paginations;
            } else {
                $end_loop = $no_of_paginations;
            }
        } else {
            $start_loop = 1;
            if ($no_of_paginations > 7)
                $end_loop = 7;
            else
                $end_loop = $no_of_paginations;
        }

        // Pagination Buttons logic     
        $pag_container .= "
        <div class='cvf-universal-pagination'>
            <ul>";

        if ($first_btn && $cur_page > 1) {
            $pag_container .= "<li p='1' class='active entity'>&laquo;</li>";
        } else if ($first_btn) {
            $pag_container .= "<li p='1' class='inactive entity'>&laquo;</li>";
        }

        if ($previous_btn && $cur_page > 1) {
            $pre = $cur_page - 1;
            $pag_container .= "<li p='$pre' class='active entity'>&lsaquo;</li>";
        } else if ($previous_btn) {
            $pag_container .= "<li class='inactive entity'>&lsaquo;</li>";
        }
        for ($i = $start_loop; $i <= $end_loop; $i++) {

            if ($cur_page == $i)
                $pag_container .= "<li p='$i' class = 'selected' >{$i}</li>";
            else
                $pag_container .= "<li p='$i' class='active'>{$i}</li>";
        }

        if ($next_btn && $cur_page < $no_of_paginations) {
            $nex = $cur_page + 1;
            $pag_container .= "<li p='$nex' class='active entity'>&rsaquo;</li>";
        } else if ($next_btn) {
            $pag_container .= "<li class='inactive entity'>&rsaquo;</li>";
        }

        if ($last_btn && $cur_page < $no_of_paginations) {
            $pag_container .= "<li p='$no_of_paginations' class='active entity'>&raquo;</li>";
        } else if ($last_btn) {
            $pag_container .= "<li p='$no_of_paginations' class='inactive entity'>&raquo;</li>";
        }

        $pag_container = $pag_container . "
            </ul>
        </div>";

        // We echo the final output
        echo 
        '<div class = "cvf-pagination-content">' . $msg . '</div>' . 
        '<div class = "cvf-pagination-nav">' . $pag_container . '</div>';

    }
    // Always exit to avoid further execution
    exit();
}

//stops the WP api requests for retrieving the users data 
add_filter('rest_endpoints', function($endpoints){ 
    if (isset( $endpoints['/wp/v2/users'])) {
        unset( $endpoints['/wp/v2/users']);
    } 
    if (isset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'])) {
        unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)']);
    }
    return $endpoints; 
});

//removing wordpress version from 
remove_action('wp_head', 'wp_generator');

add_action( 'send_headers', 'my_headers' );
function my_headers() {
    header('X-Frame-Options: DENY');
}

?>