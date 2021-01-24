<?php
session_start();
require_once (__DIR__ . "/../../scripts/php/useful_functions.php");
require_once (__DIR__ . "/../../scripts/php/database.php");

$db_connection = db_connect();
$links = array();
$links = checkSession();

$page = file_get_contents(__DIR__ . "/../html/ricette.html");
$header = file_get_contents(__DIR__ . "/../html/components/header.html");
$current = '<li class="current" aria-current="page"><a href="ricette">Scopri le ricette</a></li>';
$header = str_replace('<li><a href="ricette">Scopri le ricette</a></li>', $current, $header);
$replacements = [
  "<placeholder_head_default_tags />" => file_get_contents(__DIR__ . "/../html/components/head_default_tags.html"),
  "<placeholder_header />" => $header,
  "<placeholder_footer />" => file_get_contents(__DIR__ . "/../html/components/footer.html"),
  "<placeholder_ricette_cards />" => html_ricette_cards(),
  "<placeholder_ricette_aggiungi_link />" => ricette_aggiungi_link(),
  "<placeholder_ricette_check_login />" => replace_check_login()
];

db_close($db_connection);
$replacements = addReplacements($replacements, $links);
echo replace($page, $replacements);


// Ritorna il codice html con tutte le ricette
function html_ricette_cards() {
  $ricette_cards = "";

  $sql = "SELECT nome from ricette";
  $result = $GLOBALS["db_connection"]->query($sql);
  while($row = $result->fetch_assoc()) {
    $ricette_cards .= "\n" . html_ricette_card($row["nome"]);
  }
  return $ricette_cards;
}

// Ritorna il codice html di una singola ricetta
function html_ricette_card($ricetta_nome) {
  $ricette_card = file_get_contents(__DIR__ . "/../html/components/ricette_card.html");

  $sql = "SELECT utenti.username AS autore,
                 ricette.tipo AS tipo,
                 ricette.vegetariana AS vegetariana,
                 ricette.ingredienti AS ingredienti,
                 ricette.nome_immagine AS immagine,
                 ricette.id AS id
          FROM ricette JOIN utenti ON ricette.autore=utenti.id
          WHERE ricette.nome=\"$ricetta_nome\"";
  $result = $GLOBALS["db_connection"]->query($sql);
  $row = $result->fetch_assoc();
  $ricetta_autore = $row["autore"];
  if($row["autore"] == "admin") {
    $ricetta_autore = "CLASSICA";
  }
  $ricetta_tipo = $row["tipo"];
  $ricetta_immagine = $row["immagine"];
  $ricetta_id = $row["id"];

  $ricetta_ingredienti = "";
  $ingredienti = $row["ingredienti"];
  $array_ingredienti = explode(',', $ingredienti);
  foreach ($array_ingredienti as $ingrediente) {
    $ingrediente = trim($ingrediente);
    $html_ingrediente = file_get_contents(__DIR__ . "/../html/components/ricette_card_ingrediente.html");
    $html_ingrediente = str_replace("<placeholder_sql_ricetta_ingrediente />", $ingrediente, $html_ingrediente);
    $ricetta_ingredienti .= $html_ingrediente . "\n";
  }

  $ricetta_vegetariana = "";
  if ($row["vegetariana"] == true) {
    $ricetta_vegetariana = file_get_contents(__DIR__ . "/../html/components/ricette_card_tag_vegetariana.html");
  }

  $sql = "SELECT COUNT(*) AS n_likes
          FROM likes JOIN ricette ON likes.ricetta=ricette.id
          WHERE ricette.nome=\"$ricetta_nome\"";
  $result = $GLOBALS["db_connection"]->query($sql);
  $row = $result->fetch_assoc();
  $ricetta_likes = $row["n_likes"];


  $replacements = [
    "<placeholder_sql_ricetta_nome />" => $ricetta_nome,
    "<placeholder_sql_ricetta_autore />" => $ricetta_autore,
    "<placeholder_sql_ricetta_tipo />" => $ricetta_tipo,
    "<placeholder_sql_ricetta_vegetariana_tag />" => $ricetta_vegetariana,
    "<placeholder_sql_ricetta_ingredienti />" => $ricetta_ingredienti,
    "<placeholder_sql_likes />" => $ricetta_likes,
    "<placeholder_sql_ricetta_immagine />" => $ricetta_immagine,
    "<placeholder_sql_ricetta_id />" => $ricetta_id
  ];
  return replace($ricette_card, $replacements);;
}

function ricette_aggiungi_link() {
  if(isset($_SESSION['usid'])) {
    $link = "ricetta-aggiungi";
  } else {
    $link = "login";
  }
  return $link;
}

function replace_check_login() {
  if (!isset($_SESSION['usid'])) {
    return "<strong>(devi aver effettuato il login)</strong>";
  }
  return "";
}
?>
