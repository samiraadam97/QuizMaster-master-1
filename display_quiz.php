<?php
session_start();
$topic = $_GET['topic'];

require 'db_config.php';
$sql = "select topic from topics where id = '$topic';"; 
$result = run_sql($sql);
$topic_name = $result->fetch_array()[0];
$page_title = "Quiz " . $topic_name;
$sql = "select value from preferences where name='NO_OF_QUESTIONS_TO_SHOW';";
$result = run_sql($sql);
$num_of_questions = (int)$result->fetch_array()[0];
$sql = "select * from questions where topic = $topic limit $num_of_questions; ";
$result = run_sql($sql);
// better debugging method below, shows the values of the associative array for each column and each row
 //while($row=mysqli_fetch_assoc($result)){
 //printf ("([%s] [%s] [%s] [%s] [%s]), ",$row["choice_1"],$row["choice_2"], $row['choice_3'],$row['choice_4'],$row['answer']);}
  // another debugging method below
  // print_r(mysqli_fetch_assoc($result)); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title><?php echo htmlspecialchars($page_title);?></title>


<script>
   //****************************************************
//  This block helps to catch the syntax errors.
//  These errors are reported back to the web page
//****************************************************
      window.onerror = function(e) {
        document.write('There\'s an error: ', e, '</br>')
     };
   </script>

   <!--**************************************************** -->
   <!--This is the tool bar-->
   <!--**************************************************** -->
<style>
header {
			text-align:center;
		}
header a{
			display:inline-block;
			margin:10px;
		}			
header input {
			display:block;
			text-align:center;
		}
</style>
</head>
		
<body>
<?php
include 'header.inc.php';
?>

   <!--**************************************************** -->
   <!-- This is a placeholder question.  -->
   <!-- This will be replaced by a random question -->
   <!-- when the page first loads up.  -->
   <!-- **************************************************** -->

   <p><img id="q_image" src="Images\dances\kathakali.jpeg" style="max-height:250px;width:auto;" alt="img not found" /></p>
   <p id="question"> Dummy question </p>
   <form>
      <input type="radio" name="choices" id="choice_1" value="A" onclick="updateGivenAnswer(this.value)" />
      <label for="choice_1" id="choice_1_label"> choice 1 </label>
      <br>
      <input type="radio" name="choices" id="choice_2" value="B" onclick="updateGivenAnswer(this.value)" />
      <label for="choice_2" id="choice_2_label"> choice 2 </label>
      <br>
      <input type="radio" name="choices" id="choice_3" value="C" onclick="updateGivenAnswer(this.value)" />
      <label for="choice_3" id="choice_3_label"> choice 3 </label>
      <br>
      <input type="radio" name="choices" id="choice_4" value="D" onclick="updateGivenAnswer(this.value)" />
      <label for="choice_4" id="choice_4_label"> choice 4 </label>
      <br>
   </form>



<!-- **************************************************** -->
<!--   Add three buttons "Previous", "Submit", "Next" -->
<!--   TODO: These will be enabled / disabled based on how many questions are answered. -->
<!-- **************************************************** -->

<button id="previousBtn" type="button">
   Previous
</button>

<button id="submitBtn" type="button" disabled>
   Submit
</button>

<button id="nextBtn" type="button">
   Next
</button>



<script>
   //**********************************************
   // STEP 1:  Assign the Event Listeners to the three buttons
   //          Also attach the Event Listern to the radio buttons
   //**********************************************

   var next_btn = document.getElementById("nextBtn");
   if (next_btn) {
      next_btn.addEventListener("click", showNextQuestion);
   }

   var previous_btn = document.getElementById("previousBtn");
   if (previous_btn) {
      previous_btn.addEventListener("click", showPreviousQuestion);
   }

   var submit_btn = document.getElementById("submitBtn");
   if (submit_btn) {
      submit_btn.addEventListener("click", showResults);
   }

   //**********************************************
   // STEP 2:  Establish the contract for QUESTION object
   //**********************************************

   /* This is our contract for the Question Object
   topic
   question
   choice_1
   choice_2
   choice_3
   choice_4
   answer
   image
   given_answer
   */

   // Object constructor function and methods
   function Question(x_topic, x_question, x_a, x_b, x_c, x_d, x_answer, x_image, x_given_answer) {
      this.topic = x_topic;
      this.question = x_question;
      this.choice_1 = x_a;
      this.choice_2 = x_b;
      this.choice_3 = x_c;
      this.choice_4 = x_d;
      this.answer = x_answer;
      this.image = x_image;
      this.given_answer = x_given_answer;

      this.toString = function () {
         document.write("<br><br> ");
         document.write("<br>" + this.topic);
         document.write("<br>" + this.question);
         document.write("<br>" + this.choice_1);
         document.write("<br>" + this.choice_2);
         document.write("<br>" + this.choice_3);
         document.write("<br>" + this.choice_4);
         document.write("<br>" + this.answer);
         document.write("<br>" + this.image);
         document.write("<br>" + this.given_answer + "<br>");
      }
      
   }


   //**********************************************
   // STEP 3:  Create 20 Questions per the above contract
   // TODO: Only 10 are created as of now; 10 pending to be done
   // NOTE: for this topic, images are stored in images/dances folder
   //**********************************************
var question_bank = [
<?php
$topic_name_with_qoutes = "\"$topic_name\"";
while($row = $result->fetch_assoc()){
	$question = "\"" . $row['question'] . "\"";
	$choice_1 = "\"" . $row['choice_1'] . "\"";
	$choice_2 = "\"" . $row['choice_2'] . "\"";
	$choice_3 = "\"" . $row['choice_3'] . "\"";
	$choice_4 = "\"" . $row['choice_4'] . "\"";
	$answer = "\"" . $row['answer'] . "\"";
	$image_name = "\" Images/$topic_name/" . $row['image_name'] . "\"";
	$X = "\"X\"";
	echo "new Question($topic_name_with_qoutes, $question, $choice_1, $choice_2, $choice_3, $choice_4, $answer, $image_name, $X)," ;
}

?>
];
 
   //**********************************************
   // STEP 4:  Create an array to hold all the above questions
   //**********************************************

   //var question_bank = [q1, q2, q3, q4, q5, q6, q7, q8, q9, q10, q11, q12, q13, q14, q15, q16, q17, q18, q19, q20];
   //**********************************************
   // STEP 5:  set HOW_MANY=5 questions
   // This constant will be used to select that many questions from the question bank 
   //**********************************************
   var HOW_MANY = <?php echo $num_of_questions;?>;

   //**********************************************
   // STEP 6:  Shuffle/Randomize the Array
   // Reference: https://javascript.info/task/shuffle 
   //**********************************************
   function shuffle(array) {
      for (let i = array.length - 1; i > 0; i--) {
         let j = Math.floor(Math.random() * (i + 1));
         [array[i], array[j]] = [array[j], array[i]];
      }
   }
   // for debugging purposes, disable shuffle for the timebeing
    shuffle(question_bank);

   //**********************************************
   // STEP 7:  Select HOW_MANY questions 
   //**********************************************
   var mini_question_bank = question_bank.slice(0, HOW_MANY);
	var score_quiz = [];


   //**********************************************
   // STEP 8:  Display the first question 
   //          from the mini_question_bank 
   // A random question will then show up when the page first loads up.
   //**********************************************
   // we need to keep track of where we are in the question order
   var index = 0;
   updateQuestion(index);


   //**********************************************
   // STEP 9:  Implement the Next Button
   //**********************************************

   function showNextQuestion() {
      index = index + 1;
      updateQuestion(index);
   }


   //**********************************************
   // STEP 10:  Implement the Previous Button
   //**********************************************

   function showPreviousQuestion() {
      index = index - 1;
      updateQuestion(index);
   }


   //**********************************************
   // STEP 11:  Implement the Submit Button
   //**********************************************

   // Loop through the mini_question_object
   // compare the given_answers with the correct answer
   // keep counting the correct answers
   // publish the score to the user
   function showResults() {

      var count = 0;
      for (var i = 0; i < mini_question_bank.length; i++) {
         if (mini_question_bank[i].answer == mini_question_bank[i].given_answer) {
            count = count + 1;
			score_quiz[i] = true;
         }
		 else {
			 score_quiz[i] = false;
			 var answer = mini_question_bank[i].answer;
		 }
      }
      document.write("<style> #table_1 {border-spacing: 200px 0px;} .congrats { text-align: center; } #congratsi {height: 200px; width: 200px; display: block; margin-left: auto; margin-right: auto;}</style>");
      document.write("<table id = 'table_1'><tr><td><img id = 'silc' src='Images/index_images/silc_home.jpg'></td><td id = 'text'><a href = 'about.html'>About</a></td><td id = 'text'><a href = 'help.html'>Help</a></td></tr></table>");
      document.write("<br> <p class = 'congrats' >Congratulations</p>");
      document.write("<img id = 'congrats' src='Images/about_images/thumbsup.jpg'>")
      document.write("<p class = 'congrats'>Your final score: ", count, " out of ", HOW_MANY, "</p>");
	  
	  score_quiz.forEach((item,index) => {
		  var isCorrect = (item)?"Correct":"Incorrect" + "<br>" + "Correct answer is " + answer;
	  document.write("<p>Question number "+(index+1)+" : "+isCorrect+"</p>");
	  	//	  if((item) == false){
		 // document.write("Correct answer is: " + score_quiz[i].answer;
		 // }
	  });
	  
   }

   //**********************************************
   // STEP 12:  This is the common function called by 
   //           Page Load, Previous and Next buttons
   //**********************************************
	
   function updateQuestion(selected_question) {
      // Get the Question at the bookmark/index
      var selected_question = mini_question_bank[index];

      // now update the default question with the selected question
      document.getElementById("question").innerHTML = "question number: " + (index+1) + "<br>" + selected_question.question;
      document.getElementById("choice_1_label").innerHTML = selected_question.choice_1;
      document.getElementById("choice_2_label").innerHTML = selected_question.choice_2;
      document.getElementById("choice_3_label").innerHTML = selected_question.choice_3;
      document.getElementById("choice_4_label").innerHTML = selected_question.choice_4;
      document.getElementById("q_image").src = selected_question.image;


      // Do not carry forward the previous selection on the radio buttons
      // If the user has not selected any answer yet, then unset all the radio buttons
      // If the user changes the answer, then the corresponding radio button event will update the answer
      if (selected_question.given_answer == "X") {
         // if the given_answer is X, unselect all
         document.getElementById("choice_1").checked = false;
         document.getElementById("choice_2").checked = false;
         document.getElementById("choice_3").checked = false;
         document.getElementById("choice_4").checked = false;
      } 

      // If the question already has an answer, then show that answer
      if (selected_question.given_answer == "A") {
         document.getElementById("choice_1").checked = true;
      } else
      if (selected_question.given_answer == "B") {
         document.getElementById("choice_2").checked = true;
      } else
      if (selected_question.given_answer == "C") {
         document.getElementById("choice_3").checked = true;
      } else
      if (selected_question.given_answer == "D") {
         document.getElementById("choice_4").checked = true;
      }
      // once the question is updated, validate all the three buttons
      validateButtons();
   }


   
   //**********************************************
   // LAST STEP:  All the supporting functions are here
   //********************************************** 

   // When the user presses the radio button
   // We need to update the Question object with the given_answer
   // this function will be invoked whenever the user selects a choice
   // we also need to validate the buttons here
   // since the SUBMIT button may have to be enabled
   function updateGivenAnswer(value) {
      mini_question_bank[index].given_answer = value;
      validateButtons();
   }

   // Validation of all the three buttons - Previous, Submit and Next - happen here
   // Validation depends on the index and whether all questions are answered by the user
   function validateButtons() {
      // if index == 0, disable the previous button
      if (index == 0) {
         previous_btn.disabled = true;
      } else {
         previous_btn.disabled = false;
      }

      // if index == HOW_MANY, disable the next button
      if (index == HOW_MANY-1) {
         next_btn.disabled = true;
      } else {
         next_btn.disabled = false;
      }

      // if all questions are answered, then enable the submit button
      var are_all_questions_answered = true;
      for (var i=0; i < mini_question_bank.length; i=i+1)
      {
         if (mini_question_bank[i].given_answer == "X")
         {
            are_all_questions_answered = false;
            break;
         }
      }

      if (are_all_questions_answered)
      {
         submit_btn.disabled = false;
      }
   }
</script>
</body>
</html>