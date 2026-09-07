<?php get_header(); ?>
	<div class="blog">
		<div class="container">
            <?php if ( have_posts() ) : ?>
                <div class="blogList">
                    <?php while ( have_posts() ) : the_post(); ?>
                    	<?php the_content(); ?>
                    <?php endwhile; ?>
                </div>

				<div>			
					<?php //comments_template('/comments.php',true); ?>				
				</div>
            <?php endif; ?>
		</div>
	</div>

<?php get_footer(); ?>