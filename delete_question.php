<?php
$page_title = "delete question";
require 'db_config.php';
if(isset($_POST['id'])){
	//get values
	
    $id = $db->real_escape_string(trim($_POST["id"]));
	//validate form
	  	$error = "";
  	
	//update
	//no validation errors?
  	if (!strlen($error)){
    	//actually try to insert...
      	$sql = "delete from questions where id= $id;"; 
      	$success = run_sql($sql);
      	if ($success){
			
        	//insert worked; redirect
          	header("Location: ./questions_list.php"); 
          	exit();
        }
      	else {
        	$error = "There was a problem deleting this question from the database";
        }
    }
}
	


$id = $_GET['id']; 
?>
<!DOCTYPE HTML>
<html>
<head>
<title><?php echo htmlspecialchars($page_title);?></title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<style>
	
	form input[type='submit'], a {
		display: inline-block;
		border: 0;
		font-size: 16pt;
		font-family: sans-serif;	
		text-decoration: none;
		padding: 5px 10px;
		background: linear-gradient(cyan,navy);
		color: aliceblue;
	}
	
	</style>
</head>

<body>
<h1> Are you sure you want to delete this? </h1>
<form method='POST' action='delete_question.php'>
<input type='hidden' name='id' value='<?php echo $id ?>'>

<input type='submit' value='Yes'>
<a href='questions_list.php'> No </a>
<?php
if(isset($error)){
	echo '<p>'. $error . '</p>';
}
?>
</form>
</body>
</html>