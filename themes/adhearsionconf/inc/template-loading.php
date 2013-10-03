<?php

function get_loop(){
    $template = mpress_locate_template('loop');
    if( $template ){
        load_template( $template );
    } else {
        get_template_part('loop');
    }
}

function get_menu(){
    $template = mpress_locate_template('menu');
    if( $template ){
        load_template( $template );
    } else {
        get_template_part('menu');
    }
}

function mpress_locate_template( $name ){
    if( is_front_page() ){
            if( is_home() ){
                return locate_template( array(
                    $name.'-home.php',
                    $name.'.php'
                ) );
            } else{
                return locate_template( array(
                    $name.'-front.php',
                    $name.'.php'
                ) );
            }
        } elseif( is_home() ){
            return locate_template( array(
                $name.'-home.php',
                $name.'.php'
            ) );
        } elseif( is_singular() ){
            if( is_page() ){
                $slug = get_queried_object()->post_name;
                $id = get_queried_object()->ID;
                return locate_template( array(
                    $name.'-page-'.$slug.'.php',
                    $name.'-page-'.$id.'.php',
                    $name.'-page.php',
                    $name.'-page.php',
                    $name.'.php'
                ) );
            } elseif( is_single() ){
                $post_type = get_post_type();
                return locate_template( array(
                    $name.'-single-'.$post_type.'.php',
                    $name.'-single.php',
                    $name.'.php'
                ) );
            } elseif( is_attachment() ){
                return locate_template( array(
                    $name.'-attachment.php',
                    $name.'-single.php',
                    $name.'.php'
                ) );
            } else{
                return locate_template( array(
                    $name.'-single.php',
                    $name.'.php'
                ) );
            }
        } elseif( is_archive() ){
            if( is_category() ){
                $slug = get_queried_object()->slug;
                $id = get_queried_object()->term_id;
                return locate_template( array(
                    $name.'-category-'.$slug.'.php',
                    $name.'-category-'.$id.'.php',
                    $name.'-category.php',
                    $name.'-taxonomy.php',
                    $name.'-archive.php',
                    $name.'.php'
                ) );
            } elseif( is_tag() ){
                $slug = get_queried_object()->slug;
                $id = get_queried_object()->term_id;
                return locate_template( array(
                    $name.'-tag-'.$slug.'.php',
                    $name.'-tag-'.$id.'.php',
                    $name.'-tag.php',
                    $name.'-taxonomy.php',
                    $name.'-archive.php',
                    $name.'.php'
                ) );
            } elseif( is_tax() ){
                $taxonomy = get_queried_object()->taxonomy;
                $term = get_queried_object()->slug;
                return locate_template( array(
                    $name.'-taxonomy-'.$taxonomy.'-'.$term.'.php',
                    $name.'-taxonomy-'.$taxonomy.'.php',
                    $name.'-taxonomy.php',
                    $name.'-archive.php',
                    $name.'.php'
                ) );
            } elseif( is_author() ){
                $nicename = get_queried_object()->user_nicename;
                $id = get_queried_object()->ID;
                return locate_template( array(
                    $name.'-author-'.$nicename.'.php',
                    $name.'-author-'.$id.'.php',
                    $name.'-author.php',
                    $name.'-archive.php',
                    $name.'.php'
                ) );
            } elseif( is_date() ){
                return locate_template( array(
                    $name.'-date.php',
                    $name.'-archive.php',
                    $name.'.php'
                ) );
            } else {
                return locate_template( array(
                    $name.'-archive.php',
                    $name.'.php'
                ) );
            }
        } elseif( is_search() ){
            return locate_template( array(
                $name.'-search.php',
                $name.'.php'
            ) );
        } elseif( is_404() ){
            return locate_template( array(
                $name.'-404.php',
                $name.'.php'
            ) );
        } else{
            return locate_template( array(
                $name.'.php'
            ) );
        }
}