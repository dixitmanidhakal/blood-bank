<?php 
session_start(); 
if(!isset($_SESSION['admin'])) { header('Location: admin_login.php'); exit; }
include 'config.php';

// ADD DONOR
if(isset($_POST['add_donor'])) {
    $name = $_POST['name'];
    $blood_type = $_POST['blood_type'];
    $phone = $_POST['phone'];
    $location = $_POST['location'];
    $conn->query("INSERT INTO donors (name, blood_type, phone, location, status) VALUES ('$name', '$blood_type', '$phone', '$location', 'available')");
}

// DELETE DONOR
if(isset($_GET['delete'])) {
    $conn->query("DELETE FROM donors WHERE id = " . $_GET['delete']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Donors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark bg-danger">
    <div class="container">
        <a class="navbar-brand"><i class="fas fa-users"></i> Manage Donors</a>
        <a href="admin_dashboard.php" class="btn btn-light">Dashboard</a>
    </div>
</nav>

<div class="container mt-4">
    <!-- ADD DONOR FORM -->
    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            <h4><i class="fas fa-plus"></i> Add New Donor</h4>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="row">
                    <div class="col-md-3"><input type="text" class="form-control" name="name" placeholder="Full Name" required></div>
                    <div class="col-md-2">
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
                    <div class="col-md-2"><input type="text" class="form-control" name="phone" placeholder="Phone" required></div>
                    <div class="col-md-3"><input type="text" class="form-control" name="location" placeholder="Location" required></div>
                    <div class="col-md-2"><button class="btn btn-success w-100" name="add_donor"><i class="fas fa-save"></i> Add</button></div>
                </div>
            </form>
        </div>
    </div>

    <!-- DONORS TABLE -->
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4><i class="fas fa-list"></i> Donors List (<?= $conn->query("SELECT COUNT(*) as total FROM donors")->fetch_assoc()['total'] ?>)</h4>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Blood Type</th>
                        <th>Phone</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $conn->query("SELECT * FROM donors ORDER BY name");
                    while($row = $result->fetch_assoc()): 
                    ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <td><span class="badge fs-6 bg-danger"><?= $row['blood_type'] ?></span></td>
                        <td><?= $row['phone'] ?></td>
                        <td><?= $row['location'] ?></td>
                        <td><span class="badge bg-<?= $row['status']=='available' ? 'success' : 'secondary' ?>"><?= ucfirst($row['status']) ?></span></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-warning">Edit</a>
                            <a href="?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</a>
                            <a href="#" class="btn btn-sm btn-info">View</a>
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
