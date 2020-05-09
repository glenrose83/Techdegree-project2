<?php
//Starting the session
session_start();

//Include questions from the questions.php file
include_once('inc/questions.php');

//Made a variable to hold the total number of questions to ask
$totalQuestions = count($questions); 

//Made a variable to hold the toast message and set it to an empty string
$toast = "";

//Varible that determines if the score should be shown
$show_score = false;

//If an answer has been "posted" 
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    //Comparing posted answer and correct answer and incrementing session varible
    if ($_POST['answer'] == $questions[$_POST['index']]['correctAnswer']) {
        $toast = "Winner Winner Chicken Dinner - Your answer is correct";

        $_SESSION['totalCorrect']++;
    } else {
        $toast = "FAIL - Wrong answer - You live you learn";
    }

}

//When "restart quiz "link" on scorepage is clicked this will run 
if (isset($_GET['status'])) {
    $_SESSION['used_indexes'] = array();
    $_SESSION['totalCorrect'] = 0;
}

//IF the session varible is not set, like if its the first question, 
//This will assign an 0 to totalCorrect and creates an empty array into used_indexes
if (!isset($_SESSION['used_indexes'])) {
    $_SESSION['used_indexes'] = array();
    $_SESSION['totalCorrect'] = 0;
}

//Right here we checks if we have submitted 10 answers
if (count($_SESSION['used_indexes']) == $totalQuestions) {
        $_SESSION['used_indexes'] = 0;
        $show_score = true;     

        } else {

        $show_score = false;

            //Here we set total correct and toast message to 0 if there isn´t any questions at all
            if ($totalQuestions == 0) {
                $_SESSION['totalCorrect'] = 0;
                $toast = "";
    
                } else {
            
                //else - we count the number of questions and -1 since it counts index 0 
                $NumberOfQuestions = count($questions) -1;
                
                /* We find random number and keep assigning a new to $index, 
                   as long as the number is in_array
                */
                do {
                $index = rand(0,$NumberOfQuestions);
                } while (in_array($index, $_SESSION['used_indexes']));
        
                //Then we get the specific question and assigns to $question
                $question = $questions[$index];
        
                /*we select 2 incorrect answers and one correct and put them in and array. 
                  hereafter we shuffle it below
                */
                $answers = array("$question[correctAnswer]",
                        "$question[firstIncorrectAnswer]",
                        "$question[secondIncorrectAnswer]"
        
                        );

                shuffle($answers);
        
                //finally we push the it into our session varible called used_indexes.
                array_push($_SESSION['used_indexes'], $index);
                }

}