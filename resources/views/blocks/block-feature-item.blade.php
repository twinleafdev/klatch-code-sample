{{--
  Title: Waltron Feature Section Item
  Description: Hero with text
  Category: formatting
  Icon: admin-comments
  Keywords: featured item
  Mode: preview
  Align: full
  PostTypes: page
  SupportsAlign: false
  SupportsMode: false
  SupportsMultiple: true

--}}

<?php
$image = get_field('icon');
$size = 'medium'; // (thumbnail, medium, large, full or custom size)
?>

<div data-{{ $block['id'] }} class="flex-row d-flex {{ $block['classes'] }}">
<div class="col-3 p-0">
  <?php if( $image ) {
     echo wp_get_attachment_image( $image, $size, "", array( "class" => "img-fluid rounded-circle icon" ) );
  } ?>
  </div>
  <div class="col-9">
  	<h3><?=get_field('title');?></h3>
    <p class="small m-0"><?=get_field('description');?></p>
  </div>
</div>