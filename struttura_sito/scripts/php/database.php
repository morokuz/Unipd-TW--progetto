<?php
function db_connect() {
  // TODO: i parametri della funzione variano in base al ambiente in cui sono eseguiti. Andranno modificati correttamente quando installati sul server tecweb
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
  
// Test query: Stampa tutto dalla tabella "ricette"
function db_unsafee_query_test ($connection) {
  $sql = "SELECT * FROM ricette";
  $result = $connection->query($sql);
  while($row = $result->fetch_assoc()) {
    foreach($row as $key => $value) {
      echo "$key = $value" . "<br>";
    }
    echo "<br>--- <br><br>";
  }
}

// Test query: Stampa da "ricette" la ricetta con un determinato id
function db_safe_query_test ($connection, $id_ricetta) {
  $query = $connection->prepare('SELECT * FROM ricette WHERE id=?');
  $query->bind_param('i', $id_ricetta); // 'i': type => 'integer'
  $query->execute();
  $result = $query->get_result();
  while ($row = $result->fetch_assoc()) {
    foreach($row as $key => $value) {
      echo "$key = $value" . "<br>";
    }
    echo "<br>--- <br><br>";
  }
}
?>