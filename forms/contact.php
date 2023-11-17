<?php
  $receiving_email_address = 'ahmetyuksel@ahmetyuksel.com';

  if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include( $php_email_form );
  } else {
    die( 'Unable to load the "PHP Email Form" Library!');
  }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;
  
  $contact->to = $receiving_email_address;
  $contact->from_name = $_POST['name'];
  $contact->from_email = $_POST['email'];
  $contact->subject = $_POST['subject'];

  $contact->add_message( $_POST['name'], 'From');
  $contact->add_message( $_POST['email'], 'Email');
  $contact->add_message( $_POST['message'], 'Message', 10);

  $mail_subject = $contact->subject;
  $mail_message = $contact->message;
  $mail_headers = "From: " . $contact->from_name . " <" . $contact->from_email . ">\r\n";
  $mail_headers .= "Reply-To: " . $contact->from_email . "\r\n";
  $mail_headers .= "Content-Type: text/plain;charset=utf-8\r\n";

  $mail_sent = mail($contact->to, $mail_subject, $mail_message, $mail_headers);

  echo json_encode(array('success' => $mail_sent));
?>
