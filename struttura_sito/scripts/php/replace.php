<?php

function replace($string_input, $array_replacements) {
  foreach ($array_replacements as $key => $value) {
    $string_input = str_replace($key, $value, $string_input);
  }
  return $string_input;
}

?>