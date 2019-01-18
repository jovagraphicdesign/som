<?php
if(!isset($_POST['submit']))
{
	//This page should not be accessed directly. Need to submit the form.
	echo "Fout; je moet het formulier verzenden!";
}
$name = $_POST['nameEmail'];
$telefoonEmail = $_POST['telefoonEmail'];
$visitor_email = $_POST['emailEmail'];
$message = $_POST['berichtEmail'];

//Validate first
if(empty($name)||empty($visitor_email)||empty($telefoonEmail)) 
{
    echo "Naam, telefoon en email verplicht!";
    exit;
}

if(IsInjected($visitor_email))
{
    echo "Geef een juiste E-mail in!";
    exit;
}

$email_from = 'info@serviceopmaat.be';//<== update the email address
$email_subject = "Nieuw ingevuld contactFormulier!";
$email_body = "Je heb een nieuw bericht van gebruiker $name.\n".
    "Hier is het bericht:\n $message".
    
$to = "info@serviceopmaat.be";//<== update the email address
$headers = "Van: $email_from \r\n";
$headers .= "Antwoord-Naar: $visitor_email \r\n";
//Send the email!
mail($to,$email_subject,$email_body,$headers);
//done. redirect to thank-you page.
header('Location: thank-you.html');


// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
   
?> 