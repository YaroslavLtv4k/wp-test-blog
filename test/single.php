<?php get_header(); ?>

<?php get_template_part('template-parts/breadcrumbs'); ?>

<section class="post_blog_bg primary-bg">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			
        	<div class="col-md-8">        		

        		<article class="blog_post">


        			<h4><?php the_title(); ?></h4>

        			<div class="blog_category">
						<ul> 
							<li> <?php the_category(', ') ?></li>
						</ul>

						<!-- Если events -->
						<?php if ( is_singular( 'events' ) ) { ?>
								<ul>
									
									<li><?php the_taxonomies(); ?></li><br>
									<li><?php the_field('Локация'); ?></li><br>
									<li><b>Дата начала:</b> <?php the_field('start_date'); ?></li><br>
									<li><b>Дата окончания:</b> <?php the_field('end_date'); ?></li><br>


								</ul>

						<?php } ?>

					</div>	

					<br><hr>

        			<?php the_post_thumbnail(); ?>

        			<hr>

        			<?php the_content(); ?>

        		</article>
			
			</div>	
			
				
			<?php get_sidebar() ?>
				
				
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>


