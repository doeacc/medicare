<?php
// Shared header include: navbar
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Medical Store</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="adminmainpage.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="inventory-view.php">Inventory</a></li>
                <li class="nav-item"><a class="nav-link" href="supplier-view.php">Suppliers</a></li>
                <li class="nav-item"><a class="nav-link" href="purchase-view.php">Purchases</a></li>
                <li class="nav-item"><a class="nav-link" href="employee-view.php">Employees</a></li>
                <li class="nav-item"><a class="nav-link" href="customer-view.php">Customers</a></li>
                <li class="nav-item"><a class="nav-link" href="pos1.php">POS</a></li>
                <li class="nav-item"><a class="nav-link" href="sales-view.php">Sales</a></li>
            </ul>
            <div class="d-flex">
                <a class="btn btn-outline-secondary" href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</nav>
