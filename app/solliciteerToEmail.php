<?php
if(!isset($_POST['submit']))
{
	//This page should not be accessed directly. Need to submit the form.
	echo "Fout; je moet het formulier verzenden!";
}
$naam = $_POST['naamSol'];
$voornaam = $_POST['voornaamSol'];
$adres = $_POST['adresSol'];
$telefoon = $_POST['telefoonSol'];
$gsm = $_POST['gsmSol'];
$visitor_email = $_POST['emailSol'];
$som = $_POST['somInschrijven'];
$welkeDagen = nl2br(implode(',', $_POST['check_dagen']));
$opmerkingen = $_POST['opmerkingenSol'];

//Validate first
if(empty($name)||empty($visitor_email)||empty($adres)) 
{
    echo "Naam, voornaam, adres, en email verplicht!";
    exit;
}

if(IsInjected($visitor_email))
{
    echo "Geef een juiste E-mail in!";
    exit;
}

// aanmaken van message var met alle gegevens van de aanvraag

// nog toevoegen ferqentie
$message = "Naam: ".$naam." ".$voornaam."\nAdres: ".$adres."\nTelefoon: ".$telefoon."\nGSM: ".$gsm.
            "\nEmail: ".$visitor_email."\n Waar ken ik som van: ".$som."\nOp welke dagen: ".$welkeDagen. 
            "\nOpmerkingen: ".$opmerkingen; 

//mail versturen 
$email_from = 'info@serviceopmaat.be';//<== update the email address
$email_subject = "Nieuw ingevuld SollicitatieFormulier!";
$email_body = "Je heb een nieuwe Sollicitatie van gebruiker ". $name."\n".
    "Hier is zijn de gegevens:\n".$message;
    
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