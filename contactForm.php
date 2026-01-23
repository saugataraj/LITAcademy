<?php
session_start();


$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['mobile'];
$subjectSel = $_POST['subject'];
//$msg = $_POST['msg'];


	$to = 'webadmin@lit.academy';
	
	$subject = 'LIT Academy';
	$from_email= "From: " . $email . ""; 
	$headers = "From: " . $email . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
	$message = "<html><body>";
	$message .="<table align=left width=100% cellpadding=0 cellspacing=3 bgcolor=#fff><tr><td><h2>" . $subject. "</h2></td></tr></table>
	<table width=100% cellpadding=5 cellspacing=3 border=0 bgcolor=#fff>
	<tr><td bgcolor=#eeeeee style=text-transform:uppercase;><strong>Name :</strong></td><td bgcolor=#eeeeee>". $name ."</td></tr>
	<tr><td bgcolor=#eeeeee style=text-transform:uppercase;><strong>E-mail :</strong></td><td bgcolor=#eeeeee>". $email ."</td></tr>
	<tr><td bgcolor=#eeeeee style=text-transform:uppercase;><strong>Mobile :</strong></td><td bgcolor=#eeeeee>". $phone ."</td></tr>
	<tr><td bgcolor=#eeeeee style=text-transform:uppercase;><strong>Subject :</strong></td><td bgcolor=#eeeeee>". $subjectSel ."</td></tr>";
	$message .= "</table>";
	$message .= "</html></body>";

	if(mail($to, $subject, $message, $headers)){
		//echo $message;
		header("Location: http://lit.academy/");
	}else{
		//echo $message;
		header("Location: http://lit.academy/");
	}


?>
