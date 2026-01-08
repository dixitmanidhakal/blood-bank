<?php 
session_start(); 
if(!isset($_SESSION['admin'])) { 
    header('Location: admin_login.php'); 
    exit; 
}
include 'config.php';

// ========== CRUD OPERATIONS ==========
if(isset($_POST['create'])) {
    $name = $_POST['name'];
    $blood_type = $_POST['blood_type'];
    $phone = $_POST['phone'];
    $location = $_POST['location'];
    $conn->query("INSERT INTO donors (name, blood_type, phone, location, status) VALUES ('$name', '$blood_type', '$phone', '$location', 'available')");
    header('Location: admin_dashboard.php');
}

if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $blood_type = $_POST['blood_type'];
    $phone = $_POST['phone'];
    $location = $_POST['location'];
    $conn->query("UPDATE donors SET name='$name', blood_type='$blood_type', phone='$phone', location='$location' WHERE id=$id");
    header('Location: admin_dashboard.php');
}

if(isset($_GET['delete'])) {
    $conn->query("DELETE FROM donors WHERE id=" . $_GET['delete']);
    header('Location: admin_dashboard.php');
}

// Stats
$total_donors = $conn->query("SELECT COUNT(*) FROM donors")->fetch_row()[0];
$donors = $conn->query("SELECT * FROM donors ORDER BY name")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>BDMS Admin - CRUD Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-danger">
        <div class="container">
            <a class="navbar-brand">
                <i class="fas fa-tint me-2"></i>BDMS Admin
            </a>
            <a href="logout.php" class="btn btn-outline-light">Logout</a>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Stats -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h1><?= $total_donors ?></h1>
                        <h5>Total Donors</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- ADD DONOR FORM (CREATE) -->
        <div class="card mb-4 shadow">
            <div class="card-header bg-success text-white">
                <h5><i class="fas fa-plus"></i> Add New Donor</h5>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="name" placeholder="Name" required>
                        </div>
                        <div class="col-md-2">
                            <select class="form-select" name="blood_type" required>
                                <option value="">Blood Type</option>
                                <option>O+</option><option>A+</option><option>B+</option><option>AB+</option>
                                <option>O-</option><option>A-</option><option>B-</option><option>AB-</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="phone" placeholder="Phone" required>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="location" placeholder="Location" required>
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-success w-100" name="create">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- DONORS TABLE (READ + UPDATE + DELETE) -->
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5><i class="fas fa-list"></i> Donors List (<?= $total_donors ?>)</h5>
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
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($donors as $donor): ?>
                        <tr>
                            <td><?= $donor['id'] ?></td>
                            <td><?= $donor['name'] ?></td>
                            <td><span class="badge bg-danger"><?= $donor['blood_type'] ?></span></td>
                            <td><?= $donor['phone'] ?></td>
                            <td><?= $donor['location'] ?></td>
                            <td>
                                <!-- UPDATE FORM -->
                                <form method="POST" class="d-inline">
                                    <input type="hidden" name="id" value="<?= $donor['id'] ?>">
                                    <input type="text" name="name" value="<?= $donor['name'] ?>" class="form-control d-inline w-auto me-1" style="width:100px">
                                    <input type="text" name="blood_type" value="<?= $donor['blood_type'] ?>" class="form-control d-inline w-auto me-1" style="width:80px">
                                    <button class="btn btn-warning btn-sm me-1" name="update">Update</button>
                                </form>
                                <!-- DELETE -->
                                <a href="?delete=<?= $donor['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete?')">
                                    Delete
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
