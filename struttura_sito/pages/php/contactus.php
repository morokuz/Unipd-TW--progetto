<?php
session_start();

require_once (__DIR__ . "/../../scripts/php/useful_functions.php");

$page = file_get_contents(__DIR__ . "/../html/contactus.html");
$links = array();

$links = checkSession();

if(isset($_POST['submit'])) {
  $name = $_POST['nome'];
  $email = $_POST['email'];
  $oggetto = $_POST['oggetto'];
  $messaggio = $_POST['messaggio'];

  // Sfortunatamente non abbiamo un dominio con cui testarne il funzionamento
  // Non si può utilizzare la propria email perche Gmail blocca le mail mandate con mail() di PHP
  // Una possibile soluzione era l'utilizzo della libreria PHPMailer ma abbiamo deciso di non approfondire la questione
  $myemail = "";
  $mex = "Email da : " .$email;
  $text = "Di: " .$name. "\n\n" .$messaggio;
  mail($myemail, $oggetto, $txt , $mex);
  header("location: home.php");
}

$replacements = [
  "<placeholder_head_default_tags />" => file_get_contents(__DIR__ . "/../html/components/head_default_tags.html"),
  "<placeholder_header />" => file_get_contents(__DIR__ . "/../html/components/header.html"),
  "<placeholder_log />" => $links[0],
  "<placeholder_reg />" => $links[1],
  "<placeholder_footer />" => file_get_contents(__DIR__ . "/../html/components/footer.html"),
  "<placeholder_breadcrumbs />" => file_get_contents(__DIR__ . "/../html/components/breadcrumbs.html")
];

echo replace($page, $replacements);
