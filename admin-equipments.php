<?php
session_start();
require_once './inc/header.php';
require_once './inc/functions.php';
$equipmentController = $controllers->equipment();

// Check for the delete action
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    // Retrieve the id of the equipment to be deleted
    $equipmentId = $_GET['id'];

    // Call a function to handle the deletion
    $equipmentController->delete_equipment($equipmentId);

    // Redirect back to the admin-equipments.php page to avoid duplicate form submissions
    header('Location: admin-equipments.php');
    exit;
}
?>

<div class="container mt-4">
    <h2>Admin Dashboard - Equipment Inventory</h2>
    
    <a href="admin-equipments-add.php" class="btn btn-primary mb-3">Add New Equipment</a>


    <table class="table table-striped">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $equipment = $equipmentController->get_all_equipments();
            foreach ($equipment as $equip): ?>
                <tr>
                    <td>
                        <img src="<?= htmlspecialchars($equip['image']) ?>" 
                            alt="Image of <?= htmlspecialchars($equip['description']) ?>" 
                            style="width: 100px; height: auto;">
                    </td>
                    <td><?= htmlspecialchars($equip['name']) ?></td>
                    <td><?= htmlspecialchars($equip['description']) ?></td>
                    <td>
                        <a href="admin-equipments-edit.php" class="btn btn-warning btn-sm">Edit</a>
                        <a href="admin-equipments.php?action=delete&id=<?= $equip['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<?php require __DIR__ . "/inc/footer.php"; ?>
