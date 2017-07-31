<?php

/*
 * Contact us Process
 * 
 */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$value = array();	
	if ($_POST['name'] == '' || preg_match("/[_\.0-9a-zA-Z-\s]$/i", $_POST['name']) == false) {		
		$value['value']		= 0;
		$value['message']	= 'Please insert your name..';
	} else
	if ($_POST['email'] == '') {		
		$value['value']		= 0;
		$value['message']	= 'Please insert your email..';
	} else
	if (preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $_POST['email']) == false) {		
		$value['value']		= 0;
		$value['message']	= 'Please insert right email address..';
	} else if ($_POST['message'] == '' || preg_match("/[_\.0-9a-zA-Z-\s]$/i", $_POST['message']) == false) {		
		$value['value']		= 0;
		$value['message']	= 'Please insert your message..';
	} else {		
		$to       = $_POST['email'];
		$subject  = 'Thank you contacting me at '.$_SERVER["SERVER_NAME"].'';
		$message  = 'Dear '.$_POST['name'].', Thank you contacting me via my web : '.$_SERVER["SERVER_NAME"].'<br/>';
		$message .= 'I\'ll respond to your message about: '.$_POST['message'].', immedietly.';		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'Content-Transfer-Encoding: 8bit' . "\r\n";	
		$headers .= 'From: noreply@'.$_SERVER["SERVER_NAME"].'' . "\r\n" .
		'Reply-To: noreply@'.$_SERVER["SERVER_NAME"].'' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
		
		$to2       = 'defrian.yarfi@gmail.com';
		$subject2  = 'Someone contacting you from '.$_SERVER["SERVER_NAME"].'';
		$message2  = 'Name is : '.$_POST['name'].', Email is: '.$_POST['email'].'<br/>';
		$message2 .= 'The Message is : '.$_POST['message'];		
		$headers2  = 'MIME-Version: 1.0' . "\r\n";
		$headers2 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers2 .= 'Content-Transfer-Encoding: 8bit' . "\r\n";	
		$headers2 .= 'From: noreply@'.$_SERVER["SERVER_NAME"].'' . "\r\n" .
		'Reply-To: noreply@'.$_SERVER["SERVER_NAME"].'' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
				
		if (mail($to, $subject, $message, $headers) &&
				mail($to2, $subject2, $message2, $headers2)) {			
			$value['value']		= 1;
			$value['message']	= 'Thank you, I\'ll respond your message immedietly..';			
		}		
	}	
	usleep(200000);
	echo json_encode($value);	
	//exit;
}
?>
