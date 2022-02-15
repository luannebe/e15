<?php

session_start();

$inputString = $_POST['inputString'];

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
    $str = preg_replace("/[^a-z]/i", '', $str);
    $str = str_split( strtolower( $str ) );
    $reversed = array_reverse($str);
    return $str == $reversed; 
}

function letterShift( $str ) {
    $newStr = '';
    $lowercase = range("a","y");
    $uppercase = range("A","Y");
    $alphabet = array_merge($lowercase, $uppercase);
    for ($i = 0; $i < strlen($str); $i++) {
        if( in_array( $str[$i], $alphabet ) ) {
            $newStr .= chr( ord($str[$i]) + 1 );
        } elseif ($str[$i] == "Z") {
            $newStr .= "A";
        } elseif ($str[$i] == "z") {
            $newStr .= "a";
        } else {
            $newStr .= $str[$i];
        }             
    }
    return $newStr;
}

function pigLatin( $str ) {
    $translation = '';
    $words = explode(' ', $str);
    foreach ($words as $word) {
        $translation .= pigLatinWord($word);
        $translation .= ' ';
    }
    return $translation;
}

function pigLatinWord( $str ) {
    $word = $suffix = '';
    $count = 0;
    $str = preg_replace("/[^a-z]/i", '', $str);
    $letters = str_split( strtolower($str) );

    foreach ($letters as $letter) {
        if (!in_array($letter, ['a', 'e', 'i', 'o', 'u'])) {
            $suffix .= $letter;
            ++$count;
        } else {
            $word = substr($str, $count);
            break;
        }
    }
    $suffix = ($suffix) ? $suffix . 'ay' : 'yay';
    return $word . $suffix;
}

$vowelCount = countVowels($inputString);
$isPalindrome = isPalindrome($inputString);
$pigLatin = pigLatin($inputString);
$letterShift = letterShift($inputString);

$_SESSION['results'] = [
    'inputString' => $inputString,
    'vowelCount' => $vowelCount,
    'isPalindrome' => $isPalindrome,
    'letterShift' => $letterShift,
    'pigLatin' => $pigLatin
];

header('Location: index.php');