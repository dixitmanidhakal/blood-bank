<?php 
session_start(); 
if(!isset($_SESSION['admin'])) { 
    header('Location: admin_login.php'); 
    exit; 
}
include 'config.php';

// ADD STOCK
if(isset($_POST['add_stock'])) {
    $stmt = $conn->prepare("INSERT INTO blood_inventory (blood_type, units, location, expiry_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $_POST['blood_type'], $_POST['units'], $_POST['location'], $_POST['expiry_date']);
    $stmt->execute();
    header('Location: blood_stock.php');
    exit;
}

// DELETE STOCK
if(isset($_GET['delete'])) {
    $stmt = $conn->prepare("DELETE FROM blood_inventory WHERE id = ?");
    $stmt->bind_param("i", $_GET['delete']);
    $stmt->execute();
    header('Location: blood_stock.php');
    exit;
}

// READ
$inventory = $conn->query("SELECT * FROM blood_inventory ORDER BY blood_type")->fetch_all(MYSQLI_ASSOC);
$total_units = $conn->query("SELECT SUM(units) as total FROM blood_inventory")->fetch_assoc()['total'] ?? 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Blood Stock - Blood Bank</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-danger">
        <div class="container-fluid">
            <span class="navbar-brand"><i class="fas fa-warehouse"></i> Blood Stock</span>
            <div>
                <a href="admin_dashboard.php" class="btn btn-outline-light me-2">Dashboard</a>
                <a href="logout.php" class="btn btn-outline-light">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Stats -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h2><?= $total_units ?></h2>
                        <p>Total Blood Units</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Stock Form -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5>Add Blood Stock</h5>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="row">
                        <div class="col-md-3">
                            <select class="form-select" name="blood_type" required>
                                <option value="">Blood Type</option>
                                <option>O+</option><option>O-</option>
                                <option>A+</option><option>A-</option>
                                <option>B+</option><option>B-</option>
                                <option>AB+</option><option>AB-</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="number" class="form-control" name="units" placeholder="Units" required>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="location" value="Main Storage" required>
                        </div>
                        <div class="col-md-3">
                            <input type="date" class="form-control" name="expiry_date" value="<?= date('Y-m-d', strtotime('+30 days')) ?>" required>
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-success w-100" name="add_stock">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Stock Table -->
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5>Blood Inventory</h5>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Blood Type</th>
                            <th>Units</th>
                            <th>Location</th>
                            <th>Expiry Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($inventory as $item): ?>
                        <tr>
                            <td><?= $item['id'] ?></td>
                            <td><span class="badge bg-danger fs-6"><?= $item['blood_type'] ?></span></td>
                            <td><strong><?= $item['units'] ?></strong></td>
                            <td><?= $item['location'] ?></td>
                            <td><?= date('M j, Y', strtotime($item['expiry_date'])) ?></td>
                            <td>
                                <a href="?delete=<?= $item['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
