<?php

	include "config.php";
	<?php
	include "config.php";
	session_start();

	$ename = '';
	if (isset($_SESSION['user'])) {
			$sql = "SELECT E_FNAME FROM EMPLOYEE WHERE E_ID='" . mysqli_real_escape_string($conn, $_SESSION['user']) . "'";
			$res = $conn->query($sql);
			if ($res) {
					$r = $res->fetch_row();
					$ename = $r[0] ?? '';
			}
	}

	// Fetch inventory
	$items = [];
	$sql = "SELECT * FROM INVENTORY";
	$res = $conn->query($sql);
	if ($res) {
			while ($row = $res->fetch_assoc()) {
					$items[] = $row;
			}
	}

	$conn->close();
	?>
	<!doctype html>
	<html lang="en">
		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title>View Inventory (Pharmacist)</title>
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
				<h2 class="mb-3">Inventory</h2>
				<div class="table-responsive">
					<table class="table table-striped table-bordered">
						<thead class="table-dark">
							<tr>
								<th>Inventory ID</th>
								<th>Item Name</th>
								<th>Manufacturer</th>
								<th>Strength</th>
								<th>Batch ID</th>
								<th>Expiry Date</th>
								<th>MRP</th>
								<th>Quantity</th>
								<th>Company</th>
								<th>Selling Price</th>
								<th>Discount</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($items as $row): ?>
							<tr>
								<td><?php echo htmlspecialchars($row['INVENTORY_ID']); ?></td>
								<td><?php echo htmlspecialchars($row['ITEM_NAME']); ?></td>
								<td><?php echo htmlspecialchars($row['MANUFACTURER']); ?></td>
								<td><?php echo htmlspecialchars($row['STRENGTH']); ?></td>
								<td><?php echo htmlspecialchars($row['BATCH_ID']); ?></td>
								<td><?php echo htmlspecialchars($row['EXPIRY_DATE']); ?></td>
								<td><?php echo htmlspecialchars($row['MRP']); ?></td>
								<td><?php echo htmlspecialchars($row['QTY']); ?></td>
								<td><?php echo htmlspecialchars($row['COMPANY']); ?></td>
								<td><?php echo htmlspecialchars($row['SELLING_PRICE']); ?></td>
								<td><?php echo htmlspecialchars($row['DISCOUNT']); ?></td>
								<td>
									<a class="btn btn-sm btn-success" href="pharm-pos1.php?id=<?php echo urlencode($row['INVENTORY_ID']); ?>">Sell</a>
									<a class="btn btn-sm btn-primary" href="inventory-update.php?id=<?php echo urlencode($row['INVENTORY_ID']); ?>">Update</a>
									<a class="btn btn-sm btn-danger" href="inventory-delete.php?id=<?php echo urlencode($row['INVENTORY_ID']); ?>">Delete</a>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>

			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
		</body>
	</html>
			  dropdownContent.style.display = "block";
			  }
			  });
			}
			
</script>

</html>
