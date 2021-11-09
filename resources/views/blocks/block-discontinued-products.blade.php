{{--
  Title: Waltron Discontinued Product List
  Description: Discontinued Product list
  Category: formatting
  Icon: admin-comments
  Keywords: products
  Mode: preview
  Align: full
  PostTypes: page
  SupportsAlign: false
  SupportsMode: false
  SupportsMultiple: false
--}}


      <?php
        $args = array(
            'post_type' => array( 
              'analyzers', 
            ),
            'orderby' => 'name',
            'order' => 'ASC',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'active_products',
                    'field'    => 'slug',
                    'terms'    => 'discontinued',
                ),
            ),
	
        );

        $the_query = new WP_Query( $args );
        $model_numbers = array();
        $analyzers_return = "";
        $parameters = [];
        // The Loop
        if ( $the_query->have_posts() ) :
          while ( $the_query->have_posts() ) : $the_query->the_post();
            $link = get_the_permalink();
            $title = get_the_title();
            $parameter_spec = get_field('analyzer_type', get_the_ID());
            $analyzer_title = get_field('analyzer_title', get_the_ID());
            $analyzer_model = $analyzer_title['model_number'];
            $support = get_field('support', get_the_ID());
       
            
            // analyzer products
            $key = App::stringify($parameter_spec['parameter']);
            $analyzers_return .= "<div class='discontinued-analyzer ".$key." col-md-3 my-3' data-paramiter='".$key."'><p class='entry-title'><a href='".$support['manual']."' target='_blank'><i class='fas fa-file-pdf'></i> ".$title."</a></p></div>";


          endwhile;
        
        
        endif;
        
        // Reset Post Data
        wp_reset_postdata();

        
        ?>

<div data-{{ $block['id'] }} class=" {{ $block['classes'] }}" >
 
  <div class="row">
  <?php
    if("" != $analyzers_return) {
      echo $analyzers_return;
    } else {
      echo "<h1 class='mx-auto my-5 text-danger'>No Analyzers Found</h1>";
    }
  ?>
   </div><!-- .row -->

</div>