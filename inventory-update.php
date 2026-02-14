<?php
	include "config.php";
	
	if(isset($_GET['id']))
	{
		$id=$_GET['id'];
		$qry1="SELECT * FROM meds WHERE med_id='$id'";
		$result = $conn->query($qry1);
		$row = $result -> fetch_row();

	</body>

	<?php include 'footer.php'; ?>

	</html>
						<li class="nav-item"><a class="nav-link" href="inventory-view.php">Inventory</a></li>
					</ul>
					<div class="d-flex">
						<a class="btn btn-outline-secondary" href="logout.php">Logout</a>
					</div>
				</div>
			</div>
		<?php include 'header.php'; ?>

		<div class="container mt-4">
			<div class="row justify-content-center">
				<div class="col-12 col-md-8 col-lg-6">
					<div class="card shadow-sm">
						<div class="card-body">
							<h3 class="card-title text-center mb-3">Update Medicine</h3>

							<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
								<div class="row g-3">
									<div class="col-12">
										<label for="medid" class="form-label">Medicine ID</label>
										<input type="number" class="form-control" name="medid" value="<?php echo $row[0]; ?>" readonly>
									</div>
									<div class="col-12">
										<label for="medname" class="form-label">Medicine Name</label>
										<input type="text" class="form-control" name="medname" value="<?php echo $row[1]; ?>">
									</div>
									<div class="col-12 col-md-6">
										<label for="qty" class="form-label">Quantity</label>
										<input type="number" class="form-control" name="qty" value="<?php echo $row[2]; ?>">
									</div>
									<div class="col-12 col-md-6">
										<label for="cat" class="form-label">Category</label>
										<input type="text" class="form-control" name="cat" value="<?php echo $row[3]; ?>">
									</div>
									<div class="col-12 col-md-6">
										<label for="sp" class="form-label">Price</label>
										<input type="number" step="0.01" class="form-control" name="sp" value="<?php echo $row[4]; ?>">
									</div>
									<div class="col-12 col-md-6">
										<label for="loc" class="form-label">Location</label>
										<input type="text" class="form-control" name="loc" value="<?php echo $row[5]; ?>">
									</div>
									<div class="col-12 text-center mt-3">
										<button type="submit" name="update" class="btn btn-primary">Update</button>
									</div>
								</div>
							</form>
				
	<?php

								if( isset($_POST['medname'])||isset($_POST['qty'])||isset($_POST['cat'])||isset($_POST['sp'])||isset($_POST['loc'])) {
										 $id=$_POST['medid'];
										 $name=$_POST['medname'];
										 $qty=$_POST['qty'];
										 $cat=$_POST['cat'];
										 $price=$_POST['sp'];
										 $lcn=$_POST['loc'];
                     
								$sql="UPDATE meds SET med_name='$name',med_qty='$qty',category='$cat',med_price='$price',location_rack='$lcn' where med_id='$id'";
								if ($conn->query($sql))
								header("location:inventory-view.php");
								else
								echo "<p style='font-size:8;color:red;'>Error! Unable to update.</p>";
								}

	?>

						</div>
					</div>
				</div>
			</div>
		</div>

</body>

<script>
		<!-- Bootstrap Bundle JS -->
		(function(){
			var s = document.createElement('script');
			s.src = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js';
			s.integrity = 'sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+AMvyTG2vI5DkLtS3qm9Ekf5KkN0y';
			s.crossOrigin = 'anonymous';
			document.head.appendChild(s);
		})();

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