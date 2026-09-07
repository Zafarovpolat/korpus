<?php
/**
 * Template name: Cookies
 */
get_header();
?>

<div class="first-tab">


	<section class="cookies certain-sizes">
		<div class="cookies__container basic__container">
			<div class="cookies__panel fade-in-anim">
				<?php the_field('text_1'); ?>
				<div class="cookies__panel-btns">
					<button class="g-btn " type="submit" data-task="accept"><span><?php _e('Accept all', 'kp'); ?></span></button>
					<button class="g-btn " type="submit" data-task="decline"><span><?php _e('Decline all', 'kp'); ?></span></button>
					<button class="g-btn " type="submit" data-task="manage"><span><?php _e('MANAGE', 'kp'); ?></span></button>
				</div>
			</div>
			
			<main>
				<h1 class="g-title" data-title="<?php the_field('page_title'); ?>"></h1>
				<div class="cookies__paragraph fade-in-anim">
					<?php the_field('text_2'); ?>
				</div>
				
				<?php if(have_rows('cookies_list')) : ?>
					<div class="cookies__settings fade-in-anim">
						<?php while(have_rows('cookies_list')) : the_row(); ?>
							<div class="cookies__settings-item  <?php //echo (get_row_index() == 1) ? 'show' : ''; ?>">
								<header>
									<main>
										<p><?php the_sub_field('cookie_name'); ?></p>
										<a href="#" type="button">
											<span><?php _e('Learn more', 'kp'); ?></span>
											<svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/svg/sprite.svg#sliderArrow"></use></svg>
										</a>
									</main>
									<label class="switcher-checkbox">
										<input class="switch" type="checkbox" data-cookie-slug="<?php the_sub_field('cookie_slug'); ?>" <?php echo (get_row_index() == 1) ? 'checked' : ''; ?>>
										<div><div></div></div>
									</label>                        
								</header>
								<div class="cookies__settings-item-content">
									<main>
										<p><?php the_sub_field('cookie_description'); ?></p>
									</main>
								</div>
							</div>
						<?php endwhile; ?>
					</div>
				<?php endif; ?>
				<div class="cookies__save">
					<button class="g-btn" type="submit"><span><?php the_field('button_text'); ?></span></button>
				</div>
			</main>
		</div>
	</section>
</div>

<script>
	jQuery(function($) {
		var save_btn_text = $('.cookies__save').find('.g-btn span').text();
		
		$('.cookies__panel-btns .g-btn').on('click', function() {
			var task = $(this).data('task');
			if(task == 'accept') $('.cookies__settings-item').find('.switch').prop('checked', true).prop('disabled', true);
			else if(task == 'decline') $('.cookies__settings-item').find('.switch').prop('checked', false).prop('disabled', true);
			else if(task == 'manage') $('.cookies__settings-item').find('.switch').prop('checked', false).prop('disabled', false);
			
			$('.cookies__save').find('.g-btn span').text(save_btn_text);
		});
		
		$('.cookies__settings-item').find('input').each(function() {
			var cookie_slug = $(this).data('cookie-slug');
			if(Cookies.get(cookie_slug) == '1') $(this).prop('checked', true);
			else $(this).prop('checked', false);
		})
		
		$('.cookies__settings-item a').on('click', function() {
			$(this).parents('.cookies__settings-item').toggleClass('show');
		});
		
		$('.switcher-checkbox > div').on('click', function() {
			
		})
		
		$('.cookies__save .g-btn').on('click', function() {
			$('.cookies__settings-item').find('.switch').each(function() {
				if($(this).is(':checked')) {
					Cookies.set($(this).data('cookie-slug'), "1", { expires:1, path: '/' });
				}
				else Cookies.remove($(this).data('cookie-slug'));
			});
			
			$(this).find('span').text('<?php _e('Successfully saved!', 'kp'); ?>');
		});
	})
</script>

<?php get_footer(); ?>