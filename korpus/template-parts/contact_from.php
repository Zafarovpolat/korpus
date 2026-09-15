<?php
$nonce = wp_create_nonce('contact_form_nonce');

// Уникальный префикс ID для каждого экземпляра формы.
// Форма выводится дважды на странице Contacts (десктоп data-tab и мобильный data-mobile-tab),
// дубли ID ломали <label for="...">: клик по чекбоксу в мобильном табе
// переключал скрытый чекбокс десктопной копии.
$uid = function_exists('wp_unique_id') ? wp_unique_id('kp-form-') : 'kp-form-' . uniqid();
?>
<form id="<?php echo esc_attr($uid); ?>" class="contact-form__wrapper-form" action="">
    <input type="hidden" name="security" value="<?php echo esc_attr($nonce); ?>">
	<header>
		<div class="g-input"><input autocomplete="off" type="text" name="first_name" data-validate-field="name" placeholder="<?php _e('First name', 'kp'); ?>" required></div>
		<div class="g-input"><input autocomplete="off" type="text" name="last_name" data-validate-field="surname" placeholder="<?php _e('Last name', 'kp'); ?>" required> </div>
		<div class="g-input"><input autocomplete="off" type="email" name="email" data-validate-field="mail" placeholder="<?php _e('E-mail', 'kp'); ?>" required></div>
		<div class="g-input"><input autocomplete="off" type="tel" name="phone" data-validate-field="tel" placeholder="<?php _e('Phone', 'kp'); ?>" required></div>
	</header>

	<div class="g-input"><input autocomplete="off" type="text" name="message" data-validate-field="message" placeholder="<?php _e('Your message', 'kp'); ?>" required></div>

	<footer>
		<div class="contact-form__wrapper-form-policy contact-form__wrapper-form-policy--policy">
			<input id="<?php echo esc_attr($uid); ?>-policy" type="checkbox" name="policyCheckbox" data-validate-field="checkbox">
			<label for="<?php echo esc_attr($uid); ?>-policy">
				<p><?php _e('I agree to the terms of processing of my data specified in', 'kp'); ?>
					<?php $privacy_page = function_exists('pll_get_post') ? pll_get_post(get_option('wp_page_for_privacy_policy'), pll_current_language()) : get_option('wp_page_for_privacy_policy'); ?>
					<a href="<?php echo esc_url(get_the_permalink($privacy_page)); ?>" target="_blank" rel="noopener">
						<?php echo get_the_title($privacy_page); ?>
					</a>
				</p>
			</label>
		</div>
		<div class="contact-form__wrapper-form-policy contact-form__wrapper-form-policy--send">
			<input id="<?php echo esc_attr($uid); ?>-useful" type="checkbox" name="receive_emails" data-validate-field="checkbox">
			<label for="<?php echo esc_attr($uid); ?>-useful">
				<p><?php _e('I want to receive some useful e-mails about legal news and change of legislation', 'kp'); ?></p>
			</label>
		</div>
		<button class="contact-form-submit g-btn" type="submit"><span><?php _e('Submit', 'kp'); ?></span></button>
	</footer>
</form>
