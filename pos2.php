<?php
include "config.php";

// Determine sale id
$sid = '';
if (isset($_GET['sid'])) {
		$sid = mysqli_real_escape_string($conn, $_GET['sid']);
}
if (empty($sid)) {
		$sql = "SHOW TABLE STATUS LIKE 'sales'";
		$result = $conn->query($sql);
		if ($result) {
				$row = $result->fetch_assoc();
				$sid = $row['Auto_increment'] - 1;
		}
}
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
				<div class="d-flex">
					<a class="btn btn-outline-light" href="logout.php">Logout</a>
				</div>
			</div>
		</nav>

		<div class="container py-4">
			<div class="d-flex justify-content-between align-items-center mb-3">
				<h2 class="mb-0">Sales Invoice</h2>
				<div>
					<a class="btn btn-secondary" href="pos1.php<?php echo $sid?('?sid='.urlencode($sid)):''; ?>">Back to Sales Page</a>
				</div>
			</div>

			<div class="table-responsive">
				<table class="table table-striped table-bordered align-middle">
					<thead class="table-light">
						<tr>
							<th>Medicine ID</th>
							<th>Medicine Name</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Total Price</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
					if (!empty($sid)) {
							$qry1 = "SELECT med_id, sale_qty, tot_price FROM sales_items WHERE sale_id='" . mysqli_real_escape_string($conn, $sid) . "'";
							$result1 = $conn->query($qry1);
							if ($result1 && $result1->num_rows > 0) {
									while ($row1 = $result1->fetch_assoc()) {
											$medid = mysqli_real_escape_string($conn, $row1['med_id']);
											$qry2 = "SELECT med_name, med_price FROM meds WHERE med_id='" . $medid . "'";
											$result2 = $conn->query($qry2);
											$row2 = $result2 ? $result2->fetch_row() : [ '', '' ];
											echo '<tr>';
											echo '<td>' . htmlspecialchars($row1['med_id']) . '</td>';
											echo '<td>' . htmlspecialchars($row2[0]) . '</td>';
											echo '<td>' . htmlspecialchars($row1['sale_qty']) . '</td>';
											echo '<td>' . htmlspecialchars($row2[1]) . '</td>';
											echo '<td>' . htmlspecialchars($row1['tot_price']) . '</td>';
											echo '<td class="text-center">';
											echo '<a class="btn btn-sm btn-danger" href="pos-delete.php?mid=' . urlencode($row1['med_id']) . '&slid=' . urlencode($sid) . '" onclick="return confirm(\'Remove this item?\')">Delete</a>';
											echo '</td>';
											echo '</tr>';
									}
							} else {
									echo '<tr><td colspan="6" class="text-center">No items in this sale.</td></tr>';
							}
					} else {
							echo '<tr><td colspan="6" class="text-center">No sale selected.</td></tr>';
					}
					?>
					</tbody>
				</table>
			</div>

			<div class="mt-3">
				<form method="post">
					<button type="submit" name="custadd" class="btn btn-primary">Complete Order</button>
				</form>
			</div>

			<?php
			if (isset($_POST['custadd']) && !empty($sid)) {
					// Call stored procedure to compute total
					mysqli_query($conn, "SET @p0='" . mysqli_real_escape_string($conn, $sid) . "';");
					mysqli_query($conn, "CALL `TOTAL_AMT`(@p0,@p1);");
					$res = mysqli_query($conn, "SELECT @p1 as TOTAL;");
					$tot = 0;
					if ($res) {
							while ($row3 = mysqli_fetch_array($res)) {
									$tot = $row3['TOTAL'];
							}
					}
					echo '<div class="card mt-3"><div class="card-body">';
					echo '<h5 class="card-title">Order Total</h5>';
					echo '<p class="card-text">' . htmlspecialchars($tot) . '</p>';
					echo '<a href="sales-view.php" class="btn btn-success">View Sales</a>';
					echo '</div></div>';
			}
			?>

		</div>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	</body>
</html>