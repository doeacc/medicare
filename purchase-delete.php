<?php
include "config.php";
$pid = isset($_GET['pid']) ? mysqli_real_escape_string($conn, $_GET['pid']) : '';
$sid = isset($_GET['sid']) ? mysqli_real_escape_string($conn, $_GET['sid']) : '';
$mid = isset($_GET['mid']) ? mysqli_real_escape_string($conn, $_GET['mid']) : '';

if ($pid === '' || $sid === '' || $mid === '') {
		header('Location: purchase-view.php');
		exit;
}

$sql = "DELETE FROM purchase WHERE p_id='$pid' AND sup_id='$sid' AND med_id='$mid'";
if ($conn->query($sql)) {
		header("Location: purchase-view.php");
		exit;
} else {
		?>
		<!doctype html>
		<html lang="en">
			<head>
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<title>Delete Purchase</title>
				<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
			</head>
			<body class="p-3">
				<div class="container">
					<div class="alert alert-danger">Failed to delete purchase. <a href="purchase-view.php" class="btn btn-sm btn-primary ms-2">Back</a></div>
				</div>
			</body>
		</html>
		<?php
}
?>