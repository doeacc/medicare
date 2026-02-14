<?php
include "config.php";

// Handle POST update before output
if (isset($_POST['update'])) {
		$id = mysqli_real_escape_string($conn, $_POST['sid']);
		$name = mysqli_real_escape_string($conn, $_POST['sname']);
		$add = mysqli_real_escape_string($conn, $_POST['sadd']);
		$phno = mysqli_real_escape_string($conn, $_POST['sphno']);
		$mail = mysqli_real_escape_string($conn, $_POST['smail']);

		$sql = "UPDATE suppliers SET sup_name='$name', sup_add='$add', sup_phno='$phno', sup_mail='$mail' WHERE sup_id='$id'";
		if ($conn->query($sql)) {
				header("Location: supplier-view.php");
				exit;
		} else {
				$error = "Unable to update supplier.";
		}
}

// Load supplier when id is provided
$row = null;
if (isset($_GET['id'])) {
		$id = mysqli_real_escape_string($conn, $_GET['id']);
		$qry1 = "SELECT * FROM suppliers WHERE sup_id='$id'";
		$result = $conn->query($qry1);
		$row = $result->fetch_row();
}
?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Update Supplier</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
			<div class="container-fluid">
				<a class="navbar-brand" href="adminmainpage.php">Medical Store</a>
				<div class="d-flex">
					<a class="btn btn-outline-light" href="logout.php">Logout</a>
				</div>
			</div>
		</nav>

		<div class="container">
			<div class="card">
				<div class="card-header">Update Supplier Details</div>
				<div class="card-body">
					<?php if (!empty($error)) echo '<div class="alert alert-danger">'.htmlspecialchars($error).'</div>'; ?>
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . (isset($_GET['id']) ? '?id=' . urlencode($_GET['id']) : '')); ?>" method="post">
						<div class="row g-3">
							<div class="col-md-4">
								<label class="form-label">Supplier ID</label>
								<input class="form-control" type="text" name="sid" value="<?php echo isset($row[0])?htmlspecialchars($row[0]):''; ?>" readonly>
							</div>
							<div class="col-md-8">
								<label class="form-label">Company Name</label>
								<input class="form-control" type="text" name="sname" value="<?php echo isset($row[1])?htmlspecialchars($row[1]):''; ?>" required>
							</div>
							<div class="col-12">
								<label class="form-label">Address</label>
								<input class="form-control" type="text" name="sadd" value="<?php echo isset($row[2])?htmlspecialchars($row[2]):''; ?>">
							</div>
							<div class="col-md-6">
								<label class="form-label">Phone Number</label>
								<input class="form-control" type="text" name="sphno" value="<?php echo isset($row[3])?htmlspecialchars($row[3]):''; ?>">
							</div>
							<div class="col-md-6">
								<label class="form-label">Email Address</label>
								<input class="form-control" type="email" name="smail" value="<?php echo isset($row[4])?htmlspecialchars($row[4]):''; ?>">
							</div>
						</div>
						<div class="mt-3">
							<button type="submit" name="update" class="btn btn-primary">Update</button>
							<a href="supplier-view.php" class="btn btn-secondary ms-2">Cancel</a>
						</div>
					</form>
				</div>
			</div>
		</div>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	</body>
</html>