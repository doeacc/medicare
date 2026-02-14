<?php
include "config.php";
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Transaction Reports</title>
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
			<h2 class="mb-3">Transaction Reports</h2>

			<form method="post" class="row g-3 mb-4">
				<div class="col-md-4">
					<label class="form-label">Start Date</label>
					<input class="form-control" type="date" name="start" required>
				</div>
				<div class="col-md-4">
					<label class="form-label">End Date</label>
					<input class="form-control" type="date" name="end" required>
				</div>
				<div class="col-md-4 align-self-end">
					<button type="submit" name="submit" class="btn btn-primary">View Records</button>
				</div>
			</form>

			<?php
			if (isset($_POST['submit'])) {
				$start = mysqli_real_escape_string($conn, $_POST['start']);
				$end = mysqli_real_escape_string($conn, $_POST['end']);

				// Purchase totals via DB function
				$res = mysqli_query($conn, "SELECT P_AMT('$start','$end') AS PAMT");
				$pamt = 0;
				if ($res) {
					while ($r = mysqli_fetch_array($res)) $pamt = $r['PAMT'];
				}

				// Sales totals via DB function
				$res = mysqli_query($conn, "SELECT S_AMT('$start','$end') AS SAMT");
				$samt = 0;
				if ($res) {
					while ($r = mysqli_fetch_array($res)) $samt = $r['SAMT'];
				}

				$profit = $samt - $pamt;
				$profits = number_format($profit, 2);
			?>

			<div class="row">
				<div class="col-lg-6 mb-4">
					<div class="card">
						<div class="card-header">Purchases (<?php echo htmlspecialchars($start) . ' to ' . htmlspecialchars($end); ?>)</div>
						<div class="card-body p-0">
							<div class="table-responsive">
								<table class="table table-striped mb-0">
									<thead class="table-light">
										<tr>
											<th>Purchase ID</th>
											<th>Supplier ID</th>
											<th>Medicine ID</th>
											<th>Quantity</th>
											<th>Date</th>
											<th>Cost (Rs)</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$sql = "SELECT p_id,sup_id,med_id,p_qty,p_cost,pur_date FROM purchase WHERE pur_date >= '$start' AND pur_date <= '$end'";
										$result = $conn->query($sql);
										if ($result && $result->num_rows > 0) {
											while ($row = $result->fetch_assoc()) {
												echo '<tr>';
												echo '<td>' . htmlspecialchars($row['p_id']) . '</td>';
												echo '<td>' . htmlspecialchars($row['sup_id']) . '</td>';
												echo '<td>' . htmlspecialchars($row['med_id']) . '</td>';
												echo '<td>' . htmlspecialchars($row['p_qty']) . '</td>';
												echo '<td>' . htmlspecialchars($row['pur_date']) . '</td>';
												echo '<td>' . htmlspecialchars($row['p_cost']) . '</td>';
												echo '</tr>';
											}
										} else {
											echo '<tr><td colspan="6" class="text-center">No purchase records.</td></tr>';
										}
										?>
										<tr>
											<td colspan="5" class="text-end fw-bold">Total</td>
											<td class="fw-bold">Rs.<?php echo htmlspecialchars($pamt); ?></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-6 mb-4">
					<div class="card">
						<div class="card-header">Sales (<?php echo htmlspecialchars($start) . ' to ' . htmlspecialchars($end); ?>)</div>
						<div class="card-body p-0">
							<div class="table-responsive">
								<table class="table table-striped mb-0">
									<thead class="table-light">
										<tr>
											<th>Sale ID</th>
											<th>Customer ID</th>
											<th>Employee ID</th>
											<th>Date</th>
											<th>Sale Amount (Rs)</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$sql = "SELECT sale_id, c_id, e_id, s_date, total_amt FROM sales WHERE s_date >= '$start' AND s_date <= '$end'";
										$result = $conn->query($sql);
										if ($result && $result->num_rows > 0) {
											while ($row = $result->fetch_assoc()) {
												echo '<tr>';
												echo '<td>' . htmlspecialchars($row['sale_id']) . '</td>';
												echo '<td>' . htmlspecialchars($row['c_id']) . '</td>';
												echo '<td>' . htmlspecialchars($row['e_id']) . '</td>';
												echo '<td>' . htmlspecialchars($row['s_date']) . '</td>';
												echo '<td>' . htmlspecialchars($row['total_amt']) . '</td>';
												echo '</tr>';
											}
										} else {
											echo '<tr><td colspan="5" class="text-center">No sales records.</td></tr>';
										}
										?>
										<tr>
											<td colspan="4" class="text-end fw-bold">Total</td>
											<td class="fw-bold">Rs.<?php echo htmlspecialchars($samt); ?></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Transaction Amount</h5>
					<p class="card-text">Rs.<?php echo htmlspecialchars($profits); ?></p>
				</div>
			</div>

			<?php
			}
			$conn->close();
			?>
		</div>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	</body>
</html>
