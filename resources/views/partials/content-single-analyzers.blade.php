<article @php post_class() @endphp>

  <div class="entry-content">
<div class="row">
  <div class="col-12 col-md-4">
      <?=get_the_post_thumbnail( '', 'large', array( 'class' => 'img-fluid w-100' ) );?>
    </div>
    <div class="col-12 col-md-8">
    	<h1 class="entry-title">{!! get_the_title() !!}</h1>
    	 {!! App::modelNumbers() !!}
    	 <hr>
    	 <?=get_field('overview');?>
    </div>
    <div class="col my-5">
      <ul class="nav nav-pills nav-fill mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <a class="nav-link active" id="pills-features-tab" data-toggle="pill" href="#pills-features" role="tab" aria-controls="pills-features" aria-selected="true">Features</a>
        </li>
        <li class="nav-item mx-2" role="presentation">
          <a class="nav-link" id="pills-specifications-tab" data-toggle="pill" href="#pills-specifications" role="tab" aria-controls="pills-specifications" aria-selected="false">Specifications</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="pills-support-tab" data-toggle="pill" href="#pills-support" role="tab" aria-controls="pills-support" aria-selected="false">Support</a>
        </li>
      </ul>
      <div class="tab-content" id="pills-tabContent"> 	
            <div class="tab-pane fade show active" id="pills-features" role="tabpanel" aria-labelledby="pills-features-tab"><?=get_field('features');?></div>
            <div class="tab-pane fade" id="pills-specifications" role="tabpanel" aria-labelledby="pills-specifications-tab"><?=get_field('specifications');?></div>
            <div class="tab-pane fade" id="pills-support" role="tabpanel" aria-labelledby="pills-support-tab">
              <div class="row">
                <div class="col-6"> 
                  <p class="bg-light text-primary text-center">Technical Documents</p>  
                    <?php
                      $support = get_field('support');
                      $manual_url = $support['manual'];
                      $manual_section = $support['manual_section'];
                      $brochure = $support['brochure'];
                    ?>
                    <ul>
                      <li><a href="<?=$manual_url?>" target="_blank">User Manual</a></li>
                      
                      <?php
                       $rows = $manual_section;
                      if( $rows ) {
                          foreach( $rows as $row ) {
                              $section_title = $row['section_title'];
                              $page_number = $row['page_number'];
                              echo '<li><a href="'.$manual_url.'#page='.$page_number.'" target="_blank" >'.$section_title.'</a></li>';
                          }
                      }
                      
                      if($brochure){
//                         $brochure['title']
                        echo '<li><a href="'.$brochure['url'].'" target="_blank" >Product Sheet</a></li>';
                      }  
                      ?>  
            
                    </ul>
                </div> <!-- col-6 -->
                <?php /*
                <div class="col-6">
                	<p class="bg-light text-primary text-center">Product Support</p>
                    <?=get_field('support_contact', 'options');?>
                </div> <!-- col-6 -->
                */
                ?>
                
            </div><!-- .row -->
          </div> <!-- .tab-pane -->
      </div>
    </div>
</div>
    @php the_content() @endphp
  </div>
  <footer>
  </footer>
</article>
