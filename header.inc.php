		<header>
            <image id = "silc" src="Images/index_images/silc_home.jpg"></image>
            <!--Link To About-->
          <nav>
		    <a href="index.php">Home</a>
			<a href = "#">About</a>
            <!--Link To Help-->
            <a href = "#">Help</a>
			<?php
				if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
					echo "<a href='logout.php'>Log Out</a>";
					echo "<a href='questions_list.php'>List</a>";
					echo "<a href='preferences.php'>Preferences</a>";
					
				}
				else{
					echo "<a href='login.php'>Login</a>";
				}
			?>
		  </nav>
		</header>