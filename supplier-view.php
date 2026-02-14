<?php
include "config.php";
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Suppliers</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
			<div class="container-fluid">
				<a class="navbar-brand" href="adminmainpage.php">Medical Store</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navMenu">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item"><a class="nav-link" href="inventory-view.php">Inventory</a></li>
						<li class="nav-item"><a class="nav-link active" href="supplier-view.php">Suppliers</a></li>
						<li class="nav-item"><a class="nav-link" href="purchase-view.php">Purchases</a></li>
						<li class="nav-item"><a class="nav-link" href="employee-view.php">Employees</a></li>
						<li class="nav-item"><a class="nav-link" href="customer-view.php">Customers</a></li>
					</ul>
					<div class="d-flex">
						<a class="btn btn-outline-light" href="logout.php">Logout</a>
					</div>
				</div>
			</div>
		</nav>

		<div class="container py-4">
			<div class="d-flex justify-content-between align-items-center mb-3">
				<h2 class="mb-0">Suppliers</h2>
				<a class="btn btn-success" href="supplier-add.php">Add New Supplier</a>
			</div>

			<div class="table-responsive">
				<table class="table table-striped table-bordered align-middle">
					<thead class="table-light">
						<tr>
							<th>Supplier ID</th>
							<th>Company Name</th>
							<th>Address</th>
							<th>Phone Number</th>
							<th>Email Address</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$sql = "SELECT sup_id,sup_name,sup_add,sup_phno,sup_mail FROM suppliers";
					$result = $conn->query($sql);
					if ($result && $result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							echo '<tr>';
							echo '<td>' . htmlspecialchars($row['sup_id']) . '</td>';
							echo '<td>' . htmlspecialchars($row['sup_name']) . '</td>';
							echo '<td>' . htmlspecialchars($row['sup_add']) . '</td>';
							echo '<td>' . htmlspecialchars($row['sup_phno']) . '</td>';
							echo '<td>' . htmlspecialchars($row['sup_mail']) . '</td>';
							echo '<td class="text-center">';
							echo '<a class="btn btn-sm btn-primary me-1" href="supplier-update.php?id=' . urlencode($row['sup_id']) . '">Edit</a>';
							echo '<a class="btn btn-sm btn-danger" href="supplier-delete.php?id=' . urlencode($row['sup_id']) . '" onclick="return confirm(\'Delete this supplier?\')">Delete</a>';
							echo '</td>';
							echo '</tr>';
						}
					} else {
						echo '<tr><td colspan="6" class="text-center">No suppliers found.</td></tr>';
					}
					$conn->close();
					?>
					</tbody>
				</table>
			</div>
		</div>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	</body>
</html>

