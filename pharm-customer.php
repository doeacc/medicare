<?php
include "config.php";
session_start();

// Handle form submission
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

$ename = '';
if (isset($_SESSION['user'])) {
		$sql = "SELECT E_FNAME FROM EMPLOYEE WHERE E_ID='" . mysqli_real_escape_string($conn, $_SESSION['user']) . "'";
		$res = $conn->query($sql);
		if ($res) {
				$r = $res->fetch_row();
				$ename = $r[0] ?? '';
		}
}
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Add Customer (Pharmacist)</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
			<div class="container-fluid">
				<a class="navbar-brand" href="pharmmainpage.php">Pharmacist</a>
				<div class="d-flex">
					<a class="btn btn-outline-light" href="logout1.php">Logout<?php if($ename) echo ' ('.htmlspecialchars($ename).')'; ?></a>
				</div>
			</div>
		</nav>

		<div class="container py-4">
			<h2 class="mb-3">Add Customer Details</h2>
			<?php echo $message; ?>
			<form method="post" class="row g-3">
				<div class="col-md-4">
					<label class="form-label">Customer ID</label>
					<input class="form-control" type="number" name="cid" required>
				</div>
				<div class="col-md-4">
					<label class="form-label">First Name</label>
					<input class="form-control" type="text" name="cfname" required>
				</div>
				<div class="col-md-4">
					<label class="form-label">Last Name</label>
					<input class="form-control" type="text" name="clname">
				</div>
				<div class="col-md-2">
					<label class="form-label">Age</label>
					<input class="form-control" type="number" name="age">
				</div>
				<div class="col-md-2">
					<label class="form-label">Sex</label>
					<select class="form-select" name="sex">
						<option value="">Select</option>
						<option>Female</option>
						<option>Male</option>
						<option>Others</option>
					</select>
				</div>
				<div class="col-md-4">
					<label class="form-label">Phone Number</label>
					<input class="form-control" type="text" name="phno">
				</div>
				<div class="col-md-4">
					<label class="form-label">Email ID</label>
					<input class="form-control" type="email" name="emid">
				</div>
				<div class="col-12 mt-2">
					<button type="submit" name="add" class="btn btn-primary">Add Customer</button>
				</div>
			</form>
		</div>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	</body>
</html>