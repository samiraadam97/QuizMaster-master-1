<?php

require 'db_config.php';

$sql = 'select * from topics';

$result = run_sql($sql);
$cols = run_sql("SELECT value from preferences where name='NO_OF_TOPICS_PER_ROW'")->fetch_array()[0];
$page_title = "QuizMaster";
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
    </style>
	</head>
    <body>
    <table id = "table_1">
        <tr>
            <td><image id = "silc" src="Images/index_images/silc_home.jpg"></image></td>
            <!--Link To About-->
            <td id = "text"><a href = "about.html">About</a></td>
            <!--Link To Help-->
            <td id = "text"><a href = "help.html">Help</a></td>
        </tr>
    </table>
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
	echo "<td><a href='" . $row["topic"] . "_quiz.html' title='" . $row["topic"] . "'>";
    echo "<img class='image' id='" . $row["topic"] . "_quiz' src='Images/index_images/" . $row["image_name"] . "." . $row["image_ext"] . "' />";
    echo "<div id='title'>" . $row["topic"] . "</div></a></td>";

}
	
	?>
	</tr>
        <!--Links to quizzes can be put inside the href = ""
        <tr>
            <td>
                <a href = "dresses_quiz.html" title = "Dresses">
                    <image class = "image" id="dress_quiz" src = "Images/index_images/dresses_and_costumes.png"></image>
                    <div id = "title">Dresses</div>
                </a>
            </td>

            <td>
                <a href = "dances_quiz.html" title = "Dances">
                    <image class = "image" src = "Images/index_images/dances.jpg"></image>
                    <div id = "title">Dances</div>
                </a>	
            </td>

            <td>
                <a href = "festivals_quiz.html" title = "Festivals">
                    <image class = "image" src = "Images/index_images/festivals.png"></image>
                    <div id = "title">Festivals</div>
                </a> 
            </td>   

            <td>
                <a href = "food_quiz.html" title = "Foods">
                    <image class = "image" src = "Images/index_images/foods.png"></image>
                    <div id = "title">Foods</div>
                </a>
            </td>

            <td>
                <a href = "" title = "Geography">
                    <image class = "image" src = "Images/index_images/geography.png"></image>
                    <div id = "title" style="color:red" >Geography</div>
                </a>
            </td>
        </tr>

        <tr>
            <td>
                <a href = "leaders_n_scientists_quiz.html"  title = "Leaders and Scientists">
                    <image class = "image" src = "Images/index_images/leaders_and_scientists.png"></image>
                    <div id = "title">Scientists</div>
                </a>
            </td>

            <td>
                <a href = "movies_quiz.html"  title = "Movies">
                    <image class = "image" src = "Images/index_images/movies.png"></image>
                    <div id = "title">Movies</div>
                </a>
            </td>

            <td>
                <a href = "instruments_quiz.html"  title = "Musical Instruments">
                    <image class = "image" src = "Images/index_images/musical_instruments.png"></image>
                    <div id = "title">Instruments</div>
                </a>
            </td> 

            <td>
                <a href = "nris_quiz.html"  title = "NRI's">
                    <image class = "image" src = "Images/index_images/NRI's.jpg"></image>
                    <div id = "title">NRI's</div>
                </a>
            </td>

            <td>
                <a href = "monuments_quiz.html"  title = "Places and Monuments">
                    <image class = "image" src = "Images/index_images/places_and_monuments.png"></image>
                    <div id = "title">Monuments</div>
                </a>
            </td>
        </tr>

        <tr>
            <td>
                <a href = "sports_quiz.html"  title = "Sports">
                    <image class = "image" src = "Images/index_images/sports.png"></image>
                    <div id = "title">Sports</div>
                </a>
            </td>

            <td>
                <a href = "states_quiz.html"  title = "States">
                    <image class = "image" src = "Images/index_images/states.png"></image>
                    <div id = "title">States</div>
                </a>
            </td>

            <td>
                <a href = "symbols_quiz.html"  title = "Symbols">
                    <image class = "image" src = "Images/index_images/symbols_of_india.png"></image>
                    <div id = "title">Symbols</div>
                </a>
            </td>
            <td>
                <a href = "embroidery_quiz.html"  title = "Traditional Games">
                    <image class = "image" src = "Images/index_images/embroidery.png"></image>
                    <div id = "title">Embroidery</div>
                </a>
            </td>

            <td>
                <a href = ""  title = "Yoga">
                    <image class = "image" src = "Images/index_images/yoga.png"></image>
                    <div id = "title"  style="color:red">Yoga</div>
                </a>
            </td>
        </tr>
		-->
    </table>
    </body>
</html>
