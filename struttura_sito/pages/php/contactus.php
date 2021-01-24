<?php
session_start();

require_once (__DIR__ . "/../../scripts/php/useful_functions.php");

$page = file_get_contents(__DIR__ . "/../html/contactus.html");
$header = file_get_contents(__DIR__ . "/../html/components/header.html");
$current = '<li class="current" aria-current="page"><a href="contatti">Contatti</a></li>';
$header = str_replace('<li><a href="contatti">Contatti</a></li>', $current, $header);
$msg = array('username' => '', 'email' => ''); $finalmsg = ''; $links = array();
$links = checkSession();

if(isset($_POST['submit'])) {
  $username = $_POST['nome'];
  $email = $_POST['email'];
  $oggetto = $_POST['oggetto'];
  $messaggio = $_POST['messaggio'];

  if(empty($username)) {
    $msg['username'] = '<p id="err1" class="errore" tabindex="0">Lo username non può essere vuoto</p>';
  } else if (strlen($username) < 4) {
    $msg['username'] = '<p id="err1" class="errore" tabindex="0">Lo username deve avere più di 4 caratteri</p>';
  } else if (strlen($username) > 20) {
    $msg['username'] = '<p id="err1" class="errore" tabindex="0">Lo username deve avere meno di 20 caratteri</p>';
  } else if (preg_match("/[`!@#$%^&*()_+\-=\[\]{};':\\|,.<>\/?~]/" , $username)) {
    $msg['username'] = '<p id="err1" class="errore" tabindex="0">Lo username può contenere SOLO caratteri o numeri</p>';
  } else {
    $msg['username'] = '<p id="err1" class="correct" tabindex="0">Nome valido</p>';
  }

  $msg['email'] = checkEmail($msg['email'], $email);

  if($msg['username'] == '<p id="err1" class="correct" tabindex="0">Nome valido</p>'
    && $msg['email'] == '<p id="err2" class="correct" tabindex="0">Email valida</p>') {
      $myemail = "";
      $mex = "Email da : " .$email;
      $text = "Di: " .$username. "\n\n" .$messaggio;
      //mail($myemail, $oggetto, $text);
      // Sfortunatamente non abbiamo un dominio con cui testarne il funzionamento
      // Non si può utilizzare la propria email perche Gmail blocca le mail mandate con mail() di PHP
      // Una possibile soluzione era l'utilizzo della libreria PHPMailer ma abbiamo deciso di non approfondire la questione
      $finalmsg = '<p class="correct" tabindex="1">Email inviata correttamente! Verrai riportato alla home fra pochi secondi</p>';
      header("refresh:5;url=." );
    } else {
      $finalmsg = '<p class="errore" tabindex="1">Ci sono degli errori! Ricontrolla i campi</p>';
    }
}

$replacements = [
  "<placeholder_head_default_tags />" => file_get_contents(__DIR__ . "/../html/components/head_default_tags.html"),
  "<placeholder_header />" => $header,
  "<placeholder_footer />" => file_get_contents(__DIR__ . "/../html/components/footer.html"),
  "<messaggioUsername />" => $msg['username'],
  "<messaggioEmail />" => $msg['email'],
  "<messaggioFinale />" => $finalmsg
];

$replacements = addReplacements($replacements, $links);
echo replace($page, $replacements);
