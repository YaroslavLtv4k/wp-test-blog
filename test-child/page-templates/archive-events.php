<?php /* Template name: Архив Событий */ ?>
<?php get_header() ?>

<!-- breadcrumbs -->
<?php get_template_part('template-parts/breadcrumbs'); ?>

<section class="post_blog_bg primary-bg">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			
        	<div class="col-md-8">
        		
        	<?php
			$args = array( 'post_type' => 'events', 'posts_per_page' => 10 );
			$the_query = new WP_Query( $args );
			?>
			<?php if ( $the_query->have_posts() ) : ?>
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

			<article class="blog_post">
								<h4> <a href="<?php the_permalink();?>"> <?php the_title(); ?> </a> </h4>
									
									<div class="blog_category">
										<ul> 
											<li> <?php the_taxonomies(', ') ?></li>
											
										</ul>
									</div>	
									
									<div class="blog_text">
										<ul>
											<li> | </li>
											<li> Post By : <?php the_author_posts_link(); ?> </li>
											<li> | </li>
											<li>  On : <?php the_time('j F Y'); ?> </li>
										</ul>
									</div>
									
									<div class="blog_post_img">
										<a href="<?php the_permalink();?>"> <?php the_post_thumbnail(); ?> </a>
									</div>
									
									<?php the_excerpt(); ?>
								
									<a href="<?php the_permalink();?>"> Continue reading <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
									
								
							</article>
			
			<?php wp_reset_postdata(); ?>
			<?php endwhile; ?>
			<?php endif; ?>
			
			</div>				
				
			<?php get_sidebar() ?>
				
				
			</div>
		</div>
	</div>
</section>

<?php get_footer() ?>