<?php 
require_once(__DIR__ . "/../../scripts/php/replace.php");
require_once(__DIR__ . "/../../scripts/php/database.php");

$db_connection = db_connect();

$page = file_get_contents(__DIR__ . "/../html/ricette.html");
$replacements = [
  "<placeholder_head_default_tags />" => file_get_contents(__DIR__ . "/../html/components/head_default_tags.html"),
  "<placeholder_header />" => file_get_contents(__DIR__ . "/../html/components/header.html"),
  "<placeholder_footer />" => file_get_contents(__DIR__ . "/../html/components/footer.html"),
  "<placeholder_breadcrumbs />" => file_get_contents(__DIR__ . "/../html/components/breadcrumbs.html"),
  "<placeholder_nav />" => file_get_contents(__DIR__ . "/../html/components/nav.html"),
  "<placeholder_ricette_cards />" => html_ricette_cards()
];

db_close($db_connection);

echo replace($page, $replacements);




function html_ricette_cards() {
  $ricette_cards = "";

  $sql = "SELECT nome from ricette";
  $result = $GLOBALS["db_connection"]->query($sql);
  while($row = $result->fetch_assoc()) {
    $ricette_cards .= "\n" . html_ricette_card($row["nome"]);
  }
  return $ricette_cards;
}

function html_ricette_card($ricetta_nome) {
  $ricette_card = file_get_contents(__DIR__ . "/../html/components/ricette_card.html");
  
  $sql = "SELECT utenti.username AS autore,
                 ricette.tipo AS tipo,
                 ricette.is_vegan AS is_vegan,
                 ricette.ingredienti AS ingredienti
          FROM ricette JOIN utenti ON ricette.autore=utenti.id
          WHERE ricette.nome=\"$ricetta_nome\"";
  $result = $GLOBALS["db_connection"]->query($sql);
  $row = $result->fetch_assoc();
  $ricetta_autore = $row["autore"];
  $ricetta_tipo = $row["tipo"];
  $ricetta_is_vegan = $row["is_vegan"];
  $ricetta_ingrediente = $row["ingredienti"];
  
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
    "<placeholder_sql_ricetta_is_vegan />" => $ricetta_is_vegan,
    "<placeholder_sql_ricetta_ingredienti />" => $ricetta_ingrediente,
    "<placeholder_sql_likes />" => $ricetta_likes
  ];
  return replace($ricette_card, $replacements);;
}

// TODO: test and commit working code
// TODO: update database script, so it only uses info you need. update names in this script
?>