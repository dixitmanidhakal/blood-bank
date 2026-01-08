<?php
include 'config.php';

// CREATE
if(isset($_POST['create'])) {
    $stmt = $conn->prepare("INSERT INTO donors (name, blood_type, phone, location) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $_POST['name'], $_POST['blood_type'], $_POST['phone'], $_POST['location']);
    $stmt->execute();
    $success = "Donor added successfully!";
}

// UPDATE
if(isset($_POST['update'])) {
    $stmt = $conn->prepare("UPDATE donors SET name=?, blood_type=?, phone=?, location=? WHERE id=?");
    $stmt->bind_param("ssssi", $_POST['name'], $_POST['blood_type'], $_POST['phone'], $_POST['location'], $_POST['id']);
    $stmt->execute();
    $success = "Donor updated successfully!";
}

// DELETE
if(isset($_GET['delete'])) {
    $stmt = $conn->prepare("DELETE FROM donors WHERE id=?");
    $stmt->bind_param("i", $_GET['delete']);
    $stmt->execute();
    $success = "Donor deleted successfully!";
}

// READ
$donors = $conn->query("SELECT * FROM donors ORDER BY name")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Blood Donor Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-danger text-white text-center">
                <h1><i class="fas fa-tint"></i> Blood Donor Management System</h1>
                <a href="admin_login.php" class="btn btn-light btn-sm mt-2">Admin Login</a>
            </div>
            
            <div class="card-body">
                <?php if(isset($success)): ?>
                    <div class="alert alert-success"><?= $success ?></div>
                <?php endif; ?>

                <!-- Add Donor Form -->
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <h5>Add New Donor</h5>
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

                <!-- Donors Table -->
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5>Donors List (<?= count($donors) ?>)</h5>
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
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $donor['id'] ?>">Edit</button>
                                        <a href="?delete=<?= $donor['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</a>
                                    </td>
                                </tr>
                                
                                <!-- Edit Modal -->
                                <div class="modal fade" id="edit<?= $donor['id'] ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5>Edit Donor</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form method="POST">
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="<?= $donor['id'] ?>">
                                                    <div class="mb-3">
                                                        <label>Name</label>
                                                        <input type="text" class="form-control" name="name" value="<?= $donor['name'] ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Blood Type</label>
                                                        <select class="form-select" name="blood_type" required>
                                                            <?php foreach(['O+','O-','A+','A-','B+','B-','AB+','AB-'] as $type): ?>
                                                            <option <?= $donor['blood_type']==$type?'selected':'' ?>><?= $type ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Phone</label>
                                                        <input type="text" class="form-control" name="phone" value="<?= $donor['phone'] ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Location</label>
                                                        <input type="text" class="form-control" name="location" value="<?= $donor['location'] ?>" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" name="update" class="btn btn-warning">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
