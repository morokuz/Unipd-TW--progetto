<?php

require_once (__DIR__ . "/../../scripts/php/database.php");
require_once (__DIR__ . "/../../scripts/php/useful_functions.php");
$page = file_get_contents(__DIR__ . "/../html/login.html");
$header = file_get_contents(__DIR__ . "/../html/components/header.html");

$finalmsg = '' ; $username = '' ; $password = '';
$links = array();

$links = checkSession();
$connection = db_connect();

$header = str_replace("<placeholder_log />" , $links[0] , $header);
$header = str_replace("<placeholder_reg />" , $links[1] , $header);
$current = '<li class="current"><a href="login">Accedi</a></li>';
$header = str_replace('<li><a href="login">Accedi</a></li>', $current, $header);


if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  if(loginUser($connection, $username , $password)) {
    $finalmsg = '<p id="fnlmsg" class="correct" tabindex="1">Sei acceduto correttamente! Verrai riportato nella home fra pochi secondi.</p>';
    header("refresh:5;url=." );
  } else {
    $finalmsg = '<p id="fnlmsg" class="errore" tabindex="1">Utente non trovato. Controlla di aver inserito i dati corretti.</p>';
  }
}

$replacements = [
  "<placeholder_head_default_tags />" => file_get_contents(__DIR__ . "/../html/components/head_default_tags.html"),
  "<placeholder_header />" => $header,
  "<placeholder_footer />" => file_get_contents(__DIR__ . "/../html/components/footer.html"),
  "<placeholder_breadcrumbs />" => file_get_contents(__DIR__ . "/../html/components/breadcrumbs.html"),
  "<messaggioFinale />" => $finalmsg,
  "<placeholder_log />" => $links[0],
  "<placeholder_reg />" => $links[1]
];

db_close($connection);
echo replace($page, $replacements);
