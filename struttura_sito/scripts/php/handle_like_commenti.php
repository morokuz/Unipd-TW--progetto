<?php

require_once  "database.php";

session_start();
$conn = db_connect();

if (!key_exists("usid", $_SESSION)) {
	header("Location: login"); //alternativamente errore 401/ messaggio "devi registrarti"
	exit();
}

$id = $_SESSION['usid'];
$ricetta = $_SESSION['id_ricetta'];

if (isset($_POST['comment'])) {
  $contenuto = $_POST['comment'];
}

if (isset($_POST['like'])) {
	if (checkLike($id, $ricetta, $conn) == true) {
		$sql = "DELETE FROM likes WHERE likes.utente='$id' AND likes.ricetta='$ricetta'";
		$result = mysqli_query($conn, $sql);
		header("Location: ../../ricetta_id=" . $ricetta);
		exit();
	} else {
		$sql = "INSERT INTO likes (utente, ricetta) VALUES ('$id', '$ricetta')";
		$result = mysqli_query($conn, $sql);
		header("Location: ../../ricetta_id=" . $ricetta);
		exit();
	}
}

if (isset($_POST['submit_commento'])) {
	$sql = "INSERT INTO commenti (autore, ricetta, contenuto, data_ora) VALUES ('$id','$ricetta','$contenuto',NOW())";
	$result = mysqli_query($conn, $sql);
	header("Location: ../../ricetta_id=" . $ricetta);
	exit();
}

function checkLike($id, $ricetta, $conn)
{
	$sql = "SELECT * FROM likes WHERE likes.utente='$id' AND likes.ricetta='$ricetta'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		return true;
	}
	return false;
}

db_close($conn);
