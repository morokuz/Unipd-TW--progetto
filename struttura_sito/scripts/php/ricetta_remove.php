<?php
session_start();

require_once(__DIR__ . "/../../scripts/php/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $db_connection = db_connect();

  if (check_user_owner($db_connection)) {
    ricetta_remove_img();
    ricetta_remove($db_connection);
  }
  back_to_ricette($db_connection);
}



function check_user_owner(&$db_connection) {
  if (isset($_SESSION['usid']) && (is_admin() || is_owner($db_connection))) {
    return true;
  }
  return false;
}

function is_admin() {
  return $_SESSION['usid'] == 1;
}

function is_owner(&$db_connection) {
  return $_SESSION['usid'] == get_ricetta_owner_id($db_connection);
}


function get_ricetta_owner_id(&$db_connection) {
  if (isset($_SESSION['id_autore'])) {
    $id_autore = $_SESSION['id_autore'];
    unset($_SESSION['ricetta_id']);
    return $id_autore;
  }
  return 0;
}

function ricetta_remove_img() {
  $img_nome = $_SESSION['img_nome'];
  unset($_SESSION['img_nome']);
  if ($img_nome !=  "default.jpg") {
    unlink("../../imgs/ricette/" . $img_nome);
  }
}

function ricetta_remove(&$db_connection) {
  if (isset($_SESSION['id_ricetta'])) {
    $ricetta_id = $_SESSION['id_ricetta'];
    unset($_SESSION['id_ricetta']);
    
    $sql = "DELETE FROM ricette WHERE id=$ricetta_id";
    if ($db_connection->query($sql) === TRUE) {
      echo "DELETED";
    } else {
      echo "ERRORE: " . $db_connection->error;
    }
  }
}

function back_to_ricette(&$db_connection) {
  db_close($db_connection);
  header('Location: ../../ricette');
  exit();
}
