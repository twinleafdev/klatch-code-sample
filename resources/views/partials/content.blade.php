<article @php post_class('col-12 col-md-4 text-center my-3') @endphp>
  <a href="{{ get_permalink() }}">{{ the_post_thumbnail('large', ['class' => 'img-fluid responsive--full', 'title' => 'Feature image']) }}</a>
  <header>
    <h2 class="entry-title"><a href="{{ get_permalink() }}">{!! get_the_title() !!}</a></h2>
<!--     @include('partials/entry-meta') -->
  </header>
  <div class="entry-summary">
    @php // the_excerpt() @endphp
  </div>
</article>
