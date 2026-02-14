<?php
include "config.php";

// Handle POST update
if (isset($_POST['update'])) {
		$pid = mysqli_real_escape_string($conn, $_POST['pid']);
		$sid = mysqli_real_escape_string($conn, $_POST['sid']);
		$mid = mysqli_real_escape_string($conn, $_POST['mid']);
		$qty = mysqli_real_escape_string($conn, $_POST['pqty']);
		$cost = mysqli_real_escape_string($conn, $_POST['pcost']);
		$pdate = mysqli_real_escape_string($conn, $_POST['pdate']);
		$mdate = mysqli_real_escape_string($conn, $_POST['mdate']);
		$edate = mysqli_real_escape_string($conn, $_POST['edate']);

		$sql = "UPDATE purchase SET p_cost='$cost', p_qty='$qty', pur_date='$pdate', mfg_date='$mdate', exp_date='$edate' \
						WHERE p_id='$pid' AND sup_id='$sid' AND med_id='$mid'";
		if ($conn->query($sql)) {
				header('Location: purchase-view.php');
				exit;
		} else {
				$error = 'Unable to update purchase.';
		}
}

// Load purchase row for GET
$row = null;
if (isset($_GET['pid']) && isset($_GET['sid']) && isset($_GET['mid'])) {
		$pid = mysqli_real_escape_string($conn, $_GET['pid']);
		$sid = mysqli_real_escape_string($conn, $_GET['sid']);
		$mid = mysqli_real_escape_string($conn, $_GET['mid']);
		$qry1 = "SELECT * FROM purchase WHERE p_id='$pid' AND sup_id='$sid' AND med_id='$mid'";
		$result = $conn->query($qry1);
		$row = $result->fetch_row();
}
?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Update Purchase</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
			<div class="container-fluid">
				<a class="navbar-brand" href="adminmainpage.php">Medical Store</a>
				<div class="d-flex">
					<a class="btn btn-outline-light" href="logout.php">Logout</a>
				</div>
			</div>
		</nav>

		<div class="container">
			<div class="card">
				<div class="card-header">Update Purchase Details</div>
				<div class="card-body">
					<?php if (!empty($error)) echo '<div class="alert alert-danger">'.htmlspecialchars($error).'</div>'; ?>
					<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . (isset($_GET['pid'])?('?pid='.urlencode($_GET['pid']).'&sid='.urlencode($_GET['sid']).'&mid='.urlencode($_GET['mid'])):'')); ?>">
						<div class="row g-3">
							<div class="col-md-4">
								<label class="form-label">Purchase ID</label>
								<input class="form-control" type="text" name="pid" value="<?php echo isset($row[0])?htmlspecialchars($row[0]):''; ?>" readonly>
							</div>
							<div class="col-md-4">
								<label class="form-label">Supplier ID</label>
								<input class="form-control" type="text" name="sid" value="<?php echo isset($row[1])?htmlspecialchars($row[1]):''; ?>" readonly>
							</div>
							<div class="col-md-4">
								<label class="form-label">Medicine ID</label>
								<input class="form-control" type="text" name="mid" value="<?php echo isset($row[2])?htmlspecialchars($row[2]):''; ?>" readonly>
							</div>
							<div class="col-md-6">
								<label class="form-label">Purchase Quantity</label>
								<input class="form-control" type="number" name="pqty" value="<?php echo isset($row[3])?htmlspecialchars($row[3]):''; ?>">
							</div>
							<div class="col-md-6">
								<label class="form-label">Purchase Cost</label>
								<input class="form-control" type="number" step="0.01" name="pcost" value="<?php echo isset($row[4])?htmlspecialchars($row[4]):''; ?>">
							</div>
							<div class="col-md-4">
								<label class="form-label">Date of Purchase</label>
								<input class="form-control" type="date" name="pdate" value="<?php echo isset($row[5])?htmlspecialchars($row[5]):''; ?>">
							</div>
							<div class="col-md-4">
								<label class="form-label">Manufacturing Date</label>
								<input class="form-control" type="date" name="mdate" value="<?php echo isset($row[6])?htmlspecialchars($row[6]):''; ?>">
							</div>
							<div class="col-md-4">
								<label class="form-label">Expiry Date</label>
								<input class="form-control" type="date" name="edate" value="<?php echo isset($row[7])?htmlspecialchars($row[7]):''; ?>">
							</div>
						</div>
						<div class="mt-3">
							<button type="submit" name="update" class="btn btn-primary">Update</button>
							<a href="purchase-view.php" class="btn btn-secondary ms-2">Cancel</a>
						</div>
					</form>
				</div>
			</div>
		</div>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	</body>
</html>