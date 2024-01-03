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

// Check for the edit action
if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
    // Retrieve the id of the equipment to be edited
    $equipmentId = $_GET['id'];

    // Redirect to the edit page with the equipment ID
    header("Location: admin-equipments-edit.php?id=$equipmentId");
    exit;
}

// Check if the action is 'update'
if (isset($_GET['action']) && $_GET['action'] == 'update') {
    // Process the submitted form data
    $id = intval($_POST['id']);
    $name = InputProcessor::processString($_POST['name']);
    $description = InputProcessor::processString($_POST['description']);
    $image = InputProcessor::processString($_POST['image']);

    // Validate inputs
    $valid = $name['valid'] && $description['valid'] && $image['valid'];

    if ($valid) {
        // Update the equipment
        $equipmentData = [
            'id' => $id,
            'name' => $name['value'],
            'description' => $description['value'],
            'image' => $image['value'],
        ];

        $success = $equipmentController->update_equipment($equipmentData);

        if ($success) {
            // Redirect or show success message
            redirect('./admin-equipments.php');
        } else {
            $message = "Failed to update equipment. Please try again.";
        }
    } else {
        $message = "Please fix the above errors:";
    }
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
                        <a href="admin-equipments-edit.php?action=edit&id=<?= $equip['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="admin-equipments.php?action=delete&id=<?= $equip['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require __DIR__ . "/inc/footer.php"; ?>
