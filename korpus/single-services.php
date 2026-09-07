<?php get_header(); ?>

<div class="first-tab" data-scrollbar="true">
    <div class="scroll-content">

        <section class="services certain-sizes">
            <div class="services__container">
                <div class="services__item services__item--cirlce-item services__item--ready" style="z-index: 10; transition-duration: 4s;">
                    <main class="">
                        <header>
                            <h1 class="g-title" data-title="<?php the_title(); ?>"></h1>
                        </header>

                        <div class="services__item-content">
                            <div class="services__item-content-links" data-mobile-tab-links="1">
                                <?php if( have_rows('content_tabs') ) : $ti = 1; ?>
                                    <?php while( have_rows('content_tabs') ) : the_row(); ?>
                                        <button type="button" class="arrow-link" href="#" data-tab-btn="<?php echo $ti; ?>" data-mobile-tab-btn="<?php echo $ti; ?>">
                                            <span><?php the_sub_field('text'); ?></span>
                                            <div><svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/svg/sprite.svg#arrowRight"></use></svg></div>
                                        </button>
                                    <?php $ti++; endwhile; ?>
                                <?php endif; ?>
                            </div>

                            <div class="services__item-content-products">
                                <?php if( have_rows('content_tabs') ) : $ti = 1; ?>
                                    <?php while( have_rows('content_tabs') ) : the_row(); ?>
                                        <div class="services__item-content-products-items <?php echo ($ti === 1) ? 'active show' : 'none'; ?>" data-tab="<?php echo $ti; ?>">
                                            <h3><?php the_title(); ?></h3>
                                            <div class="services__item-content-products-items-container">
                                                <div class="services__item-content-products-items-info">
                                                    <main>
                                                        <?php the_sub_field('text'); ?>
                                                        <?php $link = get_sub_field('link'); ?>
                                                        <?php if( $link && $link['link'] ) : ?>
                                                            <a href="<?php echo esc_url($link['link']); ?>">
                                                                <span><?php echo esc_html($link['link_text']); ?></span>
                                                                <svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/svg/sprite.svg#sliderArrow"></use></svg>
                                                            </a>
                                                        <?php endif; ?>
                                                    </main>
                                                </div>

                                                <?php if( have_rows('tags_list') ) : ?>
                                                    <div class="services__item-content-products-items-tags">
                                                        <?php while( have_rows('tags_list') ) : the_row(); ?>
                                                            <button class="g-btn" type="submit" data-second-tab-btn="<?php echo get_row_index(); ?>">
                                                                <span><?php the_sub_field('tag_name'); ?></span>
                                                            </button>
                                                        <?php endwhile; ?>
                                                    </div>
                                                    <div class="services__item-content-products-items-scope">
                                                        <?php while( have_rows('tags_list') ) : the_row(); ?>
                                                            <p class="none" data-second-tab="<?php echo get_row_index(); ?>">
                                                                <?php the_sub_field('tag_content'); ?>
                                                            </p>
                                                        <?php endwhile; ?>
                                                    </div>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    <?php $ti++; endwhile; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </section>

    </div>
</div>

<aside class="mobile-tab" data-mobile-tab-container="1" data-scrollbar="true">
    <div class="mobile-tab__container">
        <div class="mobile-tab__slider swiper">
            <div class="swiper-wrapper">
                <?php if( have_rows('content_tabs') ) : $ti = 1; ?>
                    <?php while( have_rows('content_tabs') ) : the_row(); ?>
                        <div class="services__item-content-products-items swiper-slide" data-mobile-tab="<?php echo $ti; ?>">
                            <h3><?php the_title(); ?></h3>
                            <div class="services__item-content-products-items-info">
                                <main>
                                    <?php the_sub_field('text'); ?>
                                    <?php $link = get_sub_field('link'); ?>
                                    <?php if( $link && $link['link'] ) : ?>
                                        <a href="<?php echo esc_url($link['link']); ?>">
                                            <span><?php echo esc_html($link['link_text']); ?></span>
                                            <svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/svg/sprite.svg#sliderArrow"></use></svg>
                                        </a>
                                    <?php endif; ?>
                                </main>
                            </div>

                            <?php if( have_rows('tags_list') ) : ?>
                                <div class="services__item-content-products-items-tags">
                                    <?php while( have_rows('tags_list') ) : the_row(); ?>
                                        <button class="g-btn" type="submit" data-second-tab-btn="<?php echo get_row_index(); ?>">
                                            <span><?php the_sub_field('tag_name'); ?></span>
                                        </button>
                                    <?php endwhile; ?>
                                </div>
                                <div class="services__item-content-products-items-scope">
                                    <?php while( have_rows('tags_list') ) : the_row(); ?>
                                        <p class="<?php echo (get_row_index() == 1) ? 'show open' : 'none'; ?>" data-second-tab="<?php echo get_row_index(); ?>">
                                            <?php the_sub_field('tag_content'); ?>
                                        </p>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif; ?>

                        </div>
                    <?php $ti++; endwhile; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="arrows arrows--mobile-tab">
            <button type="button" class="arrows-item arrows-item--prev arrows-item-mobile-tab--prev">
                <svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/svg/sprite.svg#sliderLargeArrow"></use></svg>
            </button>
            <button type="button" class="arrows-item arrows-item--next arrows-item-mobile-tab--next">
                <svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/svg/sprite.svg#sliderLargeArrow"></use></svg>
            </button>
        </div>
    </div>
</aside>

<?php get_footer(); ?>