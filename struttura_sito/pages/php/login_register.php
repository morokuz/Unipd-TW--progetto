<?php 
require_once(__DIR__ . "/../../scripts/php/replace.php");

$page = file_get_contents(__DIR__ . "/../html/login_register.html");
$replacements = [
  "<placeholder_head_default_tags />" => file_get_contents(__DIR__ . "/../html/components/head_default_tags.html"),
  "<placeholder_header />" => file_get_contents(__DIR__ . "/../html/components/header.html"),
  "<placeholder_footer />" => file_get_contents(__DIR__ . "/../html/components/footer.html"),
  "<placeholder_breadcrumbs />" => file_get_contents(__DIR__ . "/../html/components/breadcrumbs.html"),
  "<placeholder_nav />" => file_get_contents(__DIR__ . "/../html/components/nav.html")
];

echo replace($page, $replacements);
?>