<?php
/**
 * Template name: History
 */
get_header();
?>


<div class="first-tab">

	<section class="history certain-sizes">
		<div class="history__container basic__container">
			<div class="history__heading fade-in-anim">
				<h1 class="g-title" data-title="<?php echo strtoupper(get_the_title()); ?>"></h1>
				
				<?php if(have_rows('history_list')) : ?>
					<ul>
						<?php while(have_rows('history_list')) : the_row(); ?>
							<button class="g-btn <?php echo (get_row_index() == 1) ? 'active' : ''; ?>" type="submit" data-tab-btn="<?php echo get_row_index(); ?>">
								<span><?php the_sub_field('period'); ?></span>
							</button>
						<?php endwhile; ?>
					</ul>
				<?php endif; ?>
			</div>
		</div>
		
		<?php if(have_rows('history_list')) : $i = 1; ?>
			<div class="history__content fade-in-anim">
				<?php while(have_rows('history_list')) : the_row(); ?>
					<ul class="history__content-table <?php echo (get_row_index() == 1) ? 'active' : 'none'; ?>" data-tab="<?php echo get_row_index(); ?>">
						<?php while(have_rows('period_data')) : the_row(); ?>
							<button type="button" class="history__content-table-item">
								<main>
									<div class="history__content-table-item-arrow">
										<svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/svg/sprite.svg#arrowRight"></use></svg>
									</div>
									<div class="history__content-table-item-desc">
										<?php while(have_rows('year_events')) : the_row(); ?>
											<div class="history__content-table-item-desc-item">
												<em>
													<?php 
													if($i < 10) echo '00'.$i;
													elseif($i >= 10 && $i < 100) echo '0'.$i;
													else echo $i;
													?>
												</em>
												<p><?php the_sub_field('event'); ?></p>
											</div>
											<?php $i++; ?>
										<?php endwhile; ?>
									</div>
									<time><?php the_sub_field('year'); ?></time>
								</main>
							</button>
						<?php endwhile; ?>
					</ul>				
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
		
		<div class="history__container basic__container">
			<?php get_template_part('template-parts/page_nav'); ?>
		</div>
		
	</section>
</div>



<?php get_footer(); ?>