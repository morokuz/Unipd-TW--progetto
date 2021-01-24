<?php
function db_connect() {
  // $servername = "localhost";
  // $username = "root";
  // $password = "";
  // $db = "test";

  /* $servername = "localhost";
  $username = "testuser";
  $password = "pw";
  $db = "test"; */

  $servername = "192.168.178.144:3306";
  $username = "root";
  $password = "admin";
  $db = "test_pizza";

  $connection = mysqli_connect($servername, $username, $password,$db);
  if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
  }
  return $connection;
}

function db_close($connection) {
  $connection->close();
}
?>