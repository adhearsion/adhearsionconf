<?php

// Register sidebars
register_sidebar( array(
    'name' => 'Primary Sidebar',
	'id' => 'sidebar',
	'description' => 'Widgets in this area show alongside the main content.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h4 class="widgettitle">',
	'after_title' => '</h4>'
));
register_sidebar( array(
    'name' => 'Twitter',
	'id' => 'twitter-sidebar',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h4 class="widgettitle">',
	'after_title' => '</h4>'
));


function s8frame_after_setup_theme(){
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 's8frame_after_setup_theme');

function s8frame_menu_fallback(){
    echo '<nav id="main-nav"><ul>';
    wp_list_pages( array( 'title_li' => NULL ) );
    echo '</ul></nav>';
}

function s8frame_excerpt_more($more) {
	global $post;
	return ' <a href="'.get_permalink($post->ID).'" title="Read more...">Read more &rarr;</a>';
}
add_filter('excerpt_more', 's8frame_excerpt_more');

function s8frame_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 's8frame' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 's8frame' ), get_the_author() ),
			get_the_author()
		)
	);
}

function s8frame_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' : ?>
	<div <?php comment_class(); ?> id="div-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
        <div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
		<div class="comment-author vcard comment-meta">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( 'by %1$s on %2$s', 's8frame' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ), sprintf( __( '%1$s at %2$s', 's8frame' ), get_comment_date(),  get_comment_time() ));
			edit_comment_link( __( '(Edit)', 's8frame' ), ' ' ); ?>
		</div>
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 's8frame' ); ?></em>
			<br />
		<?php endif; ?>
		<div class="comment-body"><?php comment_text(); ?></div>
	</div><!-- #comment-##  -->
	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<div class="post pingback">
		<p><?php _e( 'Pingback:', 's8frame' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 's8frame' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
