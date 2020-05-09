<?php
//Including the quiz-file so we can use the variables and it will get run by the interperter
include_once('inc/quiz.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Math Quiz: Addition</title>
    <link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <div id="quiz-box">
        
        <?php 
        //If-statement that determines if the HTML should be shown
        if ($show_score == false) 
        { 
        ?>    

            <p class="breadcrumbs">Question <?php echo count($_SESSION['used_indexes']) . " of " . $totalQuestions; ?></p>
            <?php if (!empty($toast)) { echo $toast; } ?>
            <p class="quiz">What is <?php echo $question['leftAdder'] . "+" . $question['rightAdder']; ?></p>
            <form action="index.php" method="post">
                <input type="hidden" name="index" value="<?php echo $index ?>" />
                <input type="submit" class="btn" name="answer" value="<?php echo $answers[0] ?>" />
                <input type="submit" class="btn" name="answer" value="<?php echo $answers[1] ?>" />
                <input type="submit" class="btn" name="answer" value="<?php echo $answers[2] ?>" />
            </form>
             
        <?php } 
            
        if ($show_score == true) {
            echo "<p> You got " .  $_SESSION['totalCorrect'] . " out of " . $totalQuestions . " correct!</p>"; 
            echo "<p><br></p>";
            echo "<a href='index.php?status=restart'>Click here to restart the quiz</a>";
            } 
        ?>
        </div>
    </div>
</body>
</html>