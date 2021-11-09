<article @php post_class() @endphp>
  <header>
    <h1 class="entry-title mb-4 text-primary">{!! get_the_title() !!}</h1>
<!--     @include('partials/entry-meta') -->
  </header>
  <div class="entry-content">
    @php the_content() @endphp
    <?php the_post_thumbnail('large', ['class' => 'd-flex mx-auto my-5 img-fluid', 'title' => get_the_title()]); ?>
  </div>
  <footer>
    {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
  </footer>
</article>
