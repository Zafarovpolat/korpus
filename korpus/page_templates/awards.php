<?php
/**
 * Template name: Awards
 */
get_header();
?>

<div class="first-tab">
	<section class="about about--awards certain-sizes">
		<div class="about__container basic__container">
			<h1 class="g-title" data-title="<?php echo strtoupper(get_the_title()); ?>"></h1>
			<main>
				<div class="about__content">
					<p class="fade-in-anim"><?php the_field('text_1'); ?></p>
					<p class="fade-in-anim"><?php the_field('text_2'); ?></p>
				</div>
				<div class="about__awards">
					<p class="fade-in-anim"><?php the_field('text_3'); ?></p>
					<?php if(have_rows('awards_list')) : ?>
						<ul>
							<?php while(have_rows('awards_list')) : the_row(); ?>
								<li class="fade-in-anim">
									<picture><?php echo wp_get_attachment_image(get_sub_field('logo'), 'medium'); ?></picture>
									<span><?php the_sub_field('text'); ?></span>
								</li>
							<?php endwhile; ?>
						</ul>
					<?php endif; ?>
				</div>
			</main>
			
			<?php get_template_part('template-parts/page_nav'); ?>
		</div>
	</section>
</div>

<?php get_footer(); ?>