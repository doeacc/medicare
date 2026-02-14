<?php
include "config.php";
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Products - Sale</title>
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
						<li class="nav-item"><a class="nav-link" href="supplier-view.php">Suppliers</a></li>
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
			<h2 class="mb-3">List of Products Sold</h2>

			<div class="table-responsive">
				<table class="table table-striped table-bordered align-middle">
					<thead class="table-light">
						<tr>
							<th>Sale ID</th>
							<th>Medicine ID</th>
							<th>Medicine Name</th>
							<th>Quantity Sold</th>
							<th>Total Price</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$sql = "SELECT sale_id, med_id, sale_qty, tot_price FROM sales_items";
					$result = $conn->query($sql);
					if ($result && $result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							$sql1 = "SELECT med_name FROM meds WHERE med_id='" . mysqli_real_escape_string($conn, $row['med_id']) . "'";
							$result1 = $conn->query($sql1);
							$medname = '';
							if ($result1 && $r1 = $result1->fetch_assoc()) $medname = $r1['med_name'];

							echo '<tr>';
							echo '<td>' . htmlspecialchars($row['sale_id']) . '</td>';
							echo '<td>' . htmlspecialchars($row['med_id']) . '</td>';
							echo '<td>' . htmlspecialchars($medname) . '</td>';
							echo '<td>' . htmlspecialchars($row['sale_qty']) . '</td>';
							echo '<td>' . htmlspecialchars($row['tot_price']) . '</td>';
							echo '</tr>';
						}
					} else {
						echo '<tr><td colspan="5" class="text-center">No sold products found.</td></tr>';
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
