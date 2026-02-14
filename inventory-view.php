<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap 5 -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ENjdO4Dr2bkBIFxQpeoYz1H6kQb1QZ1Zr+3l6Z6Y5nI1wGmZ4x0Q5tzt+2QvQ4Q" crossorigin="anonymous">
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
						<li class="nav-item"><a class="nav-link" href="inventory-add.php">Add Medicine</a></li>
					</ul>
					<div class="d-flex">
						<a class="btn btn-outline-secondary" href="logout.php">Logout</a>
					</div>
				</div>
			</div>
		</nav>

		<div class="container mt-4">
			<div class="d-flex justify-content-between align-items-center mb-3">
				<h3 class="m-0">Medicine Inventory</h3>
			</div>

			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Medicine ID</th>
							<th>Medicine Name</th>
							<th>Quantity Available</th>
							<th>Category</th>
							<th>Price</th>
							<th>Location in Store</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
		<?php
		include "config.php";

				$sql = "SELECT med_id, med_name,med_qty,category,med_price,location_rack FROM meds";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
        
				while($row = $result->fetch_assoc()) {

				echo "<tr>";
						echo "<td>" . $row["med_id"]. "</td>";
						echo "<td>" . $row["med_name"] . "</td>";
						echo "<td>" . $row["med_qty"]. "</td>";
						echo "<td>" . $row["category"]. "</td>";
						echo "<td>" . $row["med_price"] . "</td>";
						echo "<td>" . $row["location_rack"]. "</td>";
						echo "<td class='text-center'>";
								echo "<a class='btn btn-sm btn-primary me-2' href=inventory-update.php?id=".$row['med_id'].">Edit</a>";
								echo "<a class='btn btn-sm btn-danger' href=inventory-delete.php?id=".$row['med_id'].">Delete</a>";
						echo "</td>";
				echo "</tr>";
				}
				}

		$conn->close();
		?>
					</tbody>
				</table>
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
