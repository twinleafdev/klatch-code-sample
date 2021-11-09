<?php

namespace App;


/**
  * Sidebar filter
  */
add_filter('sage/display_sidebar', function ($display) {
    static $display;

    isset($display) || $display = in_array(true, [
      // The sidebar will be displayed if any of the following return true
      is_single(),
      is_404(),
      is_page_template('views/template-sidebar.blade.php'),
      is_archive()
    ]);

    return $display;
});


/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
    /** Add page slug if it doesn't exist */
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    /** Add class if sidebar is active */
    if (display_sidebar()) {
        $classes[] = 'sidebar-primary';
    }

    /** Clean up class names for custom templates */
    $classes = array_map(function ($class) {
        return preg_replace(['/-blade(-php)?$/', '/^page-template-views/'], '', $class);
    }, $classes);

    return array_filter($classes);
});

/**
 * Add "… Continued" to the excerpt
 */
add_filter('excerpt_more', function () {
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
});

/**
 * Removes “Category:”, “Tag:”, “Author:”, “Archives:” and “Other taxonomy name:” 
 */
 
add_filter( 'get_the_archive_title', function( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    }
  
    return $title;
} );


/**
 * Template Hierarchy should search for .blade.php files
 */
collect([
    'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home',
    'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment', 'embed'
])->map(function ($type) {
    add_filter("{$type}_template_hierarchy", __NAMESPACE__.'\\filter_templates');
});

/**
 * Render page using Blade
 */
add_filter('template_include', function ($template) {
    collect(['get_header', 'wp_head'])->each(function ($tag) {
        ob_start();
        do_action($tag);
        $output = ob_get_clean();
        remove_all_actions($tag);
        add_action($tag, function () use ($output) {
            echo $output;
        });
    });
    $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
        return apply_filters("sage/template/{$class}/data", $data, $template);
    }, []);
    if ($template) {
        echo template($template, $data);
        return get_stylesheet_directory().'/index.php';
    }
    return $template;
}, PHP_INT_MAX);

/**
 * Render comments.blade.php
 */
add_filter('comments_template', function ($comments_template) {
    $comments_template = str_replace(
        [get_stylesheet_directory(), get_template_directory()],
        '',
        $comments_template
    );

    $data = collect(get_body_class())->reduce(function ($data, $class) use ($comments_template) {
        return apply_filters("sage/template/{$class}/data", $data, $comments_template);
    }, []);

    $theme_template = locate_template(["views/{$comments_template}", $comments_template]);

    if ($theme_template) {
        echo template($theme_template, $data);
        return get_stylesheet_directory().'/index.php';
    }

    return $comments_template;
}, 100);



add_filter('posts_where', function ( $where ) {
	
	$where = str_replace("meta_key = 'models_$", "meta_key LIKE 'models_%", $where);

	return $where;
});


function waltron_acf_post_title($post_id, $post, $update) {
    
    $analyzer_title = get_field('analyzer_title', $post_id);
    
    if($analyzer_title && 'analyzers' == get_post_type()){ 
      
      if( has_term( 'discontinued', 'active_products' ) ) {
          $discontinued = " - discontinued";
      }

      remove_action('save_post', 'App\\waltron_acf_post_title'); // prevent a loop

      $content_reset = array(
          'ID' => $post_id,
          'post_title' => $title,
          'post_name' => $post_id,
      );
      wp_update_post($content_reset);
      clean_post_cache( $post_ID );
      
      $slug = wp_unique_post_slug( sanitize_title( $analyzer_title['model_number']." ".$analyzer_title['model_name']." Analyzer".$discontinued, $post_ID ), $post_ID, $post->post_status, $post->post_type, $post->post_parent );
      $title = $analyzer_title['model_number']." ".$analyzer_title['model_name']." Analyzer".$discontinued;

      $content = array(
          'ID' => $post_id,
          'post_title' => $title,
          'post_name' => $slug,
      );

      wp_update_post($content);
      add_action('save_post', 'App\\waltron_acf_post_title');
    }
}
add_action('save_post', 'App\\waltron_acf_post_title', 10, 3);

add_filter( 'get_search_form', function( $form ) { 
    $form = '<form role="search" method="get" id="search-form" action="' . home_url( '/' ) . '" >
    <div class="input-group">
  
    <label class="screen-reader-text" for="s">' . __('',  'domain') . '</label>
    <input type="search" value="' . get_search_query() . '" name="s" id="s" class="form-control" placeholder="Search..." aria-label="Search" aria-describedby="searchsubmit">
    <div class="input-group-append">
      <button class="btn btn-secondary" type="submit" id="searchsubmit"><i class="fas fa-search"></i></button>
    </div>
  </div>
 </form>';

 return $form;
} );