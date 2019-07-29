<?php
$page_title = "Questions";

require_once("db_config.php");

if ($_SERVER['REQUEST_METHOD'] == "POST"){
  	//get values
	$question = $db->real_escape_string(trim($_POST["question"]));
  	$choice_1 = $db->real_escape_string(trim($_POST["choice_1"]));
  	$choice_2 = $db->real_escape_string(trim($_POST["choice_2"]));
	$choice_3 = $db->real_escape_string(trim($_POST["choice_3"]));
	$choice_4 = $db->real_escape_string(trim($_POST["choice_4"]));
	$answer = $db->real_escape_string(trim($_POST["answer"]));
	$image_name = $db->real_escape_string(trim($_POST["image_name"]));
	$topic = $db->real_escape_string(trim($_POST["topic"]));
  
  	//validate
  	$error = "";
  	if (!strlen($question)){
    	$error .= "Please type a question<br>";
    }
  	if (!strlen($choice_1)){
    	$error .= "Please enter a choice A<br>";
    }
	if (!strlen($choice_2)) {
		$error .= "Please enter a choice B<br>";
	}
	if (!strlen($choice_3))  {
		$error .= "Please enter a choice C<br>";
	}
	if (!strlen($choice_4)) {
		$error .= "Please enter a choice D<br>";
	}
	if (!strlen($answer)) {
		$error .= "Please enter an answer<br>";
	}
	if (!strlen($image_name)) {
		$error .= "Please enter an image name<br>";
	}	
	
  
  	//no validation errors?
  	if (!strlen($error)){
    	//actually try to insert...
      	$sql = "insert into questions(choice_1,choice_2,choice_3,choice_4,answer,image_name,question,topic) values ('$choice_1','$choice_2','$choice_3','$choice_4','$answer','$image_name','$question',$topic);"; //TODO: write valid insert sql
      	$success = run_sql($sql);
      	if ($success){
			
        	//insert worked; redirect
          	header("Location: ./questions_list.php"); //TODO: check where to redirect on success
          	exit();
        }
      	else {
        	$error = "There was a problem inserting this question into the database";
        }
    }
}



$sql = 'select * from topics order by sequence asc';

$result = run_sql($sql);

// print_r($result); <-- use for debugging and test DB fetching



?>

<!DOCTYPE HTML>
<html>
<head>
<title><?php echo htmlspecialchars($page_title);?></title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
	<style>
	form {
		max-width: 100%;
		display: table;
		margin: 10px auto;
		text-align: right;
	}
	form label {
		display: block;
		margin: 10px 0;
	}
	form input,form select {
		width: 250px;
		max-width: 100%;
		padding: 5px 10px;
		border-radius: 5px;
	}
	form input[type='submit'] {
		width: auto;
		background: linear-gradient(cyan,navy);
		color: aliceblue;
	}
	
	</style>
</head>

<body>
<form method='POST' action='create_question.php'>
<select name='topic'>
<?php
while($row = $result->fetch_assoc()){
		echo "<option value='".$row['id']."'>".$row['topic'].'</option>';
}
	
?>
</select>
<label>Question: <input name="question"> </label>
<label>Choice a: <input name="choice_1"> </label>
<label>Choice b: <input name="choice_2"> </label>
<label>Choice c: <input name="choice_3"> </label>
<label>Choice d: <input name="choice_4"> </label>
<label>Answer: <input name="answer"> </label>
<label>Image Name: <input name="image_name"> </label>
<input type='submit' value='submit'>
<?php
if(isset($error)){
	echo '<p>'. $error . '</p>';
}
?>
</form>
</body>