<?php
global $menu_arr, $post; 

$arr = [];


//приводим меню к нужному нам виду
foreach($menu_arr as $key=>$menu_item) {
	foreach($menu_item['submenu'] as $submenu_item) {
		$arr[$key][] = $submenu_item['postID'];
	}
}

$next_page = $prev_page = '';
foreach($arr as $key => $items) {
	foreach($items as $key2 => $item) {
		if($item == $post->ID) {			
			if($key2 == 0) $next_page = $items[1];
			elseif($key2 == (count($items) - 1))  $prev_page = $arr[$key][($key2 - 1)]; 
			else {
				$next_page = $items[($key2 + 1)];
				$prev_page = $items[($key2 - 1)];
			}
		}		
	}
}
?>


<div class="navigation-page fade-in-anim">
	<?php if($prev_page) : ?>
		<a href="<?php echo get_the_permalink($prev_page); ?>" class="<?php echo(!$next_page) ? 'last_page':''; ?>">
			<span><?php echo get_the_title($prev_page); ?></span>
			<svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/svg/sprite.svg#smallArrow"></use></svg>
		</a>
	<?php endif; ?>

	<?php if($next_page) : ?>
		<a href="<?php echo get_the_permalink($next_page); ?>">
			<span><?php echo get_the_title($next_page); ?></span>
			<svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/svg/sprite.svg#smallArrow"></use></svg>
		</a>
	<?php endif; ?>
</div>
