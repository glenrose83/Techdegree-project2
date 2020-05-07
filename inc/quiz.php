<?php
// Start the session
session_start();
// Include questions from the questions.php file
include_once('inc/questions.php');

$NumberOfQuestions = count($questions)-1;
$index = rand(0,$NumberOfQuestions);
$question = $questions[$index];

$answers = array("$question[correctAnswer]",
                 "$question[firstIncorrectAnswer]",
                 "$question[secondIncorrectAnswer]"

);
shuffle($answers);


// Make a variable to hold the total number of questions to ask
$totalQuestions = count($questions); 

// Make a variable to hold the toast message and set it to an empty string
$toast = "";
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if ($_POST['answer'] == $questions[$_POST['index']]['correctAnswer']) {
        $toast = "Winner Winner Chicken Dinner - Your answer is correct";
    } else {
        $toast = "FAIL - Wrong answer - You live you learn";
    }

}


// Make a variable to determine if the score will be shown or not. Set it to false.

// Make a variable to hold a random index. Assign null to it.

// Make a variable to hold the current question. Assign null to it.


/*
    If the server request was of type POST
        Check if the user's answer was equal to the correct answer.
        If it was correct:
            1. Assign a congratulutory string to the toast variable
            2. Ancrement the session variable that holds the total number correct by one.
        Otherwise:
            1. Assign a bummer message to the toast variable.
*/

/*
    Check if a session variable has ever been set/created to hold the indexes of questions already asked.
    If it has NOT: 
        1. Create a session variable to hold used indexes and initialize it to an empty array.
        2. Set the show score variable to false.
*/


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