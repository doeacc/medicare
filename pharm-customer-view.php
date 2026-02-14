<?php
include "config.php";
session_start();

$search_result = null;
$search = '';
if (isset($_POST['search'])) {
	$search = mysqli_real_escape_string($conn, $_POST['valuetosearch'] ?? '');
	$query = "SELECT c_id, c_fname, c_lname, c_phno FROM customer WHERE CONCAT(c_id, c_fname, c_lname, c_phno) LIKE '%" . $search . "%'";
	$search_result = $conn->query($query);

	</div>
	
	<center>
	
	<div class="head">
	<h2>  CUSTOMER LIST</h2>
	</div>
	
	<form method="post">
	<input type="text" name="valuetosearch" placeholder="Enter any value to Search" style="width:400px; margin-left:250px;">&nbsp;&nbsp;&nbsp;
	<input type="submit" name="search" value="Search">
	<br><br>
	</form> 
	
	</center>

	
	<table align="right" id="table1" style="margin-right:100px;">
		<tr>
			<th>Customer ID</th>
			<th>First Name</th>
			<th>Last Name</th>
			
			<th>Phone Number</th>
		</tr>
		
	<?php
	
		if ($search_result->num_rows > 0) {
		while($row = $search_result->fetch_assoc()) {

		echo "<tr>";
			echo "<td>" . $row["c_id"]. "</td>";
			echo "<td>" . $row["c_fname"] . "</td>";
			echo "<td>" . $row["c_lname"]. "</td>";
			echo "<td>" . $row["c_phno"]. "</td>";
		echo "</tr>";
		}
		echo "</table>";
		} 

		$conn->close();
	?>
	
</body>

<script>
	
		var dropdown = document.getElementsByClassName("dropdown-btn");
		var i;

			<!doctype html>
			<html lang="en">
				<head>
					<meta charset="utf-8">
					<meta name="viewport" content="width=device-width, initial-scale=1">
					<title>Customers (Pharmacist)</title>
					<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
				</head>
				<body>
					<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
						<div class="container-fluid">
							<a class="navbar-brand" href="pharmmainpage.php">Pharmacist</a>
							<div class="d-flex">
								<?php
									$ename = '';
									if (isset($_SESSION['user'])) {
										$r = $conn->query("SELECT E_FNAME FROM EMPLOYEE WHERE E_ID='" . mysqli_real_escape_string($conn, $_SESSION['user']) . "'");
										if ($r) { $rr = $r->fetch_row(); $ename = $rr[0] ?? ''; }
									}
								?>
								<a class="btn btn-outline-light" href="logout1.php">Logout<?php if($ename) echo ' ('.htmlspecialchars($ename).')'; ?></a>
							</div>
						</div>
					</nav>

					<div class="container py-4">
						<h2 class="mb-3">Customer List</h2>

						<form method="post" class="row g-2 mb-3">
							<div class="col-md-8">
								<input type="text" name="valuetosearch" value="<?php echo htmlspecialchars($search); ?>" class="form-control" placeholder="Enter any value to search">
							</div>
							<div class="col-md-4 d-flex">
								<button type="submit" name="search" class="btn btn-primary me-2">Search</button>
								<a href="pharm-customer.php" class="btn btn-outline-secondary">Add New Customer</a>
							</div>
						</form>

						<div class="table-responsive">
							<table class="table table-striped table-bordered">
								<thead class="table-dark">
									<tr>
										<th>Customer ID</th>
										<th>First Name</th>
										<th>Last Name</th>
										<th>Phone Number</th>
									</tr>
								</thead>
								<tbody>
									<?php if ($search_result && $search_result->num_rows > 0): ?>
										<?php while ($row = $search_result->fetch_assoc()): ?>
											<tr>
												<td><?php echo htmlspecialchars($row['c_id']); ?></td>
												<td><?php echo htmlspecialchars($row['c_fname']); ?></td>
												<td><?php echo htmlspecialchars($row['c_lname']); ?></td>
												<td><?php echo htmlspecialchars($row['c_phno']); ?></td>
											</tr>
										<?php endwhile; ?>
									<?php else: ?>
										<tr><td colspan="4" class="text-center">No customers found.</td></tr>
									<?php endif; ?>
								</tbody>
							</table>
						</div>

					</div>

					<?php $conn->close(); ?>
					<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
				</body>
			</html>
