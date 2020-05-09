<?php
// Start the session
session_start();

// Include questions from the questions.php file
include_once('inc/questions.php');

// Made a variable to hold the total number of questions to ask
$totalQuestions = count($questions); 

// Made a variable to hold the toast message and set it to an empty string
$toast = "";

// varible that selects if the score should be shown. 
$show_score = false;

//If an answer has been "posted" 
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    //comparing posted answer and correct question and incrementing session varible
    if ($_POST['answer'] == $questions[$_POST['index']]['correctAnswer']) {
        $toast = "Winner Winner Chicken Dinner - Your answer is correct";

        $_SESSION['totalCorrect']++;
    } else {
        $toast = "FAIL - Wrong answer - You live you learn";
    }

}

//This assigns an 0 to totalCorrect and creates an empty array into used_indexes
if (!isset($_SESSION['used_indexes'])) {
    $_SESSION['used_indexes'] = array();
    $_SESSION['totalCorrect'] = 0;
}





/*
  If the number of used indexes in our session variable is equal to the total number of questions
  to be asked:
        1.  Reset the session variable for used indexes to an empty array 
        2.  Set the show score variable to true.        

  Else:
    1. Set the show score variable to false 

    2. If it's the first question of the round:
        a. Set a session variable that holds the total correct to 0. 
        b. Set the toast variable to an empty string.
        c. Assign a random number to a variable to hold an index. Continue doing this
            for as long as the number generated is found in the session variable that holds used indexes.
        d. Add the random number generated to the used indexes session variable.      
        e. Set the individual question variable to be a question from the questions array and use the index
            stored in the variable in step c as the index.
        f. Create a variable to hold the number of items in the session variable that holds used indexes
        g. Create a new variable that holds an array. The array should contain the correctAnswer,
            firstIncorrectAnswer, and secondIncorrect answer from the variable in step e.
        h. Shuffle the array from step g.
*/

if (count($_SESSION['used_indexes']) == $totalQuestions) {
    $_SESSION['used_indexes'] = 0;
    $show_score = true;
    } else {
    $show_score = false;
    
    if ($totalQuestions == 0) {
        $_SESSION['totalCorrect'] = 0;
        $toast = "";

    } else {
        $NumberOfQuestions = count($questions)-1;

        do {
        $index = rand(0,$NumberOfQuestions);
        } while (in_array($index, $_SESSION['used_indexes']));

        $question = $questions[$index];

        $answers = array("$question[correctAnswer]",
                 "$question[firstIncorrectAnswer]",
                 "$question[secondIncorrectAnswer]"

                 );
        shuffle($answers);
        array_push($_SESSION['used_indexes'], $index);
    }
}    