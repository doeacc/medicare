<!DOCTYPE html>
<html>


		<center>
		
		<select id="cid" name="cid">
			<option value="0" selected="selected">*Select Customer ID (only once for a customer's sales)</option>
					
					
	<?php	
			
		$qry1="SELECT c_id FROM customer";
		$result1= $conn->query($qry1);
		echo mysqli_error($conn);
		if ($result1->num_rows > 0) {
			while($row1 = $result1->fetch_assoc()) {
				
				echo "<option>".$row1["c_id"]."</option>";
				}}
    ?>
		
    </select>
	&nbsp;&nbsp;
	<input type="submit" name="custadd" value="Add to Proceed.">
	</form>
	
    <?php
			
		if(isset($_GET['sid'])) 
		{
			$sid=$_GET['sid'];
		}
		
		if(isset($_POST['cid']))
			$cid=$_POST['cid'];
		
		if(isset($_POST['custadd'])) {
			
				$qry2="INSERT INTO sales(c_id,e_id) VALUES ('$cid','$_SESSION[user]')";
				if(!($result2=$conn->query($qry2))) {
					echo "<p style='font-size:8; color:red;'>Invalid! Enter valid Customer ID to record Sales.</p>";	
		}}
			
			
	?>
			
		<form method="post">
		<select id="med" name="med">
			<option value="0" selected="selected">Select Medicine</option>
					
					
	<?php	
		$qry3="SELECT med_name FROM meds";
		$result3 = $conn->query($qry3);
		echo mysqli_error($conn);
		if ($result3->num_rows > 0) {
			while($row4 = $result3->fetch_assoc()) {
				
				echo "<option>".$row4["med_name"]."</option>";
		}}
    ?>
		
    </select>
	&nbsp;&nbsp;
	<input type="submit" name="search" value="Search">
	</form>
	
	<br><br><br>
	</center>
	
	
	<?php
	
		if(isset($_POST['search'])&&! empty($_POST['med'])) {
	
			$med=$_POST['med'];
			
			$qry4="SELECT * FROM meds where med_name='$med'";
			$result4=$conn->query($qry4); 
			$row4 = $result4 -> fetch_row();
					
		}
	?>
			<div class="one row" style="margin-right:160px;">
			<form method="post">
					<div class="column">
					
					<label for="medid">Medicine ID:</label>
					<input type="number" name="medid" value="<?php echo $row4[0]; ?>"readonly ><br><br>
					
					<label for="mdname">Medicine Name:</label>
					<input type="text" name="mdname" value="<?php echo $row4[1]; ?>" readonly><br><br>
					
					</div>
					<div class="column">
					
					<label for="mcat">Category:</label>
					<?php
					include "config.php";
					session_start();

					$alert = '';
					$order_link = '';
					$selected_med = null;

					// Fetch current employee name for header
					$ename = '';
					if (isset($_SESSION['user'])) {
							$rs = $conn->query("SELECT E_FNAME FROM EMPLOYEE WHERE E_ID='" . mysqli_real_escape_string($conn, $_SESSION['user']) . "'");
							if ($rs) { $r = $rs->fetch_row(); $ename = $r[0] ?? ''; }
					}

					// Handle adding customer (start a sale)
					if (isset($_POST['custadd'])) {
							$cid = mysqli_real_escape_string($conn, $_POST['cid'] ?? '');
							if ($cid === '' || $cid === '0') {
									$alert = '<div class="alert alert-danger">Please select a valid Customer ID.</div>';
							} else {
									$qry = "INSERT INTO sales(c_id,e_id) VALUES ('" . $cid . "','" . mysqli_real_escape_string($conn, $_SESSION['user']) . "')";
									if (!$conn->query($qry)) {
											$alert = '<div class="alert alert-danger">Invalid! Enter valid Customer ID to record Sales.</div>';
									} else {
											$alert = '<div class="alert alert-success">Sale started for customer ' . htmlspecialchars($cid) . '.</div>';
									}
							}
					}

					// Handle medicine search
					if (isset($_POST['search']) && !empty($_POST['med'])) {
							$med = mysqli_real_escape_string($conn, $_POST['med']);
							$res = $conn->query("SELECT * FROM meds WHERE med_name='" . $med . "'");
							if ($res && $res->num_rows > 0) {
									$selected_med = $res->fetch_assoc();
							} else {
									$alert = '<div class="alert alert-warning">Medicine not found.</div>';
							}
					}

					// Handle adding medicine to current sale
					if (isset($_POST['add'])) {
							// get latest sale id
							$res = $conn->query("SELECT sale_id FROM sales ORDER BY sale_id DESC LIMIT 1");
							$sid = ($res && $res->num_rows>0) ? $res->fetch_row()[0] : null;
							$mid = mysqli_real_escape_string($conn, $_POST['medid'] ?? '');
							$aqty = intval($_POST['mqty'] ?? 0);
							$qty = intval($_POST['mcqty'] ?? 0);
							$mprice = floatval($_POST['mprice'] ?? 0);

							if (!$sid) {
									$alert = '<div class="alert alert-danger">No active sale. Add a customer first.</div>';
							} elseif ($qty <= 0 || $qty > $aqty) {
									$alert = '<div class="alert alert-danger">Quantity invalid or exceeds available stock.</div>';
							} else {
									$price = $mprice * $qty;
									$ins = "INSERT INTO sales_items(`sale_id`,`med_id`,`sale_qty`,`tot_price`) VALUES($sid,$mid,$qty,$price)";
									if ($conn->query($ins)) {
											$order_link = '<a class="btn btn-success" href="pharm-pos2.php?sid=' . urlencode($sid) . '">View Order</a>';
									} else {
											$alert = '<div class="alert alert-danger">Error adding item to sale.</div>';
									}
							}
					}

					// Fetch customers and medicines for selects
					$customers = [];
					$rs = $conn->query("SELECT c_id FROM customer");
					if ($rs) { while ($r = $rs->fetch_assoc()) $customers[] = $r['c_id']; }

					$medicines = [];
					$rs2 = $conn->query("SELECT med_name FROM meds");
					if ($rs2) { while ($r = $rs2->fetch_assoc()) $medicines[] = $r['med_name']; }

					?>

					<!doctype html>
					<html lang="en">
						<head>
							<meta charset="utf-8">
							<meta name="viewport" content="width=device-width, initial-scale=1">
							<title>Point of Sale (Pharmacist)</title>
							<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
						</head>
						<body>
							<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
								<div class="container-fluid">
									<a class="navbar-brand" href="pharmmainpage.php">Pharmacist POS</a>
									<div class="d-flex">
										<a class="btn btn-outline-light" href="logout1.php">Logout<?php if($ename) echo ' ('.htmlspecialchars($ename).')'; ?></a>
									</div>
								</div>
							</nav>

							<div class="container py-4">
								<h2 class="mb-3">Point of Sale</h2>
								<?php echo $alert; ?>

								<div class="row g-4">
									<div class="col-md-6">
										<div class="card">
											<div class="card-body">
												<h5 class="card-title">Start Sale</h5>
												<form method="post" class="row g-2 align-items-end">
													<div class="col-8">
														<label class="form-label">Customer ID</label>
														<select name="cid" class="form-select">
															<option value="0">Select Customer ID</option>
															<?php foreach ($customers as $c): ?>
																<option value="<?php echo htmlspecialchars($c); ?>"><?php echo htmlspecialchars($c); ?></option>
															<?php endforeach; ?>
														</select>
													</div>
													<div class="col-4">
														<button type="submit" name="custadd" class="btn btn-primary w-100">Add</button>
													</div>
												</form>
											</div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="card">
											<div class="card-body">
												<h5 class="card-title">Find Medicine</h5>
												<form method="post" class="d-flex gap-2">
													<select name="med" class="form-select">
														<option value="">Select Medicine</option>
														<?php foreach ($medicines as $m): ?>
															<option value="<?php echo htmlspecialchars($m); ?>"><?php echo htmlspecialchars($m); ?></option>
														<?php endforeach; ?>
													</select>
													<button type="submit" name="search" class="btn btn-secondary">Search</button>
												</form>
											</div>
										</div>
									</div>
								</div>

								<?php if ($selected_med): ?>
								<div class="card mt-4">
									<div class="card-body">
										<h5 class="card-title">Medicine Details</h5>
										<form method="post" class="row g-3">
											<div class="col-md-3">
												<label class="form-label">Medicine ID</label>
												<input class="form-control" name="medid" value="<?php echo htmlspecialchars($selected_med['med_id'] ?? $selected_med['med_id']); ?>" readonly>
											</div>
											<div class="col-md-3">
												<label class="form-label">Name</label>
												<input class="form-control" name="mdname" value="<?php echo htmlspecialchars($selected_med['med_name'] ?? ''); ?>" readonly>
											</div>
											<div class="col-md-2">
												<label class="form-label">Category</label>
												<input class="form-control" name="mcat" value="<?php echo htmlspecialchars($selected_med['category'] ?? $selected_med['cat'] ?? $selected_med['med_type'] ?? ''); ?>" readonly>
											</div>
											<div class="col-md-2">
												<label class="form-label">Location</label>
												<input class="form-control" name="mloc" value="<?php echo htmlspecialchars($selected_med['location'] ?? $selected_med['loc'] ?? ''); ?>" readonly>
											</div>
											<div class="col-md-2">
												<label class="form-label">Available Qty</label>
												<input class="form-control" name="mqty" value="<?php echo htmlspecialchars($selected_med['qty'] ?? $selected_med['med_qty'] ?? $selected_med['QTY'] ?? ''); ?>" readonly>
											</div>
											<div class="col-md-3">
												<label class="form-label">Unit Price</label>
												<input class="form-control" name="mprice" value="<?php echo htmlspecialchars($selected_med['price'] ?? $selected_med['selling_price'] ?? $selected_med['sp'] ?? ''); ?>" readonly>
											</div>
											<div class="col-md-3">
												<label class="form-label">Quantity Required</label>
												<input class="form-control" type="number" name="mcqty" min="1">
											</div>
											<div class="col-md-6 d-flex align-items-end">
												<button type="submit" name="add" class="btn btn-primary me-2">Add Medicine</button>
												<?php echo $order_link; ?>
											</div>
										</form>
									</div>
								</div>
								<?php endif; ?>

							</div>

							<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
						</body>
					</html>