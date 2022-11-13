<aside class="col-md-4">
	<div class="side_blog_bg">
		
		<!-- <div class="news_sletter">
			<div class="side_bar_sub_heading">
				<h6> Newsletter </h6>							
			</div>
			
			<p> Subscribe to our email newsletter for useful tips and resources.</p>
			
			<form>
		  		<div class="form-group blog_form">
					<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email Address" >
			 	 </div>
				  
			 	 <div class="search_btn-3">
					<button class="btn btn-default" type="submit">  Subscribe </button>	
				 </div>
		   </form>
	   
		</div> -->
	
	
		<div class="sidebar_wrap">
			<div class="side_bar_heading">
				<h6>Recent Post </h6>							
			</div>

			<ul class="recent-posts-ul">
 
				<?php 
				// Define our WP Query Parameters
				$the_query = new WP_Query( 'posts_per_page=5' ); ?>
				  
				 
				<?php 
				// Start our WP Query
				while ($the_query -> have_posts()) : $the_query -> the_post(); 
				// Display the Post Title with Hyperlink
				?>
				  
				 


				<div class="recent-detail">
					<div class="recent-image">
						<a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'thumbnail', array('class' => 'post_thumbnail_sidebar')) ?> </a>
					</div> 
				
					<div class="recent-text">
						<h6> <a href="<?php the_permalink() ?>"> <?php the_title(); ?> </a> </h6>
						
						<div class="blog_category side_category">
							<ul> 
								<li> <?php the_category(', ') ?> </li>
							</ul>
						</div>
						
					</div>

				</div>
				  
				 

				  
				 
				<?php 
				// Repeat the process and reset once it hits the limit
				endwhile;
				wp_reset_postdata();
				?>
			</ul>

		
			
		</div>

		<div class="sidebar_wrap">
			<div class="side_bar_heading">
				<h6>Recent Events </h6>							
			</div>

			<ul class="recent-posts-ul">
 
				<?php 
				$args = array(
					'post_type' => 'events',
					'posts_per_page' => 5,
				);
				$recent_posts = new WP_Query( $args ); ?>
				  
				 
				<?php 
				while ($recent_posts -> have_posts()) : $recent_posts -> the_post(); 
				?>
				  
				 


				<div class="recent-detail">
					<div class="recent-image">
						<a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'thumbnail', array('class' => 'post_thumbnail_sidebar')) ?> </a>
					</div> 
				
					<div class="recent-text">
						<h6> <a href="<?php the_permalink() ?>"> <?php the_title(); ?> </a> </h6>
						
						<div class="blog_category side_category">
							<ul> 
								<li> <?php the_taxonomies(', ') ?> </li>
							</ul>
						</div>
						
					</div>

				</div>
				  
				 

				  
				 
				<?php 
				endwhile;
				wp_reset_postdata();
				?>
			</ul>

		
			
		</div>

	
		
		<div class="sidebar_wrap">
			<div class="side_bar_heading">
				<h6> Categories </h6>							
			</div>
			
			<div class="category-detail">
				
				<ul>
					<?php

		                $test_categories = get_categories('hide_empty=0');

		                foreach( $test_categories as $cat ) {

		                    echo '<li><a href="' . get_tag_link($cat->term_id) . '"><i class="fa fa-folder-open-o" aria-hidden="true"></i>' .$cat->name .  '<span>' . $cat->category_count . '</span></a></li>';
		                }

		             ?>
				</ul>
				
				
			</div>
			
			
		</div>
		
		
		<div class="sidebar_wrap">
			<div class="side_bar_heading">
				<h6> Explore tags </h6>							
			</div>
			
			<div class="tag-detail">
				 

				<?php 

					$test_tags = get_tags('hide_empty=0');
					$tags_link_array = array();
					foreach( $test_tags as $onetag ){

						$tags_link_array[] = '<li><a href="' . get_tag_link($onetag->term_id) . '">' .$onetag->name . '</a></li>';
						}
						echo implode(' ', $tags_link_array);
					
				?>

				
				
			</div>


			
			
		</div>
		
		
	
	</div>
</aside>