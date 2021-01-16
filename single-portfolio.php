<?php get_header() ?>

  <section class="two-column row no-max pad">
    <div class="small-12 columns">
      <div class="row">
        <!-- Primary Column -->
        <div class="small-12 medium-7 medium-offset-1 medium-push-4 columns">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <div class="primary">
          <div class="work-item">
            <?php the_field('images') ?>
          </div>
          </div>    
        </div>
        <div class="small-12 medium-4 medium-pull-8 columns">
          <div class="secondary">
              <h1><?php the_title() ?></h1>
              <?php the_content() ?>
              <p>
                <?php previous_post_link() ?>
              </p>
          </div>
        </div>
        <?php endwhile; endif; wp_reset_postdata(); ?>
      </div>
  </section>       

<?php get_footer() ?>