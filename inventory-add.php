<?php
include "config.php";

$message = '';
if (isset($_POST['add'])) {
	$id = mysqli_real_escape_string($conn, $_POST['medid']);
	$name = mysqli_real_escape_string($conn, $_POST['medname']);
	$qty = mysqli_real_escape_string($conn, $_POST['qty']);
	$category = mysqli_real_escape_string($conn, $_POST['cat']);
	$sprice = mysqli_real_escape_string($conn, $_POST['sp']);
	$location = mysqli_real_escape_string($conn, $_POST['loc']);

	$sql = "INSERT INTO meds VALUES ($id, '$name', $qty,'$category',$sprice, '$location')";
	if (mysqli_query($conn, $sql)) {
		$message = '<div class="alert alert-success">Medicine details successfully added!</div>';
	} else {
		$message = '<div class="alert alert-danger">Error adding medicine. Check details.</div>';
	}
}
?>

<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Bootstrap 5 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<title>Medicines</title>
</head>

<body>



	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">Medical Store</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item"><a class="nav-link" href="adminmainpage.php">Dashboard</a></li>
					<li class="nav-item"><a class="nav-link" href="inventory-view.php">Manage Inventory</a></li>
				</ul>
				<div class="d-flex">
					<a class="btn btn-outline-secondary" href="logout.php">Logout</a>
				</div>
			</div>
		</div>
	</nav>

	<div class="container mt-5">
		<?php echo $message; ?>
		<div class="row justify-content-center">
			<div class="col-12 col-md-9 col-lg-7">
				<div class="card shadow-sm">
					<div class="card-body">
						<h3 class="card-title text-center mb-4">Add Medicine</h3>
						<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
							<div class="row g-3">
								<div class="col-12 col-md-6">
									<label for="medid" class="form-label">Medicine ID</label>
									<input type="number" class="form-control" name="medid" id="medid">
								</div>
								<div class="col-12 col-md-6">
									<label for="medname" class="form-label">Medicine Name</label>
									<input type="text" class="form-control" name="medname" id="medname">
								</div>
								<div class="col-12 col-md-4">
									<label for="qty" class="form-label">Quantity</label>
									<input type="number" class="form-control" name="qty" id="qty">
								</div>
								<div class="col-12 col-md-4">
									<label for="sp" class="form-label">Price</label>
									<input type="number" step="0.01" class="form-control" name="sp" id="sp">
								</div>
								<div class="col-12 col-md-4">
									<label for="cat" class="form-label">Category</label>
									<select id="cat" name="cat" class="form-select">
										<option>Tablet</option>
										<option>Capsule</option>
										<option>Syrup</option>
									</select>
								</div>
								<div class="col-12">
									<label for="loc" class="form-label">Location</label>
									<input type="text" class="form-control" name="loc" id="loc">
								</div>
								<div class="col-12 text-center mt-3">
									<button type="submit" name="add" class="btn btn-primary">Add Medicine</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php $conn->close(); ?>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
	var dropdown = document.getElementsByClassName("dropdown-btn");
	var i;

	for (i = 0; i < dropdown.length; i++) {
		dropdown[i].addEventListener("click", function() {
			this.classList.toggle("active");
			var dropdownContent = this.nextElementSibling;
			if (dropdownContent.style.display === "block") {
				dropdownContent.style.display = "none";
			} else {
				dropdownContent.style.display = "block";
			}
		});
	}

</script>

</html>


