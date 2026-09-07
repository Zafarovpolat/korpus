<?php
/**
 * Template name: Team
 */
get_header();
?>

<div class="first-tab">


	<section class="team certain-sizes">
		<div class="team__container basic__container">
			<div class="team__heading">
				<h1 class="g-title" data-title="<?php echo strtoupper(get_the_title()); ?>"></h1>
				<?php
				$team_groups = get_terms(
					[
						'taxonomy' => 'team_group',
						/*'orderby' => 'term_id',
						'order' => 'ASC'*/
					]
				);
				if($team_groups) {
					echo '<ul>';
					$i = 1;
					foreach($team_groups as $group) {
						if($i == 1) $class="active";
						else $class="";
						echo '<button class="g-btn '.$class.'" data-group="'.$group->slug.'" type="submit"><span>'.$group->name.'</span></button>';
						$i++;
					}
					echo '</ul>';
				}
				?>
			</div>
			
			<?php
			$args = array(
				'post_type' => 'team',
				'posts_per_page' => -1,
				/*'orderby' => 'title',
				'order' => 'ASC'*/
			);
			$team_members = new WP_Query($args);
			?>
			<?php if($team_members->have_posts()) : $group_classes = []; ?>
			<main>
				<div class="team__links fade-in-anim" data-mobile-tab-links="1">
					<?php while($team_members->have_posts()) : $team_members->the_post(); ?>
						<?php 
						$member_groups = get_the_terms($post->ID, 'team_group');
						
						foreach( $member_groups as $member_group ){
							$group_classes[$post->ID][] = $member_group->slug;
						}
						?>
						<button type="button" class="arrow-link <?php echo implode(' ', $group_classes[$post->ID]); ?>" href="#" data-tab-btn="<?php echo $team_members->current_post; ?>" data-mobile-tab-btn="<?php echo $team_members->current_post; ?>">
							<span><?php the_title(); ?></span>
							<div><svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/svg/sprite.svg#arrowRight"></use></svg></div>
						</button>
					<?php endwhile; ?>
				</div>
				
				<div class="team__content fade-in-anim">
					<?php while($team_members->have_posts()) : $team_members->the_post(); ?>
						<div class="team__content-employees <?php echo implode(' ', $group_classes[$post->ID]); ?> <?php echo ($team_members->current_post == 0) ? 'active' : 'none'; ?>" data-tab="<?php echo $team_members->current_post; ?>">
							<h4><?php the_title(); ?></h4>
							<div class="team__content-employees-position"><?php the_field('member_post'); ?></div>
							<?php if($linkedin = get_field('linkedin')) : ?>
								<a class="team__content-employees-link" href="<?php echo $linkedin; ?>">
									<svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/svg/sprite.svg#linkedInIcon"></use></svg>
								</a>
							<?php else : ?>
								<span class="team__content-employees-link"></span>
							<?php endif; ?>
							
							<div class="team__content-employees-wrapper">
								<div class="team__content-employees-wrapper-column">
									<?php the_content(); ?>
									
									<?php if($email = get_field('email')) : ?>
									<a href="mailto:<?php echo $email; ?>" class="g-btn team__content-employees-wrapper-column-mail">
										<span><?php _e('SEND E-MAIL', 'kp'); ?></span>
									</a>
									<?php endif; ?>
								</div>
								<div class="team__content-employees-wrapper-column">
									<?php the_post_thumbnail('medium_large'); ?>
								</div>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			</main>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
			
			<?php get_template_part('template-parts/page_nav'); ?>
		</div>
	</section>
</div>

<script>
	jQuery(function($) {
		function hide_content(group) {
			$('.team__links .arrow-link:not(.'+group+')').hide();
			$('.team__links .arrow-link.'+group).show();
			
			$('.team__content-employees').removeClass('active').removeClass('show').addClass('none');
			$('.team__content-employees.'+group).eq(0).addClass('active').addClass('show').removeClass('none');
		}
		
		var first_group = $('.team__heading .g-btn.active').data('group');
		hide_content(first_group);
		
		$('.team__heading .g-btn').on('click', function() {
			var group = $(this).data('group');
			hide_content(group);		
		});
	})
</script>

<?php get_footer(); ?>