<!DOCTYPE html>
<html>

<head>

	<!-- Bootstrap 5 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ENjdO4Dr2bkBIFxQpeoYz1H6kQb1QZ1Zr+3l6Z6Y5nI1wGmZ4x0Q5tzt+2QvQ4Q" crossorigin="anonymous">
<title>
Customers
</title>
</head>

<body>



		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container-fluid">
				<a class="navbar-brand" href="#">Medical Store</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item"><a class="nav-link" href="adminmainpage.php">Dashboard</a></li>
						<li class="nav-item"><a class="nav-link" href="customer-view.php">Customers</a></li>
					</ul>
					<div class="d-flex">
						<a class="btn btn-outline-secondary" href="logout.php">Logout</a>
					</div>
				</div>
			</div>
		</nav>

		<div class="container mt-4">
			<div class="row justify-content-center">
				<div class="col-12 col-md-8 col-lg-6">
					<div class="card shadow-sm">
						<div class="card-body">
							<h3 class="card-title text-center mb-3">Update Customer</h3>

		<?php
		include "config.php";

		$message = '';
		if (isset($_POST['update'])) {
			$id = mysqli_real_escape_string($conn, $_POST['cid']);
			$fname = mysqli_real_escape_string($conn, $_POST['cfname']);
			$lname = mysqli_real_escape_string($conn, $_POST['clname']);
			$age = mysqli_real_escape_string($conn, $_POST['age']);
			$sex = mysqli_real_escape_string($conn, $_POST['sex']);
			$phno = mysqli_real_escape_string($conn, $_POST['phno']);
			$mail = mysqli_real_escape_string($conn, $_POST['emid']);

			$sql = "UPDATE customer SET c_fname='$fname',c_lname='$lname',c_age='$age',c_sex='$sex',c_phno='$phno',c_mail='$mail' WHERE c_id='$id'";
			if ($conn->query($sql)) {
				header("Location: customer-view.php");
				exit;
			} else {
				$message = '<div class="alert alert-danger">Error! Unable to update.</div>';
			}
		}

		$row = [];
		if (isset($_GET['id'])) {
			$id = mysqli_real_escape_string($conn, $_GET['id']);
			$qry1 = "SELECT * FROM customer WHERE c_id='$id'";
			$result = $conn->query($qry1);
			if ($result) $row = $result->fetch_row();
		}
		?>

							<?php echo $message; ?>
							<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
								<div class="row g-3">
									<div class="col-12">
										<label for="cid" class="form-label">Customer ID</label>
										<input type="number" class="form-control" name="cid" value="<?php echo $row[0]; ?>" readonly>
									</div>
									<div class="col-12 col-md-6">
										<label for="cfname" class="form-label">First Name</label>
										<input type="text" class="form-control" name="cfname" value="<?php echo $row[1]; ?>">
									</div>
									<div class="col-12 col-md-6">
										<label for="clname" class="form-label">Last Name</label>
										<input type="text" class="form-control" name="clname" value="<?php echo $row[2]; ?>">
									</div>
									<div class="col-12 col-md-4">
										<label for="age" class="form-label">Age</label>
										<input type="number" class="form-control" name="age" value="<?php echo $row[3]; ?>">
									</div>
									<div class="col-12 col-md-4">
										<label for="sex" class="form-label">Sex</label>
										<input type="text" class="form-control" name="sex" value="<?php echo $row[4]; ?>">
									</div>
									<div class="col-12 col-md-4">
										<label for="phno" class="form-label">Phone Number</label>
										<input type="number" class="form-control" name="phno" value="<?php echo $row[5]; ?>">
									</div>
									<div class="col-12">
										<label for="emid" class="form-label">Email ID</label>
										<input type="email" class="form-control" name="emid" value="<?php echo $row[6]; ?>">
									</div>
									<div class="col-12 text-center mt-3">
										<button type="submit" name="update" class="btn btn-primary">Update</button>
									</div>
								</div>
							</form>

						</div>
					</div>
				</div>
			</div>
		</div>
	
</body>	

<script>
	
		var dropdown = document.getElementsByClassName("dropdown-btn");
		var i;

			for (i = 0; i < dropdown.length; i++) {
			  dropdown[i].addEventListener("click", function() {
			  this.classList.toggle("active");
			  var dropdownContent = this.nextElementSibling;
			  if (dropdownContent.style.display === "block") {
			  dropdownContent.style.display = "none";
			  } else {
			  dropdownContent.style.display = "block";
			  }
			  });
			}
			
</script>
	
</html>