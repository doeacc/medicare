<?php
include "config.php";
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Sales Invoice</title>
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
			<div class="d-flex justify-content-between align-items-center mb-3">
				<h2 class="mb-0">Sales Invoice Details</h2>
				<a class="btn btn-success" href="pos1.php">Add New Sale</a>
			</div>

			<div class="table-responsive">
				<table class="table table-striped table-bordered align-middle">
					<thead class="table-light">
						<tr>
							<th>Sale ID</th>
							<th>Customer ID</th>
							<th>Date and Time</th>
							<th>Sale Amount</th>
							<th>Employee ID</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$sql = "SELECT sale_id, c_id, s_date, s_time, total_amt, e_id FROM sales";
					$result = $conn->query($sql);
					if ($result && $result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							echo '<tr>';
							echo '<td>' . htmlspecialchars($row['sale_id']) . '</td>';
							echo '<td>' . htmlspecialchars($row['c_id']) . '</td>';
							echo '<td>' . htmlspecialchars($row['s_date']) . ' ' . htmlspecialchars($row['s_time']) . '</td>';
							echo '<td>' . htmlspecialchars($row['total_amt']) . '</td>';
							echo '<td>' . htmlspecialchars($row['e_id']) . '</td>';
							echo '</tr>';
						}
					} else {
						echo '<tr><td colspan="5" class="text-center">No sales found.</td></tr>';
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
