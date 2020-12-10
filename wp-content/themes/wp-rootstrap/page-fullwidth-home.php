<?php
/**
 * Template Name: Full-width(no sidebar home)
 *
 * This is the template that displays full width page without sidebar
 *
 * @package rootstrap
 */

get_header(); ?>
<div id="content" class="site-content container">
	<div id="primary" class="content-area col-sm-12 col-md-12">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->



<!-- Modal -->
<div id="modal_r" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Que tipo de proponente eres?</h4>
      </div>
      <div class="modal-body">
        
	<div class="row">
		<div class="col-md-6"><a href="<?=site_url('registro?tipo=pn')?>">Persona Natural</a></div>
		<div class="col-md-6"><a href="<?=site_url('registro?tipo=pn')?>">Persona Natural</a></div>
			
	</div>
	

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<?php get_footer(); ?>
