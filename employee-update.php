
</body>

<?php include 'footer.php'; ?>

</html>
					e_type='$etype',e_jdate='$jdate',e_sal='$sal',e_phno='$phno',e_mail='$mail',e_add='$add' WHERE e_id='$id'";

			if ($conn->query($sql)) {
				header("Location: employee-view.php");
				exit;

			</button>
			<div class="dropdown-container">
				<a href="purchase-add.php">Add New Purchase</a>
				<a href="purchase-view.php">Manage Purchases</a>
			</div>		
			<button class="dropdown-btn">Employees
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="employee-add.php">Add New Employee</a>
				<a href="employee-view.php">Manage Employees</a>
			</div>			
			<button class="dropdown-btn">Customers
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="customer-add.php">Add New Customer</a>
				<a href="customer-view.php">Manage Customers</a>
			</div>
			<a href="sales-view.php">View Sales Invoice Details</a>
			<a href="salesitems-view.php">View Sold Products Details</a>
			<a href="pos1.php">Add New Sale</a>		
			<button class="dropdown-btn">Reports
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="stockreport.php">Medicines - Low Stock</a>
				<a href="expiryreport.php">Medicines - Soon to Expire</a>
				<a href="salesreport.php">Transactions Reports</a>			
			</div>		
	</div>

		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container-fluid">
				<a class="navbar-brand" href="#">Medical Store</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item"><a class="nav-link" href="adminmainpage.php">Dashboard</a></li>
						<li class="nav-item"><a class="nav-link" href="employee-view.php">Employees</a></li>
					</ul>
					<div class="d-flex">
						<a class="btn btn-outline-secondary" href="logout.php">Logout</a>
					</div>
				</div>
			</div>
		</nav>

		<div class="container mt-4">
			<div class="row justify-content-center">
				<div class="col-12 col-md-10 col-lg-8">
					<div class="card shadow-sm">
						<div class="card-body">
							<h3 class="card-title text-center mb-3">Update Employee</h3>

		<?php echo $message; ?>

							<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
								<div class="row g-3">
									<div class="col-12 col-md-6">
										<label for="eid" class="form-label">Employee ID</label>
										<input type="number" class="form-control" name="eid" value="<?php echo $row[0]; ?>" readonly>
									</div>
									<div class="col-12 col-md-6">
										<label for="efname" class="form-label">First Name</label>
										<input type="text" class="form-control" name="efname" value="<?php echo $row[1]; ?>">
									</div>
									<div class="col-12 col-md-6">
										<label for="elname" class="form-label">Last Name</label>
										<input type="text" class="form-control" name="elname" value="<?php echo $row[2]; ?>">
									</div>
									<div class="col-12 col-md-6">
										<label for="ebdate" class="form-label">Date of Birth</label>
										<input type="date" class="form-control" name="ebdate" value="<?php echo $row[3]; ?>">
									</div>
									<div class="col-12 col-md-4">
										<label for="eage" class="form-label">Age</label>
										<input type="number" class="form-control" name="eage" value="<?php echo $row[4]; ?>">
									</div>
									<div class="col-12 col-md-4">
										<label for="esex" class="form-label">Sex</label>
										<input type="text" class="form-control" name="esex" value="<?php echo $row[5]; ?>">
									</div>
									<div class="col-12 col-md-4">
										<label for="etype" class="form-label">Employee Type</label>
										<input type="text" class="form-control" name="etype"  value="<?php echo $row[6]; ?>">
									</div>
									<div class="col-12 col-md-6">
										<label for="ejdate" class="form-label">Date of Joining</label>
										<input type="date" class="form-control" name="ejdate" value="<?php echo $row[7]; ?>">
									</div>
									<div class="col-12 col-md-6">
										<label for="esal" class="form-label">Salary</label>
										<input type="number" step="0.01" class="form-control" name="esal" value="<?php echo $row[8]; ?>">
									</div>
									<div class="col-12 col-md-6">
										<label for="ephno" class="form-label">Phone Number</label>
										<input type="number" class="form-control" name="ephno" value="<?php echo $row[9]; ?>">
									</div>
									<div class="col-12 col-md-6">
										<label for="e_mail" class="form-label">Email ID</label>
										<input type="email" class="form-control" name="e_mail"  value="<?php echo $row[10]; ?>">
									</div>
									<div class="col-12">
										<label for="eadd" class="form-label">Address</label>
										<input type="text" class="form-control" name="eadd"  value="<?php echo $row[11]; ?>">
									</div>
									<div class="col-12 text-center mt-3">
										<button type="submit" name="update" class="btn btn-primary">Update</button>
									</div>
								</div>
							</form>

						</div>
					</div>
				</div>
			</div>
		</div>

</body>

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