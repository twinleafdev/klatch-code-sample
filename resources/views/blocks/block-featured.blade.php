{{--
  Title: Waltron Feature Section
  Description: Hero with text
  Category: formatting
  Icon: admin-comments
  Keywords: jumbotron hero
  Mode: auto
  Align: full
  PostTypes: page
  SupportsAlign: false
  SupportsMode: false
  SupportsMultiple: false
  SupportsInnerBlocks: true
--}}

<?php
$image = get_field('header_image');
$size = 'full'; // (thumbnail, medium, large, full or custom size)
?>

<div data-{{ $block['id'] }} class="container card my-5 {{ $block['classes'] }}">
<div class="row card-body">
	
  <div class="col-md-4">
  	<h3>ANALYZERS</h3>
    <p class="small">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
  </div>
  
  <div class="col-md-4">
  	<h3>ANALYZERS</h3>
    <p class="small">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
  </div>
  
  <div class="col-md-4">
  	<h3>ANALYZERS</h3>
    <p class="small">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
  </div>
</div><!-- .row -->

</div>