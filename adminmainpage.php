<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<title>Admin Dashboard</title>
</head>

<body>



	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container-fluid">
		<a class="navbar-brand" href="#">Medical Store - Admin</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsAdmin" aria-controls="navbarsAdmin" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarsAdmin">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item"><a class="nav-link" href="adminmainpage.php">Dashboard</a></li>
				<li class="nav-item"><a class="nav-link" href="inventory-view.php">Inventory</a></li>
				<li class="nav-item"><a class="nav-link" href="employee-view.php">Employees</a></li>
				<li class="nav-item"><a class="nav-link" href="salesreport.php">Reports</a></li>
			</ul>
			<div class="d-flex">
				<a class="btn btn-outline-secondary" href="logout.php">Logout</a>
			</div>
		</div>
	</div>
	<?php include 'header.php'; ?>

<div class="container py-4">
	<h2 class="mb-4 text-center">Admin Dashboard</h2>
	<div class="row g-4 justify-content-center">
		<div class="col-6 col-md-3 text-center">
			<a href="pos1.php" title="Add New Sale"><img src="carticon1.png" class="img-fluid rounded border" alt="Add New Sale"></a>
			<div class="mt-2">Add New Sale</div>
		</div>
		<div class="col-6 col-md-3 text-center">
			<a href="inventory-view.php" title="View Inventory"><img src="inventory.png" class="img-fluid rounded border" alt="Inventory"></a>
			<div class="mt-2">Inventory</div>
		</div>
		<div class="col-6 col-md-3 text-center">
			<a href="employee-view.php" title="View Employees"><img src="emp.png" class="img-fluid rounded border" alt="Employees"></a>
			<div class="mt-2">Employees</div>
		</div>
		<div class="col-6 col-md-3 text-center">
			<a href="salesreport.php" title="View Transactions"><img src="moneyicon.png" class="img-fluid rounded border" alt="Transactions"></a>
			<div class="mt-2">Transactions</div>
		</div>
		<div class="col-6 col-md-3 text-center">
			<a href="stockreport.php" title="Low Stock Alert"><img src="alert.png" class="img-fluid rounded border" alt="Low Stock"></a>
			<div class="mt-2">Low Stock</div>
		</div>
	</div>
</div>
	
	
</body>


</body>

<?php include 'footer.php'; ?>

</html>