<?php

$input_string = 'A Toyota';

function countVowels( $str ) {
    $count = 0;
    $letters = str_split( strtolower($str) );
    foreach ( $letters as $letter ) {
        if ( in_array( $letter, ['a', 'e', 'i', 'o', 'u'] ) ) {
           ++$count;
        }
    }
    return $count;
}

function isPalindrome( $str ) {
    $letters = str_split( strtolower( str_replace(' ', '', $str) ) );
    $letters_reversed = array_reverse($letters);
    if ($letters === $letters_reversed  ) {
        $is_palindrome = true;
    } else {
        $is_palindrome = false;
    };
    return $is_palindrome;
}

$vowel_count = countVowels($input_string);
$is_palindrome = isPalindrome($input_string);

require "index-view.php";