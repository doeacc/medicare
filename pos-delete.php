<?php
include "config.php";
$slid = isset($_GET['slid']) ? mysqli_real_escape_string($conn, $_GET['slid']) : '';
$mid = isset($_GET['mid']) ? mysqli_real_escape_string($conn, $_GET['mid']) : '';
if ($slid === '' || $mid === '') {
		header('Location: pos2.php');
		exit;
}
$sql = "DELETE FROM sales_items WHERE sale_id='$slid' AND med_id='$mid'";
if ($conn->query($sql)) {
		header('Location: pos2.php?sid=' . urlencode($slid));
		exit;
} else {
		?>
		<!doctype html>
		<html lang="en">
			<head>
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<title>Delete Item</title>
				<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
			</head>
			<body class="p-3">
				<div class="container">
					<div class="alert alert-danger">Failed to remove item. <a href="pos2.php?sid=<?php echo urlencode($slid); ?>" class="btn btn-sm btn-primary ms-2">Back</a></div>
				</div>
			</body>
		</html>
		<?php
}
?>


