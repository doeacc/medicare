<?php
include "config.php";
$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';
if ($id === '') {
		header('Location: supplier-view.php');
		exit;
}
$sql = "DELETE FROM suppliers WHERE sup_id='$id'";
if ($conn->query($sql)) {
		header("Location: supplier-view.php");
		exit;
} else {
		// Show a simple Bootstrap-styled error page on failure
		?>
		<!doctype html>
		<html lang="en">
			<head>
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<title>Delete Supplier</title>
				<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
			</head>
			<body class="p-3">
				<div class="container">
					<div class="alert alert-danger">Failed to delete supplier. <a href="supplier-view.php" class="btn btn-sm btn-primary ms-2">Back</a></div>
				</div>
			</body>
		</html>
		<?php
}
?>