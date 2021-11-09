{{--
  Title: Waltron Product List
  Description: Product list
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
            'orderby' => 'models_0_model_number',
            'order' => 'ASC',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'active_products',
                    'field'    => 'slug',
                    'terms'    => 'active',
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
            $status = get_field('status', get_the_ID());
            $order = $status['order'];
            
            
            // analyzer products
            $key = App::stringify($parameter_spec['parameter']);
            $analyzers_return .= "<div class='analyzer ".$key." col-12 col-sm-6 col text-center' data-paramiter='".$key."' style='order: ".$order.";'>".get_the_post_thumbnail( '', 'thumbnail', array( 'class' => 'img-fluid' ) )."<p class='entry-title lead'><a href='".get_the_permalink()."'>".$title."</a></p></div>";
             
            // parameter selects            
            if (!in_array($parameter_spec['parameter'], $parameters)) {
             $parameter_selects[$key] = '<option value="'.$key.'">'.$parameter_spec['parameter'].'</option>';
            }
            $parameters[] = $parameter_spec['parameter'];

            // Model number selects
            $model_selects[$analyzer_model] = '<option value="'.$link.'">'.$title.'</option>';


          endwhile;
        
          // sort model numbers
          ksort($model_selects);
          $model_selects_return = "";
          foreach($model_selects as $model_no => $select) {
            $model_selects_return .= $select;
          }
          
          // sort parameter 
          sort($parameter_selects);
          $parameter_selects_return = "";
          foreach($parameter_selects as $select) {
            $parameter_selects_return .= $select;
          } 
        
        endif;
        
        // Reset Post Data
        wp_reset_postdata();

        
        ?>

<div data-{{ $block['id'] }} class=" {{ $block['classes'] }}" >
 
	<div class="row">
  	<div class="col-md-6 mb-4">
      <form>
        <div class="form-group">
          <label for="parameter-filter">Filter by Parameter used</label>
          <select onchange="jQuery('.analyzer').hide(); jQuery('.' + this.options[this.selectedIndex].value + '').fadeIn();" class="form-control" id="#tech-sort">
            <option disabled selected>Choose One</option>
            <option value="analyzer">View All</option>
                          
            <?=$parameter_selects_return;?>

          </select>
        </div>
      </form>
  	</div>

  	<div class="col-md-6 mb-4">
       <form>
        <div class="form-group">
          <label for="parameter-filter">Choose a Model number</label>
          <select onchange="location = this.options[this.selectedIndex].value;" class="form-control" id="#tech-sort">
            <option disabled selected>Choose One</option>
            <?=$model_selects_return;?>
          </select>
        </div>
      </form>   		
  	</div>
	</div><!-- .row -->

  <div class="row justify-content-center">
  <?php
    if("" != $analyzers_return) {
      echo $analyzers_return;
    } else {
      echo "<h1 class='mx-auto my-5 text-danger'>No Analyzers Found</h1>";
    }
  ?>
   </div><!-- .row -->

</div>