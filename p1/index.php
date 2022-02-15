<?php

session_start();

if (isset($_SESSION['results'])) {
    $results = $_SESSION['results'];
    $inputString = $results['inputString'];
    $vowelCount = $results['vowelCount'];
    $isPalindrome = $results['isPalindrome'];
    $letterShift = $results['letterShift'];
    $pigLatin = $results['pigLatin'];

    $_SESSION['results'] = null;
}

require 'index-view.php';