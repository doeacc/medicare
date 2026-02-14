<?php
include "config.php";
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Stock Expiry Report</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
			<div class="container-fluid">
				<a class="navbar-brand" href="adminmainpage.php">Medical Store</a>
				<div class="d-flex">
					<a class="btn btn-outline-light" href="logout.php">Logout</a>
				</div>
			</div>
		</nav>

		<div class="container py-4">
			<h2 class="mb-3">Stock Expiring Within 6 Months</h2>

			<div class="table-responsive">
				<table class="table table-striped table-bordered align-middle">
					<thead class="table-light">
						<tr>
							<th>Purchase ID</th>
							<th>Supplier ID</th>
							<th>Medicine ID</th>
							<th>Quantity</th>
							<th>Cost</th>
							<th>Date of Purchase</th>
							<th>Manufacturing Date</th>
							<th>Expiry Date</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$result = mysqli_query($conn, "CALL `EXPIRY`();");
					if ($result && $result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							echo '<tr>';
							echo '<td>' . htmlspecialchars($row['p_id']) . '</td>';
							echo '<td>' . htmlspecialchars($row['sup_id']) . '</td>';
							echo '<td>' . htmlspecialchars($row['med_id']) . '</td>';
							echo '<td>' . htmlspecialchars($row['p_qty']) . '</td>';
							echo '<td>' . htmlspecialchars($row['p_cost']) . '</td>';
							echo '<td>' . htmlspecialchars($row['pur_date']) . '</td>';
							echo '<td>' . htmlspecialchars($row['mfg_date']) . '</td>';
							echo '<td class="text-danger fw-bold">' . htmlspecialchars($row['exp_date']) . '</td>';
							echo '</tr>';
						}
					} else {
						echo '<tr><td colspan="8" class="text-center">No expiring stock found.</td></tr>';
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
