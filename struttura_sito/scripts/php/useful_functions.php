<?php

function replace($string_input, $array_replacements) {
  foreach ($array_replacements as $key => $value) {
    $string_input = str_replace($key, $value, $string_input);
  }
  return $string_input;
}

function checkSession() {
  if(isset($_SESSION['usid'])) {
    $links[0] = '<li><a href="logout" role="button">Ciao ' . $_SESSION["usname"] . '! Effettua il logout</a></li>';
  } else {
    $links[0] = '<li><a href="login">Accedi</a></li>';
    $links[1] = '<li><a href="signup">Registrati</a></li>';
  }
  return $links;
}

function addReplacements($replacements, $links) {
  if(count($links) == 2){
    $replacements += ["<placeholder_log />" => $links[0]];
    $replacements += ["<placeholder_reg />" => $links[1]];
  } else {
    $replacements += ["<placeholder_log />" => $links[0]];
  }
  return $replacements;
}

function checkEmail($msg, $email) {
  if(empty($email)) {
    $msg = '<p id="err2" class="errore" tabindex="0">L\'email non può essere vuota</p>';
  } else if (!preg_match("/^(([^<>()\[\]\\.,;:\s@\"]+(\.[^<>()\[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/", $email)) {
    $msg = '<p id="err2" class="errore" tabindex="0">Email non valida, ricontrollala</p>';
  } else {
    $msg = '<p id="err2" class="correct" tabindex="0">Email valida</p>';
  }
  return $msg;
}

function alreadyTaken ($conn , $username) {
  $sql="SELECT * FROM utenti WHERE username = ?;";
  $stmt =mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt, $sql)){
    exit();
  }
  mysqli_stmt_bind_param($stmt, "s" , $username);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);
  if($row = mysqli_fetch_assoc($resultData)){
    return $row;
  } else {
    return false;
  }
  mysqli_stmt_close($stmt);
}

function createUser ($conn , $username, $email, $password) {
  $sql = "INSERT INTO utenti (username, email, pword) VALUES (?,?,?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: signup.php?error=stmtfailed");
    exit();
  }

  $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

  mysqli_stmt_bind_param($stmt, "sss", $username , $email, $hashedPwd);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
}


function loginUser($conn , $username , $password) {
  $usExists = alreadyTaken ($conn , $username);
  if($usExists != false){
    $pwdHashed = $usExists["pword"];
    $checkPwd = password_verify($password, $pwdHashed);
    if(!$checkPwd){
      return false;
    } else {
      session_start();
      $_SESSION["usid"] = $usExists["id"];
      $_SESSION["usname"] = $usExists["username"];
      return true;
    }
  } else {
    return false;
  }
}



// Funzioni per rimuovere ricetta
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
