<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="format-detection" content="telephone=no"> 
	
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon/site.webmanifest">
    <link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
	
	<?php wp_head(); ?>
</head>
<body class="">
   <?php $home_page = pll_get_post(get_option('page_on_front'), pll_current_language()); ?> 
    <header class="header">
        <div class="header__container">
			
            <a href="<?php echo get_the_permalink($home_page); ?>" class="header__logo">
				<img src="<?php the_field('logo', 'options'); ?>" alt="logo">
			</a>
			
            <button class="burger burger--menu" aria-label="Burger menu">
                <span></span>
                <span></span>
            </button>
			
			<?php
			$cur_lang = pll_current_language(); 
			$translations = pll_the_languages(array('raw'=>1));
			//unset($translations[$cur_lang]);
			?>
            <div data-language-switcher class="lang-switcher">
				<?php
				$i = 1;
				foreach ($translations as $lang) {
					if($cur_lang == $lang['slug']) {
						echo '<span data-language="'.$lang['slug'].'" class="lang-switcher__btn lang-switcher__btn--current" lang="'.$lang['slug'].'" hreflang="'.$lang['slug'].'">';
							echo $lang['slug'];
						echo '</span>';
					}
					else {
						echo '<a data-language="'.$lang['slug'].'" class="lang-switcher__btn lang-switcher__btn--'.$i.'" lang="'.$lang['slug'].'" hreflang="'.$lang['slug'].'" href="'.$lang['url'].'">';
							echo $lang['slug'];
						echo '</a>';
					}	
					$i++;
				}
				?>
            </div>
        </div>
    </header>
	
    <div class="menu">
		<?php
		$menu_name = 'main_menu';
		$locations = get_nav_menu_locations();
		if( $locations && isset( $locations[ $menu_name ] ) ){
			$menu_items = wp_get_nav_menu_items( $locations[ $menu_name ] );

			$menu_arr = [];
			global $menu_arr;
			//Формируем структуру меню
			foreach((array) $menu_items as $key => $menu_item) {
				if($menu_item->menu_item_parent != 0) {										
					$menu_arr[$menu_item->menu_item_parent]['submenu'][$menu_item->ID]['title'] = $menu_item->title;
					$menu_arr[$menu_item->menu_item_parent]['submenu'][$menu_item->ID]['url'] = $menu_item->url;	
					$menu_arr[$menu_item->menu_item_parent]['submenu'][$menu_item->ID]['postID'] = $menu_item->object_id;	//for page nav
					$menu_arr[$menu_item->menu_item_parent]['submenu'][$menu_item->ID]['classes'] = $menu_item->classes;	
				}
				else {
					$menu_arr[$menu_item->ID]['title'] = $menu_item->title;
					$menu_arr[$menu_item->ID]['url'] = $menu_item->url;
				}
			}
		}
		
		
		?>
		
        <div class="menu__switchbar"></div>
        <div class="menu__container">
			<?php if($menu_arr) : ?>
            <ul class="menu__list">
				<?php foreach($menu_arr as $menu_item) : ?>
					<li class="menu__list-item">
						<main class="">
							<h1 class="g-title" data-title="<?php echo $menu_item['title']; ?>"></h1>
							
							<?php if($menu_item['submenu']) : ?>
								<div class="menu__list-item-links">
									<ul>
										<?php foreach($menu_item['submenu'] as $submenu_item) : ?>
											<a class="arrow-link" href="<?php echo $submenu_item['url']; ?>">
												<span><?php echo $submenu_item['title']; ?></span>
												<div><svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/svg/sprite.svg#arrowRight"></use></svg></div>
											</a>
											<?php if(in_array('new_col', $submenu_item['classes'])) echo '</ul><ul>'; ?>
										<?php endforeach; ?>
									</ul>	
								</div>
							<?php endif; ?>
						</main>
					</li>
				<?php endforeach; ?>
            </ul>
		
    		<?php endif; ?>
            <div class="menu__footer"> 
                <p>© 2003-<?php echo date("Y"); ?> korpus Prava. <?php _e('All rights reserved.', 'kp'); ?></p>
                <a href="<?php the_field('privacy_policy_file', 'options'); ?>" class="g-btn" target="_blank">
                    <span><?php _e('PRIVACY POLICY', 'kp'); ?></span>
                </a>
            </div>
        </div>		
    </div>
	
	<?php 
	if(is_front_page()) $class = 'page--main';
	else $class = '';
	?>
	<div id="page" class="page <?php echo $class; ?>">
