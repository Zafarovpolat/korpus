<?php
/**
 * Template name: Media
 */
get_header();
?>


<div class="first-tab">
	<section class="about about--media certain-sizes">
		<div class="about__container basic__container">
			<h1 class="g-title" data-title="<?php echo strtoupper(get_the_title()); ?>"></h1>
			
			<main>
				<div class="about__content">
					<div class="fade-in-anim"><?php the_content(); ?></div>
				</div>
				
				<?php
				$args = array(
					'post_type' => 'post',
					'post_per_page' => -1
				);
				$post_list = new WP_Query($args);
				?>
				
				<?php if($post_list->have_posts()) : ?>
					<div class="media__slider swiper fade-in-anim">
						<div class="arrows arrows--media">
							<button type="button" class="arrows-item arrows-item--prev arrows-item-media--prev"><svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/svg/sprite.svg#sliderArrow"></use></svg></button>
							<button type="button" class="arrows-item arrows-item--next arrows-item-media--next"><svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/svg/sprite.svg#sliderArrow"></use></svg></button>
						</div>

						<div class="swiper-wrapper">
							<ul class="swiper-slide">
								<?php while($post_list->have_posts()) : $post_list->the_post(); ?>
									<?php if($post_list->current_post != 0 && $post_list->current_post % 3 == 0) echo '</ul><ul class="swiper-slide">'; ?>
									<li>
										<?php if($link = get_field('link')) : ?>
											<a href="<?php echo $link; ?>">
												<?php $link_text = get_field('link_text'); ?>
												<?php echo ($link_text) ? $link_text : str_replace(array('https://', 'http://'), '', $link); ?>
											</a>
										<?php endif; ?>
										
										<h4><?php the_title(); ?></h4>
										<?php the_content(); ?>
									</li>							
								<?php endwhile; ?>
								<?php wp_reset_postdata(); ?>
							</ul>
						</div>
					</div>
				<?php endif; ?>
			</main>
			
			<?php get_template_part('template-parts/page_nav'); ?>		
		</div>
	</section>
</div>


<?php get_footer(); ?>