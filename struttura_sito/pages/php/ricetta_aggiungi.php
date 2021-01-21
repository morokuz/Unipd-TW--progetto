<?php
session_start();

require_once (__DIR__ . "/../../scripts/php/useful_functions.php");

$post_output = "";
if ($_SESSION['post_output']) {
  $post_output = "<p>" . $_SESSION['post_output'] . "</p>";
  unset($_SESSION['post_output']);
}

$page = file_get_contents(__DIR__ . "/../html/ricetta_aggiungi.html");
$links = array();
$links = checkSession();

$replacements = [
  "<placeholder_head_default_tags />" => file_get_contents(__DIR__ . "/../html/components/head_default_tags.html"),
  "<placeholder_header />" => file_get_contents(__DIR__ . "/../html/components/header.html"),
  "<placeholder_footer />" => file_get_contents(__DIR__ . "/../html/components/footer.html"),
  "<placeholder_breadcrumbs />" => file_get_contents(__DIR__ . "/../html/components/breadcrumbs.html"),
  "<placeholder_log />" => $links[0],
  "<placeholder_reg />" => $links[1],
  "<placeholder_post_output />" => $post_output
];

echo replace($page, $replacements);
?>
