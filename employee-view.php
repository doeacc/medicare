<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap 5 -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ENjdO4Dr2bkBIFxQpeoYz1H6kQb1QZ1Zr+3l6Z6Y5nI1wGmZ4x0Q5tzt+2QvQ4Q" crossorigin="anonymous">
<title>Employees</title>
</head>
Employees
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
						<li class="nav-item"><a class="nav-link" href="employee-add.php">Add Employee</a></li>
					</ul>
					<div class="d-flex">
						<a class="btn btn-outline-secondary" href="logout.php">Logout</a>
					</div>
				</div>
			</div>
		<?php include 'header.php'; ?>

		<div class="container mt-4">
			<div class="d-flex justify-content-between align-items-center mb-3">
				<h3 class="m-0">Employee List</h3>
			</div>

			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Employee ID</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Date of Birth</th>
							<th>Age</th>
							<th>Sex</th>
							<th>Employee Type</th>
							<th>Date of Joining</th>
							<th>Salary</th>
							<th>Phone Number</th>
							<th>Email Address</th>
							<th>Home Address</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
		<?php

		include "config.php";
		$sql = "SELECT e_id, e_fname, e_lname, bdate, e_age, e_sex, e_type, e_jdate, e_sal, e_phno, e_mail, e_add FROM employee where e_id<>1";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {

		while($row = $result->fetch_assoc()) {

		echo "<tr>";
				echo "<td>" . $row["e_id"]. "</td>";
				echo "<td>" . $row["e_fname"] . "</td>";
				echo "<td>" . $row["e_lname"] . "</td>";
				echo "<td>" . $row["bdate"] . "</td>";
				echo "<td>" . $row["e_age"]. "</td>";
				echo "<td>" . $row["e_sex"]. "</td>";
				echo "<td>" . $row["e_type"]. "</td>";
				echo "<td>" . $row["e_jdate"]. "</td>";
				echo "<td>" . $row["e_sal"]. "</td>";
				echo "<td>" . $row["e_phno"]. "</td>";
				echo "<td>" . $row["e_mail"]. "</td>";
				echo "<td>" . $row["e_add"]. "</td>";
				echo "<td class='text-center'>";
				echo "<a class='btn btn-sm btn-primary me-2' href=employee-update.php?id=".$row['e_id'].">Edit</a>";
				echo "<a onclick='return confirm(\'Are you sure to delete?\');' class='btn btn-sm btn-danger' href=employee-delete.php?id=".$row['e_id'].">Delete</a>";
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

<?php include 'footer.php'; ?>

</html>

