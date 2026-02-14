<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Bootstrap 5 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ENjdO4Dr2bkBIFxQpeoYz1H6kQb1QZ1Zr+3l6Z6Y5nI1wGmZ4x0Q5tzt+2QvQ4Q" crossorigin="anonymous">
<title>
New Sales
</title>
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
						<li class="nav-item"><a class="nav-link" href="pos2.php">View Orders</a></li>
					</ul>
					<div class="d-flex">
						<a class="btn btn-outline-secondary" href="logout.php">Logout</a>
					</div>
				</div>
			</div>
		<?php include 'header.php'; ?>

		<div class="container mt-4">
			<div class="row justify-content-center">
				<div class="col-12 col-md-10 col-lg-8">
					<div class="card shadow-sm mb-4">
						<div class="card-body">
							<h3 class="card-title text-center mb-3">Point of Sale</h3>

							<form action="<?=$_SERVER['PHP_SELF']?>" method="post" class="row g-2 align-items-end">
								<div class="col-auto flex-grow-1">
									<label for="cid" class="form-label">Customer ID</label>
									<select id="cid" name="cid" class="form-select">
										<option value="0" selected>*Select Customer ID (only once for customer's sales)</option>
										<?php
											include "config.php";
											$qry="SELECT c_id FROM customer";
											$result= $conn->query($qry);
											echo mysqli_error($conn);
											if ($result->num_rows > 0) {
												while($row = $result->fetch_assoc()) {
													echo "<option>".$row["c_id"]."</option>";
												}
											}
										?>
									</select>
								</div>
								<div class="col-auto">
									<button type="submit" name="custadd" class="btn btn-primary">Proceed</button>
								</div>
							</form>

						</div>
					</div>
	
		
	<?php
	
							<form method="post" class="row g-3 align-items-end">
								<div class="col-12 col-md-8">
									<label for="med" class="form-label">Select Medicine</label>
									<select id="med" name="med" class="form-select">
										<option value="0" selected>Select Medicine</option>
										<?php
											$qry3="SELECT med_name FROM meds";
											$result3 = $conn->query($qry3);
											echo mysqli_error($conn);
											if ($result3->num_rows > 0) {
												while($row4 = $result3->fetch_assoc()) {
													echo "<option>".$row4["med_name"]."</option>";
												}
											}
										?>
									</select>
								</div>
								<div class="col-auto">
									<button type="submit" name="search" class="btn btn-secondary">Search</button>
								</div>
							</form>

							<?php
								if(isset($_POST['search']) && ! empty($_POST['med'])) {
									$med=$_POST['med'];
									$qry4="SELECT * FROM meds where med_name='$med'";
									$result4=$conn->query($qry4);
									$row4 = $result4 -> fetch_row();
								}
							?>

							<div class="card mt-4">
								<div class="card-body">
									<form method="post" class="row g-3">
										<div class="col-12 col-md-4">
											<label class="form-label">Medicine ID</label>
											<input type="number" class="form-control" name="medid" value="<?php echo isset($row4[0]) ? $row4[0] : ''; ?>" readonly>
										</div>
										<div class="col-12 col-md-4">
											<label class="form-label">Medicine Name</label>
											<input type="text" class="form-control" name="mdname" value="<?php echo isset($row4[1]) ? $row4[1] : ''; ?>" readonly>
										</div>
										<div class="col-12 col-md-4">
											<label class="form-label">Category</label>
											<input type="text" class="form-control" name="mcat" value="<?php echo isset($row4[3]) ? $row4[3] : ''; ?>" readonly>
										</div>
										<div class="col-12 col-md-4">
											<label class="form-label">Location</label>
											<input type="text" class="form-control" name="mloc" value="<?php echo isset($row4[5]) ? $row4[5] : ''; ?>" readonly>
										</div>
										<div class="col-12 col-md-4">
											<label class="form-label">Quantity Available</label>
											<input type="number" class="form-control" name="mqty" value="<?php echo isset($row4[2]) ? $row4[2] : ''; ?>" readonly>
										</div>
										<div class="col-12 col-md-4">
											<label class="form-label">Price per Unit</label>
											<input type="number" class="form-control" name="mprice" value="<?php echo isset($row4[4]) ? $row4[4] : ''; ?>" readonly>
										</div>
										<div class="col-12 col-md-6">
											<label class="form-label">Quantity Required</label>
											<input type="number" class="form-control" name="mcqty">
										</div>
										<div class="col-12 col-md-6 d-flex align-items-end">
											<button type="submit" name="add" class="btn btn-primary">Add Medicine</button>
										</div>
									</form>

									<?php
										if(isset($_POST['add'])) {
											$qry5="select sale_id from sales ORDER BY sale_id DESC LIMIT 1";
											$result5=$conn->query($qry5);
											$row5=$result5->fetch_row();
											$sid=$row5[0];
											echo mysqli_error($conn);

											$mid=$_POST['medid'];
											$aqty=$_POST['mqty'];
											$qty=$_POST['mcqty'];

											if($qty>$aqty||$qty==0) {
												echo "<div class='text-danger mt-2'>QUANTITY INVALID!</div>";
											} else {
												$price=$_POST['mprice']*$qty;
												$qry6="INSERT INTO sales_items(`sale_id`,`med_id`,`sale_qty`,`tot_price`) VALUES($sid,$mid,$qty,$price)";
												$result6 = mysqli_query($conn,$qry6);
												echo mysqli_error($conn);

												echo "<div class='text-center mt-3'><a class='btn btn-outline-primary' href=pos2.php?sid=".$sid.">View Order</a></div>";
											}
										}
									?>

								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
					$mid=$_POST['medid'];
					$aqty=$_POST['mqty'];
					$qty=$_POST['mcqty'];
					
					if($qty>$aqty||$qty==0)
					{echo "QUANTITY INVALID!";}
					else {
					$price=$_POST['mprice']*$qty;
					$qry6="INSERT INTO sales_items(`sale_id`,`med_id`,`sale_qty`,`tot_price`) VALUES($sid,$mid,$qty,$price)";
					$result6 = mysqli_query($conn,$qry6);
					echo mysqli_error($conn);
					
					echo "<br><br> <center>";
					echo "<a class='button1 view-btn' href=pos2.php?sid=".$sid.">View Order</a>";
					echo "</center>";
					}
		}	
		?>

		
		</form>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>