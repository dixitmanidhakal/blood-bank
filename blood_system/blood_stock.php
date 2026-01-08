<?php 
session_start(); 
if(!isset($_SESSION['admin'])) { header('Location: admin_login.php'); exit; }
include 'config.php';

// ADD STOCK
if(isset($_POST['add_stock'])) {
    $blood_type = $_POST['blood_type'];
    $units = $_POST['units'];
    $conn->query("INSERT INTO blood_inventory (blood_type, units,) VALUES ('$blood_type', $units)");
}

// DELETE STOCK
if(isset($_GET['delete_stock'])) {
    $conn->query("DELETE FROM blood_inventory WHERE id = " . $_GET['delete_stock']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Blood Stock Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark bg-danger">
    <div class="container">
        <a class="navbar-brand"><i class="fas fa-cubes"></i> Blood Stock</a>
        <a href="admin_dashboard.php" class="btn btn-light">Dashboard</a>
    </div>
</nav>

<div class="container mt-4">
    <!-- ADD STOCK FORM -->
    <div class="card mb-4">
        <div class="card-header bg-info text-white">
            <h4><i class="fas fa-plus"></i> Add Blood Stock</h4>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="row">
                    <div class="col-md-3">
                        <select class="form-select" name="blood_type" required>
                            <option value="">Blood Type</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                        </select>
                    </div>
                    <div class="col-md-2"><input type="number" class="form-control" name="units" placeholder="Units" required></div>

                    
                    <div class="col-md-2"><button class="btn btn-info w-100" name="add_stock">Add Stock</button></div>
                </div>
            </form>
        </div>
    </div>

    <!-- STOCK TABLE -->
    <div class="card">
        <div class="card-header bg-warning text-dark">
            <h4>Blood Inventory (<?= $conn->query("SELECT SUM(units) as total FROM blood_inventory")->fetch_assoc()['total'] ?> units)</h4>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Blood Type</th>
                        <th>Units</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $conn->query("SELECT * FROM blood_inventory ORDER BY expiry_date");
                    while($row = $result->fetch_assoc()): 
                        $status = $row['units'] < 5 ? 'Low Stock' : 'Available';
                        $status_class = $row['units'] < 5 ? 'warning' : 'success';
                    ?>
                    <tr class="<?= $row['units'] < 5 ? 'table-warning' : '' ?>">
                        <td><?= $row['id'] ?></td>
                        <td><span class="badge fs-6 bg-danger"><?= $row['blood_type'] ?></span></td>
                        <td><strong><?= $row['units'] ?></strong></td>
                        <td><?= $row['location'] ?></td>
                        <td><?= date('M j', strtotime($row['expiry_date'])) ?></td>
                        <td><span class="badge bg-<?= $status_class ?>"><?= $status ?></span></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-warning">Edit</a>
                            <a href="?delete_stock=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
