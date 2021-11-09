<header class="banner">
  <div class="container pt-5 pb-lg-0 pb-1">
    <div class="d-flex align-items-center flex-wrap"> <a class="brand mr-auto mb-4 mb-lg-0" href="{{ home_url('/') }}">{!! App::siteLogo() !!}</a> <!-- <a href="#" class="ml-auto mr-3 text-secondary">Where to Buy</a> --> <?php get_search_form( true ); ?></div>
		<nav class="navbar-expand-lg nav-primary pt-lg-5">
		  <button class="navbar-toggler ml-auto border border-primary my-2 d-flex d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon text-primary"><i class="fas fa-bars w-100 h-100"></i></span>
		  </button>
		
		  <div class="collapse navbar-collapse w-100" id="navbarContent">
					@if (has_nav_menu('primary_navigation'))
					  {!! wp_nav_menu($primarymenu) !!}
					@endif
		  </div>
		</nav>

  </div>
</header>



