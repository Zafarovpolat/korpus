<?php
/**
 * Template name: Home page
 */
get_header();
?>
<div class="first-tab">
	<?php
	$servise_types = get_terms([
		'taxonomy' => 'services_type',
		/*'orderby' => 'ID',
		'order' => 'ASC'*/
	]);
	?>
	
	<section class="services certain-sizes">
		<?php if($servise_types) : $i = 1; ?>
			<div class="services__container">
				<?php foreach($servise_types as $type) : ?>
					<div class="services__item">
						<main class="none">
							<header>
								<h1 class="g-title <?php echo(have_rows('title_words', $type)) ? 'hide__500px':''; ?>" data-title="<?php echo $type->name; ?>"></h1>
								<?php if(have_rows('title_words', $type)) : ?>
									<?php while(have_rows('title_words', $type)) : the_row(); ?>
										<h1 class="g-title show__500px" data-title="<?php the_sub_field('word'); ?>"></h1>
									<?php endwhile; ?>
								<?php endif; ?>

								<?php if($type->description) : ?>
									<div class="services__item-paragraph"><p><?php echo $type->description; ?></p></div>
								<?php endif; ?>
							</header>

							<?php
							$args = array(
								'post_type' => 'services',
								'posts_per_page' => -1,
								'tax_query' => [
									[
										'taxonomy' => 'services_type',
										'field' => 'term_id',
										'terms' => $type->term_id
									]
								],
								/*'orderby' => 'ID',
								'order' => 'ASC'*/
							);
							$service_list = new WP_Query($args);
							?>

							<?php if($service_list->have_posts()) : ?>
								<div class="services__item-content">						
									<div class="services__item-content-links" data-mobile-tab-links="<?php echo $i; ?>">
										<?php while($service_list->have_posts()) : $service_list->the_post(); ?>
											<button type="button" class="arrow-link" href="#" data-tab-btn="<?php echo ($service_list->current_post + 1); ?>" data-mobile-tab-btn="<?php echo ($service_list->current_post + 1); ?>">
												<span><?php the_title(); ?></span>
												<div><svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/svg/sprite.svg#arrowRight"></use></svg></div>
											</button>
										<?php endwhile; ?>
									</div>

									<div class="services__item-content-products">
										<?php while($service_list->have_posts()) : $service_list->the_post(); ?>							
											<div class="services__item-content-products-items <?php echo ($service_list->current_post == 0) ? 'active show' : 'none'; ?>" data-tab="<?php echo ($service_list->current_post + 1); ?>">
												<h3><?php the_title(); ?></h3>
												<div class="services__item-content-products-items-container">

													<?php if(have_rows('content_tabs')) : ?>
														<div class="services__item-content-products-items-info">
															<?php while(have_rows('content_tabs')) : the_row(); ?>
																<main>
																	<?php the_sub_field('text'); ?>

																	<?php $link = get_sub_field('link'); ?>
																	<?php if($link["link"]) : ?>
																		<a href="<?php echo $link["link"]; ?>">
																			<span><?php echo $link["link_text"]; ?></span>
																			<svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/svg/sprite.svg#sliderArrow"></use></svg>
																		</a>
																	<?php endif; ?>
																</main>
															<?php endwhile; ?>
														</div>
													<?php endif; ?>

													<?php if(have_rows('tags_list')) : ?>
														<div class="services__item-content-products-items-tags">
															<?php while(have_rows('tags_list')) : the_row(); ?>
																<button class="g-btn" type="submit" data-second-tab-btn="<?php echo get_row_index(); ?>">
																	<span><?php the_sub_field('tag_name'); ?></span>
																</button>
															<?php endwhile; ?>
														</div>
														<div class="services__item-content-products-items-scope">
															<?php while(have_rows('tags_list')) : the_row(); ?>
																<p class="none" data-second-tab="<?php echo get_row_index(); ?>">
																	<?php the_sub_field('tag_content'); ?>
																</p>
															<?php endwhile; ?>
														</div>
													<?php endif; ?>
												</div>
											</div>
										<?php endwhile; ?>
										<?php wp_reset_postdata(); ?>
									</div>
								</div>
							<?php endif; ?>
						</main>
						<div class="services__item-circle-title">
							<img src="<?php the_field('icon', $type); ?>" alt="svg">
						</div>
					</div>
					<?php $i++; ?>
				<?php endforeach; ?>
			</div>
		<?php endif; ?> 		
	</section>
</div>

<div class="services__cookies none">
	<div class="services__cookies-container">
		<p><a href="/Privacy_Policy_Final.pdf" title="Privacy Policy" target="_blank"><u><?php the_field('privacy_text1', 'options'); ?></u></a></p>
		<p class="show__500px"><a href="/Privacy_Policy_Final.pdf" title="Privacy Policy" target="_blank"><u><?php the_field('privacy_text2', 'options'); ?></u></a></p>
		<div class="services__cookies-btns">
			<button class="g-btn cookies-btn cookies-accept" type="submit" data-second-tab-btn="1">
				<span><?php _e('Accept all', 'kp'); ?></span>
			</button>
			<button class="g-btn cookies-btn cookies-decline" type="submit" data-second-tab-btn="1">
				<span><?php _e('Decline all', 'kp'); ?></span>
			</button>
			<?php $page = get_field('cookie_page', 'options'); ?>
			<a href="<?php echo get_the_permalink($page[0]); ?>" class="g-btn" type="submit" data-second-tab-btn="1">
				<span><?php _e('MANAGE', 'kp'); ?></span>
			</a>
		</div>
	</div>
</div>


<?php if($servise_types) : $i = 1; ?>
	<?php foreach($servise_types as $type) : ?>
		<?php
		$args = array(
			'post_type' => 'services',
			'posts_per_page' => -1,
			'tax_query' => [
				[
					'taxonomy' => 'services_type',
					'field' => 'term_id',
					'terms' => $type->term_id
				]
			],
			'orderby' => 'ID',
			'order' => 'ASC'
		);
		$service_list = new WP_Query($args);
		?>
		<aside class="mobile-tab" data-mobile-tab-container="<?php echo $i; ?>">
			<div class="mobile-tab__container">
				<?php if($service_list->have_posts()) : ?>
					<div class="mobile-tab__slider swiper">
						<div class="swiper-wrapper">
							<?php while($service_list->have_posts()) : $service_list->the_post(); ?>
								<div class="services__item-content-products-items swiper-slide" data-mobile-tab="<?php echo ($service_list->current_post + 1); ?>">
									<h3><?php the_title(); ?></h3>

									<?php if(have_rows('content_tabs')) : ?>
										<div class="services__item-content-products-items-info">
											<?php while(have_rows('content_tabs')) : the_row(); ?>
												<main>
													<?php the_sub_field('text'); ?>

													<?php $link = get_sub_field('link'); ?>
													<?php if($link["link"]) : ?>
														<a href="<?php echo $link["link"]; ?>">
															<span><?php echo $link["link_text"]; ?></span>
															<svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/svg/sprite.svg#sliderArrow"></use></svg>
														</a>
													<?php endif; ?>
												</main>
											<?php endwhile; ?>
										</div>
									<?php endif; ?>

									<?php if(have_rows('tags_list')) : ?>
										<div class="services__item-content-products-items-tags">
											<?php while(have_rows('tags_list')) : the_row(); ?>
												<button class="g-btn" type="submit" data-second-tab-btn="<?php echo get_row_index(); ?>">
													<span><?php the_sub_field('tag_name'); ?></span>
												</button>
											<?php endwhile; ?>
										</div>
										<div class="services__item-content-products-items-scope">
											<?php while(have_rows('tags_list')) : the_row(); ?>
												<p class="<?php echo (get_row_index() == 1) ? 'show open' : 'none'; ?>" data-second-tab="<?php echo get_row_index(); ?>">
													<?php the_sub_field('tag_content'); ?>
												</p>
											<?php endwhile; ?>
										</div>
									<?php endif; ?>
								</div>
							<?php endwhile; ?>
							<?php wp_reset_postdata(); ?>
						</div>
					</div>
				<?php endif; ?>
				
				<div class="arrows arrows--mobile-tab">
					<button type="button" class="arrows-item arrows-item--prev arrows-item-mobile-tab--prev"><svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/svg/sprite.svg#sliderLargeArrow"></use></svg></button>
					<button type="button" class="arrows-item arrows-item--next arrows-item-mobile-tab--next"><svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/svg/sprite.svg#sliderLargeArrow"></use></svg></button>
				</div>
			</div>
		</aside>
		<?php $i++; ?>
	<?php endforeach; ?>
<?php endif; ?> 

<script>
	jQuery(function($) {
		$('.cookies-btn').on('click', function() {
			<?php $page = get_field('cookie_page', 'options'); ?>
			<?php if(have_rows('cookies_list', $page[0])) : ?>
				<?php while(have_rows('cookies_list', $page[0])) : the_row(); ?>
					if($(this).hasClass('cookies-accept')) Cookies.set('<?php the_sub_field('cookie_slug'); ?>', "1", { expires:1, path: '/' });
					else if($(this).hasClass('cookies-decline')) Cookies.remove('<?php the_sub_field('cookie_slug'); ?>');
				<?php endwhile; ?>
			<?php endif; ?>
			
			if($(this).hasClass('cookies-accept')) Cookies.set('accept_all_cookies', "1", { expires:1, path: '/' });
			
			$(this).addClass('active');
			$('.services__cookies').removeClass('show');
		});
		
		if(Cookies.get('accept_all_cookies')) {
			$('.services__cookies').css('display', 'none');
		}
	});
</script>

<?php get_footer(); ?>