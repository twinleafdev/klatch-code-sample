{{--
  Title: Waltron Hero
  Description: Hero with text
  Category: formatting
  Icon: admin-comments
  Keywords: jumbotron hero
  Mode: preview
  Align: full
  PostTypes: page
  SupportsAlign: false
  SupportsMode: false
  SupportsMultiple: false
--}}


<?php
$image = get_field('header_image');
$video = get_field('header_video');
$size = 'full'; // (thumbnail, medium, large, full or custom size)
$headline = get_field('headline');
$sub_headline = get_field('sub_headline');
$static_image = "";
?>

<div data-{{ $block['id'] }} class="jumbotron jumbotron-fluid full-width {{ $block['classes'] }}">
  <div class="container text-shadow">

    <?=$headline;?>
    <?=$sub_headline;?>
<!--     <a class="btn btn-primary btn-lg mb-4" href="#" role="button">Learn more</a> -->
 
  </div><!-- .container -->
  <?php if( $image ) {
	  	echo  wp_get_attachment_image( $image, $size, "", array( "class" => "img-fluid jumbo-bg" ) );
  }
  
  if( $video ) {
      echo '<video playsinline autoplay muted loop class="jumbo-bg" id="bgvid">';
			  echo '<source src="'.$video.'" type="video/mp4">';
			echo '</video>';
  }
  
  
  ?>
</div>