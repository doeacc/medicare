<?php
include "config.php";
session_start();
$ename = '';
if (isset($_SESSION['user'])) {
		$sql = "SELECT E_FNAME FROM EMPLOYEE WHERE E_ID='" . mysqli_real_escape_string($conn, $_SESSION['user']) . "'";
		$result = $conn->query($sql);
		if ($result) {
				$row = $result->fetch_row();
				$ename = $row[0] ?? '';
		}
}
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Pharmacist Dashboard</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
			<div class="container-fluid">
				<a class="navbar-brand" href="pharmmainpage.php">Pharmacist</a>
				<div class="d-flex">
					<a class="btn btn-outline-light" href="logout1.php">Logout<?php if($ename) echo ' (signed in as '.htmlspecialchars($ename).')'; ?></a>
				</div>
			</div>
		</nav>

		<div class="container py-4 text-center">
			<h2 class="mb-4">Pharmacist Dashboard</h2>
			<div class="row justify-content-center g-4">
				<div class="col-12 col-md-4">
					<a href="pharm-pos1.php" class="text-decoration-none">
						<div class="card">
							<img src="carticon1.png" class="card-img-top" style="height:200px;object-fit:contain" alt="Add New Sale">
							<div class="card-body">
								<h5 class="card-title">Add New Sale</h5>
							</div>
						</div>
					</a>
				</div>
				<div class="col-12 col-md-4">
					<a href="pharm-inventory.php" class="text-decoration-none">
						<div class="card">
							<img src="inventory.png" class="card-img-top" style="height:200px;object-fit:contain" alt="Inventory">
							<div class="card-body">
								<h5 class="card-title">View Inventory</h5>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	</body>
</html>