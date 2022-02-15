<!doctype html>
<html lang='en'>

<head>
    <title>Project 1</title>
    <meta charset='utf-8'>
    <link href=data:, rel=icon>
</head>

<body>
    <h1>String Processor</h1>

    <form method='POST' action='process.php'>

        <label for='inputString'>Enter a string:</label>
        <input type='text' name='inputString' id='inputString' value='<?php echo $inputString ?? "" ?>'>

        <button type='submit'>Process</button>
    </form>

    <?php if (isset($results)) { ?>
    <h2>Results</h2>
    <p>
        You entered: <?php echo $inputString; ?>
    </p>

    <ul>
        <li>The string has this many vowels : <?php echo $vowelCount ?></li>
        <li> Is it a pallindrome?
            <?php if ($isPalindrome) { ?>
            Yup
            <?php } else { ?>
            Nope
            <?php } ?>
        </li>
        <li>Shift the letters: <?php echo $letterShift ?></li>
        <li>Say it in Pig Latin*: <?php echo $pigLatin ?></li>
    </ul>
    <cite>*<a href="https://en.wikipedia.org/wiki/Pig_Latin">Igpay Atinlay inyay Ikipediaway</a>
        <?php } ?>

</body>

</html>