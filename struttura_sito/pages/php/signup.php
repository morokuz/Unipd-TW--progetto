<?php

require_once (__DIR__ . "/../../scripts/php/database.php");
require_once (__DIR__ . "/../../scripts/php/useful_functions.php");

$page = file_get_contents(__DIR__ . "/../html/signup.html");
$header = file_get_contents(__DIR__ . "/../html/components/header.html");

$msg = array('username' => '', 'email' => '', 'password' => '', 'passwordRpt' => '');
$finalmsg = '' ; $username = '' ; $email = ''; $password = ''; $passwordRpt = '';
$links = array();

$links = checkSession();
$header = str_replace("<placeholder_log />" , $links[0] , $header);
$header = str_replace("<placeholder_reg />" , $links[1] , $header);
$current = '<li class="current">Registrati</li>';
$header = str_replace('<li><a href="signup">Registrati</a></li>', $current, $header);

$connection = db_connect();
if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $passwordRpt = $_POST['conferma_password'];

  if(empty($username)) {
    $msg['username'] = '<p class="errore" tabindex="0">Lo username non può essere vuoto</p>';
  } else if (strlen($username) < 4) {
    $msg['username'] = '<p class="errore" tabindex="0">Lo username deve avere più di 4 caratteri</p>';
  } else if (strlen($username) > 20) {
    $msg['username'] = '<p class="errore" tabindex="0">Lo username deve avere meno di 20 caratteri</p>';
  } else if (preg_match("/[`!@#$%^&*()_+\-=\[\]{};':\\|,.<>\/?~]/" , $username)) {
    $msg['username'] = '<p class="errore" tabindex="0">Lo username può contenere SOLO caratteri o numeri</p>';
  } else if (alreadyTaken($connection , $username) === false){
    $msg['username'] = '<p class="correct" tabindex="0">Nome valido</p>';
  } else {
    $msg['username'] = '<p class="errore" tabindex="0">Username già utilizzato da un altro utente</p>';
  }

  if(empty($email)) {
    $msg['email'] = '<p class="errore" tabindex="0">L\'email non può essere vuota</p>';
  } else if (!preg_match("/^(([^<>()\[\]\\.,;:\s@\"]+(\.[^<>()\[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/", $email)) {
    $msg['email'] = '<p class="errore" tabindex="0">Email non valida, ricontrollala</p>';
  } else {
    $msg['email'] = '<p class="correct" tabindex="0">Email valida</p>';
  }

  if(empty($password)) {
    $msg['password'] = '<p class="errore" tabindex="0">Password mancante</p>';
  } else if(strlen($password) < 5) {
    $msg['password'] = '<p class="errore" tabindex="0">Password con meno di 5 caratteri</p>';
  } else if(strlen($password) > 15) {
    $msg['password'] = '<p class="errore" tabindex="0">Password più lunga di 15 caratteri</p>';
  } else if (!preg_match("/(?=.*[0-9])/", $password)) {
    $msg['password'] = '<p class="errore" tabindex="0">Manca il numero obbligatorio</p>';
  } else if(!preg_match("/(?=.*[A-Z])/", $password)) {
    $msg['password'] = '<p class="errore" tabindex="0">Manca la lettera maiuscola obbligatoria</p>';
  } else {
    $msg['password'] = '<p class="correct" tabindex="0">Password valida</p>';
  }

  if(empty($password)) {
    $msg['passwordRpt'] = '';
  } else if(empty($passwordRpt)) {
    $msg['passwordRpt'] = '<p class="errore" tabindex="0">Devi reinserire la password</p>';
  } else if ($passwordRpt != $password) {
    $msg['passwordRpt'] = '<p class="errore" tabindex="0">Le password inserite non coincidono</p>';
  } else {
    $msg['passwordRpt'] = '<p class="correct" tabindex="0">Le password coincidono</p>';
  }

  if($msg['username'] == '<p class="correct" tabindex="0">Nome valido</p>'
    && $msg['email'] == '<p class="correct" tabindex="0">Email valida</p>'
    && $msg['password'] == '<p class="correct" tabindex="0">Password valida</p>'
    && $msg['passwordRpt'] == '<p class="correct" tabindex="0">Le password coincidono</p>') {
    createUser ($connection , $username, $email, $password);
    $finalmsg = '<p id="fnlmsg" class="correct" tabindex="1">Ti sei registrato correttamente! <a href="login">Accedi</a> ora!</p>';
  } else {
    $finalmsg = '<p id="fnlmsg" class="errore" tabindex="1">Ci sono degli errori! Ricontrolla i campi</p>';
  }
}

$replacements = [
  "<placeholder_head_default_tags />" => file_get_contents(__DIR__ . "/../html/components/head_default_tags.html"),
  "<placeholder_header />" => $header,
  "<placeholder_footer />" => file_get_contents(__DIR__ . "/../html/components/footer.html"),
  "<placeholder_breadcrumbs />" => file_get_contents(__DIR__ . "/../html/components/breadcrumbs.html"),
  "<messaggioUsername />" => $msg['username'] ,
  "<messaggioEmail />" => $msg['email'] ,
  "<messaggioPassword />" => $msg['password'] ,
  "<messaggioPasswordRpt />" => $msg['passwordRpt'] ,
  "<messaggioFinale />" => $finalmsg ,
  "<valoreUsername />" => $username ,
  "<valoreEmail />" => $email ,
  "<valorePass />" => $password ,
  "<valorePassRpt />" => $passwordRpt
];
db_close($connection);

echo replace($page, $replacements);
