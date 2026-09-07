<?php
/**
 * Template name: Alumni
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
					<span class="hide__500px">
						<?php $sign_up = get_field('sign_up'); ?>
						<a href="<?php echo $sign_up["link"]; ?>"><?php echo $sign_up["text"]; ?></a>
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
				<div class="people__content fade-in-anim show__500px">
					<p><?php the_field('text_block_2'); ?></p>
					<span>
						<a href="<?php echo $sign_up["link"]; ?>"><?php echo $sign_up["text"]; ?></a>
					</span>
				</div>
			</main>
			
			<?php get_template_part('template-parts/page_nav'); ?>
		</div>
	</section> 
</div>


<?php get_footer(); ?>