<?php

function replace($string_input, $array_replacements) {
  foreach ($array_replacements as $key => $value) {
    $string_input = str_replace($key, $value, $string_input);
  }
  return $string_input;
}

function checkSession() {
  if(isset($_SESSION['usid'])) {
    $links[0] = '<li><a href="./profile_page.php">Ciao ' . $_SESSION['usname'] . '</a></li>';
    $links[1] = '<li><a href="../../scripts/php/logout.php">Log out</a></li>';
  } else {
    $links[0] = '<li><a href="./signup.php">Registrati</a></li>';
    $links[1] = '<li><a href="./login.php">Accedi</a></li>';
  }
  return $links;
}

function alreadyTaken ($conn , $username) {
  $sql="SELECT * FROM utenti WHERE utenteName = ?;";
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
  $sql = "INSERT INTO utenti (utenteName, utenteEmail, utentePwd) VALUES (?,?,?);";
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
    $pwdHashed = $usExists["utentePwd"];
    $checkPwd = password_verify($password, $pwdHashed);
    if(!$checkPwd){
      return false;
    } else {
      session_start();
      $_SESSION["usid"] = $usExists["utenteId"];
      $_SESSION["usname"] = $usExists["utenteName"];
      return true;
    }
  } else {
    return false;
  }
}
