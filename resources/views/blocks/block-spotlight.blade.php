{{--
  Title: Waltron Product Spotlight
  Description: Product highlight
  Category: formatting
  Icon: admin-comments
  Keywords: spotlight highlight product
  Mode: preview
  Align: full
  PostTypes: page
  SupportsAlign: false
  SupportsMode: false
  SupportsMultiple: false
--}}


<?php
$analyzer = get_field('spotlight_analyzer');
$overview = get_field('overview', $analyzer);
$spotlight_image = get_field('spotlight-image');
$size = 'medium'; // (thumbnail, medium, large, full or custom size)
?>

<div data-{{ $block['id'] }} class="full-width product-spotlight mt-5 {{ $block['classes'] }}" style="background: linear-gradient(45deg, #3284c2, #23346e);">
  <div class="container-fluid bg-white">
  	
    <div class="container">
      <div class="row">
        <div class="col-md-6 offset-3">  
          <p class="lead text-uppercase my-3 font-weight-bold text-primary">
          	Product Spotlight
          </p>
        </div>
      </div>
    </div>
  </div><!-- .container-fluid -->
  <div class="container">
    <div class="row">
      <div class="col-md-3">  
        <?php echo wp_get_attachment_image( $spotlight_image, 'large', "", array( "class" => "img-fluid w-100 border border-primary spotlight-image" ) );  ?>    	

      </div>
      <div class="col-md-6 text-white">
      
        <p class="lead my-3 font-weight-bold">
        	<?=get_the_title($analyzer);?>
        </p>
        <p><?=$overview;?></p>
    
      </div>
      <div class="col-md-3 d-flex align-items-center">
        <?php
          echo get_the_post_thumbnail( $analyzer, 'large', array( 'class' => 'img-fluid' ) );
        ?>
      </div>
      
     </div><!-- .row -->
  </div><!-- .container -->

</div>