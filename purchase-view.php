<?php
include "config.php";
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Purchases</title>
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
						<li class="nav-item"><a class="nav-link active" href="purchase-view.php">Purchases</a></li>
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
				<h2 class="mb-0">Stock Purchases</h2>
				<a class="btn btn-success" href="purchase-add.php">Add New Purchase</a>
			</div>

			<div class="table-responsive">
				<table class="table table-striped table-bordered align-middle">
					<thead class="table-light">
						<tr>
							<th>Purchase ID</th>
							<th>Supplier ID</th>
							<th>Medicine ID</th>
							<th>Medicine Name</th>
							<th>Quantity</th>
							<th>Cost</th>
							<th>Purchase Date</th>
							<th>Mfg Date</th>
							<th>Expiry Date</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$sql = "SELECT p_id,sup_id,med_id,p_qty,p_cost,pur_date,mfg_date,exp_date FROM purchase";
					$result = $conn->query($sql);
					if ($result && $result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							// fetch medicine name
							$sql1 = "SELECT med_name FROM meds WHERE med_id='" . mysqli_real_escape_string($conn, $row['med_id']) . "'";
							$result1 = $conn->query($sql1);
							$medname = '';
							if ($result1 && $r1 = $result1->fetch_assoc()) $medname = $r1['med_name'];

							echo '<tr>';
							echo '<td>' . htmlspecialchars($row['p_id']) . '</td>';
							echo '<td>' . htmlspecialchars($row['sup_id']) . '</td>';
							echo '<td>' . htmlspecialchars($row['med_id']) . '</td>';
							echo '<td>' . htmlspecialchars($medname) . '</td>';
							echo '<td>' . htmlspecialchars($row['p_qty']) . '</td>';
							echo '<td>' . htmlspecialchars($row['p_cost']) . '</td>';
							echo '<td>' . htmlspecialchars($row['pur_date']) . '</td>';
							echo '<td>' . htmlspecialchars($row['mfg_date']) . '</td>';
							echo '<td>' . htmlspecialchars($row['exp_date']) . '</td>';
							echo '<td class="text-center">';
							echo '<a class="btn btn-sm btn-primary me-1" href="purchase-update.php?pid=' . urlencode($row['p_id']) . '&sid=' . urlencode($row['sup_id']) . '&mid=' . urlencode($row['med_id']) . '">Edit</a>';
							echo '<a class="btn btn-sm btn-danger" href="purchase-delete.php?pid=' . urlencode($row['p_id']) . '&sid=' . urlencode($row['sup_id']) . '&mid=' . urlencode($row['med_id']) . '" onclick="return confirm(\'Delete this purchase?\')">Delete</a>';
							echo '</td>';
							echo '</tr>';
						}
					} else {
						echo '<tr><td colspan="10" class="text-center">No purchases found.</td></tr>';
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
