	<aside class="switchbar">
		<button type="button" class="switchbar__btn">
			<div class="switchbar__logo"><svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/svg/sprite.svg#logoAbreviate"></use></svg></div>
		</button>
	</aside>
	

	<div class="second-tab">
		<div class="second-tab__wrapper">
			<div class="second-tab__container">
				<h1 class="g-title" data-title="<?php the_field('kp_digital_title', 'options'); ?>"></h1>
				
				<?php if(have_rows('items_list', 'options')) : ?>
					<ul class="second-tab__table">
						<?php while(have_rows('items_list', 'options')) : the_row(); ?>
							<li class="second-tab__table-item fade-in-anim second-tab__table-item--<?php echo get_row_index(); ?>">
								<img src="<?php the_sub_field('icon'); ?>" alt="svg">
								<h3><?php the_sub_field('title'); ?></h3>
								<p><?php the_sub_field('text'); ?></p>
								<?php $link = get_sub_field('link'); ?>
								
								<?php if($link["link"]) : ?>
									<a href="<?php echo $link["link"]; ?>" class="g-btn" type="submit">
										<span><?php echo $link["link_text"]; ?></span>
									</a>
								<?php endif; ?>
							</li>
						<?php endwhile; ?>
					</ul>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div><!--.page-->

<?php wp_footer(); ?>


</body>
</html>