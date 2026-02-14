<!DOCTYPE html>
<html>


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
				<a href="salesreport.php">Transactions - Last Month</a>				
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
						<li class="nav-item"><a class="nav-link" href="purchase-view.php">Manage Purchases</a></li>
					</ul>
					<div class="d-flex">
						<a class="btn btn-outline-secondary" href="logout.php">Logout</a>
					</div>
				</div>
			</div>
		</nav>

		<div class="container mt-5">
			<div class="row justify-content-center">
				<div class="col-12 col-md-10 col-lg-8">
					<div class="card shadow-sm">
						<div class="card-body">
							<h3 class="card-title text-center mb-4">Add Purchase</h3>

							<?php
								include "config.php";
                 
								if(isset($_POST['add']))
								{
								$pid = mysqli_real_escape_string($conn, $_REQUEST['pid']);
								$sid = mysqli_real_escape_string($conn, $_REQUEST['sid']);
								$mid = mysqli_real_escape_string($conn, $_REQUEST['mid']);
								$qty = mysqli_real_escape_string($conn, $_REQUEST['pqty']);
								$cost = mysqli_real_escape_string($conn, $_REQUEST['pcost']);
								$pdate = mysqli_real_escape_string($conn, $_REQUEST['pdate']);
								$mdate = mysqli_real_escape_string($conn, $_REQUEST['mdate']);
								$edate = mysqli_real_escape_string($conn, $_REQUEST['edate']);

								$sql = "INSERT INTO purchase VALUES ($pid, $sid, $mid,'$qty','$cost','$pdate','$mdate','$edate')";
								if(mysqli_query($conn, $sql)){
										echo "<p style='font-size:8;'>Purchase details successfully added!</p>";
								} else{
										echo "<p style='font-size:8;color:red;'>Error! Check details.</p>";
								}
                
								}
                 
								$conn->close();
							?>

							<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
								<div class="row g-3">
									<div class="col-12 col-md-6">
										<label for="pid" class="form-label">Purchase ID</label>
										<input type="number" class="form-control" name="pid" id="pid">
									</div>
									<div class="col-12 col-md-6">
										<label for="sid" class="form-label">Supplier ID</label>
										<input type="number" class="form-control" name="sid" id="sid">
									</div>
									<div class="col-12 col-md-6">
										<label for="mid" class="form-label">Medicine ID</label>
										<input type="number" class="form-control" name="mid" id="mid">
									</div>
									<div class="col-12 col-md-6">
										<label for="pqty" class="form-label">Purchase Quantity</label>
										<input type="number" class="form-control" name="pqty" id="pqty">
									</div>
									<div class="col-12 col-md-6">
										<label for="pcost" class="form-label">Purchase Cost</label>
										<input type="number" step="0.01" class="form-control" name="pcost" id="pcost">
									</div>
									<div class="col-12 col-md-6">
										<label for="pdate" class="form-label">Date of Purchase</label>
										<input type="date" class="form-control" name="pdate" id="pdate">
									</div>
									<div class="col-12 col-md-6">
										<label for="mdate" class="form-label">Manufacturing Date</label>
										<input type="date" class="form-control" name="mdate" id="mdate">
									</div>
									<div class="col-12 col-md-6">
										<label for="edate" class="form-label">Expiry Date</label>
										<input type="date" class="form-control" name="edate" id="edate">
									</div>
									<div class="col-12 text-center mt-3">
										<button type="submit" name="add" class="btn btn-primary">Add Purchase</button>
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