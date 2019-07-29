<?php
session_start();

require 'db_config.php';

$sql = 'select * from topics order by sequence asc';

$result = run_sql($sql);
$cols = run_sql("SELECT value from preferences where name='NO_OF_TOPICS_PER_ROW'")->fetch_array()[0];
$page_title = "QuizMaster";
?>

    <!DOCTYPE HTML>
<html>
<head>
<title><?php echo htmlspecialchars($page_title);
	echo 'hello';?></title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">

    <style>
        .image {
            width: 100px;
            height: 100px;
            padding: 20px 20px 20px 20px;
            transition: transform .2s;
        }
        .image:hover {
            transform: scale(1.2)
        }
        #table_1 {
            border-spacing: 300px 0px;
        }
        #table_2 {
            margin-left: auto;
            margin-right: auto;
        }
        #silc {
            width: 300;
            height: 85;
        }
        #welcome {
            text-align: center;
        }
        #directions {
            text-align: center;
        }
        #title {    
            color: black;        
            text-align: center;
        }
        a:visited, a:link, a:active {
            text-decoration: none;
        }
		header {
			text-align:center;
		}
		header a{
			display:inline-block;
			margin:10px;
		}
		input {
			display:block;
			text-align:center;
		}
		
    </style>
	</head>
    <body>
		<?php
		include "header.inc.php";
		?>
    <h1 id = "welcome">Welcome to QuizMaster</h1>
    <h2 id = "directions">Select a topic to test your knowledge about India</h2>
    <table id = "table_2">
	<tr>
	<?php
	$index = 0;
	while ($row = $result->fetch_assoc()){
	if ($index++ >= $cols) {
		$index = 1;
        echo "</tr><tr>";
	}
	echo "<td><a href='display_quiz.php?topic=" . $row["id"] . "' title='" . $row["topic"] . "'>";
    echo "<img class='image' id='" . $row["topic"] . "_quiz' src='Images/index_images/" . $row["image_name"] . "' />";
    echo "<div id='title'>" . $row["topic"] . "</div></a></td>";

}
	
	?>
	</tr>
    </table>
    </body>
</html>
