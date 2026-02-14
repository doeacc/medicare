<?php
include "config.php";
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Medicines - Low Stock</title>
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
			<div class="d-flex justify-content-between align-items-center mb-3">
				<h2 class="mb-0">Medicines Low On Stock (Less than 50)</h2>
			</div>

			<div class="table-responsive">
				<table class="table table-striped table-bordered align-middle">
					<thead class="table-light">
						<tr>
							<th>Medicine ID</th>
							<th>Medicine Name</th>
							<th>Quantity Available</th>
							<th>Category</th>
							<th>Price</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$result = mysqli_query($conn, "CALL `STOCK`();");
					if ($result && $result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							echo '<tr>';
							echo '<td>' . htmlspecialchars($row['med_id']) . '</td>';
							echo '<td>' . htmlspecialchars($row['med_name']) . '</td>';
							echo '<td class="text-danger fw-bold">' . htmlspecialchars($row['med_qty']) . '</td>';
							echo '<td>' . htmlspecialchars($row['category']) . '</td>';
							echo '<td>' . htmlspecialchars($row['med_price']) . '</td>';
							echo '</tr>';
						}
					} else {
						echo '<tr><td colspan="5" class="text-center">No low-stock medicines found.</td></tr>';
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
