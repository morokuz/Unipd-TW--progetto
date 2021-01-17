<?php

require_once (__DIR__ . "/../../scripts/php/database.php");
require_once (__DIR__ . "/../../scripts/php/useful_functions.php");
$page = file_get_contents(__DIR__ . "/../html/login.html");

$finalmsg = '' ; $username = '' ; $password = '';

$connection = db_connect();

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  if(loginUser($connection, $username , $password)) {
    $finalmsg = '<p id="fnlmsg" class="correct" tabindex="1">Sei acceduto correttamente! </br> Verrai riportato nella home fra pochi secondi.</p>';
    header("refresh:5;url=home.php" );
  } else {
    $finalmsg = '<p id="fnlmsg" class="errore" tabindex="1">Utente non trovato. </br> Controlla di aver inserito i dati corretti.</p>';
    header("location: login.php");
  }
}

$replacements = [
  "<placeholder_head_default_tags />" => file_get_contents(__DIR__ . "/../html/components/head_default_tags.html"),
  "<placeholder_header />" => file_get_contents(__DIR__ . "/../html/components/header.html"),
  "<placeholder_footer />" => file_get_contents(__DIR__ . "/../html/components/footer.html"),
  "<placeholder_breadcrumbs />" => file_get_contents(__DIR__ . "/../html/components/breadcrumbs.html"),
  "<placeholder_nav />" => file_get_contents(__DIR__ . "/../html/components/nav.html"),
  "<messaggioFinale />" => $finalmsg
];
db_close($connection);
echo replace($page, $replacements);
