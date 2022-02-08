<!doctype html>
<html lang='en'>

<head>
    <title>Project 1</title>
    <meta charset='utf-8'>
    <link href=data:, rel=icon>
</head>

<body>
    <h1>String Processor</h1>
    <ul>
        <li>String: <?php echo $input_string ?>
        </li>
        <li>The string has this many vowels : <?php echo $vowel_count ?></li>
        <li> Is it a pallindrome?
            <?php if ($is_palindrome) { ?>
            Yup
            <?php } else { ?>
            Nope
            <?php } ?>
        </li>
    </ul>
</body>

</html>