<!DOCTYPE html>
<html>

<head>
<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ENjdO4Dr2bkBIFxQpeoYz1H6kQb1QZ1Zr+3l6Z6Y5nI1wGmZ4x0Q5tzt+2QvQ4Q" crossorigin="anonymous">
<div class="header">
<h1>Medical Store Management System</h1>
 <p style="margin-top:-20px;line-height:1;font-size:30px;">A Medicine Management Systems</p>
 <p style="margin-top:-20px;line-height:1;font-size:20px;">Credit: Dharmedra Yadav(7011377671)</p>
</div>
<title>
Pharmacia 
</title>
</head>

<body>

	<br><br><br><br>
	<div class="container">
		<form method="post" action="">
			<div id="div_login">
				<h1>Pharmacist Login</h1>
				<center>
				<div>
					<input type="text" class="form-control" id="uname" name="uname" placeholder="Username" />
				</div>
				<div class="mt-2">
					<input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password"/>
				</div>
				<div class="mt-3">
					<input type="submit" value="Submit" name="submit" id="submit" class="btn btn-primary" />
					<input type="submit" value="Click here for Admin Login" name="psubmit" id="submit" class="btn btn-secondary ms-2" />
				</div>
			 
				
	<?php
				
		include "config.php";

		if(isset($_POST['submit'])){

			$uname = mysqli_real_escape_string($conn,$_POST['uname']);
			$password = mysqli_real_escape_string($conn,$_POST['pwd']);

			if ($uname != "" && $password != ""){

				$sql="SELECT e_id FROM emplogin WHERE e_username='$uname' AND e_pass='$password'";
				$result = $conn->query($sql);
				$row = $result->fetch_row();
				if(!$row) {
					echo "<p style='color:red;'>Invalid username or password!</p>";
				}
				else {
				
					$emp=$row[0];
					session_start();
					$_SESSION['user']=$emp;
					header("location:pharmmainpage.php");
				}
			}
		}
				
		if(isset($_POST['psubmit']))
		{
			header("location:mainpage.php");
		}
	?>

				</center> 
			</div>
		</form>
	</div>
	<div class=footer>
	<br>
	Developed by, Dharmendra Yadav, @2021-27
	<br><br>
	</div>

</body>

</html>