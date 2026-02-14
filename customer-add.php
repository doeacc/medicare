<?php
include "config.php";

$message = '';
if (isset($_POST['add'])) {
	$id = mysqli_real_escape_string($conn, $_POST['cid']);
	$fname = mysqli_real_escape_string($conn, $_POST['cfname']);
	$lname = mysqli_real_escape_string($conn, $_POST['clname']);
	$age = mysqli_real_escape_string($conn, $_POST['age']);
	$sex = mysqli_real_escape_string($conn, $_POST['sex']);
	$phno = mysqli_real_escape_string($conn, $_POST['phno']);
	$mail = mysqli_real_escape_string($conn, $_POST['emid']);

	$sql = "INSERT INTO customer VALUES ($id, '$fname', '$lname',$age,'$sex',$phno, '$mail')";
	if (mysqli_query($conn, $sql)) {
		$message = '<div class="alert alert-success">Customer successfully added!</div>';
	} else {
		$message = '<div class="alert alert-danger">Error adding customer. Check details.</div>';
	}
}
?>

<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Bootstrap 5 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ENjdO4Dr2bkBIFxQpeoYz1H6kQb1QZ1Zr+3l6Z6Y5nI1wGmZ4x0Q5tzt+2QvQ4Q" crossorigin="anonymous">
<title>Customers</title>
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
					<li class="nav-item"><a class="nav-link" href="customer-view.php">Manage Customers</a></li>
				</ul>
				<div class="d-flex">
					<a class="btn btn-outline-secondary" href="logout.php">Logout</a>
				</div>
			</div>
		</div>
	</nav>

	<div class="container mt-5">
		<?php echo $message; ?>
		<div class="row justify-content-center">
			<div class="col-12 col-md-8 col-lg-6">
				<div class="card shadow-sm">
					<div class="card-body">
						<h3 class="card-title mb-4 text-center">Add Customer</h3>
						<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
							<div class="row g-3">
								<div class="col-12 col-md-6">
									<label for="cid" class="form-label">Customer ID</label>
									<input type="number" class="form-control" name="cid" id="cid">
								</div>
								<div class="col-12 col-md-6">
									<label for="age" class="form-label">Age</label>
									<input type="number" class="form-control" name="age" id="age">
								</div>
								<div class="col-12 col-md-6">
									<label for="cfname" class="form-label">First Name</label>
									<input type="text" class="form-control" name="cfname" id="cfname">
								</div>
								<div class="col-12 col-md-6">
									<label for="clname" class="form-label">Last Name</label>
									<input type="text" class="form-control" name="clname" id="clname">
								</div>
								<div class="col-12 col-md-6">
									<label for="sex" class="form-label">Sex</label>
									<select id="sex" name="sex" class="form-select">
										<option value="">Select</option>
										<option>Female</option>
										<option>Male</option>
										<option>Others</option>
									</select>
								</div>
								<div class="col-12 col-md-6">
									<label for="phno" class="form-label">Phone Number</label>
									<input type="number" class="form-control" name="phno" id="phno">
								</div>
								<div class="col-12">
									<label for="emid" class="form-label">Email ID</label>
									<input type="email" class="form-control" name="emid" id="emid">
								</div>
								<div class="col-12 text-center mt-3">
									<button type="submit" name="add" class="btn btn-primary">Add Customer</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>

	<?php $conn->close(); ?>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+AMvyTG2vI5DkLtS3qm9Ekf5KkN0y" crossorigin="anonymous"></script>

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