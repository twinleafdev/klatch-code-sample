<article @php post_class('pr-md-3') @endphp>
  <header>
    <h2 class="entry-title mb-4 text-primary"><a href="{{ get_permalink() }}">{!! get_the_title() !!}</a></h2>
  </header>
  <div class="entry-summary">
    @php the_content() @endphp
    <?php the_post_thumbnail('large', ['class' => 'd-flex mx-auto my-5 img-fluid', 'title' => get_the_title()]); ?>
  </div>
</article>