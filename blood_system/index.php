<?php
include 'config.php';

// CREATE
if(isset($_POST['create'])) {
    $name = $_POST['name'];
    $blood_type = $_POST['blood_type'];
    $phone = $_POST['phone'];
    $location = $_POST['location'];
    $conn->query("INSERT INTO donors (name, blood_type, phone, location) VALUES ('$name', '$blood_type', '$phone', '$location')");
}

// UPDATE
if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $blood_type = $_POST['blood_type'];
    $phone = $_POST['phone'];
    $location = $_POST['location'];
    $conn->query("UPDATE donors SET name='$name', blood_type='$blood_type', phone='$phone', location='$location' WHERE id=$id");
}

// DELETE
if(isset($_GET['delete'])) {
    $conn->query("DELETE FROM donors WHERE id=" . $_GET['delete']);
}

// READ ALL
$donors = $conn->query("SELECT * FROM donors ORDER BY name")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Blood Donor CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h1><i class="fas fa-tint text-danger"></i> Blood Donor Management</h1>

    <!-- CREATE FORM -->
    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            <h4>Add New Donor</h4>
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

    <!-- READ TABLE -->
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>Donors List (<?= count($donors) ?>)</h4>
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
                            <!-- UPDATE FORM (Inline) -->
                            <form method="POST" class="d-inline" style="width:300px;">
                                <input type="hidden" name="id" value="<?= $donor['id'] ?>">
                                <input type="text" name="name" value="<?= $donor['name'] ?>" class="form-control d-inline w-auto" style="width:80px;">
                                <input type="text" name="blood_type" value="<?= $donor['blood_type'] ?>" class="form-control d-inline w-auto" style="width:60px;">
                                <button class="btn btn-sm btn-warning" name="update">Update</button>
                            </form>
                            <a href="?delete=<?= $donor['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
