<?php
if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password'])){
	//validation
	require 'db_config.php';
	$sql = "select * from users where email='".$_POST['email']."';";
	$result = run_sql($sql);
	$user = $result->fetch_assoc();
	if($user && $user['hash'] == md5($_POST['password'])){
		//redirect
		session_start();
		$_SESSION['loggedin'] = true;
		header('Location: index.php');
		exit();
	}
	else{
		$error = "incorrect Login";
	}
}

?>
<!DOCTYPE>
<html>
<head>
	<title>QuizMaster Login Page</title>
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
	<main>
		<form action="" method="POST">	
		<label>Email: <input name="email" type="email" required/></label>
		<label>Password: <input name="password" type="password" required/></label>
		<input type="submit" value="Login"/>
		</form>
		<?php
			if(isset($error)){
				echo $error;
			}
		?>
	</main>	
</body>

</html>		