<?php
/**
 * Template name: Who we are
 */
get_header();
?>

<div class="first-tab">
	<section class="about certain-sizes">
		<div class="about__container basic__container">
			<h1 class="g-title" data-title="<?php echo strtoupper(get_the_title()); ?>"></h1>
			<main>
				<div class="about__content">
					<p class="fade-in-anim"><?php the_field('text_block'); ?></p>
					<p></p>
					<!---p class="fade-in-anim hide__500px">
						<?php// the_field('learn_more_text'); ?> 
						<?php //$link = get_field('brochure'); ?>
						<a href="<?php //echo $link["link"]; ?>"><?php //echo $link["link_text"]; ?></a>
					</p-->
					<div class="about__content-links hide__500px">
						<div class="arrow-link">
							<span><?php _e('Follow us', 'kp'); ?></span>
							<div><svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/svg/sprite.svg#arrowRight"></use></svg></div>
						</div>
						<ul>
							<?php if($tg = get_field('telegram', 'options')) : ?>
								<a href="<?php echo $tg; ?>"><svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/svg/sprite.svg#telegramIcon"></use></svg></a>
							<?php endif; ?>
							
							<?php if($linkedin = get_field('linkedin', 'options')) : ?>
								<a href="<?php echo $linkedin; ?>"><svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/svg/sprite.svg#linkedInIcon"></use></svg></a>
							<?php endif; ?>
							
							<?php if($twitter = get_field('twitter', 'options')) : ?>
								<a href="<?php echo $twitter; ?>"><svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/svg/sprite.svg#twitterIcon"></use></svg></a>
							<?php endif; ?>
						</ul>
					</div>
				</div>
				
				<?php if(have_rows('features_list')) : ?>
					<div class="about__skills">
						<?php while(have_rows('features_list')) : the_row(); ?>
							<div class="about__skills-item fade-in-anim">
								<h4><?php the_sub_field('title'); ?></h4>
								<p><?php the_sub_field('text'); ?></p>
							</div>
						<?php endwhile; ?>
					</div>
				<?php endif; ?>
				
				<div class="about__content show__500px">
					<p class="fade-in-anim">
						<?php the_field('learn_more_text'); ?> 
						<a href="<?php echo $link["link"]; ?>"><?php echo $link["link_text"]; ?></a>
					</p>
					<div class="about__content-links">
						<div class="arrow-link">
							<span><?php _e('Follow us', 'kp'); ?></span>
							<div><svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/svg/sprite.svg#arrowRight"></use></svg></div>
						</div>
						<ul>
							<?php if($tg) : ?>
								<a href="<?php echo $tg; ?>"><svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/svg/sprite.svg#telegramIcon"></use></svg></a>
							<?php endif; ?>
							
							<?php if($linkedin) : ?>
								<a href="<?php echo $linkedin; ?>"><svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/svg/sprite.svg#linkedInIcon"></use></svg></a>
							<?php endif; ?>
							
							<?php if($twitter) : ?>
								<a href="<?php echo $twitter; ?>"><svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/svg/sprite.svg#twitterIcon"></use></svg></a>
							<?php endif; ?>
						</ul>
					</div>
				</div>
			</main>
			
			<?php get_template_part('template-parts/page_nav'); ?>
		</div>
	</section>
</div>

<?php get_footer(); ?>