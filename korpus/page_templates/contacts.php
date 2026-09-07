<?php
/**
 * Template name: Contacts
 */
get_header();
?>

<div class="first-tab">


	<section class="contacts certain-sizes">
		<div class="contacts__container basic__container">
			<h1 class="g-title" data-title="<?php echo strtoupper(get_the_title()); ?>"></h1>
			<main>
				<div class="contacts__links fade-in-anim" data-mobile-tab-links="1">
					<button type="button" class="arrow-link" href="#" data-tab-btn="1" data-mobile-tab-btn="1">
						<span><?php the_field('tab_name1'); ?></span>
						<div><svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/svg/sprite.svg#arrowRight"></use></svg></div>
					</button>
					<button type="button" class="arrow-link" href="#" data-tab-btn="2" data-mobile-tab-btn="2">
						<span><?php the_field('tab_name2'); ?></span>
						<div><svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/svg/sprite.svg#arrowRight"></use></svg></div>
					</button>
					<button type="button" class="arrow-link" href="#" data-tab-btn="3" data-mobile-tab-btn="3">
						<span><?php the_field('tab_name3'); ?></span>
						<div><svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/svg/sprite.svg#arrowRight"></use></svg></div>
					</button>
				</div>
				<div class="contacts__content fade-in-anim">
					<ul class="contacts__content-info active" data-tab="1">
						<?php while(have_rows('contacts_list', 'options')) : the_row(); ?>
							<li class="contacts__content-info-item">
								<h4><?php the_sub_field('country'); ?></h4>
								<address><?php the_sub_field('address'); ?></address>
								<a class="contacts__content-info-item-phone" href="tel:<?php echo str_replace(array(' ', '-', '(', ')'), '', get_sub_field('telephone')); ?>">
									<?php the_sub_field('telephone'); ?>
								</a>
								<a class="contacts__content-info-item-email" href="mailto:<?php the_sub_field('email'); ?>">
									<?php the_sub_field('email'); ?>
								</a>
							</li>
						<?php endwhile; ?>
					</ul>
					<div class="contacts__content-form contact-form none" data-tab="2">
						<div class="contact-form__container">
							<h4><?php the_field('form_title'); ?></h4>
							<?php //echo do_shortcode('[contact-form-7 id="6" html_class="contact-form__wrapper-form" title="Contact form (EN)"]'); ?>
							<?php get_template_part('template-parts/contact_from'); ?>
						</div>
						<div class="contact-form__thx none">
							<?php the_field('success_send_text'); ?>
						</div>
					</div>
					<div class="contacts__content-community none" data-tab="3">
						<h4><?php the_field('join_title'); ?></h4>
						<div class="contacts__content-community-wrapper">
							<?php the_field('left_text'); ?>
							<div class="contacts__content-community-wrapper-list">
								<?php the_field('right_text'); ?>
								
								<?php $link = get_field('join_link'); ?>
								<?php if ($link): ?>
									<?php 
									$link_url = is_array($link) ? ($link['link'] ?? '') : $link;
									$link_text = is_array($link) ? ($link['link_text'] ?? '') : '';
									?>
									<?php if (!empty($link_url)): ?>
										<a class="contact-form-submit g-btn" href="<?php echo esc_url($link_url); ?>">
											<span><?php echo esc_html($link_text); ?></span>
										</a>
									<?php endif; ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
					
					<br/><br/><div id="myZadarmaCallmeWidget13120"></div>
					<script src="/zw/callUs_EN.js"></script>

				</div>
			</main>
			
			<?php get_template_part('template-parts/page_nav'); ?>
		</div>
	</section>
</div>

<aside class="mobile-tab" data-mobile-tab-container="1">
	<div class="mobile-tab__container">
		<div class="mobile-tab__slider swiper">
			<div class="swiper-wrapper">
				<ul class="contacts__content-info swiper-slide" data-mobile-tab="1">
					<?php while(have_rows('contacts_list', 'options')) : the_row(); ?>
						<li class="contacts__content-info-item">
							<h4><?php the_sub_field('country'); ?></h4>
							<address><?php the_sub_field('address'); ?></address>
							<a class="contacts__content-info-item-phone" href="tel:<?php echo str_replace(array(' ', '-', '(', ')'), '', get_sub_field('telephone')); ?>">
								<?php the_sub_field('telephone'); ?>
							</a>
							<a class="contacts__content-info-item-email" href="mailto:<?php the_sub_field('email'); ?>">
								<?php the_sub_field('email'); ?>
							</a>
						</li>
					<?php endwhile; ?>
				</ul>
				<div class="contacts__content-form contact-form swiper-slide" data-mobile-tab="2">
					<div class="contact-form__container">
						<h4><?php the_field('form_title'); ?></h4>
						<?php //echo do_shortcode('[contact-form-7 id="6" html_class="contact-form__wrapper-form" title="Contact form (EN)"]'); ?>
						<?php get_template_part('template-parts/contact_from'); ?>
					</div>
					<div class="contact-form__thx none">
						<?php the_field('success_send_text'); ?>
					</div>
				</div>
				<div class="contacts__content-community swiper-slide" data-mobile-tab="3">
					<h4><?php the_field('join_title'); ?></h4>
					<div class="contacts__content-community-wrapper">
						<?php the_field('left_text'); ?>
						
						<div class="contacts__content-community-wrapper-list">
							<?php the_field('right_text'); ?>

							<?php $link = get_field('join_link'); ?>
							<?php if ($link): ?>
								<?php 
								$link_url = is_array($link) ? ($link['link'] ?? '') : $link;
								$link_text = is_array($link) ? ($link['link_text'] ?? '') : '';
								?>
								<?php if (!empty($link_url)): ?>
									<a class="contact-form-submit g-btn" href="<?php echo esc_url($link_url); ?>">
										<span><?php echo esc_html($link_text); ?></span>
									</a>
								<?php endif; ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="arrows arrows--mobile-tab">
			<button type="button" class="arrows-item arrows-item--prev arrows-item-mobile-tab--prev"><svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/svg/sprite.svg#sliderLargeArrow"></use></svg></button>
			<button type="button" class="arrows-item arrows-item--next arrows-item-mobile-tab--next"><svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/svg/sprite.svg#sliderLargeArrow"></use></svg></button>
		</div>
	</div>
</aside>


<?php get_footer(); ?>
