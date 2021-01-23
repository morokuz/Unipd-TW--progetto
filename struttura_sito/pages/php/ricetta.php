<?php
session_start();
require_once(__DIR__ . "/../../scripts/php/useful_functions.php");
require_once(__DIR__ . "/../../scripts/php/database.php");

$db_connection = db_connect();
$links = array();
$links = checkSession();

$ricetta_id = $_GET['id'];
$_SESSION['id_ricetta'] = $ricetta_id;

$sql = "SELECT utenti.username AS autore,
               ricette.nome AS nome,
               ricette.tipo AS tipo,
               ricette.vegetariana AS vegetariana,
               ricette.informazioni AS informazioni,
               ricette.ingredienti AS ingredienti,
               ricette.nome_immagine AS immagine
        FROM ricette JOIN utenti ON ricette.autore=utenti.id
        WHERE ricette.id=\"$ricetta_id\"";
$result = $GLOBALS["db_connection"]->query($sql);
$row = $result->fetch_assoc();
$ricetta_nome = $row["nome"];
$ricetta_autore = $row["autore"];
if ($row["autore"] == "admin") {
  $ricetta_autore = "CLASSICA";
}
$ricetta_tipo = $row["tipo"];
$ricetta_informazioni = $row["informazioni"];
$ricetta_immagine = $row["immagine"];

$ricetta_vegetariana = "";
if ($row["vegetariana"] == true) {
  $ricetta_vegetariana = file_get_contents(__DIR__ . "/../html/components/ricette_card_tag_vegetariana.html");
}

$ricetta_ingredienti = "";
$ingredienti = $row["ingredienti"];
$array_ingredienti = explode(',', $ingredienti);
foreach ($array_ingredienti as $ingrediente) {
  $ingrediente = trim($ingrediente);
  $html_ingrediente = file_get_contents(__DIR__ . "/../html/components/ricetta_ingrediente.html");
  $html_ingrediente = str_replace("<placeholder_sql_ricetta_ingrediente />", $ingrediente, $html_ingrediente);
  $ricetta_ingredienti .= $html_ingrediente . "\n";
}

$sql = "SELECT COUNT(*) AS n_likes
        FROM likes JOIN ricette ON likes.ricetta=ricette.id
        WHERE ricette.id=\"$ricetta_id\"";
$result = $GLOBALS["db_connection"]->query($sql);
$row = $result->fetch_assoc();
$ricetta_likes = $row["n_likes"];

$ricetta_commenti = "";
$html_ricetta_commento_template = file_get_contents(__DIR__ . "/../html/components/ricetta_commento.html");
$sql = "SELECT commenti.contenuto AS contenuto,
               commenti.data_ora AS data_ora,
               utenti.username AS username
        FROM commenti JOIN utenti ON commenti.autore=utenti.id
        WHERE commenti.ricetta=\"$ricetta_id\"
        ORDER BY data_ora DESC";
$result = $GLOBALS["db_connection"]->query($sql);

while ($row = $result->fetch_assoc()) {
  $replacements_commento = [
    "<placeholder_sql_ricetta_commento_username />" => $row["username"],
    "<placeholder_sql_ricetta_commento_dataora />" => $row["data_ora"],
    "<placeholder_sql_ricetta_commento_contenuto />" => $row["contenuto"]
  ];
  $html_ricetta_commento = replace($html_ricetta_commento_template, $replacements_commento);
  $ricetta_commenti .= $html_ricetta_commento . "\n";
}

$page = file_get_contents(__DIR__ . "/../html/ricetta.html");
$header = file_get_contents(__DIR__ . "/../html/components/header.html");
$current = '<li class="current"><a href="ricette">Scopri i gusti</a></li>';
$header = str_replace('<li><a href="ricette">Scopri i gusti</a></li>', $current, $header);
$replacements = [
  "<placeholder_head_default_tags />" => file_get_contents(__DIR__ . "/../html/components/head_default_tags.html"),
  "<placeholder_header />" => $header,
  "<placeholder_footer />" => file_get_contents(__DIR__ . "/../html/components/footer.html"),
  "<placeholder_breadcrumbs />" => file_get_contents(__DIR__ . "/../html/components/breadcrumbs.html"),
  "<placeholder_sql_ricetta_nome />" => $ricetta_nome,
  "<placeholder_sql_ricetta_autore />" => $ricetta_autore,
  "<placeholder_sql_ricetta_tipo />" => $ricetta_tipo,
  "<placeholder_sql_ricetta_vegetariana_tag />" => $ricetta_vegetariana,
  "<placeholder_sql_ricetta_informazioni />" => $ricetta_informazioni,
  "<placeholder_sql_ricetta_ingredienti />" => $ricetta_ingredienti,
  "<placeholder_sql_ricetta_immagine />" => $ricetta_immagine,
  "<placeholder_sql_likes />" => $ricetta_likes,
  "<placeholder_sql_ricetta_commenti />" => $ricetta_commenti
];

$replacements = addReplacements($replacements, $links);

db_close($db_connection);

echo replace($page, $replacements);
