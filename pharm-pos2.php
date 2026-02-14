<?php
include "config.php";
session_start();

$alert = '';
$total = null;

$ename = '';
if (isset($_SESSION['user'])) {
		$rs = $conn->query("SELECT E_FNAME FROM EMPLOYEE WHERE E_ID='" . mysqli_real_escape_string($conn, $_SESSION['user']) . "'");
		if ($rs) { $r = $rs->fetch_row(); $ename = $r[0] ?? ''; }
}

// Determine sale id
$sid = null;
if (isset($_GET['sid'])) $sid = intval($_GET['sid']);
if (!$sid) {
		$res = $conn->query("SHOW TABLE STATUS LIKE 'sales'");
		if ($res) {
				$row = $res->fetch_assoc();
				$sid = max(0, intval($row['Auto_increment']) - 1);
		}
}

// Handle completion (calculate total via stored proc)
if (isset($_POST['custadd']) && $sid) {
		$conn->query("SET @p0=" . intval($sid));
		$conn->query("CALL TOTAL_AMT(@p0,@p1)");
		$res = $conn->query("SELECT @p1 as TOTAL");
		if ($res) {
				$r = $res->fetch_assoc();
				$total = $r['TOTAL'] ?? null;
				$alert = '<div class="alert alert-success">Order total: ' . htmlspecialchars($total) . '</div>';
		} else {
				$alert = '<div class="alert alert-danger">Error calculating total.</div>';
		}
}

// Fetch sale items
$items = [];
if ($sid) {
		$res = $conn->query("SELECT med_id,sale_qty,tot_price FROM sales_items WHERE sale_id=" . intval($sid));
		if ($res) {
				while ($r = $res->fetch_assoc()) {
						$mid = intval($r['med_id']);
						$mres = $conn->query("SELECT med_name, med_price FROM meds WHERE med_id=" . $mid);
						$mrow = $mres ? $mres->fetch_assoc() : null;
						$items[] = [
								'med_id' => $mid,
								'med_name' => $mrow['med_name'] ?? '',
								'med_price' => $mrow['med_price'] ?? '',
								'sale_qty' => $r['sale_qty'],
								'tot_price' => $r['tot_price']
						];
				}
		}
}

?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Sales Invoice (Pharmacist)</title>
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
			<h2 class="mb-3">Sales Invoice</h2>
			<?php echo $alert; ?>

			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead class="table-dark">
						<tr>
							<th>Medicine ID</th>
							<th>Medicine Name</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Total Price</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php if (count($items) === 0): ?>
							<tr><td colspan="6" class="text-center">No items in this sale.</td></tr>
						<?php else: ?>
							<?php foreach ($items as $it): ?>
								<tr>
									<td><?php echo htmlspecialchars($it['med_id']); ?></td>
									<td><?php echo htmlspecialchars($it['med_name']); ?></td>
									<td><?php echo htmlspecialchars($it['sale_qty']); ?></td>
									<td><?php echo htmlspecialchars($it['med_price']); ?></td>
									<td><?php echo htmlspecialchars($it['tot_price']); ?></td>
									<td><a class="btn btn-sm btn-danger" href="pharm-pos-delete.php?mid=<?php echo urlencode($it['med_id']); ?>&slid=<?php echo urlencode($sid); ?>">Delete</a></td>
								</tr>
							<?php endforeach; ?>
						<?php endif; ?>
					</tbody>
				</table>
			</div>

			<div class="d-flex gap-2 mt-3">
				<a class="btn btn-secondary" href="pharm-pos1.php?sid=<?php echo urlencode($sid); ?>">Go Back to Sales Page</a>
				<form method="post" class="m-0">
					<button type="submit" name="custadd" class="btn btn-primary">Complete Order</button>
				</form>
			</div>

		</div>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	</body>
</html>