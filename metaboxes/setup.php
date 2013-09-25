<?php


include_once (TEMPLATEPATH.'/inc/wpalchemy/MetaBox.php');
 
// global styles for the meta boxes
if (is_admin()) wp_enqueue_style('wpalchemy-metabox', get_stylesheet_directory_uri() . '/metaboxes/meta.css');

/* eof */