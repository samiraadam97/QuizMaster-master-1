<?php
$page_title = "Questions";

require 'db_config.php';

$sql = 'select * from topics';

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
</form>
</body>