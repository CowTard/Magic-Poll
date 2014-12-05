<?php

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$to = 'ei12109@fe.up.pt';
		$from = $_POST['email']; // this is the sender's Email address
    	$first_name = $_POST['name'];
	    $subject = "[MAGICPOLL] " . $_POST['subject'];
	    $subject2 = "[MAGICPOLL] A copy of your message that was sent to us.";
	    $message = $first_name . " wrote the following:" . "\n\n" . $_POST['message'];
	    $message2 = "Here is a copy of your message " . $first_name . "\n\n" . $_POST['message'];


	    $headers = "From:" . $from;
    	$headers2 = "From:" . $to;
    	mail($to,$subject,$message,$headers);
    	mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
    	echo "SUCESS";
	}
	else echo "FAIL";

?>