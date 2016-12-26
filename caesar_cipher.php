<?php

/**
 * Encode the string into Caesar Cypher.
 * @param string $cyrillic_string Cyrillic string for cipher.
 * @param int $code Cipher code.
 * @return string
 */
function caesar_cypher($cyrillic_string, $code) {
  $string         = mb_strtolower(mb_convert_encoding($cyrillic_string, 'UTF-8', 'auto'));
  $string_array   = mbStringToArray($string);
  $alph           = mb_strtolower(mb_convert_encoding('АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ', 'UTF-8', 'auto')); // Cyrillic alphabet.
  $alph_array     = mbStringToArray($alph);
  $alph_arr_count = count($alph_array);
  $code           = strval($code); // cipher code
  $code_count     = strlen($code);
  $ci             = 0; // code element position
  $target_string  = '';
  foreach ($string_array as $letter) {
    $source_position = array_search($letter, $alph_array);

    if ($source_position !== FALSE) {
      $target_position = $source_position + $code[$ci];
      if ($target_position >= $alph_arr_count) {
        $target_position = $target_position - $alph_arr_count;
      }
      $letter = $alph_array[$target_position];
      // Make sure we go to the 1st symbol.
      $ci++;
      if ($ci == $code_count) {
        $ci = 0;
      }
    }

    $target_string .= $letter;
  }
  return $target_string;
}

/**
 * Split string to array.
 * @param string $string
 * @return array
 */
function mbStringToArray($string) {
  $strlen = mb_strlen($string);
  while ($strlen) {
    $array[] = mb_substr($string, 0, 1, "UTF-8");
    $string  = mb_substr($string, 1, $strlen, "UTF-8");
    $strlen  = mb_strlen($string);
  }
  return $array;
}
