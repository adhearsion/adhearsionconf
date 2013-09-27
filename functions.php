<?php 
/**
 * @package WordPress
 * @subpackage Sideways8: Skeleton
 */

/* mpress functions */
include (TEMPLATEPATH.'/inc/theme-setup.php');
include (TEMPLATEPATH.'/inc/template-loading.php');
include (TEMPLATEPATH.'/inc/twitter-widget.php');

/* wpalchemy metaboxes class */
include_once (TEMPLATEPATH.'/metaboxes/setup.php');
//include_once (TEMPLATEPATH.'/metaboxes/simple-spec.php');
//include_once (TEMPLATEPATH.'/metaboxes/full-spec.php');
//include_once (TEMPLATEPATH.'/metaboxes/checkbox-spec.php');
//include_once (TEMPLATEPATH.'/metaboxes/radio-spec.php');
//include_once (TEMPLATEPATH.'/metaboxes/select-spec.php');

// drag and drop menu support
register_nav_menu( 'primary', 'Primary Menu' );
register_nav_menu( 'sidebar', 'Sidebar Menu' );
register_nav_menu( 'footer-1', 'Footer Menu 1' );
register_nav_menu( 'footer-2', 'Footer Menu 2' );

// ACF Customizations
if( function_exists('acf_add_options_sub_page') )
{
    acf_add_options_sub_page( 'Site Information' );
}
// End ACF Customizations

// Create custom post type for Events
add_action( 'init', 'create_post_type_events' );
function create_post_type_events() {
    register_post_type( 'ahn_event',
        array(
            'labels' => array(
                'name' => __( 'Events' ),
                'singular_name' => __( 'Event' ),
                'add_new_item' => 'Add New Event',
                'edit_item' => 'Edit Event',
                'view_item' => 'View Event',
                'search_items' => 'Search Events',
                'not_found' => 'No events found.',
                'not_found_in_trash' => 'No events found in Trash.'
            ),
            'public' => true,
            'has_archive' => false,
            'rewrite' => array('slug' => 'events')
        )
    );
}
// End create custom post type for Events

// Create custom post type for Speakers
add_action( 'init', 'create_post_type_speakers' );
function create_post_type_speakers() {
    register_post_type( 'ahn_speaker',
        array(
            'labels' => array(
                'name' => __( 'Speakers' ),
                'singular_name' => __( 'Speakers' ),
                'add_new_item' => 'Add New Speaker',
                'edit_item' => 'Edit Speaker',
                'view_item' => 'View Speaker',
                'search_items' => 'Search Speakers',
                'not_found' => 'No speakers found.',
                'not_found_in_trash' => 'No speakers found in Trash.'
            ),
            'public' => true,
            'has_archive' => false,
            'rewrite' => array('slug' => 'speakers')
        )
    );
}
// End create custom post type for Speakers

//widget support for a right sidebar
register_sidebar(array(
  'name' => 'Right SideBar',
  'id' => 'right-sidebar',
  'description' => 'Widgets in this area will be shown on the right-hand side.',
  'before_widget' => '<div id="%1$s">',
  'after_widget'  => '</div>',  
  'before_title' => '<h3>',
  'after_title' => '</h3>'
));

//widget support for the footer
register_sidebar(array(
  'name' => 'Footer SideBar',
  'id' => 'footer-sidebar',
  'description' => 'Widgets in this area will be shown in the footer.',
  'before_widget' => '<div id="%1$s">',
  'after_widget'  => '</div>',
  'before_title' => '<h3>',
  'after_title' => '</h3>'
));

//This theme uses post thumbnails
add_theme_support( 'post-thumbnails' );

//custom featured image size
if ( function_exists( 'add_theme_support' ) ) { 
	// Generate a new thumbnail with our desired name and size
	//add_image_size( 'projects-full', 560, 150, true );
}

//Apply do_shortcode() to widgets so that shortcodes will be executed in widgets
add_filter('widget_text', 'do_shortcode');


/**
 * MANAGE REMOVING OR ADDING STUFF (aka Function Snippets)
 * comment in or out what you want
 */

// remove stuff,  uncomment to enable
//require_once( get_template_directory() . '/snippets/remove-stuff.php' );

// add stuff
//require_once( get_template_directory() . '/snippets/add-stuff.php' );


/* DEVENSAYS */
if ( !function_exists( 'optionsframework_init' ) ) {
  define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
  require_once dirname( __FILE__ ) . '/inc/options-framework.php';
}


/*--------------------------------------- Excerpts ---------------------------------------*/
function s8_excerpt_limit($limit, $perm) {
      $excerpt = explode(' ', get_the_excerpt(), $limit);
      if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
      } else {
        $excerpt = implode(" ",$excerpt);
      } 
      $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);

      if ($perm) {
        $excerpt = $excerpt . ' <a href="'. $perm .'">read more ></a>';
      }

      return $excerpt;
    }

function s8_content_limit($limit) {
      $content = explode(' ', get_the_content(), $limit);
      if (count($content)>=$limit) {
        array_pop($content);
        $content = implode(" ",$content).'...';
      } else {
        $content = implode(" ",$content);
      } 
      $content = preg_replace('/\[.+\]/','', $content);
      $content = apply_filters('the_content', $content); 
      $content = str_replace(']]>', ']]&gt;', $content);
      return $content;
}
/*---------------------------------------  ---------------------------------------*/


/*--------------------------------------- TWITTER ---------------------------------------*/
function s8_wp_get_twitter($name='twitter', $number='1'){
    require_once (ABSPATH . WPINC . '/class-feed.php');
    $feed = new SimplePie();
    $feed->enable_cache(false); // This gets rid of some warnings that were showing up.
    $feed->set_feed_url('http://twitter.com/statuses/user_timeline/'.$name.'.rss');
    $feed->set_file_class('WP_SimplePie_File');
    //$feed->set_cache_duration(600); // This shouldn't be needed if the cache is disabled.
    $feed->init();
    $feed->handle_content_type();
    $items = $feed->get_items(0,$number);
    foreach($items as $item) {
        $tweet = $item->get_description();
        $tweet = str_replace("{$name}: ", "", $tweet);
        $tweet_array = explode(' ', $tweet);
        foreach($tweet_array as $key=>$word_yo) {
            if(substr($word_yo, 0, 1) == '@' && strlen($word_yo) > 1) {
                if(substr($word_yo, -1) == ':')
                    $tweet_array[$key] = '@<a href="https://twitter.com/#!/'.substr($word_yo, 1, -1).'" target="_blank">'.substr($word_yo, 1, -1).'</a>:';
                else
                    $tweet_array[$key] = '@<a href="https://twitter.com/#!/'.substr($word_yo, 1).'" target="_blank">'.substr($word_yo, 1).'</a>';
            }
            elseif(substr($word_yo, 0, 1) == '#' && strlen($word_yo) > 1) {
                $tweet_array[$key] = '#<a href="https://twitter.com/#!/search/realtime/%23'.substr($word_yo, 1).'" target="_blank">'.substr($word_yo, 1).'</a>';
            }
            elseif(substr($word_yo, 0, 4) == 'http' && strlen($word_yo) > 10) {
                $tweet_array[$key] = '<a href="'.$word_yo.'" target="_blank">'.$word_yo.'</a>';
            }
        }
        $tweet = implode(' ', $tweet_array);
        echo '<blockquote class="twitter-blockquote"><p>'.$tweet;
        echo ' <span>'.$item->get_local_date('%m/%d @ %I:%M%p') .'</span>';
        echo '</p></blockquote>';
    }
}
/*--------------------------------------- end ---------------------------------------*/


/*--------------------------------------- Events call in ---------------------------------------*/
function s8_get_upcoming_events($num_events) {
  $args = array(
    'post_type' => 'mpress_event',
    'posts_per_page' => $num_events,
    'orderby' => 'meta_value',
    'meta_key' => '_mpress_event_startDate',
    'order' => 'ASC',
    'meta_query' => array(
      array(
        'key' => '_mpress_event_startDate',
        'value' => date('Y-m-d'),
        'compare' => '>=',
        'type' => 'DATE',
      ),
    ),
  );
  return get_posts($args);
}

function s8_get_current_events($num_events) {
  $args = array(
    'post_type' => 'mpress_event',
    'posts_per_page' => $num_events,
    'orderby' => 'meta_value',
    'meta_key' => '_mpress_event_startDate',
    'order' => 'ASC',
    'meta_query' => array(
      array(
        'key' => '_mpress_event_endDate',
        'value' => date('Y-m-d'),
        'compare' => '>=',
        'type' => 'DATE',
      ),
    ),
  );
  return get_posts($args);
}

function s8_get_event_timestamp($id) {
  $time = get_post_meta($id, '_mpress_event_startDate', true);
  if($time) {
    $date = explode('-', $time);
    $year = (int) $date[0];
    $month = (int) $date[1];
    $day = (int) $date[2];
    return mktime(0,0,0,$month,$day,$year);
  }
  return time();
}

function s8_get_event_end_timestamp($id) {
  $time = get_post_meta($id, '_mpress_event_endDate', true);
  if($time) {
    $date = explode('-', $time);
    $year = (int) $date[0];
    $month = (int) $date[1];
    $day = (int) $date[2];
    return mktime(0,0,0,$month,$day,$year);
  }
  return time();
}
function s8_get_the_excerpt($post_id) {
  global $post;  
  $save_post = $post;
  $post = get_post($post_id);
  setup_postdata($post);
  $output = get_the_excerpt();
  $post = $save_post;
  return $output;
}

function s8_get_event_address($id) {
  $streetAddr = get_post_meta($id, '_mpress_event_streetAddress', true);
  $addrLocation = get_post_meta($id, '_mpress_event_addressLocality', true);
  $addrRegion = get_post_meta($id, '_mpress_event_addressLocality', true);
  $addrZip = get_post_meta($id, '_mpress_event_postalCode', true);
  echo '<!--';
  echo $streetAddr . ' | '.$addrLocation. ' | '.$addrRegion. ' | '.$addrZip;
  echo '-->';
  $output = array();
  if($streetAddr) $output[] = $streetAddr;
  if($addrLocation) $output[] = $addrLocation;
  $tmp = array();
  if($addrRegion) $tmp[] = $addrRegion;
  if($addrZip) $tmp[] = $addrZip;
  if(count($tmp) > 1) $output[] = implode(' ', $tmp);
  elseif(count($tmp) == 1) $output[] = $tmp[0];
  return implode(', ', $output);
}
?>
