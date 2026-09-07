<?php
/**
 * Template name: Career
 */
get_header();
?>

<div class="first-tab">
	<section class="people certain-sizes">
		<div class="people__container basic__container">
			<h1 class="g-title" data-title="<?php echo strtoupper(get_the_title()); ?>"></h1>
			<main>
				<div class="people__content fade-in-anim">
					<p><?php the_field('text_block_1'); ?></p>
					<p class="hide__500px"><?php the_field('text_block_2'); ?></p>
					
					<?php $email_us = get_field('email_us'); ?>
					<span class="hide__500px"><?php echo $email_us["text"]; ?> <a href="mailto:<?php echo $email_us["email"]; ?>"><?php echo $email_us["email"]; ?></a></span>
					
					<?php $meet = get_field('meet_our_team'); ?>
					<span class="hide__500px"><?php echo $meet["text"]; ?> 
						<?php $page = $meet["page_link"]; ?>
						<a href="<?php echo get_the_permalink($page[0]); ?>"><?php echo get_the_title($page[0]); ?></a>
					</span>
				</div>
				<div class="people__quotes fade-in-anim">
					<h4><?php the_field('members_words_title'); ?></h4>
					<?php if(have_rows('members_words_list')) : ?>
						<ul>
							<?php while(have_rows('members_words_list')) : the_row(); ?>
								<li>
									<svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/svg/sprite.svg#quotesIcon"></use></svg>
									<p><?php the_sub_field('text'); ?></p>
									<span><?php the_sub_field('member_name'); ?></span>
									<svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/svg/sprite.svg#quotesIcon"></use></svg>
								</li>
							<?php endwhile; ?>
						</ul>
					<?php endif; ?>
				</div>
				<div class="people__content show__500px fade-in-anim">
					<p><?php the_field('text_block_2'); ?></p>
					<span><?php echo $email_us["text"]; ?> <a href="mailto:<?php echo $email_us["email"]; ?>"><?php echo $email_us["email"]; ?></a></span>
					<span><?php echo $meet["text"]; ?> 
						<a href="<?php echo get_the_permalink($page[0]); ?>"><?php echo get_the_title($page[0]); ?></a>
					</span>
				</div>
			</main>
			
			<?php get_template_part('template-parts/page_nav'); ?>
		</div>
	</section> 
</div>

<?php get_footer(); ?>