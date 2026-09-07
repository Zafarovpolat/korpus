<?php
function send_mail_func(){	
	$admin_email  = 'russia@korpusprava.com';
	$form_subject = 'Letter from Korpus Prava';
	$project_name = 'Korpus Prava';

	$message .= "<tr>
<td style='padding: 10px; border: #e9e9e9 1px solid;'><b>Name: </b></td>
<td style='padding: 10px; border: #e9e9e9 1px solid;'>".$_POST["first_name"]." ".$_POST["last_name"]."</td>
</tr>";
	$message .= "<tr style='background-color: #f8f8f8;'>
<td style='padding: 10px; border: #e9e9e9 1px solid;'><b>Email: </b></td>
<td style='padding: 10px; border: #e9e9e9 1px solid;'>".$_POST["email"]."</td>
</tr>";
	$message .= "<tr>
<td style='padding: 10px; border: #e9e9e9 1px solid;'><b>Phone: </b></td>
<td style='padding: 10px; border: #e9e9e9 1px solid;'>".$_POST["phone"]."</td>
</tr>";
	$message .= "<tr style='background-color: #f8f8f8;'>
<td style='padding: 10px; border: #e9e9e9 1px solid;'><b>Message: </b></td>
<td style='padding: 10px; border: #e9e9e9 1px solid;'>".$_POST["message"]."</td>
</tr>";
	$message .= "<tr>
<td style='padding: 10px; border: #e9e9e9 1px solid;'><b>Receive e-mails?: </b></td>
<td style='padding: 10px; border: #e9e9e9 1px solid;'>".($_POST["receive_emails"] ? 'Yes' : 'No')."</td>
</tr>";




	$message = "<table style='width: 100%;'>".$message."</table>";


	$headers = "MIME-Version: 1.0" . PHP_EOL .
		"Content-Type: text/html; charset=utf-8" . PHP_EOL .
		'From: '.$project_name.' <'.$admin_email.'>' . PHP_EOL .
		'Reply-To: '.$admin_email.'' . PHP_EOL;

	mail($admin_email, $form_subject, $message, $headers );


	wp_die(); 
}
add_action('wp_ajax_send_mail', 'send_mail_func'); 
add_action('wp_ajax_nopriv_send_mail', 'send_mail_func'); 
?>