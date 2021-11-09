<footer class="content-info jumbo-bg-wrap pt-5">
  <div class="container text-white">
    <div class="row">
    	<div class="col-md-3">
    		{!! App::footerLogo() !!}
    	</div>
    </div><!-- .row -->
    <div class="row">
      <div class="col-md-3 pt-5 mb-4 mb-sm-0">
        
        @php dynamic_sidebar('sidebar-footer') @endphp
      </div>
      <div class="col-md-4 pt-5 mb-5 mb-sm-0">
      <div class="shop-btns px-5 d-flex justify-content-center h-100 flex-column border-left border-right">
        <a class="btn btn-primary btn-md my-4 w-100" href="https://shop.waltron.net/">SHOP ONLINE U.S.</a>
<!--       	<a class="btn btn-primary btn-md mb-4 w-100" href="#">International Orders</a> --></div>
      </div>
      <div class="col-md-5 promotions">
        <h3 class="mb-3">CURRENT PROMOTIONS</h3>
        
        <?php
        $args = array(
            'post_type' => array( 
              'current_promotions', 
            ),
            'posts_per_page' => 1,	
        );
        
        $the_query = new WP_Query( $args );
        
        if ( $the_query->have_posts() ) :
          while ( $the_query->have_posts() ) : $the_query->the_post();
        ?>   
            <a href="<?=get_the_permalink();?>"><?=get_the_post_thumbnail( '', 'thumbnail', array( 'class' => 'img-fluid alignleft mr-3' ) );?></a>
            <h3 class="promo-title"><a href="<?=get_the_permalink();?>"><?=get_the_title();?></a></h3>
            <p><?=get_the_excerpt();?></p>
            
            <a class="btn btn-primary btn-md mt-4 w-100" href="/current_promotions/">View all promotions</a>
        <?php    
          endwhile;
        endif;
        wp_reset_postdata();
        ?>
<!--                 <img src="/wp-content/uploads/2021/06/clearance-place-holder.png" width="444" height="268" class="img-fluid" /> -->
        
      </div>
    </div><!-- .row -->
  </div>

  <div class="copyright py-3 text-white mt-5">
    <div class="container">
  		<div class="row">
  		<div class="col-md-12 d-flex justify-content-md-between align-items-center flex-column flex-md-row">
					@if (has_nav_menu('footer_links'))
					  {!! wp_nav_menu($footermenu) !!}
					@endif
  			<span class="pt-2 pb-4 py-md-0"><a href="#" class="twitter rounded-circle p-1 social text-white"><i class="fab fa-linkedin-in"></i> </a> <a href="#" class="facebook rounded-circle p-1 social text-white"><i class="fab fa-facebook-f"></i></a></span> <span class="small text-center">© Copyright <?=Date('Y');?> Waltron Bull & Roberts, LLC, and Waltron BV. All Rights Reserved. | Website by <a href="https://asenka.com">Asenka</a></span>
  		</div>
  	</div><!-- .row -->
    </div><!-- .container -->
  </div>

{!! App::footerBg() !!}
</footer>