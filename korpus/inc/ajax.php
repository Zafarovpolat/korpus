<?php
// AJAX обработчик для отправки формы контактов

add_action('wp_ajax_send_mail', 'kp_send_mail_ajaxHandler');
add_action('wp_ajax_nopriv_send_mail', 'kp_send_mail_ajaxHandler');

function kp_send_mail_ajaxHandler() {
    // Получаем данные из POST
    $first_name = isset($_POST['first_name']) ? sanitize_text_field($_POST['first_name']) : '';
    $last_name  = isset($_POST['last_name']) ? sanitize_text_field($_POST['last_name']) : '';
    $email      = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $phone      = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    $message    = isset($_POST['message']) ? sanitize_textarea_field($_POST['message']) : '';
    $receive_emails = isset($_POST['receive_emails']) ? true : false;

    // Валидация - обязательные поля
    $errors = [];

    if (empty($first_name)) {
        $errors[] = 'First name is required';
    }
    if (empty($last_name)) {
        $errors[] = 'Last name is required';
    }
    if (empty($email) || !is_email($email)) {
        $errors[] = 'Valid email is required';
    }
    if (empty($phone)) {
        $errors[] = 'Phone is required';
    }
    if (empty($message)) {
        $errors[] = 'Message is required';
    }

    // Проверка галочек - на мобильных устройствах они могут быть не доступны
    // Поэтому делаем их необязательными, если запрос пришел с мобильного
    $is_mobile = wp_is_mobile();
    
    if (!$is_mobile) {
        // Для десктопа проверяем обязательные чекбоксы
        if (empty($_POST['policyCheckbox'])) {
            $errors[] = 'You must agree to the privacy policy';
        }
    }

    if (!empty($errors)) {
        wp_send_json_error([
            'message' => implode('; ', $errors),
            'status'  => 'error'
        ]);
    }

    // Формируем email
    $to = get_option('admin_email');
    $subject = sprintf(__('New contact form submission from %s %s', 'kp'), $first_name, $last_name);
    
    $body = sprintf(
        __('Name: %s %s<br>Email: %s<br>Phone: %s<br>Message: %s<br>Receive emails: %s',
            'kp'
        ),
        esc_html($first_name),
        esc_html($last_name),
        esc_html($email),
        esc_html($phone),
        nl2br(esc_html($message)),
        $receive_emails ? __('Yes', 'kp') : __('No', 'kp')
    );

    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        // На многих хостингах wp_mail() молча теряется, если From не принадлежит
        // домену сайта. Отправляем от служебного ящика на домене сайта,
        // ответы уходят клиенту через Reply-To.
        'From: ' . get_bloginfo('name') . ' <no-reply@' . preg_replace('/^www\./i', '', (string) wp_parse_url(home_url(), PHP_URL_HOST)) . '>',
        'Reply-To: ' . $email
    ];

    $sent = wp_mail($to, $subject, $body, $headers);

    if (!$sent) {
        error_log('[kp contact form] wp_mail() failed to send to ' . $to);
    }

    if ($sent) {
        wp_send_json_success([
            'message' => __('Thank you! Your message has been sent.', 'kp'),
            'status'  => 'success'
        ]);
    } else {
        wp_send_json_error([
            'message' => __('Error sending message. Please try again later.', 'kp'),
            'status'  => 'error'
        ]);
    }
}

// ---------------------------------------------------------------------------
// Доставка почты: если хостинг не настроен на отправку (wp_mail() возвращает
// true, но письма не доходят), включите SMTP без плагина — добавьте в wp-config.php:
//
//   define('KP_SMTP_HOST', 'smtp.yandex.ru');   // сервер провайдера почты
//   define('KP_SMTP_PORT', 465);                // 465 (SSL) или 587 (TLS)
//   define('KP_SMTP_SECURE', 'ssl');            // 'ssl' или 'tls'
//   define('KP_SMTP_USER', 'noreply@korpusprava.ru');
//   define('KP_SMTP_PASS', 'пароль_почты');
//
add_action('phpmailer_init', function ($phpmailer) {
    if (defined('KP_SMTP_HOST') && KP_SMTP_HOST) {
        $phpmailer->isSMTP();
        $phpmailer->Host       = KP_SMTP_HOST;
        $phpmailer->SMTPAuth   = true;
        $phpmailer->Port       = defined('KP_SMTP_PORT') ? KP_SMTP_PORT : 465;
        $phpmailer->SMTPSecure = defined('KP_SMTP_SECURE') ? KP_SMTP_SECURE : 'ssl';
        $phpmailer->Username   = defined('KP_SMTP_USER') ? KP_SMTP_USER : '';
        $phpmailer->Password   = defined('KP_SMTP_PASS') ? KP_SMTP_PASS : '';
        if (defined('KP_SMTP_FROM') && KP_SMTP_FROM) {
            $phpmailer->From   = KP_SMTP_FROM;
        }
    }
});
