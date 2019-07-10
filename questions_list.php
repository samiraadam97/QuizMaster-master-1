<?php
$page_title = "Questions";

require 'db_config.php';

$sql = 'select * from questions';

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
	 a {
		 padding: 5px 10px;
		 border: 1px solid black;
		 border-radius: 5px;
		 background: linear-gradient(cyan,navy);
		 color: aliceblue;
		 text-decoration: none;
		 font-family: sans-serif;
	 }
	 .table {
		margin: 25px 0 !important; 
	 }
	</style>
</head>

<body>
<a href='create_question.php' class="create_question" >Create Question</a>

<table class="table table-striped" id="questions_table">
            <div class="table responsive">
    <thead>

	<tr>
		<th>Question</th>   
		<th>Choice 1</th>
		<th>Choice 2</th>
		<th>Choice 3</th>
		<th>Choice 4</th>
		<th>answer</th>
		<th>image_name</th>
		<th></th>
	</tr>
	</thead>
                <tbody>
<?php 
	while($row = $result->fetch_assoc()){
		$id=$row['id'];
		echo '<tr>';
		echo '<td>'.$row['question'].'</td>';
		echo '<td>'.$row['choice_1'].'</td>';
		echo '<td>'.$row['choice_2'].'</td>';
		echo '<td>'.$row['choice_3'].'</td>';
		echo '<td>'.$row['choice_4'].'</td>';
		echo '<td>'.$row['answer'].'</td>';
		echo '<td>'.$row['image_name'].'</td>';
		echo '<td><a href="update_question.php?id='.$id.'">edit</a><a href="delete_question.php?id='.$id.'">delete</a></td>';
		echo '</tr>';
		
	}
?>
                </tbody>
            </div>
        </table>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!--jQuery-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!--Data Table-->
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" language="javascript">
    $(document).ready( function () {
        $('#questions_table').DataTable( {
            dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'csv' , 'pdf'
                ] }
        );
    } );
</script>
</body>

</html>