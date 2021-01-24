<?php
session_start();

require_once(__DIR__ . "/../../scripts/php/database.php");
require_once(__DIR__ . "/../../scripts/php/useful_functions.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $db_connection = db_connect();

  if (check_user_owner()) {
    ricetta_remove_img();
    ricetta_remove();
  }
  back_to_ricette();
}


// Rimuove l'immagine della ricetta, a meno che non sia quella di default
function ricetta_remove_img() {
  $img_nome = $_SESSION['img_nome'];
  unset($_SESSION['img_nome']);
  if ($img_nome !=  "default.jpg") {
    unlink("../../imgs/ricette/" . $img_nome);
  }
}

// rimuove la ricetta dal database
function ricetta_remove() {
  if (isset($_SESSION['id_ricetta'])) {
    $ricetta_id = $_SESSION['id_ricetta'];
    unset($_SESSION['id_ricetta']);
    
    $sql = "DELETE FROM ricette WHERE id=$ricetta_id";
    $GLOBALS["db_connection"]->query($sql);
  }
}

// Termina la rimozione e ritorna alla pagina delle ricette
function back_to_ricette() {
  db_close($GLOBALS["db_connection"]);
  header('Location: ../../ricette');
  exit();
}
